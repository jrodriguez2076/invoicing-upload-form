node {
  checkout scm
  sh "eval \$(aws ecr get-login --no-include-email)"
  shortCommit = sh(returnStdout: true, script: "git log -n 1 --pretty=format:'%h'").trim()
  lastCommitParent = sh(returnStdout: true, script: "git log -n 1 --pretty=format:'%h' | git show --no-patch --format=\"%p\" | awk '{print \$2}'").trim()
  deployCommit = lastCommitParent ? lastCommitParent : shortCommit
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
                    env.BRANCH_NAME != "production"
                }
            }

            steps {
                sh "echo Installing yarn dependencies"
                sh "docker-compose -f docker-compose.cli.yml run --rm -v \${PWD}:/application --name dep-js-" + shortCommit + " yarn"
            }
        }

        stage("build:prod") {
            when {
                expression {
                    env.BRANCH_NAME != "production"
                }
            }

            steps {
                sh "IMAGE_TAG=" + shortCommit + " docker-compose build --pull --build-arg GITHUB_TOKEN"
            }
        }

        stage("test:prep") {
            when {
                expression {
                    env.BRANCH_NAME != "production"
                }
            }

            steps {
                sh "echo Creating services so the network is not duplicated"
                sh "IMAGE_TAG=" + shortCommit + " docker-compose up --no-start"
                sh "echo Copying .env.dist to .env"
                sh "cp .env.dist .env"
            }
        }

        stage("test") {
            when {
                expression {
                    env.BRANCH_NAME != "production"
                }
            }

            steps {
                parallel(
                    "lint:prettier": {
                        sh "docker-compose -f docker-compose.cli.yml run --rm -v \${PWD}:/application --name lint-misc-" + shortCommit + " yarn lint:check"
                    },
                    "lint:php": {
                        sh "IMAGE_TAG=" + shortCommit + " docker-compose run --rm -e LINIO_ENV=production --name lint-php-" + shortCommit + " php composer lint:check"
                    },
                    "security:check": {
                        sh "IMAGE_TAG=" + shortCommit + " docker-compose run --rm -e LINIO_ENV=production --name security-check-" + shortCommit + " php vendor/bin/security-checker security:check"
                    },
                    "lint:yaml": {
                        sh "IMAGE_TAG=" + shortCommit + " docker-compose -f docker-compose.yml -f docker-compose.ci.yml run --rm -e LINIO_ENV=production -e STORE=mx --name lint-yaml-" + shortCommit + " php bin/console lint:yaml config"
                        sh "IMAGE_TAG=" + shortCommit + " docker-compose -f docker-compose.yml -f docker-compose.ci.yml run --rm -e LINIO_ENV=production -e STORE=mx --name lint-yaml-" + shortCommit + " php bin/console lint:yaml translations"
                    },
                    "lint:twig": {
                        sh "IMAGE_TAG=" + shortCommit + " docker-compose -f docker-compose.yml -f docker-compose.ci.yml run --rm -e LINIO_ENV=production -e STORE=mx --name lint-twig-" + shortCommit + " php bin/console lint:twig templates"
                    }
                )
            }
        }

        stage("deploy:latest") {
            when {
                expression {
                    env.BRANCH_NAME == "master"
                }
            }

            steps {
                sh "docker tag 137361304112.dkr.ecr.us-east-1.amazonaws.com/seller-signup-form-php:" + shortCommit + " 137361304112.dkr.ecr.us-east-1.amazonaws.com/seller-signup-form-php:latest"
                sh "docker tag 137361304112.dkr.ecr.us-east-1.amazonaws.com/seller-signup-form-nginx:" + shortCommit + " 137361304112.dkr.ecr.us-east-1.amazonaws.com/seller-signup-form-nginx:latest"
                sh "docker-compose -f docker-compose.yml push"
            }
        }

        stage("deploy:staging") {
            when {
                expression {
                    (currentBuild.result == null || currentBuild.result == "SUCCESS") && env.BRANCH_NAME == "production"
                }
            }

            steps {
                sh "docker pull 137361304112.dkr.ecr.us-east-1.amazonaws.com/docker-rake:latest"
                sh "docker run --rm -e REVISION=" + deployCommit + " -v \${HOME}/.kube/config:/root/.kube/config -v \${PWD}:/application -e RELEASE_CONTROL_API_KEY 137361304112.dkr.ecr.us-east-1.amazonaws.com/docker-rake:latest deploy:staging"
            }
        }

        stage("deploy:development") {
            when {
                expression {
                    (currentBuild.result == null || currentBuild.result == "SUCCESS")  && env.BRANCH_NAME == "master"
                }
            }

            steps {
                sh "IMAGE_TAG=" + shortCommit + " docker-compose push"
                sh "docker pull 137361304112.dkr.ecr.us-east-1.amazonaws.com/docker-rake:latest"
                sh "docker run --rm -e REVISION=" + shortCommit + " -v \${HOME}/.kube/config:/root/.kube/config -v \${PWD}:/application -e RELEASE_CONTROL_API_KEY 137361304112.dkr.ecr.us-east-1.amazonaws.com/docker-rake:latest deploy:development"
            }
        }
    }

    post {
        cleanup {
            sh "IMAGE_TAG=" + shortCommit + " docker-compose down --rmi all || true"
        }
    }
}
