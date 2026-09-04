# Tigshop Project - AI Agent & Architecture Guidelines

> **Notice for AI Assistants**: This document provides the full system architecture, deployment topology, environment configurations, troubleshooting gotchas, and standard operation procedures (SOP) for the **Tigshop** project. Read this carefully before making architectural modifications, deployment suggestions, or code updates.

---

## 1. Project Overview

* **Project Name**: Tigshop E-Commerce Platform
* **Backend Stack**: ThinkPHP 8 (PHP 8.2), MySQL 5.7, Redis, Think-Queue, Swoole
* **Frontend Admin**: Vue 3 + Vite + TypeScript + Element Plus (SPA)
* **Frontend Mobile (H5)**: UniApp (Vue 3 + Vite + TypeScript)
* **Hosting Environment**:
  - **Active Production Server**: Ubuntu 24.04 LTS ECS Instance (`47.104.227.47`, 华北1 青岛)
  - **Legacy / Cold-Standby**: Ubuntu 22.04 LTS ECS Instance (`39.96.41.191`, 华北2 北京)
  - Management: BT-Panel (宝塔面板)

---

## 2. System Architecture & Topology

```
[ Client Browser / Mobile User ]
       │
       ├── Main Domain (HTTP/S) ───>  https://lxxshop.com:80 / 443
       ├── Admin Panel (HTTPS)  ───>  https://lxxshop.com:9527
       └── UniApp H5 (HTTPS)    ───>  https://lxxshop.com:8001
                                               │
                                               ▼
┌───────────────────────────────────────────────────────────────────────────┐
│ Ubuntu 24.04 ECS (`47.104.227.47`)                                        │
│                                                                           │
│  ┌──────────────────────────────┐        ┌──────────────────────────────┐ │
│  │ Port 8001 (Nginx Site)       │        │ Port 9527 (Nginx Site)       │ │
│  │ UniApp H5 Static Web         │        │ Admin Panel Static Web       │ │
│  │ Root: /www/water/view/       │        │ Root: /www/water/view/       │ │
│  │ Tigshop-Uniapp/dist/build/h5 │        │ Tigshop-Admin/admin-dist     │ │
│  └──────────────┬───────────────┘        └──────────────┬───────────────┘ │
│                 │ /api Proxy                            │ /adminapi Proxy │
│                 └───────────────────┬───────────────────┘                 │
│                                     │                                     │
│  ┌──────────────────────────────┐   │                                     │
│  │ Port 80/443 (Nginx Site)     │   │                                     │
│  │ Let's Encrypt Host & Fallback│───┘                                     │
│  │ Root: /www/water/php         │                                         │
│  └──────────────┬───────────────┘                                         │
│                 │ /api Proxy                                              │
│                 ▼                                                         │
│ ┌──────────────────────────────┐                                          │
│ │ Port 8000 (PHP CLI Service)  │                                          │
│ │ ThinkPHP 8 Application API   │                                          │
│ │ Process Guard: Supervisor    │                                          │
│ └───────────────┬──────────────┘                                          │
│                 │ MySQL Connection                                        │
│                 ▼                                                         │
│ ┌──────────────────────────────┐                                          │
│ │ Port 3306 (MySQL Database)   │                                          │
│ │ DB: `user` | User: `user`    │                                          │
│ └──────────────────────────────┘                                          │
└───────────────────────────────────────────────────────────────────────────┘
```

### Component Breakdown & Credentials

| Component | Endpoint / Location | Tech & Process | Details |
| :--- | :--- | :--- | :--- |
| **MySQL DB** | `localhost:3306` | MySQL 5.7.44 | DB: `user` \| User: `user` \| Pass: `123456` |
| **PHP Backend API**| `http://127.0.0.1:8000` | ThinkPHP 8 / PHP 8.2 | Guarded by BT Supervisor (`/www/server/php/82/bin/php think run -p 8000`) |
| **Main Web Entrance**| `https://lxxshop.com` (80/443) | PHP 8.2 + Nginx | Root: `/www/water/php`, Let's Encrypt validation & `/api/` fallback |
| **Admin Panel** | `https://lxxshop.com:9527` | Pure Static + Nginx | Root: `/www/water/view/Tigshop-Admin/admin-dist` |
| **UniApp H5** | `https://lxxshop.com:8001` | Pure Static + Nginx | Root: `/www/water/view/Tigshop-Uniapp/dist/build/h5` |

---

## 3. Core Environment Configurations

### 1) Backend PHP (`php/.env`)
```ini
[DB]
TYPE = mysql
HOST = localhost
NAME = user
USER = user
PASS = 123456
PORT = 3306
```

### 2) Admin Frontend (`view/Tigshop-Admin/.env.production`)
```env
VITE_NODE_ENV = production
VITE_BASE_URL = https://lxxshop.com:9527
VITE_REQUEST_URL_PREFIX = /adminapi
VITE_BASE_DIR = 
```

### 3) UniApp H5 Frontend (`view/Tigshop-Uniapp/.env.production` & `manifest.json`)
* **`.env.production`**:
  ```env
  VITE_NODE_ENV = production
  VITE_API_URL = https://lxxshop.com:9527
  VITE_API_PREFIX = /api/
  ```
* **`src/manifest.json`**:
  ```json
  "h5" : {
      "router" : {
          "mode" : "history",
          "base" : "/"
      }
  }
  ```

---

## 4. Key Gotchas & Troubleshooting Knowledge (AI Instructions)

