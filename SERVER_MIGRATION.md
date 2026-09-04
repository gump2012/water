# Tigshop 服务器完整迁移与部署实战手册 (SOP)

> 本手册根据从原北京服务器 (`39.96.41.191`, Ubuntu 22.04) 迁移至新青岛服务器 (`47.104.227.47`, Ubuntu 24.04) 的全流程实战踩坑整理。

---

## 1. 服务器配置基准

| 配置项 | 原服务器 (老) | 目标服务器 (新) |
| :--- | :--- | :--- |
| **公网 IP** | `39.96.41.191` (华北2 北京) | `47.104.227.47` (华北1 青岛) |
| **规格配置** | 2核 4G, 3Mbps, Ubuntu 22.04 64位 | 2核 4G, 3Mbps, Ubuntu 24.04 64位 |
| **软件环境** | Nginx 1.20+, MySQL 5.7, Redis 8.0, PHP 8.2 | Nginx 1.20+, MySQL 5.7.44, Redis 8.0.5, PHP 8.2.33 |
| **Node.js** | Node.js Manager (LTS) | Node.js 24.18.1, npm 11.16.0 |
| **项目路径** | `/www/water` | `/www/water` |

---

## 2. 第一步：基础环境与软件依赖安装

### 1) 开启 Swap 交换分区（防止 4G 内存编译构建 OOM）
```bash
dd if=/dev/zero of=/var/swapfile bs=1M count=4096 && chmod 600 /var/swapfile && mkswap /var/swapfile && swapon /var/swapfile
echo "/var/swapfile swap swap defaults 0 0" >> /etc/fstab
```

### 2) 宝塔软件商店安装基础服务
- **Web 服务**: Nginx 1.20+
- **数据库**: MySQL 5.7.44
- **缓存**: Redis 8.0.5
- **PHP**: PHP-8.2 (8.2.33)
- **管理器**: 进程守护管理器 3.0.6, Node.js版本管理器 2.8

### 3) PHP 8.2 必须安装的扩展
登录宝塔面板 -> **软件商店** -> **PHP-8.2** -> **设置** -> **安装扩展**：
1. **`fileinfo`**（图形验证码 ajcaptcha、图片上传必选）
2. **`redis`**（系统缓存、session、队列依赖）
3. **`swoole`**（**核心必装**：ThinkPHP `topthink/think-swoole` 依赖 `ext-swoole >= 4.4.8`，未安装会导致 `composer install` 直接报错中断）

### 4) PHP 8.2 禁用函数解禁
在 **PHP-8.2** -> **设置** -> **禁用函数**，删除以下函数：
- `putenv`（Composer 必须）
- `proc_open`（Composer 依赖进程派生）
- `proc_get_status`
- `passthru`（ThinkPHP CLI 命令及进程守护需要）
- `exec`, `shell_exec`, `system`

### 5) 修复 Node.js / npm 环境变量（解决 npm command not found）
宝塔 Node.js 管理器安装在独立路径，默认全局终端无法识别 `node`/`npm`，执行以下脚本写入 PATH：
```bash
cat >/etc/profile.d/nodejs.sh <<'EOF'
export PATH=/www/server/nodejs/v24.18.1/bin:$PATH
EOF
chmod +x /etc/profile.d/nodejs.sh
grep -q '/www/server/nodejs/v24.18.1/bin' /root/.bashrc || echo 'export PATH=/www/server/nodejs/v24.18.1/bin:$PATH' >> /root/.bashrc
source /etc/profile.d/nodejs.sh
source /root/.bashrc

# 验证
node -v  # 应输出 v24.18.1
npm -v   # 应输出 11.16.0
```

---

## 3. 第二步：数据库导出与迁移

### 1) 从原服务器或本地导出数据库
```bash
# 原服务器导出（或本地上传导出的 sql）
mysqldump -u user -p123456 --default-character-set=utf8mb4 user > /www/user_backup.sql
```

