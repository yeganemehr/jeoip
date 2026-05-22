FROM node:22-alpine AS frontend-builder
WORKDIR /app

COPY package.json package-lock.json ./
RUN npm install

COPY . /app/
RUN npm run build


FROM dunglas/frankenphp:1.12.2-php8.4-alpine

RUN --mount=type=bind,source=.docker/fs,target=/mnt \
	install-php-extensions bcmath zip && \
    apk add --no-cache supervisor && \
    curl -s https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin/ --filename=composer && \
    cp -Rv /mnt/* / && \
	mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

COPY --from=frontend-builder /app/public/build /app/public/build
COPY --exclude=./docker --exclude=./Dockerfile . /app

RUN composer i --no-cache --optimize-autoloader --no-dev

CMD ["/bin/start"]
