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

   Nginx 示例（含无扩展名 URL：/publish → publish.php）：

   ```nginx
   server {
       server_name www.zhaopin.es;
       root /var/www/zhaopin/zp_html;
       index index.php;

       location / {
           # 无扩展名请求：先按原样找文件/目录，找不到再映射到 .php
           try_files $uri $uri/ @extless;
       }
       location @extless {
           rewrite ^(.*[^/])/?$ $1.php last;
       }
       location ~ \.php$ {
           # $request_uri 是客户端原始地址，内部 rewrite 不会改变它：
           # 外部直访才触发 301；内部映射来的请求正常执行，不会循环
           # ① /…/index 与 /…/index.php → 301 到目录本身（/ 或 /c/cp/）
           if ($request_uri ~ ^/((?:[^?]*/)?)index(\.php)?(\?|$)) {
               return 301 /$1$is_args$args;
           }
           # ② 其余 /xxx.php → 301 到 /xxx
           if ($request_uri ~ ^/([^?]+)\.php(\?|$)) {
               return 301 /$1$is_args$args;
           }
           include fastcgi_params;
           fastcgi_pass unix:/run/php/php8.2-fpm.sock;
           fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
       }
   }
   ```

   Apache 下无需额外配置：`zp_html/.htaccess` 已内置同等重写规则
   （mod_rewrite），无扩展名 URL 自动映射，显式 `.php` 访问 301 规范化。

   双保险：`app/.htaccess` 已内置 `Require all denied`，即使误把 `app/`
   放进可访问路径（部分共享主机），Apache 下也会拒绝一切 HTTP 访问。

2. **机密配置**：复制 `app/config/config.example.php` 为
   `app/config/config.php` 并填写 DB 密码、Google OAuth、Brevo Key。
   该文件已被 `.gitignore` 排除，不入库、不进版本库。

3. **数据库**：MySQL 8.4/8.x，表前缀 `zhaopin_`，建库文件在 `db/`，
   按顺序执行：

   ```bash
   mysql zhaopin < db/schema.sql            # 12 张表 + settings 初始参数
   mysql zhaopin < db/seed_regions.sql      # 地区种子（19 大区 + 约 90 市）
   mysql zhaopin < db/seed_categories.sql   # 职位类别种子（14 类）
   # 最后插入第一位超级管理员（邮箱换成真实管理员的 Google 邮箱，role=2）：
   mysql zhaopin -e "INSERT INTO zhaopin_admins (email, role, status, created_at)
                     VALUES ('admin@example.com', 2, 1, UTC_TIMESTAMP());"
   ```

   旧库升级执行 `db/migrate_20260703_admin_roles.sql`（管理员分级 +
   发券授权开关），之后管理员在后台「管理员」页维护，无需再动库。
   角色：**超级管理员**（全部功能 + 参数配置 + 管理员管理 + 置顶券）；
   **普通管理员**（信息/类别/举报/失效，置顶券权限由超管开关控制）。

4. **管理后台**：约定入口为 `https://<域名>/c/cp/`（对应
   `zp_html/c/cp/`）。登录仅 Google OAuth + 邮箱白名单（全站零密码），
   回调地址配置为 `<base_url>/c/cp/login.php`。

5. **HTTPS 必须**（OAuth 与取号接口）；其余上线闸门项见
   `docs/04_开发路线图.md` §4。

## 本地开发

```bash
cp app/config/config.example.php app/config/config.php   # 填写本地 DB
# dev_router 模拟生产的无扩展名 URL（内置服务器不解析 .htaccess）
php -S 127.0.0.1:8000 -t zp_html tools/dev_router.php
```

本地调试管理后台（无 Google OAuth 凭据时）：在 `config.php` 的
`dev.fake_admin_email` 填一个已在 `zhaopin_admins` 白名单内的邮箱，
访问 `/c/cp/login.php?dev=1` 直登。**生产环境该项必须留空。**
