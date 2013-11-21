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

?>
<?php if ($this->item) { ?>
	<div class="special" style="background-color:<?php echo $this->item->color1 ?>; color: <?php echo $this->item->color2 ?>">
		<img class="special_img" src="<?php echo $this->item->image ?>"/>
		<?php 
		if($this->item->logo) 
			echo '<img class="special_logo" src="'.$this->item->logo.'"/>';
		?>
		<div class="special_content">
			<?php echo $this->item->description ?>
		</div>
		<?php echo $this->loadTemplate("events");?>
	</div>    
<?php
}else
    echo JText::_('COM_EVENTSHANDLER_ITEM_NOT_LOADED');

?>
