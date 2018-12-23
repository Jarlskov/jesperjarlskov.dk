FROM ubuntu:18.04

RUN useradd -ms /bin/bash -u 1337 vessel
WORKDIR /var/www/html

ENV TZ=Etc/UTC
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN apt-get update \
    && apt-get install -y apt-utils curl zip unzip git supervisor sqlite3 \
    && apt-get install -y nginx php7.2-fpm php7.2-cli php7.2-gd php7.2-mysql \
       php7.2-pgsql php7.2-imap php-memcached php7.2-mbstring php7.2-xml php7.2-curl \
       php7.2-imagick php7.2-zip php7.2-bcmath php7.2-sqlite3 php7.2-xdebug \
    && php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer \
    && mkdir /run/php \
    && apt-get -y autoremove \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* \
    && echo "daemon off;" >> /etc/nginx/nginx.conf

RUN ln -sf /dev/stdout /var/log/nginx/access.log \
    && ln -sf /dev/stderr /var/log/nginx/error.log

COPY h5bp /etc/nginx/h5bp
COPY default /etc/nginx/sites-available/default
COPY php-fpm.conf /etc/php/7.1/fpm/php-fpm.conf
COPY xdebug.ini /etc/php/7.1/mods-available/xdebug.ini

EXPOSE 80

COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY start-container /usr/local/bin/start-container
RUN chmod +x /usr/local/bin/start-container

ENTRYPOINT ["start-container"]
