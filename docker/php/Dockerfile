FROM yiisoftware/yii2-php:7.2-apache

RUN pwd
RUN ls -la
COPY ./virtualhost.conf /etc/apache2/sites-available/yii2-ecommerce.localhost.conf
RUN ln -s /etc/apache2/sites-available/yii2-ecommerce.localhost.conf /etc/apache2/sites-enabled/yii2-ecommerce.localhost.conf

RUN docker-php-ext-install zip intl mbstring pdo_mysql exif gd

#CMD ["service", "apache2", "reload"]