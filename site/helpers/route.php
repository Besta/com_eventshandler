<?php

// no direct access
defined('_JEXEC') or die;


// Component Helper
jimport('joomla.application.component.helper');
jimport('joomla.application.categories');


abstract class EventsHandlerHelperRoute {
    
	
	protected static $lookup;
	
	/**
	 * This method route quote in the view "category".
	 *
	 * @param	int		$id		The id of the item.
	 * @param	int		$catid	The id of the category.
	 */
	public static function getSpecialRoute($id, $screen = null) {
	
	
		$needles = array(
				'special' => array((int)$id),
		);
	
		//Create the link
		$link = 'index.php?option=com_eventshandler&view=special&id='. $id;
	
	
	
		// Set a screen page
		if(!empty($screen)) {
			$link .= '&screen='.$screen;
		}
	
		// Looking for menu item (Itemid)
	
		if ($item = self::_findItem($needles)) {
			$link .= '&Itemid='.$item;
		} elseif ($item = self::_findItem(null)) { // Get the menu item (Itemid) from the active (current) item.
			$link .= '&Itemid='.$item;
		}
	
		
		return $link;
	}
	
	/**
	 * This method route quote in the view "category".
	 *
	 * @param	int		$id		The id of the item.
	 * @param	int		$catid	The id of the category.
	 */
	public static function getEventsRoute() {
	
		$link = 'index.php?option=com_eventshandler&view=events';
	
	
		// Looking for menu item id
		$app		= JFactory::getApplication();
		$menus		= $app->getMenu('site');
		
		self::$lookup = array();
		
		$component	= JComponentHelper::getComponent('com_eventshandler');
		$items		= $menus->getItems('component_id', $component->id);
	
		if ($items) {
				
			foreach ($items as $item) {
				if (isset($item->query) && isset($item->query['view'])) {
					$view = $item->query['view'];
					if($view=='events')
						$link.='&Itemid='.$item->id;
		
				}
			}
		}
		
		return $link;
	}
	
	public static function preparePlaceSegments($placeId, &$segments) {
	   	$db = JFactory::getDbo();
        $query = $db->getQuery(true);

        // Select the required fields from the table.
        $query->select('alias')->from('#__eventshandler_places')->where('id='.$placeId);
        
        $db->setQuery($query);
        $alias=$db->loadResult();
        
        $segments[]=$placeId.":".$alias;
		
	}
	
	protected static function _findItem($needles = null) {
		$app		= JFactory::getApplication();
		$menus		= $app->getMenu('site');


		if (self::$lookup === null) {
			self::$lookup = array();
	
			$component	= JComponentHelper::getComponent('com_eventshandler');
			$items		= $menus->getItems('component_id', $component->id);
				
			if ($items) {
				foreach ($items as $item) {
					if (isset($item->query) && isset($item->query['view'])) {
						$view = $item->query['view'];
						if (!isset(self::$lookup[$view])) {
							self::$lookup[$view] = array();
						}
						if ($item->params->get('item_id')!=null) {
							self::$lookup[$view][$item->params->get('item_id')]['id'] = $item->params->get('item_id');
							self::$lookup[$view][$item->params->get('item_id')]['item_id'] = $item->id;
						} else { // If it is a root element that have no a request parameter ID ( categories, authors ), we set 0 for an key
							self::$lookup[$view][0]['id'] = $item->params->get('item_id');
							self::$lookup[$view][0]['item_id'] = $item->id;
						}
						
					}
				}
			}
		}
	
		if ($needles) {
				
			foreach ($needles as $view => $ids) {
				
				
				if (isset(self::$lookup[$view])) {
					
					foreach($ids as $id) {
						if (isset(self::$lookup[$view][(int)$id]['id'])) {
							return self::$lookup[$view][(int)$id]['item_id'];
						}
					}
						
				}
			}
	
		} else {
			$active = $menus->getActive();
			if ($active) {
				return $active->id;
			}
		}
	
		return null;
	}
	
}
