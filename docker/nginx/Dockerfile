FROM gcr.io/linio-support/docker-node:10-1.1.0 AS DEVELOPMENT

COPY package.json yarn.lock ./
RUN yarn install

COPY . .

FROM gcr.io/linio-support/docker-nginx:2.0.0

COPY docker/nginx/conf.d /etc/nginx/conf.d

COPY --from=DEVELOPMENT /application/public public
