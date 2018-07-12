pipeline {
    agent { docker { image 'php' } }
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
