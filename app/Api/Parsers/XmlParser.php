<?php

namespace App\Api\Parsers;

use App\Api\Exceptions\InvalidRequestParameter;

/**
 * Class XmlParser
 *
 * @package App\Api\Parsers
 */
class XmlParser extends ApiParser
{
    /**
     * Returns the output as XML
     *
     * @return mixed
     * @throws InvalidRequestParameter
     */
	public function parse()
    {
        $data = $this->data;

        if(!extension_loaded('simplexml')) {
            throw new InvalidRequestParameter('Data cannot be converted to XML. Use csv or json as output-format');
        }
        $structure = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><response/>');

        $structure->addChild('total',sizeof($data));

        foreach($data as $rowKey => $row) {

            $vt = $structure->addChild('vt'.$rowKey);

            foreach($row as $key => $value){

                // convert booleans to 0-1 else they will be converted to blanks.
                if (is_bool($value) || $value === null) {
                    $value = (int) $value;
                }

                // replace anything not alpha numeric
                $key = preg_replace('/[^a-z_\-0-9]/i', '', $key);

                $vt->addChild($key,$value);
            }
        }

		//return the XML
		return $structure->asXML();
	}

}