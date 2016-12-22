# Artisan Test Helpers

Adds some helper commands to artisan for working with phpunit tests

## Setup

To get started, add the package to your composer.json file, under `require-dev`:

    "dennislindsey/artisan-test-helpers": "dev-master"

Once you've run a `composer update`, you need to register the Laravel service provider, in your `config/app.php`:

```php
'providers' => [
    ...
    DennisLindsey\ArtisanTestHelpers\Providers\ArtisanTestHelperServiceProvider::class,
],
```

Make sure to publish the `stubs` directory to your projects `tests` directory
```shell
$ php artisan vendor:publish --provider="DennisLindsey\ArtisanTestHelpers\Providers\ArtisanTestHelperServiceProvider"
```

## Usage

```shell
$ php artisan make:featuretest NameOfFeature
```

This will generate a file in your project's `/tests/feature/` directory called `NameOfFeatureTest.php`

```php
<?php

class NameOfFeatureTest extends TestCase
{
    // use DatabaseMigrations;

    /** @test */
    function testNameOfFeature()
    {
        // Arrange

        // Act

        // Assert
    }
}
```

```shell
$ php artisan make:unittest NameOfUnit
```

This will generate a file in your project's `/tests/unit/` directory called `NameOfUnitTest.php`

```php
<?php

class NameOfUnitTest extends TestCase
{
    // use DatabaseMigrations;

    /** @test */
    function testNameOfUnit()
    {
        // Arrange

        // Act

        // Assert
    }
}
```