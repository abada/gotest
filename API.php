<?php

	$params = array(
		'ClientInfo'  			=> array(
									'AccountCountryCode'	=> 'EG',
									'AccountEntity'		 	=> 'CAI',
									'AccountNumber'		 	=> '239584',
									'AccountPin'		 	=> '216216',
									'UserName'			 	=> 'mohamed.amer2050@gmail.com',
									'Password'			 	=> 'asd654321',
									'Version'			 	=> 'v1.0'
								),
								
		'Transaction' 			=> array(
									'Reference1'			=> '001' 
								),
								
		'OriginAddress' 	 	=> array(
									'City'					=> 'Nasr City',
									'State Or Province Code'                =>'egypt',
									'CountryCode'				=> 'EG'
								),
								
		'DestinationAddress' 	=> array(
									'City'					=> 'Badr city',
									'State Or Province Code'                =>'egypt',
									'CountryCode'			=> 'EG'
								),
		'ShipmentDetails'		=> array(
									'PaymentType'			 => 'P',
									//'ProductGroup'			 => 'EXP',
									//'ProductType'			 => 'PPX',
									'ProductGroup'             => 'DOM',
									'ProductType'             => 'OND',
									'ActualWeight' 			 => array('Value' => 5, 'Unit' => 'KG'),
									'ChargeableWeight' 	     => array('Value' => 5, 'Unit' => 'KG'),
									'NumberOfPieces'		 => 5
								)
	);
	
	$soapClient = new SoapClient('http://ws.aramex.net/ShippingAPI/RateCalculator/Service_1_0.svc?wsdl', array('trace' => 1));
	
	//$soapClient = new SoapClient('http://ws.dev.aramex.net/shippingapi/shipping/service_1_0.svc?wsdl', array('trace' => 1));
	$results = $soapClient->CalculateRate($params);
	
	echo '<pre>';
	print_r($results);
	die();
?>
