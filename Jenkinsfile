Jenkinsfile (Declarative Pipeline)
pipeline {
    agent { docker { image 'php' } }
    stages {
        stage('checkout') {
            checkout scm
        }
        stage('build') {
            sh "composer install"
        }
        stage('test') {
            sh "./vendor/bin/phpunit"
        }
    }
}
