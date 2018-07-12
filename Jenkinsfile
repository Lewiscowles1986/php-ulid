def docker_images = ['cd2team/docker-php:7.0', 'cd2team/docker-php:7.1', 'cd2team/docker-php:7.2']
def tasks = [:]

def get_tasks(docker_image) {
    tasks = {
        docker.image(docker_image).inside {
            stage("${docker_image}") {
                steps {
                    echo 'Running in ${docker_image}'
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
    return tasks
}


for (int i = 0; i < docker_images.size(); i++) {
    def docker_image = docker_images[i]
    tasks[docker_image] = get_tasks(docker_image)
}

pipeline {
    stage('checkout') {
        steps {
            checkout scm
        }
    }
    stage ("Matrix") {
        parallel tasks
    }
}
