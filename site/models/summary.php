<?php
/**
 * @version     1.0.0
 * @package     com_eventshandler
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Simone Bestazza <simone.bestazza@gmail.com> - http://
 */

// No direct access.
defined('_JEXEC') or die;

jimport('joomla.application.component.modellegacy');
jimport( 'joomla.registry.registry' );

/**
 * Eventshandler model.
 */
class EventshandlerModelSummary extends JModelLegacy {
	
	protected $items=array();
	
	public function getItems(){
		$app                = JFactory::getApplication();
		$params       = $app->getParams('com_eventshandler');
		$specials_id=$params->get('specials_id');
		
		$db = JFactory::getDbo();
    	$query = $db->getQuery(true);
    	$query
    	->select('id')
    	->from('#__eventshandler_specials');
    	$where='id=""';
    	$withoutSpecial=false;
    	foreach ($specials_id as $id){
    		if($id==0)
    			$withoutSpecial=true;
    		$where.=' OR id='.$id;
    	}
    	$query->where($where);
    	
    	$db->setQuery($query);
    	$specialsId=$db->loadColumn();
    	
    	
		if($withoutSpecial){
	    	$query = $db->getQuery(true);
	    	$query
	    	->select('*')
	    	->from('#__eventshandler_events')
	    	->where('special_id=""')
	    	->order('date');
	    	 
	    	$db->setQuery($query);
	    	$this->items[]=$db->loadObject();
		}
		
    	foreach ($specialsId as $id)
    	{
    		$query = $db->getQuery(true);
    		$query
    		->select('*')
    		->from('#__eventshandler_events')
    		->where('special_id='.$id)
    		->order('date');
    		$db->setQuery($query);
    		$this->items[]=$db->loadObject();
    	}
    	
    	return $this->items;
	}

	
}