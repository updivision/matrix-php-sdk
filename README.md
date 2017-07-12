# Matrix.org PHP SDK
This is a package for using a Matrix chat client into a Laravel Project.

## License

Matrix PHP SDK is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)

## Official Documentation

You can find the Matrix Client-Server API documentation on [Matrix.org](http://matrix.org/docs/api/client-server/) website.

To get started with Matrix PHP SDK, use Composer to add the package to your project's dependencies:

    composer require updivision/matrix-php-sdk

### Configuration

After installing the Matrix PHP SDK, register the `Updivision\Matrix\MatrixServiceProvider` in your `config/app.php` configuration file:

```php
'providers' => [
    // Other service providers...

    Updivision\Matrix\MatrixServiceProvider::class,
],
```

Also, add the `Matrix` facade to the `aliases` array in your `app` configuration file:

```php
'Matrix' => Updivision\Matrix\Facades\Matrix::class,
```