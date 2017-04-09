<?php

namespace AppBundle\Services;


use AppBundle\Interfaces\AllowIpToProceedWithHttpCallStrategy;
use Snc\RedisBundle\Client\Phpredis\Client as RedisClient;

class AllowIpToCallEndpoint implements AllowIpToProceedWithHttpCallStrategy
{

	/**
	 * @var RedisClient
	 */
	private $redisHandler;


	public function __construct(RedisClient $redisHandler)
	{
		$this->redisHandler=$redisHandler;
	}

	/**
	 * {@inheritDoc}
	 * @see \AppBundle\Interfaces\AllowIpToProceedWithHttpCallStrategy::applyPolicy()
	 */
	public function applyPolicy($ip) {

		$data=$this->getValuesFromRedisByIp($ip);

		if(empty($data)){
			$this->saveIpWithTime($ip);
		} else {
			//var_dump($data);
			$currentTimestamp=new \DateTime(null,new \DateTimeZone('UTC'));
			$firstVisited=\DateTime::createFromFormat('U',$data['date']);

			if($this->isDifferenceAboveSixtyMinutes($currentTimestamp,$firstVisited)){
				$this->resetVisitedTimes($data,$ip);
			} elseif((int)$data['times']>10) {
				return false;
			} else {
				$this->increaseVisitedTimes($data,$ip);
			}
		}

		return true;
	}

	private function saveIpWithTime($ip)
	{
		$currentTimestamp=new \DateTime(null,new \DateTimeZone('UTC'));
		$data=['date'=>$currentTimestamp->format('U'),'times'=>1];
		$this->writeDataToRedis($data,$ip);
	}

	private function increaseVisitedTimes(array $dataFromRedis,$ip)
	{
		$dataFromRedis['times']++;
		$this->writeDataToRedis($dataFromRedis,$ip);
	}

	private function resetVisitedTimes(array $dataFromRedis,$ip)
	{
		$dataFromRedis['times']=1;
		$this->writeDataToRedis($dataFromRedis,$ip);
	}

	private function writeDataToRedis(array $dataFromRedis,$ip)
	{
		$dataFromRedis=json_encode($dataFromRedis);
		$this->redisHandler->set($ip,$dataFromRedis);
	}

	/**
	* @return array | null
	*/
	private function getValuesFromRedisByIp($ip)
	{
		$data=$this->redisHandler->get($ip);

		if(!empty($data)){
			$data=json_decode($data,TRUE);
			//We cast the visited times as integer in order to increase and decrease the visited Times
			$data['times']=(int)$data['times'];
		}

		return $data;
	}

	private function isDifferenceAboveSixtyMinutes(\DateTime $d1, \DateTime $d2)
	{
		$diff=$d1->diff($d2);
		return abs((int)$diff->format('i'))>=60;
	}
}
