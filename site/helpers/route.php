<?php

// no direct access
defined('_JEXEC') or die;


// Component Helper
jimport('joomla.application.component.helper');
jimport('joomla.application.categories');


abstract class EventsHandlerHelperRoute {
    
	
		
	/**
	 * 
	 * Prepeare categories path to the segments.
	 * We use this method in the router "CrowdFundingParseRoute".
	 * 
	 * @param integer   $catId		Category Id
	 * @param array 	$segments	
	 * @param integer 	$mId 		Id parameter from the menu item query
	 */
	public static function preparePlaceSegments($placeId, &$segments) {
	   	$db = JFactory::getDbo();
        $query = $db->getQuery(true);

        // Select the required fields from the table.
        $query->select('alias')->from('#__eventshandler_places')->where('id='.$placeId);
        
        $db->setQuery($query);
        $alias=$db->loadResult();
        
        $segments[]=$placeId.":".$alias;
		
	}
	
}
