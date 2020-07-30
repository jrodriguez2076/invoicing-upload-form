ARG NGINX_IMAGE=gcr.io/linio-support/psc-form-nginx:latest
FROM ${NGINX_IMAGE} AS ASSETS

FROM gcr.io/linio-support/docker-php:7.4-2.4.1 AS DEPENDENCIES

COPY composer.json composer.lock ./

ARG GITHUB_TOKEN
RUN test -n "${GITHUB_TOKEN}" && composer config -g github-oauth.github.com ${GITHUB_TOKEN} || true
RUN composer install --no-scripts -o --no-dev

FROM gcr.io/linio-support/docker-php:7.4-2.4.1  AS PRODUCTION

COPY docker/php/php.ini /usr/local/etc/php/conf.d/overrides.ini

COPY . .
COPY --from=ASSETS /application/public public
COPY --from=DEPENDENCIES /application/vendor /application/vendor

RUN bin/console cache:clear --env=prod \
    && chown -R www-data:www-data var/ 

FROM PRODUCTION AS DEVELOPMENT

ARG GITHUB_TOKEN
RUN test -n "${GITHUB_TOKEN}" && composer config -g github-oauth.github.com ${GITHUB_TOKEN} || true
RUN composer install --no-scripts -o

FROM PRODUCTION
