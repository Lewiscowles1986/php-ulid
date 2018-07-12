def docker_images = ["cd2team/docker-php:7.0", "cd2team/docker-php:7.1", "cd2team/docker-php:7.2"]

def get_stages(docker_image) {
    stages = {
        docker.image(docker_image).inside {
            stage("${docker_image}") {
                echo 'Running in ${docker_image}'
            }
            stage('build') {
                sh "composer install"
            }
            stage('test') {
                sh "./vendor/bin/phpunit"
            }

        }
    }
    return stages
}

node('master') {
    def stages = [:]
    
    for (int i = 0; i < docker_images.size(); i++) {
        def docker_image = docker_images[i]
        stages[docker_image] = get_stages(docker_image)
    }
    
    stage('checkout') {
        checkout scm
    }
    parallel stages
}
