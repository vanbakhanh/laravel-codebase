FROM ubuntu:bionic
WORKDIR /application
EXPOSE 9000

# Fixes some weird terminal issues such as broken clear / CTRL+L
ENV TERM=linux

# Ensure apt doesn't ask questions when installing stuff
ENV DEBIAN_FRONTEND=noninteractive

# Install Ondrej repos for Ubuntu Bionic, PHP7.4, composer and selected extensions
RUN apt-get update \
    && apt-get -y --no-install-recommends install gnupg \
    && echo "deb http://ppa.launchpad.net/ondrej/php/ubuntu bionic main" > /etc/apt/sources.list.d/ondrej-php.list \
    && apt-key adv --keyserver keyserver.ubuntu.com --recv-keys 4F4EA0AAE5267A6C \
    && apt-get update \
    && apt-get -y --no-install-recommends install \
    ca-certificates \
    curl \
    unzip \
    vim \
    php-apcu \
    php-apcu-bc \
    php7.4-cli \
    php7.4-curl \
    php7.4-gd \
    php7.4-json \
    php7.4-mbstring \
    php7.4-opcache \
    php7.4-readline \
    php7.4-xml \
    php7.4-zip \
    php7.4-fpm \
    php7.4-mysql \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer clear-cache \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/* ~/.composer

STOPSIGNAL SIGQUIT

# PHP-FPM packages need a nudge to make them docker-friendly
COPY overrides.conf /etc/php/7.4/fpm/pool.d/z-overrides.conf

CMD ["/usr/sbin/php-fpm7.4", "-O" ]