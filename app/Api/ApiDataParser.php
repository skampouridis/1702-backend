<?php

namespace App\Api;

use App\Api\Exceptions\InvalidRequestParameter;
use App\Api\Parsers\CsvParser;
use App\Api\Parsers\JsonParser;
use App\Api\Parsers\XmlParser;

/**
 * Class ApiDataParser
 *
 * Tha Api data parser for output format.
 *
 * @package App\Api
 */
class ApiDataParser
{
    /**
     * The supported output formats
     *
     * @var array
     */
	private static $supportedFormats = ['csv','json','xml'];

    /**
     * ApiDataParser constructor.
     *
     * @param $parser
     */
	private function __construct($parser)
    {
		$this->parser = $parser;
	}


    /**
     * Returns an ApiDataParser with the relevant instantiated parser
     *
     * @param $data
     * @param $format
     * @return ApiDataParser
     * @throws InvalidRequestParameter
     */
	public static function make($data, $format)
    {
		if (!in_array($format, self::$supportedFormats)) {
            throw new InvalidRequestParameter(
			    'The supported formats are  ['.implode(",",self::$supportedFormats).']  but '. $format .' was provided.'
		    );
		}

        $parser = null;
        switch ($format) {
            case 'csv':
                $parser = new CsvParser($data);
                break;
            case 'json':
                $parser = new JsonParser($data);
                break;
            case 'xml':
                $parser = new XmlParser($data);
                break;
        }

        return new ApiDataParser($parser);
    }

    /**
     * Returns the output based on the relevant parser
     *
     * @return mixed
     */
	public function parse()
    {
		return $this->parser->parse();
	}

}