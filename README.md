# History

History is a package that give you ability log any model event (e.g. `created` or `updated`).

## Requirements

Laravel 5.6.*

## Installation

Require this package via composer.

```bash
composer require distilleries/history
```

Laravel 5.5 uses Package Auto-Discovery, so doesn't require you to manually add the ServiceProvider.

If you don't use auto-discovery, add the ServiceProvider to the providers array in **config/app.php**
```php
Distilleries\History\HistoryServiceProvider::class
```

Copy the package config to your local config with the publish command:
```bash
php artisan vendor:publish --provider="Distilleries\History\HistoryServiceProvider"
```

## Usage

You may add the trait `Distilleries\History\Models\Traits\ManageHistory` to your models.

### Events

By default, `created`, `updated`, `deleted` and `restored` events are logged. You can managed logged events with the `events` array of the configuration file (config/history.php).
You can set any eloquent event. (see https://laravel.com/docs/5.6/eloquent#events)

### Model changes

The package is able to save model changes. By default, models changes are saved on the `updated` event. You may set any eloquent event in the `log` array of the configuration file.
