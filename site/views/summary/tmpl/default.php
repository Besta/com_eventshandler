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

<?php if ($this->items){?>
	<div id="slideEvents">
		<div id="events">
		<?php foreach ($this->items as $event){	
		$special=EventshandlerHelper::getSpecial($event->special_id);
		if($special){
			if($special->color1!=null && $special->color1!="")
				$color1		= $special->color1;
			else 
				$color1		= $this->color1;
			if($special->color2!=null && $special->color2!="")
				$color2		= $special->color2;
			else 
				$color2		= $this->color2;
			if($special->color3!=null && $special->color3!="")
				$color3		= $special->color3;
			else 
				$color3		= $this->color3;
		}
		else{
			$color1		= $this->color1;
			$color2		= $this->color2;
			$color3		= $this->color3;
		}
		if($event->place_id!="" && $event->place_id!=null)
			$place=EventshandlerHelper::getPlace($event->place_id);
		?>
			<div class="event" style="background-image: url('<?php echo $event->big_image;?>');">
				<div class="bottomBar" style="background-color: <?php echo $color1; ?>;color: <?php echo $color2; ?>">
					<h3 style="color: <?php echo $color2; ?>" class="name"><?php echo $event->name; ?></h3><br>
					<?php if($place){?>
						<span style="color: <?php echo $color2; ?>"  class="place"><?php echo $place->name; ?></span>
					<?php }?>
					<span style="color: <?php echo $color2; ?>" class="date"><?php echo $event->date; ?></span>
				</div>
			</div>
		<?php } ?>
		</div>
	</div>
	<?php if(count($this->items)>1){?>
		<div class="slideCircles">
			<?php $i=0; foreach ($this->items as $event){	?>
				<span class="slideCircle" id="<?php echo $i?>"></span>
			<?php $i++; }?>
		</div>
	<?php } ?>
<?php }?>
