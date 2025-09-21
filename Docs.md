<h3>Important notes</h3>

# Library 

A Laravel-based Library Management System to manage **Books, Authors, and Borrowings** with user authentication.  
Supports both **Web UI (CRUD)** and **REST API**.

---

## Features

- **Authors** – Create, read, update, delete authors.
- **Books** – Manage books with author relationships.
- **Authentication** – Secured with Laravel Breeze
- **Borrowings** – Borrow and return books, track due dates, read counts.
- **REST API** – JSON endpoints for integration.
 
## Database

- DB_CONNECTION=mysql
- DB_HOST="MySQL-8.0"
- DB_PORT=3306
- DB_DATABASE=library_db
- DB_USERNAME=root
- DB_PASSWORD=

## Routes
- GET|HEAD        / ........................................................................................................................  
- GET|HEAD        authors ........................................................................... authors.index › AuthorController@index  
- POST            authors ........................................................................... authors.store › AuthorController@store  
- GET|HEAD        authors/create .................................................................. authors.create › AuthorController@create  
- GET|HEAD        authors/{author} .................................................................... authors.show › AuthorController@show  
- PUT|PATCH       authors/{author} ................................................................ authors.update › AuthorController@update  
- DELETE          authors/{author} .............................................................. authors.destroy › AuthorController@destroy  
- GET|HEAD        authors/{author}/edit ............................................................... authors.edit › AuthorController@edit  
- GET|HEAD        books ................................................................................. books.index › BookController@index  
- POST            books ................................................................................. books.store › BookController@store  
- GET|HEAD        books/create ........................................................................ books.create › BookController@create  
- GET|HEAD        books/{book} ............................................................................ books.show › BookController@show  
- PUT|PATCH       books/{book} ........................................................................ books.update › BookController@update  
- DELETE          books/{book} ...................................................................... books.destroy › BookController@destroy  
- GET|HEAD        books/{book}/edit ....................................................................... books.edit › BookController@edit  
- GET|HEAD        borrowings .................................................................. borrowings.index › BorrowingController@index  
- POST            borrowings .................................................................. borrowings.store › BorrowingController@store  
- GET|HEAD        borrowings/create ......................................................... borrowings.create › BorrowingController@create  
- GET|HEAD        borrowings/{borrowing} ........................................................ borrowings.show › BorrowingController@show  
- PUT|PATCH       borrowings/{borrowing} .................................................... borrowings.update › BorrowingController@update  
- DELETE          borrowings/{borrowing} .................................................. borrowings.destroy › BorrowingController@destroy  
- GET|HEAD        borrowings/{borrowing}/edit ................................................... borrowings.edit › BorrowingController@edit 
