# 基礎映像檔，選擇合適的 PHP 版本
FROM php:8.3.10

# 設置工作目錄
WORKDIR /var/www/html

# 安裝擴充套件
RUN apt-get update && \
    apt-get install -y \
        libzip-dev \
        zip \
        unzip \
    && docker-php-ext-install zip pdo_mysql

# 安裝 Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# 複製 Laravel 專案
COPY . /var/www/html
COPY .env /var/www/html/.env

# 安裝相依套件
RUN composer install

# 暴露端口
EXPOSE 8000

# 啟動指令
CMD ["php", "artisan", "serve", "--host", "0.0.0.0"]