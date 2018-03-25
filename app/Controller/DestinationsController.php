<?php
/**
 * Vessels controller.
 */

App::uses('AppController', 'Controller');

class DestinationsController extends AppController {

    public $components = array('RequestHandler');

    public function index() {

    	//get clients ip
    	$client_ip = $this->RequestHandler->getClientIp();

    	//check if limit is exceeded 10 requests per hour
    	if( $this->Destination->canRequest( $client_ip ) ) {

    		//fetch the data
    		$response = $this->Destination->getData( $this->request['url'] );

    		//log request
    		$this->Destination->logAction($this->RequestHandler->getClientIp());			
	    }else{
	    	$response = array(
				'success' => false,
				'msg' => 'You have reached max requests limit. Try again later.'
			);
	    }

	    $this->set(array(
		    	'response' => $response
		    ));
	       
	    $output = $this->Destination->getOutput($this->request['url']);

        if($output){
        	if($output == "csv") {
        		$this->RequestHandler->respondAs('html'); 
	        	$this->RequestHandler->setContent('html');
        	}else{
	        	$this->RequestHandler->respondAs($output); 
	        	$this->RequestHandler->setContent($output);
	        }

	        $this->layout = 'ajax';
	        $this->render( 'index_'.$output );
        	        	
	    }

        
    }
}