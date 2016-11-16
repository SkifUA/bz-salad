FROM php:7.0-fpm

RUN apt-get update && apt-get install -y apt-utils re2c g++ \
zlib1g zlib1g-dbg zlib1g-dev zlibc \
git

RUN docker-php-ext-install pdo_mysql && docker-php-ext-enable pdo_mysql \
&& docker-php-ext-install zip && docker-php-ext-enable zip

RUN curl -sS https://getcomposer.org/installer | php -- \
	--install-dir=/usr/local/bin \
	--filename=composer

# imagik
RUN runtimeRequirements="libmagickwand-6.q16-dev --no-install-recommends" \
	&& apt-get update && apt-get install -y ${runtimeRequirements} \
	&& ln -s /usr/lib/x86_64-linux-gnu/ImageMagick-6.8.9/bin-Q16/MagickWand-config /usr/bin/ \
	&& pecl install imagick \
	&& echo "extension=imagick.so" > /usr/local/etc/php/conf.d/ext-imagick.ini \
	&& rm -rf /var/lib/apt/lists/*

COPY ./upload.ini /usr/local/etc/php/conf.d/upload.ini

#===Xdebug===#
ADD http://xdebug.org/files/xdebug-2.4.0rc4.tgz /
RUN tar -xvzf /xdebug-2.4.0rc4.tgz \
    && cd xdebug-2.4.0RC4 \
    && phpize && \
    ./configure \
    && make \
    && cp modules/xdebug.so /usr/local/lib/php/extensions/no-debug-non-zts-20151012/

COPY xdebug.ini /usr/local/etc/php/conf.d/
RUN docker-php-ext-enable xdebug

ENV PATH=$PATH:/var/www/docker/bin:/var/www/vendor/bin

RUN apt-get clean && rm -rf /var/lib/apt/lists/*
WORKDIR /var/www