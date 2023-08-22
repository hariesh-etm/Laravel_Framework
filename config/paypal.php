<?php 
return [ 
    'client_id' => 'AQd7bZEpIALGqVmbh09aIiWnaTSp77VJv7chJBVXnN-nbWLQlNc_QwXYZitCoQ8mW_ghW_70rohtWGvH',
	'secret' => 'EFJHKGZTvsooOBPgxxMUVbOaefTArvtpCok60pmI5MDHJNOR8XwESbeybcYSTAfwjUQFepNdk-IvUepw',
    'settings' => array(
        'mode' => 'sandbox',
        'http.ConnectionTimeOut' => 1000,
        'log.LogEnabled' => true,
        'log.FileName' => storage_path() . '/logs/paypal.log',
        'log.LogLevel' => 'FINE'
    ),
];