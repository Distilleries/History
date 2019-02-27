<?php

namespace Tests;

use Illuminate\Support\Facades\Hash;
use Orchestra\Testbench\BrowserKit\TestCase;
use Tests\Models\User;

abstract class HistoryTestCase extends TestCase
{
    /**
     * @var \Tests\Models\User
     */
    protected $user;

    /**
     * {@inheritdoc}
     */
    protected function getPackageProviders($app)
    {
        return [
            'Distilleries\History\HistoryServiceProvider',
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'testing');
        $app['config']->set('database.connections.testing', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }

    protected function setUp()
    {
        parent::setUp();

        $this->loadLaravelMigrations();
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->app['router']->get('items', 'Tests\Http\Controllers\ItemController@index');
        $this->app['router']->post('items', 'Tests\Http\Controllers\ItemController@store');
        $this->app['router']->put('items/{item}', 'Tests\Http\Controllers\ItemController@update');
        $this->app['router']->delete('items/{item}', 'Tests\Http\Controllers\ItemController@delete');

        $this->user = User::create([
            'name'     => 'Tester',
            'email'    => 'test@test.com',
            'password' => Hash::make('password'),
        ]);
    }
}
