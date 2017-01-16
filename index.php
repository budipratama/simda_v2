<?php
//Setting date timezone Indonesia Jakarta
date_default_timezone_set('Asia/Jakarta');

//The key used in the request to specify the API version to use
define('API_VER', 'v');

//Check that the key was given in thne request if not, use the default API version
array_key_exists(API_VER, $_REQUEST) ? $v = $_REQUEST[API_VER] : $v = 'integrasi_v.4.0';

//Does the given key correspond to an existing API version
if (file("{$v}.php"))
{
	
	if(is_dir(dirname( __FILE__ ) . "/{$v}"))
	{
		require dirname( __FILE__ ) . "/{$v}.php";
	} 
	else 
	{
		$error = new stdClass();
		$error->error		= true;
		$error->description = 'INVALID_API_VERSION';
		echo json_encode($error);
		exit;
	}

}
else 
{
	$error = new stdClass();
	$error->error		= true;
	$error->description = 'INVALID_API_VERSION';
	echo json_encode($error);
	exit;
}