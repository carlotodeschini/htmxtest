# turbotest
Symfony CRUD test with Turbo UX


## Setup

```
$ git clone ...
```

and then copy .env to .env.local and set your database.

Make sure you have 'yarn' installed and PHP 8.1.

```
$ cd web/
$ composer install
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

## References

[Blog Post "Modal forms with Django+HTMX" from Benoit Blanchon](https://blog.benoitblanchon.fr/django-htmx-modal-form/)
[Video tutorial](https://www.youtube.com/watch?v=3dyQigrEj8A&ab_channel=BenoitBlanchon)
