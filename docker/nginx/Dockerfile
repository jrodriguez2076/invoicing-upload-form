FROM gcr.io/linio-support/docker-node:10-0.2.9 AS DEVELOPMENT

COPY package.json yarn.lock ./
RUN yarn install

COPY . .

FROM gcr.io/linio-support/docker-nginx:0.4.12

COPY docker/nginx/conf.d /etc/nginx/conf.d

COPY --from=DEVELOPMENT /application/public public
