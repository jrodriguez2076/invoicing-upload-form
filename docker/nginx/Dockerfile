FROM 137361304112.dkr.ecr.us-east-1.amazonaws.com/docker-nginx:0.2

COPY docker/nginx/conf.d /etc/nginx/conf.d

WORKDIR /application

# Copy our public assets
COPY public public

COPY docker/nginx/linio-nginx-entrypoint /usr/local/bin

ENTRYPOINT ["linio-nginx-entrypoint"]
CMD ["nginx", "-g", "daemon off;"]
