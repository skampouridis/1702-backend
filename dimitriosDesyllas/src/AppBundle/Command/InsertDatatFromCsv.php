<?php

namespace AppBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class InsertDataFromCsv extends Command
{
	const CSV_FILE_INPUT_PARAM='csv_file';
	
	const MMSID_CSV_ROW_POS=0;
	const STATUS_CSV_ROW_POS=1;
	const STATION_CSV_ROW_POS=2;
	const SPEED_CSV_ROW_POS=3;
	const LONGTITUDE_CSV_ROW_POS=4;
	const LATITUDE_CSV_ROW_POS=4;
	const COURSE_CSV_ROW_POS=5;
	const HEADING_CSV_ROW_POS=6;
	const ROTATION_CSV_ROW_POS=7;
	const TIMESTAMP_CSV_ROW_POS=9;
	
	
	protected function configure()
	{
		$this->setName("data:insert:csv")
			->setDescription('Insertd data from a csv file.')
			->setHelp('This command allows you to insert the data from a csv file')
			->addArgument(CSV_FILE_INPUT_PARAM,InputArgument::REQUIRED,'The pathy fo the csv file to read');
	}
	
	protected function execute(InputInterface $input,OutputInterface $output)
	{
		$csvFile=$input->getArgument(CSV_FILE_INPUT_PARAM);
		
		$csvFile=fopen($csvFile,'r');
		
		$treeView=[];
		
		if($csvFile===FALSE){
			$output->writeln("<error>Could not open the file.\n Please ensure that you given the correct path and have the correct read permissions.</error>");
		} else {
			$firstRowHasAlreadyBeenRead=false;
			while($data=fgetcsv($csvFile,1024,";")!==FALSE){
				
				//First row does not contain usefull data therefore we ignorew it completely
				if(!$firstRowHasAlreadyBeenRead){
					$firstRowHasAlreadyBeenRead=true;
					continue;
				}
				
				
				
			}
		}
	}
}