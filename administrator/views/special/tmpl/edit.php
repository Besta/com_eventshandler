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
        if(task == 'special.cancel'){
            Joomla.submitform(task, document.getElementById('special-form'));
        }
        else{
            
            if (task != 'special.cancel' && document.formvalidator.isValid(document.id('special-form'))) {
                
                Joomla.submitform(task, document.getElementById('special-form'));
            }
            else {
                alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
            }
        }
    }
</script>

<form action="<?php echo JRoute::_('index.php?option=com_eventshandler&layout=edit&id=' . (int) $this->item->id); ?>" method="post" enctype="multipart/form-data" name="adminForm" id="special-form" class="form-validate">
    <div class="form-horizontal">
			<div class="span12">
				<div class="row-fluid form-horizontal-desktop">
					<div class="span8">
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
							<div class="control-label"><?php echo $this->form->getLabel('logo'); ?></div>
							<div class="controls"><?php echo $this->form->getInput('logo'); ?></div>
						</div>
						<div class="control-group">
							<div class="control-label"><?php echo $this->form->getLabel('description'); ?></div>
							<div class="controls"><?php echo $this->form->getInput('description'); ?></div>
						</div>
		        	</div>
			        <div class="span3">
		        		<div class="control-group">
							<div class="control-label"><?php echo $this->form->getLabel('image'); ?></div>
							<div class="controls"><?php echo $this->form->getInput('image'); ?></div>
						</div>
						<div class="control-group">
							<div class="control-label"><?php echo $this->form->getLabel('day'); ?></div>
							<div class="controls"><?php echo $this->form->getInput('day'); ?></div>
						</div>
						<div class="control-group">
							<div class="control-label"><?php echo $this->form->getLabel('link_fb'); ?></div>
							<div class="controls"><?php echo $this->form->getInput('link_fb'); ?></div>
						</div>
						<div class="control-group">
							<div class="control-label"><?php echo $this->form->getLabel('link_tw'); ?></div>
							<div class="controls"><?php echo $this->form->getInput('link_tw'); ?></div>
						</div>
						<div class="control-group">
							<div class="control-label"><?php echo $this->form->getLabel('link_yt'); ?></div>
							<div class="controls"><?php echo $this->form->getInput('link_yt'); ?></div>
						</div>
						<div class="control-group">
							<div class="control-label"><?php echo $this->form->getLabel('website'); ?></div>
							<div class="controls"><?php echo $this->form->getInput('website'); ?></div>
						</div>
		        		<div class="control-group">
							<div class="control-label"><?php echo $this->form->getLabel('color1'); ?></div>
							<div class="controls"><?php echo $this->form->getInput('color1'); ?></div>
						</div>
						<div class="control-group">
							<div class="control-label"><?php echo $this->form->getLabel('color2'); ?></div>
							<div class="controls"><?php echo $this->form->getInput('color2'); ?></div>
						</div>
						<div class="control-group">
							<div class="control-label"><?php echo $this->form->getLabel('color3'); ?></div>
							<div class="controls"><?php echo $this->form->getInput('color3'); ?></div>
						</div>
	        		</div>
	       		</div>
		</div>
    </div>
    <input type="hidden" name="task" value="" />
        <?php echo JHtml::_('form.token'); ?>
</form>