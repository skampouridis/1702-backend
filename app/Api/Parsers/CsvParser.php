<?php

namespace App\Api\Parsers;

/**
 * Class CsvParser
 *
 * @package App\Api\Parsers
 */
class CsvParser extends ApiParser
{

    /**
     * Returns the output as CSV
     *
     * @return mixed
     */
	public function parse()
    {
        $newline = "\n";
        $delimiter = ";";
        $results = [];

        //create the headers of the csv
        $results[] = implode($delimiter,array_keys($this->data[0])).$newline;

		foreach ($this->data as $row) {
		    //create the records of the csv
		    $results[] = implode($delimiter,array_values($row)).$newline;
		}
		return $results;
	}

}