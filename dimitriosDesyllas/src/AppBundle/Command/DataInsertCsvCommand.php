<?php

namespace AppBundle\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use AppBundle\Entity\VesselMoveStatus;
use Symfony\Component\Console\Helper\ProgressBar;

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
	
	
	protected function configure()
	{
		$this->setName("data:insert:csv")
			->setDescription('Insertd data from a csv file.')
			->setHelp('This command allows you to insert the data from a csv file')
			->addArgument(self::CSV_FILE_INPUT_PARAM,InputArgument::REQUIRED,'The pathy fo the csv file to read');
	}
	
	protected function execute(InputInterface $input,OutputInterface $output)
	{
		$em=$this->getContainer()->get('doctrine')->getManager();
		
		$progress = new ProgressBar($output);
		
		$csvFile=$input->getArgument(self::CSV_FILE_INPUT_PARAM);
		$csvFile=fopen($csvFile,'r');
				
		if($csvFile===FALSE){
			$output->writeln("<error>Could not open the file.\n Please ensure that you given the correct path and have the correct read permissions.</error>");
		} else {
			$firstRowHasAlreadyBeenRead=false;
			
			$output->writeln("<fg=cyan>Could not open the file.\n Please ensure that you given the correct path and have the correct read permissions.</>");
			$progress->start();
			while(($data=fgetcsv($csvFile,0,";"))!==FALSE){
				//First row does not contain usefull data therefore we ignore it completely.
				if(!$firstRowHasAlreadyBeenRead){
					$firstRowHasAlreadyBeenRead=true;
					continue;
				}
								
				$entity=new VesselMoveStatus(
											$data[self::MMSID_CSV_ROW_POS],
											$data[self::STATUS_CSV_ROW_POS],
											$data[self::SPEED_CSV_ROW_POS],
											$data[self::LONGTITUDE_CSV_ROW_POS],
											$data[self::LATITUDE_CSV_ROW_POS],
											$data[self::COURSE_CSV_ROW_POS],
											$data[self::HEADING_CSV_ROW_POS],
											$data[self::ROTATION_CSV_ROW_POS],
											$data[self::TIMESTAMP_CSV_ROW_POS]
										); 
				$em->persist($entity);
				$progress->advance();
				sleep(0.5);
			}
			$progress->finish();
			$output->writeln('');
		}
	}
}