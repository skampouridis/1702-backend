<?php

namespace App;

use Maatwebsite\Excel\Files\ExcelFile;

class ShipPositionsListImport extends ExcelFile
{
    protected $delimiter  = ';';
    protected $enclosure  = '"';
    protected $lineEnding = '\r\n';

    public function getFile()
    {
        return database_path('seeds/csv/ship_positions/ship_positions.csv');
    }

    public function getFilters()
    {
        return [
            'chunk'
        ];
    }
}