<?php
/**
 * Return the console application configuration
 */
return CMap::mergeArray( require(dirname(__FILE__).'/main.php'), array(
	'commandMap' => array(
//     	'command-name' => array(
// 			'class'	=>	'path.alias.to.command',
// 	        'param' => 'command parameters'
//         ),
    ),
			
));
