FROM php:8.3-apache

# Set working directory
WORKDIR /var/www/html

# Copy application files
COPY . /var/www/html/

# Set default environment variables for database
ENV DB_HOST=localhost
ENV DB_USER=root
ENV DB_PASSWORD=
ENV DB_NAME=UnityGrid_db

# Install PHP extensions
RUN apt-get update && \
    apt-get install -y \
        curl \
        libzip-dev \
        default-mysql-client && \
    docker-php-ext-install \
        mysqli \
        pdo \
        pdo_mysql \
        zip && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

# Enable Apache modules
RUN a2enmod rewrite

# Configure Apache document root and directory permissions
RUN echo '<VirtualHost *:80>' > /etc/apache2/sites-available/000-default.conf && \
    echo '    ServerAdmin webmaster@localhost' >> /etc/apache2/sites-available/000-default.conf && \
    echo '    DocumentRoot /var/www/html' >> /etc/apache2/sites-available/000-default.conf && \
    echo '    <Directory /var/www/html>' >> /etc/apache2/sites-available/000-default.conf && \
    echo '        Options -Indexes' >> /etc/apache2/sites-available/000-default.conf && \
    echo '        AllowOverride All' >> /etc/apache2/sites-available/000-default.conf && \
    echo '        Require all granted' >> /etc/apache2/sites-available/000-default.conf && \
    echo '    </Directory>' >> /etc/apache2/sites-available/000-default.conf && \
    echo '    ErrorLog ${APACHE_LOG_DIR}/error.log' >> /etc/apache2/sites-available/000-default.conf && \
    echo '    CustomLog ${APACHE_LOG_DIR}/access.log combined' >> /etc/apache2/sites-available/000-default.conf && \
    echo '</VirtualHost>' >> /etc/apache2/sites-available/000-default.conf

# Create uploads directory with proper permissions
RUN mkdir -p /var/www/html/uploads /var/www/html/assets && \
    chown -R www-data:www-data /var/www/html/ && \
    chmod 755 /var/www/html/assets && \
    chmod 755 /var/www/html/uploads

# Create volume for persistent file uploads
VOLUME ["/var/www/html/uploads"]

# Expose port for discoverability
EXPOSE 80

# Use the default Apache entrypoint
CMD ["apache2-foreground"]
