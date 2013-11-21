<?php

/**
 * @version     1.0.0
 * @package     com_eventshandler
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Simone Bestazza <simone.bestazza@gmail.com> - http://
 */
defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');

/**
 * Methods supporting a list of Eventshandler records.
 */
class EventshandlerModelEvents extends JModelList {

    /**
     * Constructor.
     *
     * @param    array    An optional associative array of configuration settings.
     * @see        JController
     * @since    1.6
     */
    public function __construct($config = array()) {
        parent::__construct($config);
    }

    /**
     * Method to auto-populate the model state.
     *
     * Note. Calling getState in this method will result in recursion.
     *
     * @since	1.6
     */
        
    protected function populateState($ordering = null, $direction = null) {

        // Initialise variables.
        $app = JFactory::getApplication();
        
        // List state information
        $limit = $app->getUserStateFromRequest('global.list.limit', 'limit', $app->getCfg('list_limit'));
        $this->setState('list.limit', $limit);
        

		

        $limitstart = JFactory::getApplication()->input->getInt('limitstart', 0);
        $this->setState('list.start', $limitstart);
		
        $place_id = JFactory::getApplication()->input->getInt('place', 0);
		$this->setState('filter.place_id', $place_id);
		
		$special_id = JFactory::getApplication()->input->getInt('special', 0);
		$this->setState('filter.special_id', $special_id);
	        

		if(empty($ordering)) {
			$ordering = 'a.ordering';
		}

        // List state information.
        parent::populateState($ordering, $direction);
    }

    /**
     * Build an SQL query to load the list data.
     *
     * @return	JDatabaseQuery
     * @since	1.6
     */
    protected function getListQuery() {
        // Create a new query object.
        $db = $this->getDbo();
        $query = $db->getQuery(true);

        // Select the required fields from the table.
        $query->select(
                $this->getState(
                        'list.select', 'a.*, b.name AS place_name,b.alias AS place_alias'
                )
        );

        $query->from('`#__eventshandler_events` AS a');
        $query->leftJoin('#__eventshandler_places AS b ON a.place_id=b.id');
        
    // Join over the users for the checked out user.
    $query->select('uc.name AS editor');
    $query->join('LEFT', '#__users AS uc ON uc.id=a.checked_out');
    
		// Join over the created by field 'created_by'
		$query->select('created_by.name AS created_by');
		$query->join('LEFT', '#__users AS created_by ON created_by.id = a.created_by');
        

        // Filter by search in title
        $search = $this->getState('filter.search');
        if (!empty($search)) {
            if (stripos($search, 'id:') === 0) {
                $query->where('a.id = ' . (int) substr($search, 3));
            } else {
                $search = $db->Quote('%' . $db->escape($search, true) . '%');
                $query->where('( a.name LIKE '.$search.' )');
            }
        }
	
        // Filter by place_id
        $place_id = $this->getState('filter.place_id');
        if ($place_id!=null) {
        	$query->where('a.place_id='.$place_id);
        }
        
        // Filter by special_id
        $special_id = $this->getState('filter.special_id');
        if ($special_id!=null) {
        	$query->where('a.special_id='.$special_id);
        }
        
		//Filtering date
		$filter_date_from = $this->state->get("filter.date.from");
		if ($filter_date_from) {
			$query->where("a.date >= '".$filter_date_from."'");
		}
		$filter_date_to = $this->state->get("filter.date.to");
		if ($filter_date_to) {
			$query->where("a.date <= '".$filter_date_to."'");
		}
		$query->order('date DESC');
        return $query;
    }

    public function getItems() {
        return parent::getItems();
    }
    
    /**
     * Method to get the record form.
     *
     * @param	array	$data		An optional array of data for the form to interogate.
     * @param	boolean	$loadData	True if the form is to load its own data (default case), false if not.
     * @return	JForm	A JForm object on success, false on failure
     * @since	1.6
     */
    public function getForm($data = array(), $loadData = true)
    {
    	// Initialise variables.
    	$app	= JFactory::getApplication();
    	
    	// Get the form.
    	$form = $this->loadForm('com_eventshandler.events', 'events', array('control' => 'jform', 'load_data' => $loadData));
    
    	if (empty($form)) {
    		return false;
    	}
    
    	return $form;
    }
}
