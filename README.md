# any-shop

Simple Symfony 3.2 shop example.

## Install

Clone repository and install dependencies:

```sh
$ git clone git@github.com:da-eto-ya/any-shop.git
$ composer install
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

Run scenarios:

```sh
$ ./vendor/bin/behat
```

Testing server at [http://localhost:8089]() will be spawned while Behat runs. 
