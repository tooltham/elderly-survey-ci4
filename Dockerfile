# STAGE 1: BUILDER
FROM php:8.3-apache AS builder

# Install build dependencies
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install intl mysqli pdo_mysql zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# STAGE 2: RUNTIME (Production Ready)
FROM php:8.3-apache AS runtime

# Copy extensions and config from builder
COPY --from=builder /usr/local/lib/php/extensions /usr/local/lib/php/extensions
COPY --from=builder /usr/local/etc/php/conf.d /usr/local/etc/php/conf.d

# Install runtime system libraries (required for intl)
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libzip-dev \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Enable Apache ModRewrite
RUN a2enmod rewrite

# Pulsar Optimized PHP Config
RUN echo "memory_limit = 256M" > /usr/local/etc/php/conf.d/pulsar-limits.ini \
    && echo "upload_max_filesize = 20M" >> /usr/local/etc/php/conf.d/pulsar-limits.ini \
    && echo "post_max_size = 20M" >> /usr/local/etc/php/conf.d/pulsar-limits.ini

WORKDIR /var/www/html

# Copy application files
COPY . .

# Set permissions for CI4
RUN chown -R www-data:www-data /var/www/html/writable /var/www/html/public

# Set Apache Document Root to /public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

EXPOSE 80
