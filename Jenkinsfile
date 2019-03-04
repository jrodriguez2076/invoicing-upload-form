node {
  checkout scm
  dockerLogin()
  shortCommit = getDeployCommit(env.BRANCH_NAME)
  containers = ["psc-form-php", "psc-form-nginx"]
  buildNeeded = shouldBuild(containers, shortCommit)
  dockerRegistry = getDockerRegistry()
}

pipeline {
    agent any

    environment {
        COMPOSE_PROJECT_NAME = "${env.BUILD_TAG}"
    }

    stages {
        stage("build:prep") {
            when {
                expression {
                    buildNeeded
                }
            }

            steps {
                echo "Installing yarn dependencies"
                sh "docker-compose -f docker-compose.cli.yml run --rm -v \${PWD}:/application --name dep-js-${shortCommit} yarn"
            }
        }

        stage("build:prod") {
            when {
                expression {
                    buildNeeded
                }
            }

            steps {
                dockerComposeBuild(shortCommit)
            }
        }

        stage("test:prep") {
            when {
                expression {
                    buildNeeded
                }
            }

            steps {
                dockerComposeCreateNetworkServices(shortCommit)

                echo "Copying .env.dist to .env"
                sh "cp .env.dist .env"
            }
        }

        stage("test") {
            when {
                expression {
                    buildNeeded
                }
            }

            steps {
                parallel(
                    "lint:prettier": {
                        sh "docker-compose -f docker-compose.cli.yml run --rm -v \${PWD}:/application --name lint-misc-${shortCommit} yarn lint:check"
                    },
                    "lint:php": {
                        sh "IMAGE_TAG=${shortCommit} docker-compose run --rm -e LINIO_ENV=production --name lint-php-${shortCommit} php composer lint:check"
                    },
                    "security:check": {
                        sh "IMAGE_TAG=${shortCommit} docker-compose run --rm -e LINIO_ENV=production --name security-check-${shortCommit} php vendor/bin/security-checker security:check"
                    },
                    "lint:yaml": {
                        sh "IMAGE_TAG=${shortCommit} docker-compose -f docker-compose.yml -f docker-compose.ci.yml run --rm -e LINIO_ENV=production -e STORE=mx --name lint-yaml-${shortCommit} php bin/console lint:yaml config"
                        sh "IMAGE_TAG=${shortCommit} docker-compose -f docker-compose.yml -f docker-compose.ci.yml run --rm -e LINIO_ENV=production -e STORE=mx --name lint-yaml-${shortCommit} php bin/console lint:yaml translations"
                    },
                    "lint:twig": {
                        sh "IMAGE_TAG=${shortCommit} docker-compose -f docker-compose.yml -f docker-compose.ci.yml run --rm -e LINIO_ENV=production -e STORE=mx --name lint-twig-${shortCommit} php bin/console lint:twig templates"
                    }
                )
            }
        }

        stage("deploy:images") {
            when {
                expression {
                    buildNeeded && ["master"].contains(env.BRANCH_NAME)
                }
            }

            steps {
                pushImages(shortCommit, env.BRANCH_NAME, containers)
            }
        }

        stage("deploy:staging") {
            when {
                expression {
                    env.BRANCH_NAME == "production"
                }
            }

            steps {
                dockerRake(shortCommit, "staging")
            }
        }

        stage("deploy:development") {
            when {
                expression {
                    env.BRANCH_NAME == "master"
                }
            }

            steps {
                dockerRake(shortCommit, "development")
            }
        }
    }

    post {
        cleanup {
            dockerComposeCleanup(shortCommit)
        }
    }
}
