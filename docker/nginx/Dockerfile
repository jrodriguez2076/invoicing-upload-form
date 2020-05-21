FROM gcr.io/linio-support/docker-node:10-1.0.1 AS DEVELOPMENT

COPY package.json yarn.lock ./
RUN yarn install

COPY . .

FROM gcr.io/linio-support/docker-nginx:2.0.2

COPY docker/nginx/conf.d /etc/nginx/conf.d

COPY --from=DEVELOPMENT /application/public public
