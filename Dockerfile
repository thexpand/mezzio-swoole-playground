FROM phpswoole/swoole:4.6-php7.4-alpine

ENV PHP_CONFIG "${PHP_INI_DIR}/conf.d/custom.ini"

RUN mkdir /app
WORKDIR /app

# Install PHP extensions
RUN apk add --update --no-cache \
    && apk add --no-cache --virtual build-dependencies \
           pcre-dev \
           ${PHPIZE_DEPS} \
        && pecl install -o -f inotify \
        && rm -rf /tmp/pear \
        && docker-php-ext-enable inotify \
        && apk del build-dependencies

# Configure PHP
RUN echo "memory_limit = -1" >> ${PHP_CONFIG}

# Install composer dependencies
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
COPY composer.* ./
RUN composer install --no-scripts --no-dev --no-autoloader \
    && rm -rf /root/.composer

# Copy the rest of the project, generate composer autoload files
COPY . .
RUN composer dump-autoload

CMD ["./vendor/bin/laminas", "mezzio:swoole:start", "--num-task-workers=1"]
