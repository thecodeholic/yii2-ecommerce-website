<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Yii2 E-commerce application</h1>
    <br>
</p>

Yii2 E-commerce system built on top of [Yii2 Advanced Template](https://github.com/yiisoft/yii2-app-advanced)

## Installation
1. Clone the repository

1. Go to the project root directory and run `composer install`
1. Run `php init` from the project root directory and choose your desired environment
1. Create the database
1. Open `common/config/main-local.php`
    - Configure database credentials by changing the following lines
        ```php
        'dsn' => 'mysql:host=localhost;dbname=your_website_db',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8mb4',
        ```
    - If you want to use real SMTP credentials to send emails, configure the mail provider by replacing `mailer` component with the following code
        ```php
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'SMTP_HOST',
                'username' => 'SMTP_USERNAME',
                'password' => 'SMTP_PASSWORD',
                'port' => 'SMTP_PORT',
                'encryption' => 'tls',
            ],
        ],
        ```
1. Run `php yii migrate` to apply all system migrations.
1. Create virtual hosts for `frontend/web` and `backend/web` directories.
    Virtual Host templates
    ```
    <VirtualHost *:80>
        ServerName yii2-ecommerce.localhost
        DocumentRoot "/path/to/ecommerce-website/frontend/web/"
        
        <Directory "/path/to/ecommerce-website/frontend/web/">
            # use mod_rewrite for pretty URL support
            RewriteEngine on
            # If a directory or a file exists, use the request directly
            RewriteCond %{REQUEST_FILENAME} !-f
            RewriteCond %{REQUEST_FILENAME} !-d
            # Otherwise forward the request to index.php
            RewriteRule . index.php

            # use index.php as index file
            DirectoryIndex index.php

            # ...other settings...
            # Apache 2.4
            Require all granted
            
            ## Apache 2.2
            # Order allow,deny
            # Allow from all
        </Directory>
    </VirtualHost>
    
    
    <VirtualHost *:80>
        ServerName backend.yii2-ecommerce.localhost
        DocumentRoot "/path/to/ecommerce-website/backend/web/"
        
        <Directory "/path/to/ecommerce-website/backend/web/">
            # use mod_rewrite for pretty URL support
            RewriteEngine on
            # If a directory or a file exists, use the request directly
            RewriteCond %{REQUEST_FILENAME} !-f
            RewriteCond %{REQUEST_FILENAME} !-d
            # Otherwise forward the request to index.php
            RewriteRule . index.php

            # use index.php as index file
            DirectoryIndex index.php

            # ...other settings...
            # Apache 2.4
            Require all granted
            
            ## Apache 2.2
            # Order allow,deny
            # Allow from all
        </Directory>
    </VirtualHost>
    ```
5. Open `common/config/params-local.php` and replace the content with the following code
    Make sure you [create PayPal application](https://developer.paypal.com/developer/applications/) and take ClientId and Secret.
    ```php
    <?php
    return [
        'frontendUrl' => 'YOUR_FRONTEND_HOST', // Ex: http://yii2-ecommerce.localhost
        'paypalClientId' => '',
        'paypalSecret' => '',
        'vendorEmail' => 'admin@yourwebsite.com'
    ];
    ```
    
## Create admin user
Run the following console command to create admin user. PASSWORD is optional, you can skip it and system will generate a random password
```bash
php yii app/create-admin-user USERNAME [PASSWORD]
```
    
