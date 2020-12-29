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

2. Go to the project root directory and run `composer install`
3. Run `php init` from the project root directory and configure for your environment
4. Open `common/config/main-local.php`
    - Configure database credentials by changing the following lines
        ```php
        'dsn' => 'mysql:host=localhost;dbname=yii2advanced',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
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
5. Open `common/config/params-local.php`, paste the following key value pairs
    
    
