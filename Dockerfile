# Use official PHP + Apache image
FROM php:8.2-apache

# Enable Apache mod_rewrite if needed
RUN a2enmod rewrite

# Copy app into container
COPY . /var/www/html/

# Expose Render's port
EXPOSE 10000

# Configure Apache to listen on Render’s port
RUN sed -i 's/80/${PORT}/g' /etc/apache2/sites-available/000-default.conf
