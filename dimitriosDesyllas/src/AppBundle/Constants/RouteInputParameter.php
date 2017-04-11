<?php
namespace AppBundle\Constants;

class RouteInputParameter
{
  const PARAM_MMSI='mmsi';
  const PARAM_LONGTITUDE_MIN='longtitude_min';
  const PARAM_LONGTITUDE_MAX='longtitude_max';
  const PARAM_LATITUDE_MIN='latitude_min';
  const PARAM_LATITUDE_MAX='latitude_max';
  const PARAM_DATE_FROM='date_from';
  const PARAM_DATE_TO='date_to';
  
  const ROUTE_ROUTES_GET_HTTP_PARAMS_THAT_MUST_HAVE=[
  		self::PARAM_DATE_FROM,
  		self::PARAM_DATE_TO,
  		self::PARAM_LATITUDE_MAX,
  		self::PARAM_LATITUDE_MIN,
  		self::PARAM_LONGTITUDE_MAX,
  		self::PARAM_LONGTITUDE_MIN,
  		self::PARAM_MMSI
  ];
}
