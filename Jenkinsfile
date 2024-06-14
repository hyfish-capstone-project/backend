pipeline {
    agent any
    triggers {
        pollSCM '* * * * *'
    }
    stages {
        stage('Workspace Cleanup') {
            steps {
                cleanWs()
            }
        }
        stage('Checkout') {
            steps {
                checkout scm
            }
        }
        stage('Set up Environment') {
            steps {
                script {
                    withCredentials([file(credentialsId: 'hyfish-api-env', variable: 'ENV_FILE')]) {
                        sh 'cp $ENV_FILE .env'
                    }
                    
                    withCredentials([file(credentialsId: 'hyfish-storage-key', variable: 'SERVICE_ACCOUNT_FILE')]) {
                        sh 'cp $SERVICE_ACCOUNT_FILE service-account.json'
                    }
                }
            }
        }
        stage('Build Docker Image') {
            steps {
                script {
                    sh 'docker stop hyfish-api-container || true'
                    sh 'docker system prune -af'
                    sh 'docker build -t hyfish-api .'
                }
            }
        }
        stage('Run Docker Container') {
            steps {
                script {
                    sh 'docker run --net hyfish-network --ip 192.168.1.10 -d -p 3000:3000 --name hyfish-api-container hyfish-api'
                }
            }
        }
    }
     post {
        success {
            script {
                def commitMessage = sh(script: 'git log -1 --pretty=%B', returnStdout: true).trim()

                withCredentials([
                    string(credentialsId: 'discord-webhook', variable: 'DISCORD_WEBHOOK_URL'),
                    string(credentialsId: 'hyfish-api-url', variable: 'DEPLOYMENT_URL'),
                    string(credentialsId: 'hyfish-api-documentation-url', variable: 'DOCUMENTATION_URL')
                ]) {
                    discordSend description: "Server:\n${DEPLOYMENT_URL}\n\nAPI Documentation:\n${DOCUMENTATION_URL}\n\nLast Commit:\n\"${commitMessage}\"", 
                                footer: 'Jenkins CI/CD', 
                                link: env.BUILD_URL, 
                                result: currentBuild.currentResult, 
                                title: 'Build Successful', 
                                webhookURL: DISCORD_WEBHOOK_URL
                }
            }
        }
        failure {
            script {
                withCredentials([string(credentialsId: 'discord-webhook', variable: 'DISCORD_WEBHOOK_URL')]) {
                    discordSend description: 'Deployment Failed', 
                                footer: 'Jenkins CI/CD', 
                                link: env.BUILD_URL, 
                                result: currentBuild.currentResult, 
                                title: 'Build Failed', 
                                webhookURL: DISCORD_WEBHOOK_URL
                }
            }
        }
    }
}
