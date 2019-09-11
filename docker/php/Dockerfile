ARG IMAGE_TAG=latest
FROM gcr.io/linio-support/docker-php:7.3-1.0.0 AS BUILD

COPY composer.json composer.lock ./

ARG GITHUB_TOKEN
RUN test -n "${GITHUB_TOKEN}" && composer config -g github-oauth.github.com ${GITHUB_TOKEN} || true
RUN composer install --no-scripts -o

FROM gcr.io/linio-support/psc-form-nginx:$IMAGE_TAG AS ASSETS

FROM gcr.io/linio-support/docker-php:7.3-1.0.0

COPY docker/php/php.ini /usr/local/etc/php/conf.d/overrides.ini

COPY . .
COPY --from=ASSETS /application/public public
COPY --from=BUILD /application/vendor /application/vendor

RUN cp .env.dist .env \
    && bin/console cache:clear --env=prod \
    && chown -R www-data:www-data var/ \
    && rm .env
