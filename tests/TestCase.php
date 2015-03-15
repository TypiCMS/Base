<?php
use App\User;

class TestCase extends Illuminate\Foundation\Testing\TestCase {

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

        return $app;
    }

    public function setUp()
    {
        parent::setUp();

        // Start session so we can test post with token.
        Session::start();

        $this->app['path.base'] = __DIR__ . '/..';
        $this->app['config']->set('database.default', 'sqlite');
        $this->app['config']->set('database.connections.sqlite', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
        $this->app['config']->set('translatable.locales', ['en', 'fr']);
        Artisan::call('migrate');
        $this->seed();

        $user = new User(['name' => 'John']);
        $this->be($user);
    }

}
