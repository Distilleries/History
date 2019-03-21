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

History can be found using the model `Distilleries\History\Models\History`.

```php
use Distilleries\History\Models\History;

$log = History::query()->first()
$log->model; // Any of you models
$log->author; // null or any model that can be used to authenticated (e.g. App\User)
```

| attribute     | Type           | Description                                                                                                              |
|---------------|----------------|--------------------------------------------------------------------------------------------------------------------------|
| type          | string         | The eloquent event name.                                                                                                 |
| model_id      | integer        | The related model identifier.                                                                                            |
| model_type    | string         | The related model fully qualified class name.                                                                            |
| author_id     | integer        | The event author identifier.                                                                                             |
| author_type   | string         | The event author fully qualified class name.                                                                             |
| model_changes | array          | The model changes (without hidden attributes). Example : ```['title' => ['old' => 'Old title','new' => 'New title,],]``` |
| created_at    | \Carbon\Carbon | The history created at.                                                                                                  |


### Events

By default, `created`, `updated`, `deleted` and `restored` events are logged. You can managed logged events with the `events` array of the configuration file (config/history.php).
You can set any eloquent event. (see https://laravel.com/docs/5.6/eloquent#events)

### Model changes

The package is able to save model changes. By default, models changes are saved on the `updated` event. You may set any eloquent event in the `log` array of the configuration file.
