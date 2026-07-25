# Tigshop Project - AI Agent & Architecture Guidelines

> **Notice for AI Assistants**: This document provides the full system architecture, deployment topology, environment configurations, troubleshooting gotchas, and standard operation procedures (SOP) for the **Tigshop** project. Read this carefully before making architectural modifications, deployment suggestions, or code updates.

---

## 1. Project Overview

* **Project Name**: Tigshop E-Commerce Platform
* **Backend Stack**: ThinkPHP 8 (PHP 8.2), MySQL 8.0, Redis, Think-Queue, Swoole
* **Frontend Admin**: Vue 3 + Vite + TypeScript + Element Plus (SPA)
* **Frontend Mobile (H5)**: UniApp (Vue 3 + Vite + TypeScript)
* **Hosting Environment**: Ubuntu 22.04 LTS ECS Instance (`39.96.41.191`) managed via BT-Panel (宝塔面板)

---

## 2. System Architecture & Topology

```
[ Client Browser / Mobile User ]
       │
       ├── Admin Panel (HTTPS)  ───>  https://lxxshop.com:9527
       └── UniApp H5 (HTTPS)    ───>  https://lxxshop.com:8001
                                               │
                                               ▼
┌───────────────────────────────────────────────────────────────────────────┐
│ Ubuntu 22.04 ECS (`39.96.41.191`)                                         │
│                                                                           │
│  ┌──────────────────────────────┐        ┌──────────────────────────────┐ │
│  │ Port 8001 (Nginx Site)       │        │ Port 9527 (Nginx Site)       │ │
│  │ UniApp H5 Static Web         │        │ Admin Panel Static Web       │ │
│  │ Root: /www/water/view/       │        │ Root: /www/water/view/       │ │
│  │ Tigshop-Uniapp/dist/build/h5 │        │ Tigshop-Admin/admin-dist     │ │
│  └──────────────┬───────────────┘        └──────────────┬───────────────┘ │
│                 │ /api Proxy                            │ /adminapi Proxy │
│                 └───────────────────┬───────────────────┘                 │
│                                     ▼                                     │
│                     ┌──────────────────────────────┐                      │
│                     │ Port 8000 (PHP CLI Service)  │                      │
│                     │ ThinkPHP 8 Application API   │                      │
│                     │ Process Guard: Supervisor    │                      │
│                     └───────────────┬──────────────┘                      │
│                                     │ MySQL Connection                    │
│                                     ▼                                     │
│                     ┌──────────────────────────────┐                      │
│                     │ Port 3306 (MySQL Database)   │                      │
│                     │ DB: `user` | User: `user`    │                      │
│                     └──────────────────────────────┘                      │
└───────────────────────────────────────────────────────────────────────────┘
```

### Component Breakdown & Credentials

| Component | Endpoint / Location | Tech & Process | Details |
| :--- | :--- | :--- | :--- |
| **MySQL DB** | `localhost:3306` | MySQL 8.0 | DB: `user` \| User: `user` \| Pass: `123456` |
| **PHP Backend API**| `http://127.0.0.1:8000` | ThinkPHP 8 / PHP 8.2 | Guarded by BT Supervisor (`php think run -p 8000`) |
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
