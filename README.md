# laravel-tools

Some tools for Laravel: flash messages, breadcrumb...

```shell
composer require webup/laravel-tools
```

Provider
```
Webup\LaravelTools\ToolsServiceProvider::class,
```

You can customize view

```
php artisan vendor:publish --tag=tools
```

## Breadcrumb

```php
    // Facade
    'Breadcrumb' => Webup\LaravelTools\Facades\Breadcrumb::class,

    // Make a breadcrumb
    Breadcrumb::push('home', route('home'))
        ->push('title', 'url');

    // include breadcrumb view
    @include('tools::breadcrumb')
```

## Flash message

```php
    // Facade
    'Flash' => Webup\LaravelTools\Facades\Flash::class,

    // Push message
    Flash::info('info message');
    Flash::success('success message');
    Flash::error('error message');
    // Push message with key
    Flash::success('success message', 'confirmation');

    // include flash view
    @include('tools::flash')
    // include flash view for key
    @include('tools::flash', ['key' => 'confirmation'])
```
