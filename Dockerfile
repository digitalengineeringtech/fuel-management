FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    supervisor \
    git \
    unzip \
    curl \
    libzip-dev \
    && docker-php-ext-install zip pdo pdo_mysql \
    && pecl install redis \
    && docker-php-ext-enable redis

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy Supervisor configuration file
COPY docker/supervisor/supervisord.conf /etc/supervisor/supervisord.conf

# Copy application source code
COPY . /var/www/html

# Expose necessary ports
EXPOSE 5000

# Start Supervisor as the main process
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/supervisord.conf"]
