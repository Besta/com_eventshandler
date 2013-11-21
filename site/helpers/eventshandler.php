<?php
/**
 * @version     1.0.0
 * @package     com_eventshandler
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Simone Bestazza <simone.bestazza@gmail.com> - http://
 */

defined('_JEXEC') or die;

abstract class EventshandlerHelper
{
	public static function getSpecial($id)
	{
		$db = JFactory::getDbo();
    	$query = $db->getQuery(true);
    	$query
    	->select('*')
    	->from('#__eventshandler_specials')
    	->where('id = ' . $id);
    	$db->setQuery($query);
    	return $db->loadObject();
	}
	
	public static function getPlace($id)
	{
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query
		->select('*')
		->from('#__eventshandler_places')
		->where('id = ' . $id);
		$db->setQuery($query);
		return $db->loadObject();
	}

}

