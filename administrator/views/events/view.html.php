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

jimport('joomla.application.component.view');

/**
 * View class for a list of Eventshandler.
 */
class EventshandlerViewEvents extends JViewLegacy
{
	protected $items;
	protected $pagination;
	protected $state;

	/**
	 * Display the view
	 */
	public function display($tpl = null)
	{
		$this->state		= $this->get('State');
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');

		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			throw new Exception(implode("\n", $errors));
		}
        
		EventshandlerHelper::addSubmenu('events');
		
		$this->addToolbar();
        
        $this->sidebar = JHtmlSidebar::render();
		parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @since	1.6
	 */
	protected function addToolbar()
	{
		require_once JPATH_COMPONENT.'/helpers/eventshandler.php';

		$state	= $this->get('State');
		$canDo	= EventshandlerHelper::getActions($state->get('filter.category_id'));

		JToolBarHelper::title(JText::_('COM_EVENTSHANDLER_TITLE_EVENTS'), 'events.png');

        //Check if the form exists before showing the add/edit buttons
        $formPath = JPATH_COMPONENT_ADMINISTRATOR.'/views/event';
        if (file_exists($formPath)) {

            if ($canDo->get('core.create')) {
			    JToolBarHelper::addNew('event.add','JTOOLBAR_NEW');
		    }

		    if ($canDo->get('core.edit') && isset($this->items[0])) {
			    JToolBarHelper::editList('event.edit','JTOOLBAR_EDIT');
		    }

        }

		if ($canDo->get('core.edit.state')) {

            if (isset($this->items[0]->state)) {
			    JToolBarHelper::divider();
			    JToolBarHelper::custom('events.publish', 'publish.png', 'publish_f2.png','JTOOLBAR_PUBLISH', true);
			    JToolBarHelper::custom('events.unpublish', 'unpublish.png', 'unpublish_f2.png', 'JTOOLBAR_UNPUBLISH', true);
            } else if (isset($this->items[0])) {
                //If this component does not use state then show a direct delete button as we can not trash
                JToolBarHelper::deleteList('', 'events.delete','JTOOLBAR_DELETE');
            }

            if (isset($this->items[0]->state)) {
			    JToolBarHelper::divider();
			    JToolBarHelper::archiveList('events.archive','JTOOLBAR_ARCHIVE');
            }
            if (isset($this->items[0]->checked_out)) {
            	JToolBarHelper::custom('events.checkin', 'checkin.png', 'checkin_f2.png', 'JTOOLBAR_CHECKIN', true);
            }
		}
        
        //Show trash and delete for components that uses the state field
        if (isset($this->items[0]->state)) {
		    if ($state->get('filter.state') == -2 && $canDo->get('core.delete')) {
			    JToolBarHelper::deleteList('', 'events.delete','JTOOLBAR_EMPTY_TRASH');
			    JToolBarHelper::divider();
		    } else if ($canDo->get('core.edit.state')) {
			    JToolBarHelper::trash('events.trash','JTOOLBAR_TRASH');
			    JToolBarHelper::divider();
		    }
        }

		if ($canDo->get('core.admin')) {
			JToolBarHelper::preferences('com_eventshandler');
		}
        
        //Set sidebar action - New in 3.0
		JHtmlSidebar::setAction('index.php?option=com_eventshandler&view=events');
        
        $this->extra_sidebar = '';
        
		JHtmlSidebar::addFilter(
			JText::_('JOPTION_SELECT_PUBLISHED'),
			'filter_published',
			JHtml::_('select.options', JHtml::_('jgrid.publishedOptions'), "value", "text", $this->state->get('filter.state'), true)
		);
		
		
		//Get place options
		JFormHelper::addFieldPath(JPATH_COMPONENT . '/models/fields');
		$place = JFormHelper::loadFieldType('place', false);
		$placeOptions=$place->getOptions(); // works only if you set your field getOptions on public!!
		JHtmlSidebar::addFilter(
			JText::sprintf('COM_EVENTSHANDLER_FILTER_SELECT_LABEL', JText::_('COM_EVENTSHANDLER_PLACES')),
			'filter_place',
			JHtml::_('select.options', $placeOptions, 'value', 'text', $this->state->get('filter.place'))
		);
		
		//Get special options
		JFormHelper::addFieldPath(JPATH_COMPONENT . '/models/fields');
		$special = JFormHelper::loadFieldType('special', false);
		$specialOptions=$special->getOptions(); // works only if you set your field getOptions on public!!
		JHtmlSidebar::addFilter(
			JText::sprintf('COM_EVENTSHANDLER_FILTER_SELECT_LABEL', JText::_('COM_EVENTSHANDLER_SPECIALS')),
			'filter_special',
			JHtml::_('select.options', $specialOptions, 'value', 'text', $this->state->get('filter.special'))
		);
		
		
			$attr=array();
			$attr['class']="";
			$attr['style']="width:142px;";
			$attr['onchange']="this.form.submit();";
			//Filter for the field date
			$this->extra_sidebar .= '<small><label for="filter_from_date">From Date</label></small>';
			$this->extra_sidebar .= JHtml::_('calendar', $this->state->get('filter.date.from'), 'filter_from_date', 'filter_from_date', '%Y-%m-%d',$attr);
			$this->extra_sidebar .= '<small><label for="filter_to_date">To Date</label></small>';
			$this->extra_sidebar .= JHtml::_('calendar', $this->state->get('filter.date.to'), 'filter_to_date', 'filter_to_date', '%Y-%m-%d', $attr);
			$this->extra_sidebar .= '<hr class="hr-condensed">';

        
	}
    
	protected function getSortFields()
	{
		return array(
		'a.id' => JText::_('JGRID_HEADING_ID'),
		'a.ordering' => JText::_('JGRID_HEADING_ORDERING'),
		'a.state' => JText::_('JSTATUS'),
		'a.checked_out' => JText::_('COM_EVENTSHANDLER_EVENTS_CHECKED_OUT'),
		'a.checked_out_time' => JText::_('COM_EVENTSHANDLER_EVENTS_CHECKED_OUT_TIME'),
		'a.created_by' => JText::_('COM_EVENTSHANDLER_EVENTS_CREATED_BY'),
		'a.name' => JText::_('COM_EVENTSHANDLER_EVENTS_NAME'),
		'a.date' => JText::_('COM_EVENTSHANDLER_EVENTS_DATE'),
		);
	}

    
}
