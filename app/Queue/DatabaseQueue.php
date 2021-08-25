<?php

namespace App\Queue;

use App\Queue\Jobs\DatabaseJob;

class DatabaseQueue extends \Illuminate\Queue\DatabaseQueue
{
    protected function buildDatabaseRecord($queue, $payload, $availableAt, $attempts = 0)
    {
        $queueRecord = [
            'queue' => $queue,
            'attempts' => $attempts,
            'reserved_at' => null,
            'available_at' => $availableAt,
            'created_at' => $this->currentTime(),
            'payload' => $payload,
        ];

        if (session()->has('company')) {
            $queueRecord['company_uuid'] = session('company')['uuid'];
        }

        return $queueRecord;
    }

    protected function marshalJob($queue, $job)
    {
        $job = $this->markJobAsReserved($job);

        return new DatabaseJob(
            $this->container, $this, $job, $this->connectionName, $queue
        );
    }
}
