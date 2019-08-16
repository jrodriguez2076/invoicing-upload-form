FROM gcr.io/linio-support/docker-php:7.3-0.3.12 AS BUILD

COPY composer.json composer.lock ./

ARG GITHUB_TOKEN
RUN test -n "${GITHUB_TOKEN}" && composer config -g github-oauth.github.com ${GITHUB_TOKEN} || true
RUN composer install -o --no-scripts

FROM gcr.io/linio-support/docker-php:7.3-0.3.12

COPY docker/php/php.ini /usr/local/etc/php/conf.d/overrides.ini

COPY . .
COPY --from=BUILD /application/vendor /application/vendor

# See https://github.com/symfony/symfony/issues/26573 for more info on the env var situation
RUN cp .env.dist .env \
    && bin/console cache:clear --env=prod \
    && chown -R www-data:www-data var/ \
    && rm .env
