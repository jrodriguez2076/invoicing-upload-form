require 'capistrano/scm/git'
require 'capistrano/linio'
require 'capistrano/symfony'

install_plugin Capistrano::SCM::Git

Dir.glob('deploy/tasks/*.rake').each { |r| import r }
