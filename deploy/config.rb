set :application, 'seller-signup-form'
set :web_path, "public"
set :php_fpm_service, 'php7.1-fpm'

set :format_options, log_file: 'var/logs/capistrano.log'

append :linked_files, '.env'

append :copy_files, 'node_modules'

after 'deploy:updated', 'linio:yarn:install'
after "linio:yarn:install", :run_yarn_build do invoke("linio:yarn:run", :build) end
before 'deploy:symlink:release', 'linio:doctrine:migrate'
after 'deploy:cleanup', 'linio:php:fpm:restart'
