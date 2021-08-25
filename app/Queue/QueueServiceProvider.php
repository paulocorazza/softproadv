<?php

namespace App\Queue;

use App\Queue\Connectors\DatabaseConnector;

class QueueServiceProvider extends \Illuminate\Queue\QueueServiceProvider
{
    protected function registerDatabaseConnector($manager)
    {
        $manager->addConnector('database', function () {
            return new DatabaseConnector($this->app['db']);
        });
    }
}
