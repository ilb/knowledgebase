pipeline {
    agent any
    stages {
        stage ('Build') {
            steps {
                sh 'git pull --non-interactive /var/www/ssldevel/knowledgebase'
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