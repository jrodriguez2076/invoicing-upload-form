set :web_path, "public"
set :php_fpm_service, 'php7.1-fpm'

set :format_options, log_file: 'var/log/capistrano.log'

set :linked_files, []

set :default_env, {
  APP_ENV: 'prod'
}

after 'deploy:cleanup', 'linio:php:fpm:restart'
