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

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');
JHtml::_('behavior.keepalive');

// Import CSS
$document = JFactory::getDocument();
$document->addStyleSheet('components/com_eventshandler/assets/css/eventshandler.css');
?>
<script type="text/javascript">
    js = jQuery.noConflict();
    js(document).ready(function(){
        
    });
    
    Joomla.submitbutton = function(task)
    {
        if(task == 'event.cancel'){
            Joomla.submitform(task, document.getElementById('event-form'));
        }
        else{
            
            if (task != 'event.cancel' && document.formvalidator.isValid(document.id('event-form'))) {
                
                Joomla.submitform(task, document.getElementById('event-form'));
            }
            else {
                alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
            }
        }
    }
</script>

<form action="<?php echo JRoute::_('index.php?option=com_eventshandler&layout=edit&id=' . (int) $this->item->id); ?>" method="post" enctype="multipart/form-data" name="adminForm" id="event-form" class="form-validate">
    <div class="row-fluid">
        <div class="span5">
            <fieldset class="adminform">

	             <div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('id'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('id'); ?></div>
				</div>
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('state'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('state'); ?></div>
				</div>
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('created_by'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('created_by'); ?></div>
				</div>
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('name'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('name'); ?></div>
				</div>
				<?php echo $this->form->getInput('alias'); ?>
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('description'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('description'); ?></div>
				</div>
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('place_id'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('place_id'); ?></div>
				</div>
				

            </fieldset>
        </div>
        <div class="span3">
        	<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('special_id'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('special_id'); ?></div>
				</div>
        	<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('date'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('date'); ?></div>
				</div>
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('start_time'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('start_time'); ?></div>
				</div>
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('end_time'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('end_time'); ?></div>
				</div>
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('image'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('image'); ?></div>
				</div>
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('big_image'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('big_image'); ?></div>
				</div>
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('link_fb'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('link_fb'); ?></div>
				</div>
        <div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('tags'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('tags'); ?></div>
				</div>
        </div>

        

        <input type="hidden" name="task" value="" />
        <?php echo JHtml::_('form.token'); ?>

    </div>
</form>