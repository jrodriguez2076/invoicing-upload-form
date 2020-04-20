node {
  checkout scm
  dockerLogin()
  project = "psc-form"
  shortCommit = getDeployCommit(env.BRANCH_NAME)
  containers = ["psc-form-php", "psc-form-nginx"]
  buildNeeded = shouldBuild(containers, shortCommit)
}

pipeline {
    agent any

    environment {
        COMPOSE_PROJECT_NAME = "${env.BUILD_TAG}"
    }

    stages {
        stage("build:prod") {
            when {
                expression {
                    buildNeeded
                }
            }

            steps {
                sh "IMAGE_TAG=${shortCommit} docker-compose build nginx"
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
                        sh "docker-compose -f docker-compose.yml -f docker-compose.ci.yml run --rm --name lint-misc-${shortCommit} yarn yarn lint:check"
                    },
                    "lint:php": {
                        sh "IMAGE_TAG=${shortCommit} docker-compose run --rm --name lint-php-${shortCommit} php composer lint:check"
                    },
                    "security:check": {
                        sh "IMAGE_TAG=${shortCommit} docker-compose run --rm --name security-check-${shortCommit} php vendor/bin/security-checker security:check"
                    },
                    "lint:yaml": {
                        sh "IMAGE_TAG=${shortCommit} docker-compose -f docker-compose.yml -f docker-compose.ci.yml run --rm --name lint-yaml-${shortCommit} php bin/console lint:yaml config"
                        sh "IMAGE_TAG=${shortCommit} docker-compose -f docker-compose.yml -f docker-compose.ci.yml run --rm --name lint-yaml-${shortCommit} php bin/console lint:yaml translations"
                    },
                    "lint:twig": {
                        sh "IMAGE_TAG=${shortCommit} docker-compose -f docker-compose.yml -f docker-compose.ci.yml run --rm --name lint-twig-${shortCommit} php bin/console lint:twig templates"
                    }
                )
            }
        }

        stage("deploy:images") {
            when {
                expression {
                    buildNeeded && ["master"].contains(env.BRANCH_NAME) && !env.CHANGE_ID
                }
            }

            steps {
                pushImagesGcr(shortCommit, env.BRANCH_NAME, containers)
            }
        }

        stage("deploy:staging") {
            when {
                expression {
                    ["master"].contains(env.BRANCH_NAME) && !env.CHANGE_ID
                }
            }

            steps {
                deployGitOps2(shortCommit, project, "staging")
            }
        }
    }

    post {
        cleanup {
            dockerComposeCleanup(shortCommit)
        }
    }
}
