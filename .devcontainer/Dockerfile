FROM mcr.microsoft.com/devcontainers/php:7.4-bullseye

# Remove the problematic Yarn repository from the base image
RUN rm /etc/apt/sources.list.d/yarn.list

# Install MariaDB client (your original command, now it will work)
RUN apt-get update && export DEBIAN_FRONTEND=noninteractive \
    && apt-get install -y mariadb-client \
    && apt-get clean -y && rm -rf /var/lib/apt/lists/*

# Install php-mysql driver
RUN docker-php-ext-install mysqli pdo pdo_mysql

# ... rest of your Dockerfile