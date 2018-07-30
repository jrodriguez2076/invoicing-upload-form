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
    }

    post {
        always {
            junit "reports/**/*.xml"
        }
    }
}
