# any-shop

Simple Symfony 3.2 shop example.

## Install

Clone repository:

```sh
$ git clone git@github.com:da-eto-ya/any-shop.git
```

Copy `app/config/parameters.yml.dist` to `app/config/parameters.yml`
and fill it with actual parameters.

Run development server:

```sh
$ php bin/console server:run localhost:8080
```

Then development version should be available at [http://localhost:8080]()
and production version (for development purpose) should be available at [http://localhost:8080/app.php]().

## Testing

Run testing server from application directory:

```sh
$ php bin/console server:run --env=test localhost:8089
```

Then application should be available at [http://localhost:8089/app_test.php]().

Run scenarios:

```sh
$ ./vendor/bin/behat
```
