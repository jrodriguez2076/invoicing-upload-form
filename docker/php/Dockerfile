ARG NGINX_IMAGE=gcr.io/linio-support/psc-form-nginx:latest
FROM ${NGINX_IMAGE} AS assets

FROM gcr.io/linio-support/docker-php:7.4-2.5.3 AS base

FROM base AS dependencies

COPY composer.json composer.lock ./

ARG GITLAB_TOKEN
RUN test -n "${GITLAB_TOKEN}" && composer config -g gitlab-token.gitlab.com ${GITLAB_TOKEN} || true
RUN composer install --no-scripts -o --no-dev

FROM base  AS production

COPY docker/php/php.ini /usr/local/etc/php/conf.d/overrides.ini

COPY . .
COPY --from=assets /application/public public
COPY --from=dependencies /application/vendor /application/vendor

RUN bin/console cache:clear --env=prod \
    && chown -R www-data:www-data var/

FROM production AS development

ARG GITLAB_TOKEN
RUN test -n "${GITLAB_TOKEN}" && composer config -g gitlab-token.gitlab.com ${GITLAB_TOKEN} || true
RUN composer install --no-scripts -o

FROM production
