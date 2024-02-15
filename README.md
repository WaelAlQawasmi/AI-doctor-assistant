#  AI-doctor-assistant
<center > <img  width="500" src ="./resources/img/download.png "/> </center>


# Introduction
The Medical Diagnosis Assistance System is a web application designed to assist doctors in diagnosing medical conditions more efficiently. It integrates various technologies, including Laravel 10, Vue.js, MySQL database, and the ChatGPT language model, to provide comprehensive support for medical diagnosis based on patient cases, medical test results, medical history, and other relevant inputs.

## Features
- User Authentication: Secure user authentication system with Laravel's built-in authentication features.
- Role-based Access Control: Implemented using Spatie for managing roles and permissions, ensuring that only authorized users can access certain features.
- Database Integration: MySQL database integration for storing user data, medical cases, medical test results, and other relevant information.
- ChatGPT Integration: Integration of the ChatGPT language model to analyze patient cases and provide diagnostic recommendations.
- Vue.js Frontend: Frontend interface built with Vue.js to provide a dynamic and responsive user experience.
- Medical Case Management: Allows doctors to input patient cases, medical history, symptoms, and other relevant information for analysis.
Diagnostic Recommendations: Generates diagnostic recommendations based on patient input and medical knowledge encoded in the ChatGPT model.
Dashboard: Provides doctors with an overview of ongoing cases, diagnostic history, and other relevant statistics.
## System Architecture
The Medical Diagnosis Assistance System follows a typical client-server architecture:

- Client-side: Built with Vue.js, providing an interactive user interface for doctors to input patient data and view diagnostic recommendations.
- Server-side: Developed with Laravel 10, serving as the backend API to handle user authentication, data storage, and integration with the ChatGPT model.
- Database: Utilizes MySQL as the relational database management system for storing user data, patient cases, diagnostic history, and other relevant information.
Installation and Setup

## How to set up 
- composer install --no-dev
- npm install 
- npm run build 
- create .env file and copy content from .example.env
- setup database in .env file (DB_DATABASE, 
  DB_USERNAME, DB_PASSWORD)
-  generate app key `php artisan key:generate`
-  php artisan migrate
-  php artisan db:seed
- php artisan serve --port 8089

