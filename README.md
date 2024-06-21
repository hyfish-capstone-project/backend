# Overview
This is the backend application of Hyfish application.

# Installation
## Prerequisites
These are the tools thats need to be installed before setting up the project:
- Git
- Docker
- Composer (optional for running in local)
- PHP (optional for running in local)

## Clone the Repository
Clone this repository to your machine:
```sh
git clone https://github.com/hyfish-capstone-project/backend
cd backend
```

## Setup Environment
### 1. Create the env file
```sh
cp .env.example .env
```

### 2. Fill the env file
+ `APP_URL`: Base URL of the application, used to access the application from a web browser.
+ `DB_HOST`: Host address of the database service, used to connect to the database.
+ `DB_PORT`: Port number on which the database service is running.
+ `DB_DATABASE`: Name of the specific database within the database service.
+ `DB_USERNAME`: Username used to authenticate with the database service.
+ `DB_PASSWORD`: Password used to authenticate with the database service.
+ `GOOGLE_CLOUD_PROJECT_ID`: Project ID in Google Cloud, used for identifying the project within Google Cloud services.
+ `GOOGLE_CLOUD_STORAGE_BUCKET`: Name of the Google Cloud Storage bucket used for storing objects/files.
+ `PREDICTION_HOST`: Host address of the model deployment service, where the prediction service is running.
+ `PREDICTION_PORT`: Port number on which the model deployment service is running.

### 3. Provide service account file
Create a `service-account.json` file and place it in the `backend` directory, it should contain the key from the service account that has storage admin permission to the GCS bucket.

### 4. Run the application
+ Local
```sh
composer install
php artisan key:generate
php artisan migrate --seed
php artisan serve
```
+ Production
```sh
docker build -t hyfish-api .
docker run --net hyfish-network --ip <INTERNAL_IP> -d -p 3000:3000 --name hyfish-api-container hyfish-api
```
