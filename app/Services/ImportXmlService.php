<?php

namespace App\Services;

use App\Repositories\Contracts\XMLImportInterface;

class ImportXmlService
{
    public function import(XMLImportInterface $xml)
    {
            $xml->importXML();
    }
}
