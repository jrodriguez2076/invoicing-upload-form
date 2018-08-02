application = "seller-signup-form"

pipeline {
    agent any

    stages {
        stage("Build") {
            steps {
                parallel(
                    "Configure": {
                        sh "mkdir -p reports"
                    },

                    "PHP": {
                        sh "composer install"
                    },

                    "Ruby": {
                        sh "bundle install --path=vendor/bundle --with=development"
                    }
                )
            }
        }

        stage("Test") {
            steps {
                parallel(
                    "php-cs-fixer": {
                        sh "vendor/bin/php-cs-fixer fix --dry-run -vv --format=junit > reports/php-cs-fixer.xml"
                    },

                    "yaml": {
                        sh "bin/console lint:yaml config"
                        sh "bin/console lint:yaml translations"
                    },

                    "twig": {
                        sh "bin/console lint:twig templates"
                    }
                )
            }
        }

        stage("Deploy") {
            when {
                expression {
                    currentBuild.result == null || currentBuild.result == "SUCCESS"
                }
            }

            steps {
                deploy("master", "development01")
                deploy("production", "staging01")
            }
        }
    }

    post {
        always {
            junit "reports/**/*.xml"
        }
    }
}
