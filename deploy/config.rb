set :web_path, "public"
set :php_fpm_service, 'php7.1-fpm'

set :format_options, log_file: 'var/log/capistrano.log'

after 'deploy:cleanup', 'linio:php:fpm:restart'
