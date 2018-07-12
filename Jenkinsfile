pipeline {
    agent { docker { image 'cd2team/docker-php:7.0' } }
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
