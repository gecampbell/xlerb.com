<?php
require_once('rackspace.php');

// push a file
function pushfile($container, $filename, $mimetype) {
	$resp = $container->DataObject()->Create(
		array('name'=>$filename, 'content_type'=>$mimetype), $filename);
	printf("File: %s Type: %s Status: %s\n", 
		$filename, $mimetype, $resp->HttpStatus());
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
foreach(glob('*.html') as $filename)
	pushfile($container, $filename, 'text/html');

// publish directories
$DIRLIST = array('css','img','js');
foreach($DIRLIST as $dirname) {
	$dir = opendir('./'.$dirname);
	// process each file
	while(FALSE !== ($f = readdir($dir))) {
		if(substr($f,0,1) != '.') {
			$path = "$dirname/$f";
			if (substr($f, -3) == 'css')
				$mime = 'text/css';
			elseif (substr($f, -3) == 'png')
				$mime = 'image/png';
			elseif (substr($f, -2) == 'js')
				$mime = 'text/javascript';
			else
				die("Unrecognized file type [$f]\n");
			pushfile($container, $path, $mime);
		}
	}
}

echo "Publish container to CDN...\n";
$resp = $container->PublishToCDN(60*60);

echo "Creating static website...\n";
$resp = $container->CreateStaticSite('index.html');
$resp = $container->StaticSiteErrorPage('error.html');

printf("CDN URL:    %s\n", $container->CDNUrl());
printf("Public URL: %s\n", $container->PublicURL());


printf("Status %s\n", $resp->HttpStatus());