1. **SSL & Port Redirection Gotcha**:
   - When deploying SSL on custom ports (e.g. 9527, 8001), **NEVER** enable BT-Panel's "Force HTTPS" (强制 HTTPS) toggle. It injects a `rewrite ^(/.*)$ https://$host$1 permanent;` rule that strips the port number and causes 301 redirect loops to Port 443 (`https://lxxshop.com/`).
   - Always ensure `listen <port> ssl;` contains the **`ssl`** keyword in the Nginx site config.

2. **PHP Disabled Functions**:
   - ThinkPHP CLI commands require `passthru`, `exec`, `shell_exec`, `proc_open`, `system`. These must be removed from `disable_functions` in BT-Panel PHP Settings.

3. **PHP `fileinfo` Extension & Low RAM Compilation**:
   - The captcha module (`ajcaptcha`) requires the `fileinfo` PHP extension.
   - Compiling `fileinfo` on a 2GB RAM ECS causes OOM crashes. **Must** enable Swap space before compilation:
     ```bash
     dd if=/dev/zero of=/var/swapfile bs=1M count=2048 && chmod 600 /var/swapfile && mkswap /var/swapfile && swapon /var/swapfile
     ```

4. **UniApp Build Error (`.user.ini` Permission Blocked)**:
   - BT-Panel automatically locks `.user.ini` in web root directories using `chattr +i`.
   - If `npm run build:h5` fails with `EPERM: Operation not permitted`, unlock and remove the file:
     ```bash
     chattr -i /www/water/view/Tigshop-Uniapp/dist/build/h5/.user.ini
     rm -f /www/water/view/Tigshop-Uniapp/dist/build/h5/.user.ini
     ```

5. **Reset Admin Password**:
   - To reset the `admin` account password to `123456` via CLI:
     ```bash
     php -r '$hash = password_hash("123456", PASSWORD_DEFAULT); $m = new mysqli("127.0.0.1", "user", "123456", "user"); $s = $m->prepare("UPDATE admin_user SET password = ? WHERE username = \"admin\""); $s->bind_param("s", $hash); $s->execute();'
     ```

6. **PHP Swoole Extension Missing (`topthink/think-swoole`)**:
   - `composer install` fails with `topthink/think-swoole requires ext-swoole >= 4.4.8`.
   - **Fix**: Install the `swoole` extension in BT-Panel PHP 8.2 settings before running `composer install`. Also run `composer self-update` to eliminate PHP 8.2 return-type notices.

7. **Composer Disabled Functions**:
   - Running `composer install` requires `putenv`, `proc_open`, `proc_get_status` in addition to `passthru`, `exec`, `shell_exec`, `system`. All these must be removed from `disable_functions` in BT-Panel PHP 8.2 settings.

8. **Node.js & npm Path Environment in BT-Panel**:
   - BT Node.js Version Manager installs to `/www/server/nodejs/v<ver>/bin` which is not in the default shell `$PATH`.
   - **Fix**: Write global profile export:
     ```bash
     cat >/etc/profile.d/nodejs.sh <<'EOF'
     export PATH=/www/server/nodejs/v24.18.1/bin:$PATH
     EOF
     chmod +x /etc/profile.d/nodejs.sh
     grep -q '/www/server/nodejs/v24.18.1/bin' /root/.bashrc || echo 'export PATH=/www/server/nodejs/v24.18.1/bin:$PATH' >> /root/.bashrc
     source /etc/profile.d/nodejs.sh && source /root/.bashrc
     ```

9. **Static Storage Alias (`/storage/`) in Nginx**:
   - Uploaded media files are stored locally in `/www/water/php/public/storage/`.
   - Both the Admin site (`9527`) and H5 site (`8001`) Nginx configs must include:
     ```nginx
     location /storage/ {
         alias /www/water/php/public/storage/;
     }
     ```
     Without this, image requests to `https://lxxshop.com:9527/storage/...` or `https://lxxshop.com:8001/storage/...` return 404 broken images.

10. **Supervisor Stuck 8000 Port Recovery**:
    - If restarting the Supervisor daemon fails because port 8000 is still held:
      ```bash
      lsof -i:8000 | awk 'NR>1 {print $2}' | xargs kill -9
      ```
    - Supervisor program path: `/www/server/php/82/bin/php think run -p 8000` under directory `/www/water/php/`.

---

## 5. Deployment SOP (Standard Operating Procedure)

### Scenario A: Updating Backend PHP Code (`php/`)
PHP is an interpreted language; **no build step is required**:
```bash
cd /www/water/php && git pull
# Restart PHP service via BT Supervisor OR CLI:
pkill -f "php think" && nohup php think run -p 8000 > /dev/null 2>&1 &
```

### Scenario B: Updating Admin Frontend (`view/Tigshop-Admin/`)
```bash
cd /www/water/view/Tigshop-Admin && git pull
npm run build:prod
# Force-refresh browser (Cmd + Shift + R / Ctrl + F5)
```

### Scenario C: Updating UniApp Mobile H5 (`view/Tigshop-Uniapp/`)
```bash
cd /www/water/view/Tigshop-Uniapp && git pull
npm run build:h5
# Force-refresh browser (Cmd + Shift + R / Ctrl + F5)
```

### Scenario D: One-Click Full-Stack Deployment
```bash
cd /www/water/php && git pull && pkill -f "php think" && nohup php think run -p 8000 > /dev/null 2>&1 & && cd /www/water/view/Tigshop-Admin && git pull && npm run build:prod && cd /www/water/view/Tigshop-Uniapp && git pull && npm run build:h5
```
