## Table of contents
* [General info](#general-info)
* [Technologies](#technologies)
* [Prerequisites](#prerequisites)
* [Setup](#setup)

## General info
This project helps to aggregate the news from different sources and helps to search and pin for later use.
	
## Technologies
Project is created with:
* React js: 3.1.5
* Typescript: 5.2.2
* tailwind CSS: 3.4.7
* Vite: 5.3.4
* laravel: 10.10
* php: 8.1

## Prerequisites
* node js
* php: 8.1
* Composer
* Apache Http server.   

## Setup
To run this project:

* Pull this git project from master branch, or if you already have this project the use it (if using xammp then pull the project in htdocs folder and if wamp place it in www folder)
* In the root folder of the project, create the .env file or edit if exists. Provide guardian api key in the .env file. update the front end url in the .env. 
* Get the backend dependencies by the following command 
```
composer install
```
* Get the frontend dependencies by the following command
```
cd front-end
```
```
npm install
```
* Run the backend server 
```
php artisan serve
```
* Run the frontend vite server
```
npm run dev
```
