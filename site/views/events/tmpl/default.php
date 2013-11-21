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

$helperDir = JPATH_SITE . DIRECTORY_SEPARATOR. "components" . DIRECTORY_SEPARATOR ."com_eventshandler". DIRECTORY_SEPARATOR . "helpers";
JLoader::register("EventshandlerHelper", $helperDir . DIRECTORY_SEPARATOR . "eventshandler.php");


?>
<script type="text/javascript">
    function deleteItem(item_id){
        if(confirm("<?php echo JText::_('COM_EVENTSHANDLER_DELETE_MESSAGE'); ?>")){
            document.getElementById('form-event-delete-' + item_id).submit();
        }
    }
</script>
<div class="events">

<?php 
$show = false;

?>
        <?php foreach ($this->items as $item) { 
        	$color1		= $this->params->get('color1');
        	$color2		= $this->params->get('color2');
        	$color3		= $this->params->get('color3');
        	$special=null;
        	$special=EventshandlerHelper::getSpecial($item->special_id);
        	if($special){
        		if($special->color1)
        			$color1=$special->color1;
        		if($special->color2)
        			$color2=$special->color2;
        		if($special->color3)
        			$color3=$special->color3;
			}?>          
				<?php
					if($item->state == 1 || ($item->state == 0 && JFactory::getUser()->authorise('core.edit.own',' com_eventshandler'))){
						$show = true;?>
						<div style="background-color:<?php echo $color1?>;color:<?php echo $color2?>;" class="event">
							<?php if($this->params->get('eventsdetails')){?>
								<a href="<?php echo JRoute::_('index.php?option=com_eventshandler&view=event&id=' . (int)$item->id); ?>">
							<?php }?>	
									<img class="eventImage" src="<?php echo $item->image;?>"/>
									<span style="color:<?php echo $color2?>" class="eventTitle" ">
										<b><?php
											echo $item->name; 
											?>
										</b>
									</span>
							<?php if($this->params->get('eventsdetails')){?>
								</a>
							<?php }?>	
							<div style="color:<?php echo $color3?>" class="eventInfo">
								<span class="eventDate"><?php echo $item->start_time;?>-<?php echo $item->end_time;?> | <?php echo $item->date;?></span> 
								<a style="color:<?php echo $color3?>" class="eventPlace" href="<?php echo JRoute::_('index.php?option=com_eventshandler&view=events&place='.(int)$item->place_id).'-'.$item->place_alias;?>">
										<?php echo $item->place_name;?>
								</a>
							</div>
							<div class="eventDescription">
								<?php echo $item->description;?>
							</div>
						</div>
						<div class="clearNoBorder"></div>
					<?php } ?>

<?php } ?>
        <?php
        if (!$show):
            echo JText::_('COM_EVENTSHANDLER_NO_ITEMS');
        endif;
        ?>
    </ul>
</div>
<?php if ($show): ?>
    <div class="pagination">
        <p class="counter">
            <?php echo $this->pagination->getPagesCounter(); ?>
        </p>
        <?php echo $this->pagination->getPagesLinks(); ?>
    </div>
<?php endif; ?>

