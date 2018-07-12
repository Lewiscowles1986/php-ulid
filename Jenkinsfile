def docker_images = ["python:2.7.14", "python:3.5.4", "python:3.6.2"]

def get_stages(docker_image) {
    stages = {
        docker.image(docker_image).inside {
            stage("${docker_image}") {
                echo 'Running in ${docker_image}'
            }
            stage("Stage A") {
                switch (docker_image) {
                    case "python:2.7.14":
                        sh 'exit 123'  // for python 2.7.14 we force an error for fun
                        break
                    default:
                        sh 'sleep 10'  // for any other docker image, we sleep 10s
                }
                sh 'echo this is stage A'  // this is executed for all
            }
            stage("Stage B") {
                sh 'sleep 5'
                sh 'echo this is stage B'
            }
            stage("Stage C") {
                sh 'sleep 8'
                sh 'echo this is stage C'
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
    
    parallel stages
}