### 2) 上传至新服务器
```bash
# 从本地使用 scp 上传至新服务器
scp /Users/gump/Downloads/user_xxxx.sql root@47.104.227.47:/www/backup/database/mysql/
```

### 3) 新服务器创建数据库并导入
1. 在新服务器宝塔面板 -> **数据库** -> **添加数据库**：
   - 数据库名：`user`
   - 用户名：`user`
   - 密码：`123456`
   - 字符集：`utf8mb4`
2. 点击刚建好的 `user` 数据库右侧 **【导入】** -> **从备份文件导入**，选择刚才上传的 SQL 文件完成导入。

---

## 4. 第三步：代码部署与依赖构建

### 1) 拉取主仓库代码
```bash
cd /www/
git clone https://github.com/gump2012/water.git
cd /www/water
```

### 2) 后端依赖安装与权限配置
```bash
cd /www/water/php

# 升级 composer 并安装依赖
composer self-update
composer install --no-dev --optimize-autoloader

# 赋予运行时写权限
chmod -R 777 runtime
chmod -R 777 public/storage
```

### 3) 同步原服务器用户上传的持久化媒体文件（防商品图片裂开）
```bash
# 在原服务器打包上传目录
cd /www/water/php/public
tar -czvf /www/uploads_storage.tar.gz storage/ uploads/ 2>/dev/null || tar -czvf /www/uploads_storage.tar.gz storage/

# 推送到新服务器
scp /www/uploads_storage.tar.gz root@47.104.227.47:/www/water/php/public/

# 在新服务器解压
cd /www/water/php/public/
tar -xzvf uploads_storage.tar.gz
rm -f uploads_storage.tar.gz
chmod -R 777 storage
```

### 4) 配置 Supervisor 进程守护（PHP CLI 8000 端口）
进入宝塔面板 -> **进程守护管理器** -> **添加守护进程**：
- **名称**：`tigshop-api`
- **运行用户**：`www`
- **运行目录**：`/www/water/php/`
- **启动命令**：`/www/server/php/82/bin/php think run -p 8000`
- **进程数量**：`1`

> 遇到 8000 端口占用或重启命令：
> `lsof -i:8000 | awk 'NR>1 {print $2}' | xargs kill -9`

### 5) 构建 Admin 后台前端 (`Tigshop-Admin`)
```bash
cd /www/water/view/Tigshop-Admin
npm install --registry=https://registry.npmmirror.com
npm run build:prod
# 产物生成在 /www/water/view/Tigshop-Admin/admin-dist
```

### 6) 构建 UniApp H5 移动前端 (`Tigshop-Uniapp`)
```bash
cd /www/water/view/Tigshop-Uniapp
npm install --registry=https://registry.npmmirror.com

# 宝塔避坑：解除 .user.ini 锁定
chattr -i /www/water/view/Tigshop-Uniapp/dist/build/h5/.user.ini 2>/dev/null
rm -f /www/water/view/Tigshop-Uniapp/dist/build/h5/.user.ini 2>/dev/null

npm run build:h5
# 产物生成在 /www/water/view/Tigshop-Uniapp/dist/build/h5
```

---

## 5. 第四步：宝塔三大 Nginx 站点建立与对齐

在宝塔中一共建立 3 个站点，各自承载不同职责：

```
                    ┌── 80 / 443 (主站) ─────────> PHP 源码 (/www/water/php) + 证书验证目录 + /api/ 兜底
lxxshop.com ────────┼── 9527 (Admin 后台) ───────> Admin 静态产物 (/admin-dist) + /adminapi/ 代理
                    └── 8001 (UniApp H5 / API) ──> H5 静态产物 (/build/h5) + /api/ 代理 + /storage/
```

### 站点 1：主站点 `lxxshop.com`（端口 80 / 443）
- **职责**：标准 HTTP/HTTPS 访问入口、Let's Encrypt 证书验证与续签根节点、全局 `/api/` 及 `/storage/` 访问兜底。
- **添加站点**：
  - 域名：`lxxshop.com`
  - 根目录：`/www/water/php`
  - PHP 版本：`PHP-82`
