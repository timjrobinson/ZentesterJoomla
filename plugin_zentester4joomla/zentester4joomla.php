<?php
######################################################################
# Zentester For Joomla        	          	         				#
# Copyright (C) 2011 by Zentester	   	   	   	   	   	 #
# Homepage   : www.zentester.com		   	   	   	   	   	 #
# Author     : Tim Robinson	   	   	   	   	   	   	   	 #
# Email      : info@zentester.com 	   	   	   	   	   	     #
# Version    : 1.0.0	                       	   	    	   	   	 #
# License    : http://www.gnu.org/copyleft/gpl.html GNU/GPL          #
######################################################################

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.plugin.plugin');
jimport( 'joomla.filesystem.file' );
jimport( 'joomla.filesystem.path' );
jimport( 'joomla.client.helper' );


class plgSystemzentester4joomla extends JPlugin
{
	function plgSystemzentester4joomla(&$subject, $config)
	{
		parent::__construct($subject, $config);
		
		$this->_plugin = JPluginHelper::getPlugin( 'system', 'zentester4joomla' );
		$this->_params = new JParameter( $this->_plugin->params );
	}
	
	function onAfterRender()
	{
		global $mainframe;

		$zentester_id = $this->params->get('zentester_id', '');
			
		if($zentester_id == '' || $mainframe->isAdmin() || strpos($_SERVER["PHP_SELF"], "index.php") === false)
		{
			return;
		}
		
		$buffer = JResponse::getBody();

		$zentester_javascript = '<!--Zentester for Joomla by Zentester v1.0 | http://www.zentester.com/ !-->
<script src="//app.zentester.com/index.php/remote/load_zentester/'. $zentester_id .'/zentester.js"></script>
<!-- End of Zentester for Joomla by Zentester v1.0 !-->
';
		
		$buffer = str_replace ("</head>", $zentester_javascript."</head>", $buffer);
		JResponse::setBody($buffer);
		
		return true;
	}
}
?>