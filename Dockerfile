FROM php:8.2-apache

# Install system dependencies and OpenSSL
RUN apt-get update && apt-get install -y \
    libssl-dev \
    openssl \
    && docker-php-ext-install openssl \
    && rm -rf /var/lib/apt/lists/*

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Copy app into container
COPY . /var/www/html/

# Set DocumentRoot to /public
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf \
    && sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/apache2.conf

# Make sure Apache listens on Render’s dynamic port
RUN sed -i 's/80/${PORT}/g' /etc/apache2/ports.conf

EXPOSE 10000
