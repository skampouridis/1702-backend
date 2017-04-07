<?php

namespace AppBundle\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\ProgressBar;
use AppBundle\Entity\VesselMoveStatus;
use AppBundle\Entity\Vesel;
use Doctrine\ORM\EntityManager;

class DataInsertCsvCommand extends ContainerAwareCommand
{
	const CSV_FILE_INPUT_PARAM='csv_file';
	
	const MMSID_CSV_ROW_POS=0;
	const STATUS_CSV_ROW_POS=1;
	const SPEED_CSV_ROW_POS=2;
	const LONGTITUDE_CSV_ROW_POS=3;
	const LATITUDE_CSV_ROW_POS=4;
	const COURSE_CSV_ROW_POS=5;
	const HEADING_CSV_ROW_POS=6;
	const ROTATION_CSV_ROW_POS=7;
	const TIMESTAMP_CSV_ROW_POS=8;
	
	/**
	 * We need to store the vesels we alreade Inserted in order NOT to inster it again.
	 * @var array
	 */
	private $veselsInserted=[];
	
	/**
	 * @var EntityManager
	 */
	private $em=null;
	
	protected function configure()
	{
		$this->setName("data:insert:csv")
			->setDescription('Insert data from a csv file.')
			->setHelp('This command allows you to insert the data from a csv file saved in your filesystem')
			->addArgument(self::CSV_FILE_INPUT_PARAM,InputArgument::REQUIRED,'The pathy fo the csv file to read');
	}
	
	protected function execute(InputInterface $input,OutputInterface $output)
	{
		$this->em=$this->getContainer()->get('doctrine')->getManager();
		
		//Progress of insertion
		$progress = new ProgressBar($output);
		
		$csvFileName=$input->getArgument(self::CSV_FILE_INPUT_PARAM);
		$csvFile=fopen($csvFileName,'r');
		
		if($csvFile===FALSE){
			$output->writeln("<error>Could not open the file.\n Please ensure that you given the correct path and have the correct read permissions.</error>");
		} else {
			$firstRowHasAlreadyBeenRead=false;
			$output->writeln("<fg=cyan>Writing the data from CSV file into the database</>");
			$progress->start();
			while(($data=fgetcsv($csvFile,0,";"))!==FALSE){
				//First row does not contain any sort of usefull data therefore we ignore it completely.
				if(!$firstRowHasAlreadyBeenRead){
					$firstRowHasAlreadyBeenRead=true;
					continue;
				}
				$veselToInsert=$this->writeVesselIfNotExists($data[self::MMSID_CSV_ROW_POS]);
				$moveStatusEntity=new VesselMoveStatus(
											$veselToInsert,
											$data[self::STATUS_CSV_ROW_POS],
											$data[self::SPEED_CSV_ROW_POS],
											$data[self::LONGTITUDE_CSV_ROW_POS],
											$data[self::LATITUDE_CSV_ROW_POS],
											$data[self::COURSE_CSV_ROW_POS],
											$data[self::HEADING_CSV_ROW_POS],
											$data[self::ROTATION_CSV_ROW_POS],
											$data[self::TIMESTAMP_CSV_ROW_POS]
										); 
				$this->em->persist($moveStatusEntity);
				$this->em->flush($moveStatusEntity);
				$progress->advance();
				sleep(0.5);
			}
			$progress->finish();
			$output->writeln('');
		}
	}
	
	/**
	 * @return Vesel
	 */
	private function writeVesselIfNotExists($mmsiFromCsv)
	{
		$veselToInsert=null;
		
		if(!isset($this->veselsInserted[$mmsiFromCsv])){
			$veselToInsert=new Vesel($mmsiFromCsv);
			$this->em->persist($veselToInsert);
			$this->em->flush($veselToInsert);
			$this->veselsInserted[$mmsiFromCsv]=$veselToInsert;
		} else {
			$veselToInsert=$this->veselsInserted[$mmsiFromCsv];
		}
		
		return $veselToInsert;
	}
}