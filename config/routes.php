<?php
$config['routes'] = array(
	'/'=>array(
		'controller'	=> 'Customers',
		'action'		=> 'index',
	),
	'/customers/add'=>array(
		'controller'	=> 'Customers',
		'action'		=> 'add',
	),
	'/customers/edit'=>array(
		'controller'	=> 'Customers',
		'action'		=> 'edit',
	),
	'/customers/delete'=>array(
		'controller'	=> 'Customers',
		'action'		=> 'delete',
	),
	'/bizstates/load'=>array(
		'controller'	=> 'Bizstates',
		'action'		=> 'load',
	),
	'/bizstates/save'=>array(
		'controller'	=> 'Bizstates',
		'action'		=> 'save',
	),
);
?>
