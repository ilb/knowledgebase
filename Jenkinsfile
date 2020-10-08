pipeline {
    agent any
    stages {
        stage ('Build') {
            steps {
                sh 'phpunit --log-junit test/build/logs/junit/phpunit.xml -c /var/www/ssldevel/knowledgebase/tests/phpunit/phpunit.xml'
            }
        }
    }
    post {
        always {
            deleteDir()
        }
    }
}