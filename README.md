# turbotest
Symfony CRUD test with Turbo UX


## Setup

```
$ git clone ...
```

and then copy .env to .env.local and set your database.

```
$ cd web/
$ composer install
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

[http://localhost:8000/book/](http://localhost:8000/book/)

