set :new_relic_api_key, "2dfb320c93c5013cded743e021ece238f4176041c347db"
set :new_relic_app_name, "seller-signup-form01"

server 'web01.linio-staging.com', user: 'www-data', roles: %w{app}
