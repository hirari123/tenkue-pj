#イメージのベースを指定
FROM php:7.2-fpm

# パッケージ管理ツールapt-getの更新と必要パッケージのインストール
RUN apt-get update \
  && apt-get install -y \
  git \
  zip \
  unzip \
  vim \
  libpq-dev

# composerをインストール
RUN cd /usr/bin \
  && curl -s http://getcomposer.org/installer | php && ln -s /usr/bin/composer.phar /usr/bin/composer

#npmインストール
RUN curl -sL https://deb.nodesource.com/setup_10.x | bash - \
  && apt-get install -y nodejs

#MySQLを使えるようにする
RUN docker-php-ext-install pdo_mysql pdo_pgsql

#コンテナ内に入った時のディレクトリを指定
WORKDIR /var/www/html/laravel-vue-app
