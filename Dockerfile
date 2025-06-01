FROM unit:1.34.1-php8.3

# Set working directory
WORKDIR /var/www

# Copy application files
COPY . /var/www/

# Set default environment variables for database
ENV DB_HOST=localhost
ENV DB_USER=root
ENV DB_PASSWORD=
ENV DB_NAME=UnityGrid_db

# Install PHP extensions and Node.js
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
    curl -fsSL https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get install -y nodejs && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

# Install npm dependencies and build assets
RUN npm install && \
    npm run copy-assets

# Create Unit configuration
RUN echo '{ \
    "listeners": { \
        "*:80": { \
            "pass": "routes" \
        } \
    }, \
    "routes": [ \
        { \
            "match": { \
                "uri": "/" \
            }, \
            "action": { \
                "share": "/var/www/", \
                "index": "index.html" \
            } \
        }, \
        { \
            "match": { \
                "uri": "*.php" \
            }, \
            "action": { \
                "pass": "applications/php" \
            } \
        }, \
        { \
            "action": { \
                "share": "/var/www/" \
            } \
        } \
    ], \
    "applications": { \
        "php": { \
            "type": "php", \
            "root": "/var/www/" \
        } \
    } \
}' > /docker-entrypoint.d/config.json

# Create uploads directory with proper permissions
RUN mkdir -p /var/www/uploads && \
    chown -R unit:unit /var/www/ && \
    chmod 755 /var/www/uploads

# Create volume for persistent file uploads
VOLUME ["/var/www/uploads"]

# Expose port
EXPOSE 80

# Use the default Unit entrypoint
CMD ["unitd", "--no-daemon", "--control", "unix:/var/run/control.unit.sock"] 