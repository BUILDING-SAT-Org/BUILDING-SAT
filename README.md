# Building SAT

Building Sustainability Assessment Tool, a tool capable of estimating global warming potential at different life cycle
stages of construction activities. Funded by National Research Council of Sri Lanka under Grant 19-019.

## Requirements

- PHP 8.0.x
- Composer 2.1.x
- Laravel 8.49.x
- MySQL 8.0.x
- System Requirements
  - 2GB Ram Min
  - 2 Core CPU Min
  - 20GB HDD, SSD preferred

## Installation

Check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/8.x/installation)

Clone the repository

    git clone https://github.com/SangeethKarunaratne/BUILDING-SAT.git

Switch to the repo folder

    cd BUILDING-SAT

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the [.env](#env-file) file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Create a symbolic link from public/storage to storage/app/public

    php artisan storage:link

Run the database migrations (**Set the database connection in [.env](#env-file) before migrating**)

    php artisan migrate

### Database seeding

Populate the database with seed data to start the application. (**Add admin user details and database credentials
to [.env](#env-file) before seeding the application.**)

    php artisan db:seed

### File permissions

Run the following commands in the repository root to set the file permissions

    sudo chown -R $USER:www-data .
    sudo find . -type f -exec chmod 664 {} \;
    sudo find . -type d -exec chmod 775 {} \;
    sudo chgrp -R www-data storage bootstrap/cache
    sudo chmod -R ug+rwx storage bootstrap/cache

### Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000

### Cron Jobs

Add the following cron job to make regular backups of the database at 6 hour intervals. Backups will be saved in
database/backups directory

    * * * * * cd PATH && php artisan schedule:run >> /dev/null 2>&1

### User Types

- There are 2 user levels for this application administrator and user.
- To switch from user to administrator, the "role" column in the "users" table must be manually changed from user to
  admin.
- By default, all users will be registered with the role "user".

### .env file

Set the .env with database name and credentials

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=database_name
    DB_USERNAME=****
    DB_PASSWORD=****

Set the .env with gmail smtp details

    MAIL_MAILER=smtp
    MAIL_HOST=smtp.gmail.com
    MAIL_PORT=587
    MAIL_USERNAME=gmail_address
    MAIL_PASSWORD=gmail_password
    MAIL_ENCRYPTION=tls
    MAIL_FROM_ADDRESS=gmail_address
    MAIL_FROM_NAME="${APP_NAME}"

Set the .env with application admin details

    ADMIN_EMAIL=email_address
    ADMIN_ROLE=admin
    ADMIN_SUBSCRIBE_NEWSLETTER=1
    ADMIN_PASSWORD=*****

Set the following as required for debugging the application. When set to 1 logs will be added to the browser console.

    APP_LOG_CLIENT=1
    APP_LOG_CLIENT_EVENTS=0
    APP_LOG_CLIENT_CALCULATIONS=1
    APP_LOG_CLIENT_MODELS=0
    APP_LOG_CLIENT_ERRORS=0
    APP_LOG_CLIENT_HTTP_REQUEST=0

### Browser Compatibility

- Chrome
- Firefox

### Libraries Used

- [Bootstrap v5.1.3](https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js)
- [Vue Js v2.6.14](https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.min.js)
- [JQuery v3.6.0](https://code.jquery.com/jquery-3.6.0.min.js)
- [Bootstrap Table v1.19.1](https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.19.1/bootstrap-table.min.js)
- [Axios v0.26.0](https://cdnjs.cloudflare.com/ajax/libs/axios/0.26.0/axios.min.js)
- [ChartJs v3.7.1](https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js)
- [Apexcharts v3.33.1](https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.33.1/apexcharts.min.js)
- [Lodash v4.17.15](https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.15/lodash.min.js)
- [Vue-Tree-Select](https://github.com/SangeethKarunaratne/vue-treeselect/tree/master)
- [Vue-Form-Generator](https://github.com/SangeethKarunaratne/vue-form-generator/tree/master) 
