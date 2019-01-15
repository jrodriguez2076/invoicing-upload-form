namespace :deploy do
    desc "Deploy to development"
    task :development do
        Deploy.new.to_development('psc-form')
    end

    desc "Deploy to production"
    task :production do
        Deploy.new.to_production('psc-form')
    end

    desc "Deploy to staging"
    task :staging do
        Deploy.new.to_staging('psc-form')
    end
end
