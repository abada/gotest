<?php
	$params = array(
		'ClientInfo'  			=> array(
									'AccountCountryCode'	=> 'JO',
									'AccountEntity'		 	=> 'AMM',
									'AccountNumber'		 	=> '00000',
									'AccountPin'		 	=> '000000',
									'UserName'			 	=> 'mohamed.amer2050@gmail.com',
									'Password'			 	=> 'Asd654321',
									'Version'			 	=> 'v1.0'
								),
								
		'Transaction' 			=> array(
									'Reference1'			=> '001' 
								),
								
		'OriginAddress' 	 	=> array(
									'City'					=> 'Amman',
									'CountryCode'				=> 'JO'
								),
								
		'DestinationAddress' 	=> array(
									'City'					=> 'Dubai',
									'CountryCode'			=> 'AE'
								),
		'ShipmentDetails'		=> array(
									'PaymentType'			 => 'P',
									'ProductGroup'			 => 'EXP',
									'ProductType'			 => 'PPX',
									'ActualWeight' 			 => array('Value' => 5, 'Unit' => 'KG'),
									'ChargeableWeight' 	     => array('Value' => 5, 'Unit' => 'KG'),
									'NumberOfPieces'		 => 5
								)
	);
	
	$soapClient = new SoapClient('http://ws.aramex.net/ShippingAPI/RateCalculator/Service_1_0.svc?wsdl', array('trace' => 1));
	$results = $soapClient->CalculateRate($params);	
	
	echo '<pre>';
	print_r($results);
	die();
?>
