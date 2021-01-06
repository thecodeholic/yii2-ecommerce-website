<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Yii2 E-commerce application</h1>
    <br>
</p>

Yii2 E-commerce system


## Features
 - Bootstrap 4
 - Custom [Admin template](https://startbootstrap.com/theme/sb-admin-2) in backend
 - Product Management
 - Implement cart page
 - Checkout for guests
 - Checkout for authorized users
 - Sending email when order is made
 - Payments with PayPal - [PayPal buttons](https://developer.paypal.com/demo/checkout/#/pattern/client)
 - Order validation
 - Display order in backend
 - Dashboard with basic statistics
    - Total earnings
    - Total products sold
    - Total number of orders made
    - Total users
    - Earnings by day
    - Revenue by country

## Demo

I am working on demo. It will be available soon.

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
1. Open `common/config/params-local.php` and replace the content with the following code
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
   
## Building assets
The project uses webpack to build the assets.<br>
The project styles and bootstrap styles are built together.
Source files are located in `frontend/scss` and `backend/js`.

#### Bootstrap customization
If you want to customize bootstrap variables, open `frontend/scss/bootstrap-variables.scss`
and override any bootstrap variable.<br>
Check [the following link](https://getbootstrap.com/docs/4.0/getting-started/theming/) for more information about bootstrap customization


#### For Development
Run`npm run dev` to build the files and start watching them. This will generate unminified versions of the files
and will generate source maps as well

#### For production
Run `npm run prod` to build the files for production. This will generate minified files.

    
## Create admin user
Run the following console command to create admin user. PASSWORD is optional, you can skip it and system will generate a random password
```bash
php yii app/create-admin-user USERNAME [PASSWORD]
```
