<?php

return array(
	# Account credentials from developer portal
	'Account' => array(
		'ClientId' => env('PAYPAL_CLIENT_ID', 'AVTZ3aVhvYjXsk0H_1n797wJWJTpcvwvrbYo_aFwr5ltdJ4YDQhOC19fYQ3dDDnKz0L0d7cidK-gplJ0'),
		'ClientSecret' => env('PAYPAL_CLIENT_SECRET', 'EHwcYyvnLE_RhVRViRj_j2nvQsYlpMnV20T5rGikONa6rEg0gR7ucj7f-OQGN1jPEmYqzBbZD8C1cZYU'),
	),

	# Connection Information
	'Http' => array(
		// 'ConnectionTimeOut' => 30,
		'Retry' => 1,
		//'Proxy' => 'http://[username:password]@hostname[:port][/path]',
	),

	# Service Configuration
	'Service' => array(
		# For integrating with the live endpoint,
		# change the URL to https://api.paypal.com!
		'EndPoint' => 'https://api.paypal.com',
	),


	# Logging Information
	'Log' => array(
		//'LogEnabled' => true,

		# When using a relative path, the log file is created
		# relative to the .php file that is the entry point
		# for this request. You can also provide an absolute
		# path here
		'FileName' => '../PayPal.log',

		# Logging level can be one of FINE, INFO, WARN or ERROR
		# Logging is most verbose in the 'FINE' level and
		# decreases as you proceed towards ERROR
		//'LogLevel' => 'FINE',
	),

	# Define your application mode here
	'mode' => 'live'
);
