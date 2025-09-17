FROM php:8.2-apache

# Update packages and install useful PHP extensions
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Enable Apache mod_rewrite (for routing)
RUN a2enmod rewrite

# Copy project files
COPY . /var/www/html/

# Set Apache DocumentRoot to /public
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Use Render’s dynamic PORT
RUN sed -i 's|80|${PORT}|g' /etc/apache2/ports.conf

EXPOSE 10000
