FROM nginx:1.17-alpine

ARG APP_HOST
ENV APP_HOST=$APP_HOST

RUN set -x \
    && apk update \
    && apk upgrade \
    && apk add openssl \
    mc \
    sudo \
    && apk del gcc g++ \
    && rm -rf /var/cache/apk/*

COPY nginx/ssl /var/www/ssl

RUN mkdir -p /etc/nginx/certs \
    && mkdir -p /local/logs \
    && openssl req -new -out /var/www/ssl/app.csr -newkey rsa:2048 -nodes -sha256 -keyout /etc/nginx/certs/app.key -config /var/www/ssl/openssl.cnf \
    && openssl x509 -req -in /var/www/ssl/app.csr -CA /var/www/ssl/CA/ca.pem -CAkey /var/www/ssl/CA/ca-key.pem -CAcreateserial -extensions v3_req -extfile /var/www/ssl/alt_domains.cnf -out /etc/nginx/certs/app.cer -days 5000
