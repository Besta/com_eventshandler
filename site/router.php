<?php
/**
 * @version     1.0.0
 * @package     com_eventshandler
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Simone Bestazza <simone.bestazza@gmail.com> - http://
 */

// No direct access
defined('_JEXEC') or die;

$helperDir = JPATH_SITE . DIRECTORY_SEPARATOR. "components" . DIRECTORY_SEPARATOR ."com_eventshandler". DIRECTORY_SEPARATOR . "helpers";
JLoader::register("EventsHandlerHelperRoute", $helperDir . DIRECTORY_SEPARATOR . "route.php");

/**
 * @param	array	A named array
 * @return	array
 */
function EventshandlerBuildRoute(&$query)
{	
 	$segments = array();

 	// get a menu item based on Itemid or currently active
 	$app  = JFactory::getApplication();
 	$menu = $app->getMenu();
 	
 	// we need a menu item.  Either the one specified in the query, or the current active one if none specified
 	if(empty($query['Itemid'])){
 		$menuItem = $menu->getActive();
 	}else{
 		$menuItem = $menu->getItem($query['Itemid']);
 	}
 	$mOption	= (empty($menuItem->query['option'])) ? null : $menuItem->query['option'];
 	$mView	    = (empty($menuItem->query['view']))   ? null : $menuItem->query['view'];
 	$mCatid	    = (empty($menuItem->query['catid']))  ? null : $menuItem->query['catid'];
 	$mId	    = (empty($menuItem->query['id']))     ? null : $menuItem->query['id'];

  	// If is set view and Itemid missing, we have to put the view to the segments
 	if (isset($query['view'])) {
 		$view = $query['view'];
 		
 		if (empty($query['Itemid']) OR ($mOption !== "com_eventshandler")) {
 			$segments[] = $query['view'];
 		}
 		// We need to keep the view for forms since they never have their own menu item
 		if ($view != 'form') {
 			unset($query['view']);
 		}
 		
 		
 		
 	};
 	
 	// are we dealing with a category that is attached to a menu item?
 	if (isset($view) AND ($mView == $view) AND (isset($query['id'])) AND ($mId == intval($query['id']))) {
 		
 		unset($query['catid']);
 		unset($query['id']);
 		return $segments;
 	}
 	
 	// Views
 	if(isset($view)) {
 		switch($view) {
 			case "event":
 				$id = $query['id'];
				$segments[] = $id;
				unset($query['view']);
				unset($query['id']);
	            unset($query['catid']);
	            break;
            case "special":
            	unset($query['view']);
            	unset($query['id']);
            	unset($query['catid']);
            	break;
 		}
 	}
 	
// 	if (isset($query['task'])) {
// 		$segments[] = implode('/',explode('.',$query['task']));
// 		unset($query['task']);
// 	}
// 	if (isset($query['id'])) {
// 		$segments[] = $query['id'];
// 		unset($query['id']);
// 	}
 	return $segments;
}

/**
 * @param	array	A named array
 * @param	array
 *
 * Formats:
 *
 * index.php?/eventshandler/task/id/Itemid
 *
 * index.php?/eventshandler/id/Itemid
 */
function EventshandlerParseRoute($segments)
{
	
	$vars = array();
	
	//Get the active menu item.
	$app        = JFactory::getApplication();
	$menu       = $app->getMenu();
	$item       = $menu->getActive();
	
	$db         = JFactory::getDBO();
	
	// Count route segments
	$count      = count($segments);

	// Standard routing for articles.  If we don't pick up an Itemid then we get the view from the segments
	// the first segment is the view and the last segment is the id of the details, category or payment.
	if(!isset($item)) {
		$vars['view']   = $segments[0];
		$vars['catid']  = $segments[$count - 1];
		 
		return $vars;
	}
	if($count == 1) {
		 
		// we check to see if an alias is given.  If not, we assume it is a project,
		// because categories have always alias.
		if (false == strpos($segments[0], ':')) {
			$vars['view'] = 'event';
			$vars['id']   = (int)$segments[0];
			return $vars;
		}
	}
// 	$vars = array();
    
// 	// view is always the first element of the array
// 	$count = count($segments);
    
//     if ($count)
// 	{
// 		$count--;
// 		$segment = array_pop($segments) ;
// 		if (is_numeric($segment)) {
// 			$vars['id'] = $segment;
// 		}
//         else{
//             $count--;
//             $vars['task'] = array_pop($segments) . '.' . $segment;
//         }
// 	}

// 	if ($count)
// 	{   
//         $vars['task'] = implode('.',$segments);
// 	}
// 	return $vars;
//}
 //  if ($count)
// 	{
// 		$count--;
// 		$segment = array_pop($segments) ;
// 		if (is_numeric($segment)) {
// 			$vars['id'] = $segment;
// 		}
//         else{
//             $count--;
//             $vars['task'] = array_pop($segments) . '.' . $segment;
//         }
// 	}

// 	if ($count)
// 	{   
//         $vars['task'] = implode('.',$segments);
// 	}
// 	return $vars;
//}
}