// README.md
# Project Support
### Introduction
This Is Simple Book store project where user can see and serach for diffrent books.
### Project Support Features
* Admin user can ogin and create diffrent users and also create books for frontend.
* In frontend user can access side, see books and serach for books via author,title,publisher etc.(Url for Frontens: "/book", Url for Admin:"login")
* all apis and frontend routes define in web.php file
* I am including sample aql file but you can make all tables just by running command (php artisan migrate)
### Installation Guide
* Clone this repository [here](https://github.com/anish3196/bookstore).
* The develop branch is the most stable branch at any given time, ensure you're working from it.
* Run npm install and composer install to install all dependencies
* php artisan migrate command for tables creation in database
* When Anybody start project with "php artisan serve" it will take you to admin panel login, for accessing frontend just go to "/book" url.
* Currently Pagination is set For more than 10 pages So pagination will appear when products are more than 10.
### Usage
* Run npm run watch and php artisan serve  for starting project
### API Endpoints
| HTTP Verbs | Endpoints | Action |
| --- | --- | --- |
|post| /books/create'| To create new Book with admin panel
|get| /books/get_books'| to get all all data of books
|post| /books/edit'| To edit Particulatr book
|post| /books/delete'| for deleting book
|post| /books/upload'| To Upload picture realted to book
|post| /books/imagedelete'| to delte picture from databse for a particular book

//user managment routes
|post| /users/create'| For creating users
|get| /users/get_users'| for getting all data of users
|post| /users/edit'| For editing particualr users data
|post| /users/delete'| For deleting user data from table
|post| /users/admin_login'| for login for users who are authorized
### Technologies Used

* [Laravel](https://laravel.com/docs/9.x) aravel is a free and open-source PHP web framework, created by Taylor Otwell and intended for the development of web applications following the model–view–controller (MVC) architectural pattern and based on Symfony.
* [Vuejs](https://vuejs.org/guide/introduction.html) Vue (pronounced /vjuː/, like view) is a JavaScript framework for building user interfaces. It builds on top of standard HTML, CSS, and JavaScript and provides a declarative and component-based programming model that helps you efficiently develop user interfaces, be they simple or complex.
### Authors
* [Anish Dubey](https://github.com/anish3196)
### License
This project is available for use under the MIT License.