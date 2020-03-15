# To edit the 'php-fpm' base Image, visit its repository on Github
#    https://github.com/Laradock/php-fpm
#
# To change its version, see the available Tags on the Docker Hub:
#    https://hub.docker.com/r/laradock/php-fpm/tags/
#
# Note: Base Image name format {image-tag}-{php-version}
#

FROM laradock/php-fpm:2.7-7.3

RUN docker-php-ext-install bcmath

# Configure non-root user.
ARG PUID=1000
ENV PUID ${PUID}
ARG PGID=1000
ENV PGID ${PGID}

RUN groupmod -o -g ${PGID} www-data && \
    usermod -o -u ${PUID} -g www-data www-data

# Configure locale.
ARG LOCALE=POSIX
ENV LC_ALL ${LOCALE}

COPY . /var/www

COPY composer.lock composer.json /var/www/

WORKDIR /var/www

# make storage writable by www-data user
RUN chown -R www-data:www-data storage bootstrap/cache

# Install git & curl & supervisor
RUN apt-get update && apt-get -y install git curl

# Install composer and composer packages
RUN curl -s http://getcomposer.org/installer | php \
    && php composer.phar install --no-scripts \
    && rm -f composer.phar

RUN mv .env.production .env

