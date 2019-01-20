# Property Mananger

This is a relevant knowledge demonstration on how to develop a web page using PHP 7, Laravel 5.7 and RESTful API. 
The system manages properties with interaction of Google Maps API to complement address information such as latitude and longitude providing or receiving new property information though RESTful API. 
If you do not know how it works, it is a good manner to analise and learn with this project. 
Enjoy! :)

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

### Prerequisites

1 - Install PHP 7 on your machine;

2 - If you are using Windows, set the Environment Variables adding the PHP folder location;

3 - Copy/Clone the source code/repository to the folder where PHP projects reside;

4 - Create a database with the following configuration provided by Laravel documentation (https://laravel.com/docs/5.7/database):
Open a SGBD, do the login and create a new database with the name "propertymanagement" and select the collation "utf8mb4_unicode_ci"

## Deployment

1 - Config the database migration
Open the Terminal/Command Prompt and run the following:
```
$ cd <folder-where-the-projects-reside>/<project-name>
$ php artisan migrate
```

2 - Run the database seed
Open the Terminal/Command Prompt and run the following:
```
$ php artisan db:seed --class=CitiesTableSeeder
$ php artisan db:seed --class=PropertiesTableSeeder
```

3 - Start the server with the following command line:
```
$ cd <folder-where-the-projects-reside>/<project-name>
$ php artisan serve
```
If you prefer, you can use a different port, for example, 8080
```
$ php artisan serve --port=8080
```

4 - Open your browser and go to the following address:
```
http://localhost:8000
```
If you choose to use a different port like 8080
```
http://localhost:8080
```

## Running the tests

To test the API functions, we will just need the web browser.

### List all properties

On the web browser go to the following address:
```
http://localhost:8000/api/properties
```
It will return a JSON output collection of the data from all property.

### Retrieve a specific property

On the web browser go to the following address adding the property ID at the end, according with you have in your database, like:
```
http://localhost:8000/api/properties/1
http://localhost:8000/api/properties/2
http://localhost:8000/api/properties/3
.
.
.
```
It will return a JSON output with the data from a specific property.

## Built With

* [Laravel](https://laravel.com/docs/5.7/) - PHP Framework
* [Materialize](http://archives.materializecss.com/0.100.2/) - CSS Framework for page style
* [JQuery](https://jquery.com/) - JavaScript AJAX Framework necessary for use some elements of Materialize

## Contributing

Please read [CONTRIBUTING.md](https://gist.github.com/alexandrepro/d81e1f64e82107b7c67cce88e6cf6c6a) for details on our code of conduct, and the process for submitting pull requests to us.

## Versioning

We use [SemVer](http://semver.org/) for versioning.

## Authors

* **Alexandre Portella Ribeiro** - *Initial work* - [Property Mananger](https://github.com/alexandrepro/property-mananger)

## License

This project is licensed under the MIT License
