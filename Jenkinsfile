pipeline {
    agent { docker { image 'chialab/php:7.0' } }
    stages {
        stage('checkout') {
            steps {
                checkout scm
            }
        }
        stage('build') {
            steps {
                sh "composer install"
            }
        }
        stage('test') {
            steps {
                sh "./vendor/bin/phpunit"
            }
        }
    }
}
