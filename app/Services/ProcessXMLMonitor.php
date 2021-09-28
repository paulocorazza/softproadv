<?php

namespace App\Services;

use App\Models\Process;
use App\Repositories\Contracts\XMLIntegrationProcessInterface;

class ProcessXMLMonitor
{
    public function importXML(XMLIntegrationProcessInterface $integration)
    {
        $integration->importXML();
    }
}
