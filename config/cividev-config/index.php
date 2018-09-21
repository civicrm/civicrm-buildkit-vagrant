<?php
/**
 * If a custom dashboard file exists, load that instead of the default
 * dashboard provided by Varying Vagrant Vagrants. This file should be
 * located in the `www/default/` directory.
 */
if ( file_exists( 'dashboard-custom.php' ) ) {
	include( 'dashboard-custom.php' );
	exit;
}

// Begin default dashboard.
?>
<!DOCTYPE html>
<html>
<head>
	<title>Civi Development</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<ul class="nav">
	<li class="active"><a href="#">Home</a></li>
	<li><a href="https://github.com/civicrm/civicrm-buildkit-vagrant">Repository</a></li>
	<li><a href="database-admin/">phpMyAdmin</a></li>
	<li><a href="http://civi.test:1080">Mailcatcher</a></li>
	<li><a href="webgrind/">Webgrind</a></li>
	<li><a href="/opcache-status/opcache.php">Opcache Status</a></li>
	<li><a href="phpinfo/">PHP Info</a></li>
</ul>
<ul class="desc">
	<p>Multiple projects can be developed at once in the same environment. Cividev is pre-configured with the following CiviCRM configurations:</p>

    <p>d7-master with Drupal 7 and the current development version of CiviCRM</br>
    d7-46 with Drupal 7 and CiviCRM 4.6 (LTS)</br>
    wp-master with WordPress and the current development version of CiviCRM</br>
    wp-46 with WordPress and CiviCRM 4.6 (LTS)</br>
    d8-master with Drupal 8</br>
    b-master with Backdrop</p>

    <p>d7-master.test is configured on the first vagrant up. To sey up the others ssh to the server with 'vagrant ssh', then issue the command 'civibuild create wp-master' to create wp-master. </p>
    <p>Full details on how to create sites with Buildkit can be found here: <a href="https://github.com/civicrm/civicrm-buildkit/blob/master/doc/civibuild.md#build-types" target="_blank">Buildkit Types, Aliases and Rebuilds</a></p>
</ul>

<ul class="nav">
	<li><a href="http://d7-master.test/">http://d7-master.test/</a> Drupal 7 CiviCRM master (clean)</li>
	<li><a href="http://d7-46.test/">http://d7-46.test</a> Drupal 7 CiviCRM 4.6 (clean)</li>
	<li><a href="http://wp-master.test/">http://wp-master.test</a> WP and CiviCRM master</li>
	<li><a href="http://wp-46.test/">http://wp-46.test</a> WP and CiviCRM 4.6</li>
</ul>
</body>
</html>
