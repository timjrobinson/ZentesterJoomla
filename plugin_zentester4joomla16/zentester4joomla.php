<?php
######################################################################
# Zentester for Joomla 1.6		       	          	          	     #
# Copyright (C) 2011 by Zentester	   	   	   	   	   	             #
# Homepage   : www.zentester.com		   	   	   	   	   	         #
# Author     : Tim Robinson   		   	   	   	   	   	   	         #
# Email      : feedback@zentester.com 	   	   	   	   	   	   	 #
# Version    : 1.0	                       	   	    	   	   	     #
# License    : http://www.gnu.org/copyleft/gpl.html GNU/GPL          #
######################################################################

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.plugin.plugin');


class plgSystemzentester4joomla extends JPlugin
{


	function onAfterRender()
		{
		$mainframe = &JFactory::getApplication();

		if($mainframe->isAdmin() || strpos($_SERVER["PHP_SELF"], "index.php") === false || JRequest::getVar('format','html') != 'html'){
			return;
		}
		
		$zentester_id = $this->params->get('zentester_id', '');
			
		if($zentester_id == '' || $mainframe->isAdmin() || strpos($_SERVER["PHP_SELF"], "index.php") === false)
		{
			return;
		}
		
		$buffer = JResponse::getBody();

		$javascript = '<!--zentester for Joomla by Zentester v1.0 | http://www.zentester.com/ !-->
<script src="//app.zentester.com/index.php/remote/load_zentester/'. $zentester_id .'/zentester.js"></script>
<!-- End of zentester for Joomla by Zentester v1.0 !-->
';
		
		$buffer = str_replace ("</head>", $javascript."</head>", $buffer);
		JResponse::setBody($buffer);
		
		return true;
	}
}
?>