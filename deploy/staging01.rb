set :new_relic_api_key, "2dfb320c93c5013cded743e021ece238f4176041c347db"
set :new_relic_app_name, "shop-sync01"

server 'worker01.linio-staging.com', user: 'shop-sync', roles: %w{worker}
