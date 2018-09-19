namespace :deploy do
    desc "Deploy to development"
    task :development do
        Deploy.new.to_development('seller-signup-form')
    end

    desc "Deploy to production"
    task :production do
        Deploy.new.to_production('seller-signup-form')
    end

    desc "Deploy to staging"
    task :staging do
        Deploy.new.to_staging('seller-signup-form')
    end
end
