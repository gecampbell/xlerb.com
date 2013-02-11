<?php
require_once('rackspace.php');

// push a file
function pushfile($container, $filename) {
	if (substr($filename, -3) == 'css')
		$mime = 'text/css';
	elseif (substr($filename, -3) == 'png')
		$mime = 'image/png';
	elseif (substr($filename, -4) == 'html')
		$mime = 'text/html';
	elseif (substr($filename, -3) == 'txt')
		$mime = 'text/plain';
	elseif (substr($filename, -3) == 'ico')
		$mime = 'image/x-icon';
	elseif (substr($filename, -2) == 'js')
		$mime = 'text/javascript';
	else
		die("Unrecognized file type [$filename]\n");
	$resp = $container->DataObject()->Create(
		array('name'=>$filename, 'content_type'=>$mime), $filename);
	printf("File: %s Type: %s Status: %s\n", 
		$filename, $mime, $resp->HttpStatus());
}

define('AUTHURL', 'https://identity.api.rackspacecloud.com/v2.0/');
define('USERNAME', $_ENV['OS_USERNAME']);
define('TENANT', $_ENV['OS_TENANT_NAME']);
define('APIKEY', $_ENV['NOVA_API_KEY']);

// establish our credentials
$connection = new OpenCloud\Rackspace(AUTHURL,
	array( 'username' => USERNAME,
		   'apiKey' => APIKEY ));

// now, connect to the ObjectStore service
$objstore = $connection->ObjectStore('cloudFiles', 'DFW');

// create a new container
print("Creating Container xlerb.com\n");
$container = $objstore->Container();
$container->Create(array('name'=>'xlerb.com'));

// upload the files
pushfile($container, 'robots.txt', 'text/plain');
foreach(glob('*.*') as $filename)
	pushfile($container, $filename, 'text/html');

// publish directories
$DIRLIST = array('css','img','js');
foreach($DIRLIST as $dirname) {
	$dir = opendir('./'.$dirname);
	// process each file
	while(FALSE !== ($f = readdir($dir))) {
		if(substr($f,0,1) != '.') {
			$path = "$dirname/$f";
			pushfile($container, $path);
		}
	}
}

echo "Publish container to CDN...\n";
$resp = $container->PublishToCDN(60*60);

echo "Creating static website...\n";
$resp = $container->CreateStaticSite('index.html');
$resp = $container->StaticSiteErrorPage('error.html');

printf("Status %s\n", $resp->HttpStatus());
printf("CDN URL:    %s\n", $container->CDNUrl());
printf("Public URL: %s\n", $container->PublicURL());
