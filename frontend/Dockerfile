FROM yiisoftware/yii2-php:7.2-apache

# Change document root for Apache
RUN sed -i -e 's|/app/web|/app/frontend/web|g' /etc/apache2/sites-available/000-default.conf
RUN echo "ServerName 127.0.0.1" >> /etc/apache2/apache2.conf
RUN cp docker/apache2/virtualhost.conf /etc/apache2/sites-available/yii2-ecommerce.localhost.conf
RUN ln -s /etc/apache2/sites-available/yii2-ecommerce.localhost.conf /etc/apache2/sites-enabled/yii2-ecommerce.localhost.conf