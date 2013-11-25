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
$model=$this->getModel();
$events=$model->getEventsList($this->item->id);
?>
<?php if ($events){?>
	<div style="border-top:1px solid <?php echo $this->color3 ?>;" class="specialEvents">
		<?php foreach ($events as $event){?>
			<?php if($this->params->get('eventsdetails')){?>
				<a href="<?php echo JRoute::_('index.php?option=com_eventshandler&view=event&id=' . (int)$event->id); ?>">
			<?php }?>	
			<div class="specialEvent">
	 			<h3 style="color:<?php echo $this->color2 ?>;" class="name"><?php echo $event->name?></h3>
	 			<img class="image" src="<?php echo $event->image?>"/>
	 			<span style="color:<?php echo $this->color2 ?>;" class="date"><?php echo $event->date; if(isset($event->place)) echo ' | '.$event->place?></span>
	 			
			</div>
			<?php if($this->params->get('eventsdetails')){?>
				</a>
			<?php }?>	
		<?php } ?>
	</div>
<?php }
?>
