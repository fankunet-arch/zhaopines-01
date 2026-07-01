# 西华招聘（zhaopin.es）

面向西班牙华人服务业的极简信息发布型招聘平台。设计文档见 [`docs/`](docs/00_总览与索引.md)。

## 目录结构（虚拟主机根目录）

```
虚拟主机根目录/
├── zp_html/        ← 网站根目录（document root），URL 可访问
│   ├── index.php   薄壳入口（首页），即 https://www.zhaopin.es/index.php
│   ├── *.php       其余薄壳入口（列表/详情/发布/举报/取号…）
│   ├── user/       用户后台入口
│   ├── admin/      管理员后台入口
│   └── assets/     CSS/JS/图片静态文件
└── app/            ← URL 不可访问（在 document root 之外）
    ├── registry.php    注册表：功能名 → 处理器映射（兼白名单）
    ├── bootstrap.php   公共启动：配置/连库/注册表/公共库
    ├── config/         机密配置（config.php 不进版本库）
    ├── handlers/       各功能真正业务逻辑
    ├── lib/            公共类库（DB/视图/响应…）
    └── views/          服务端渲染模板
```

`zp_html/` 内的 `.php` 均为**薄壳**：不含业务逻辑，只 `require` 上层
`app/bootstrap.php` 并声明功能名，经注册表白名单分发到 `app/handlers/`
内的处理器执行。域名访问 `https://www.zhaopin.es/xxx.php` 即对应
`zp_html/xxx.php`；`app/` 目录任何路径经 URL 均不可达。

## 部署要点

1. **document root 必须指向 `zp_html/`**，确保 `app/` 在其外不可访问。

   Apache 虚拟主机示例：

   ```apache
   <VirtualHost *:443>
       ServerName www.zhaopin.es
       DocumentRoot /var/www/zhaopin/zp_html
       <Directory /var/www/zhaopin/zp_html>
           AllowOverride All
           Require all granted
       </Directory>
   </VirtualHost>
   ```

   Nginx 示例：

   ```nginx
   server {
       server_name www.zhaopin.es;
       root /var/www/zhaopin/zp_html;
       index index.php;
       location ~ \.php$ {
           include fastcgi_params;
           fastcgi_pass unix:/run/php/php8.2-fpm.sock;
           fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
       }
   }
   ```

   双保险：`app/.htaccess` 已内置 `Require all denied`，即使误把 `app/`
   放进可访问路径（部分共享主机），Apache 下也会拒绝一切 HTTP 访问。

2. **机密配置**：复制 `app/config/config.example.php` 为
   `app/config/config.php` 并填写 DB 密码、Google OAuth、Brevo Key。
   该文件已被 `.gitignore` 排除，不入库、不进版本库。

3. **数据库**：MySQL 8.x，表前缀 `zhaopin_`。先执行
   `docs/03_数据库设计.md` 的 DDL，再灌 `docs/seed_regions.sql` 与
   `docs/seed_categories.sql`。

4. **HTTPS 必须**（OAuth 与取号接口）；其余上线闸门项见
   `docs/04_开发路线图.md` §4。

## 本地开发

```bash
cp app/config/config.example.php app/config/config.php   # 填写本地 DB
php -S 127.0.0.1:8000 -t zp_html                         # document root 指向 zp_html/
```
