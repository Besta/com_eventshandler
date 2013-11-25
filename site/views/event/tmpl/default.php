<?php
/**
 * @version     1.0.0
 * @package     com_eventshandler
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Simone Bestazza <simone.bestazza@gmail.com> - http://
 */
// no direct access
defined('_JEXEC') or die;

//Load admin language file
$lang = JFactory::getLanguage();
$lang->load('com_eventshandler', JPATH_ADMINISTRATOR);
$helperDir = JPATH_SITE . DIRECTORY_SEPARATOR. "components" . DIRECTORY_SEPARATOR ."com_eventshandler". DIRECTORY_SEPARATOR . "helpers";
JLoader::register("EventshandlerHelper", $helperDir . DIRECTORY_SEPARATOR . "eventshandler.php");
JLoader::register("EventshandlerHelperRoute", $helperDir . DIRECTORY_SEPARATOR . "route.php");


?>
<?php if ($this->item){ 
	$info='';
	if($this->special!=null)
		$info.='| '.JText::_('COM_EVENTSHANDLER_SPECIAL').': <a style="color:'.$this->color3.'" href="'.JRoute::_(EventshandlerHelperRoute::getEventsRoute().'&special='.(int)$this->special->id.'-'.$this->special->alias).'">'.$this->special->name.'</a> ';
	if($this->place!=null)
		$info.='| '.JText::_('COM_EVENTSHANDLER_PLACE').': <a style="color:'.$this->color3.'" href="'.JRoute::_(EventshandlerHelperRoute::getEventsRoute().'&place=' . (int)$this->place->id.'-'.$this->place->alias).'">'.$this->place->name.'</a> ';
	if($this->item->date!=null)
		$info.='| '.JText::_('COM_EVENTSHANDLER_DATE').': '.$this->item->date.' ';
	if($this->item->start_time!='0:00:00')
		$info.='| '.JText::_('COM_EVENTSHANDLER_START_TIME').': '.$this->item->start_time.' ';
	if($this->item->end_time!='0:00:00')
		$info.='| '.JText::_('COM_EVENTSHANDLER_END_TIME').': '.$this->item->end_time.' ';
	$info.='|'
	?>
    <div style="background-color:<?php echo $this->color1?>; color:<?php echo $this->color2?>" class="event">
    	<img class="eventImage" src="<?php echo $this->item->big_image ?>"/>
    	<div class="eventContent">
	    	<h2 class="eventTitle"><b><?php echo $this->item->name ?></b></h2>
	    	<div style="color:<?php echo $this->color3?>" class="eventInfo"><?php echo $info ?></div>
	    	<div class="eventDesc"><?php echo $this->item->description ?></div>
    	</div>
    </div>
    
<?php
}else
    echo JText::_('COM_EVENTSHANDLER_ITEM_NOT_LOADED');

?>
