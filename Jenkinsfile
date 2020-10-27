pipeline {
    agent any
    options {
        buildDiscarder(logRotator(numToKeepStr: '3'))
    }
    stages {
        stage ('Build') {
            steps {
                sh 'umask 022; git -C /var/www/ssldevel/knowledgebase pull'
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