- **伪静态**：选择 `thinkphp`。
- **配置文件关键代理补充**（在 `access_log` 前追加）：
  ```nginx
  # 代理 ThinkPHP 8000 CLI 服务接口
  location /api/ {
      proxy_pass http://127.0.0.1:8000;
      proxy_set_header Host $http_host;
      proxy_set_header X-Real-IP $remote_addr;
      proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
      proxy_set_header X-Forwarded-Proto $scheme;
  }

  # 静态上传文件访问
  location /storage/ {
      alias /www/water/php/public/storage/;
  }
  ```

---

### 站点 2：管理后台 `lxxshop.com_9527`（端口 9527）
- **职责**：Element Plus + Vue 3 管理后台 SPA 页面及 `/adminapi/` 代理。
- **添加站点**：
  - 域名：`lxxshop.com:9527`
  - 根目录：`/www/water/view/Tigshop-Admin/admin-dist`
  - PHP 版本：`纯静态`
- **SSL 设置**：
  - 填入证书及私钥（复用主站证书）。
  - ⚠️ **切勿开启“强制 HTTPS”**！
- **伪静态**（必须配置）：
  ```nginx
  location / {
      try_files $uri $uri/ /index.html;
  }

  # 后端管理 API 反向代理
  location /adminapi {
      proxy_pass http://127.0.0.1:8000;
      proxy_set_header Host $host;
      proxy_set_header X-Real-IP $remote_addr;
      proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
  }

  # 本地存储静态资源防裂开
  location /storage/ {
      alias /www/water/php/public/storage/;
  }
  ```

---

### 站点 3：移动端 H5 与 API 门户 `lxxshop.com_8001`（端口 8001）
- **职责**：UniApp 移动商城静态页面、小程序 API 通信门户、微信支付异步通知回调入口。
- **添加站点**：
  - 域名：`lxxshop.com:8001`
  - 根目录：`/www/water/view/Tigshop-Uniapp/dist/build/h5`
  - PHP 版本：`纯静态`
- **SSL 设置**：
  - 填入证书及私钥。
  - ⚠️ **切勿开启“强制 HTTPS”**！
  - **SSL 路径防坑**：若报错 `cannot load certificate ... No such file`，请检查配置文件中的 `ssl_certificate` 路径，统一指向 `/www/server/panel/vhost/cert/lxxshop.com/fullchain.pem`。
- **伪静态**（必须配置）：
  ```nginx
  location / {
      try_files $uri $uri/ /index.html;
  }

  # 前端业务 API 反向代理
  location /api {
      proxy_pass http://127.0.0.1:8000;
      proxy_set_header Host $host;
      proxy_set_header X-Real-IP $remote_addr;
      proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
  }

  # 静态上传文件访问
  location /storage/ {
      alias /www/water/php/public/storage/;
  }
  ```

---

## 6. 第五步：防火墙与安全组放行

在阿里云控制台 **安全组规则（入方向）** 确保已放行：
- `80`, `443`
- `8001`
- `9527`
- `8888`（或当前宝塔自定义端口）
- `22` (SSH)

---

## 7. 第六步：DNS 切换与全链路验证清单

1. **修改 DNS 解析**：
   - 将 `lxxshop.com` 的 A 记录由老 IP `39.96.41.191` 改为新 IP `47.104.227.47`。
2. **后台验证**：
   - 访问 `https://lxxshop.com:9527`，测试管理员登录、商品列表、图片展示。
3. **H5 / 小程序验证**：
   - 访问 `https://lxxshop.com:8001`，测试商品浏览、加入购物车、下单。
4. **微信支付回调验证**：
   - 支付 0.01 元测试，确认微信异步通知推送至 `https://lxxshop.com:8001/api/order/pay/notify`，后台状态秒变“已支付”。
