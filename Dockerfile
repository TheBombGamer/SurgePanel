# Use the official PHP image
FROM php:8.0-cli

# Set the working directory
WORKDIR /app

# Copy the current directory contents into the container at /app
COPY . .

# Install any dependencies (if using Composer)
RUN apt-get update && apt-get install -y \
    libzip-dev \
    && docker-php-ext-install zip \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer install

# Expose the port the app runs on
EXPOSE 10000

# Command to run the application
CMD ["php", "-S", "0.0.0.0:10000", "-t", "web"]
