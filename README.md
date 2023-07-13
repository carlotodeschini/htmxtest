# htmxtest

Symfony CRUD test with HTMX library.

This is a simple web site with 3 entities: book, genre of the book, author of the book.

I generated the 3 crud web interfaces with Symfony make bundle ('make:entity' and then 'make:crud') and then I modified the book controller and templates to use HTMX library to have a SPA behaviour: new, show and edit book in a bootstrap modal, delete book confirmation also with bootstrap modal.

The goal is to compare standard Symfony CRUD form with HTMX CRUD form. So:

* author CRUD is the symfony standard CRUD with generated plain HTML template
* genre CRUD is the symfony standard CRUD with generated plain HTML template
* book is a modified CRUD using HTMX, bootstrap library ad a very little of javascript

My goal is to show how simply is to use HTMX with Symfony standard backend ;-)

## Setup

```
$ git clone ...
```

and then copy .env to .env.local and set your database; by default .env use sqlite.

Make sure you have PHP 8.1, 'composer', 'yarn' and 'symfony' command installed.


```
$ cd web/
$ composer install/update
$ yarn install
$ yarn dev
```

Run migrations:

```
$ php bin/console doctrine:migration:migrate
```

and start HTTP server

```
$ symfony server:start
```

go to

[https://localhost:8000/book/](https://localhost:8000/book/)

## To simply test EasyAdmin

go to

[https://localhost:8000/admin/](https://localhost:8000/admin/)


## References

- [Symfony PHP framework](https://symfony.com/)
- [HTMX - high power tools for HTML](https://htmx.org/)
- Blog Post ["Modal forms with Django+HTMX"](https://blog.benoitblanchon.fr/django-htmx-modal-form/) from Benoit Blanchon inspiring article and [Video tutorial](https://www.youtube.com/watch?v=3dyQigrEj8A&ab_channel=BenoitBlanchon)
