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
        if (empty($config['filter_fields'])) {
            $config['filter_fields'] = array(
                                'id', 'a.id',
                'ordering', 'a.ordering',
                'state', 'a.state',
                'created_by', 'a.created_by',
                'name', 'a.name',
                'description', 'a.description',
                'date', 'a.date',
                'start_time', 'a.start_time',
                'end_time', 'a.end_time',
                'image', 'a.image',
            	'link_fb', 'a.link_fb',
            	'place_id', 'a.place_id',
            	'special_id', 'a.special_id',
            );
        }

        parent::__construct($config);
    }

    /**
     * Method to auto-populate the model state.
     *
     * Note. Calling getState in this method will result in recursion.
     */
    protected function populateState($ordering = null, $direction = null) {
        // Initialise variables.
        $app = JFactory::getApplication('administrator');

        // Load the filter state.
        $search = $app->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
        $this->setState('filter.search', $search);

        $published = $app->getUserStateFromRequest($this->context . '.filter.state', 'filter_published', '', 'string');
        $this->setState('filter.state', $published);

		//Filter (dropdown) place
        $state = $this->getUserStateFromRequest($this->context.'.filter.place', 'filter_place', '', 'string');
        $this->setState('filter.place', $state); 

        //Filter (dropdown) special
        $state = $this->getUserStateFromRequest($this->context.'.filter.special', 'filter_special', '', 'string');
        $this->setState('filter.special', $state);

		//Filtering date
		$this->setState('filter.date.from', $app->getUserStateFromRequest($this->context.'.filter.date.from', 'filter_from_date', '', 'string'));
		$this->setState('filter.date.to', $app->getUserStateFromRequest($this->context.'.filter.date.to', 'filter_to_date', '', 'string'));


        // Load the parameters.
        $params = JComponentHelper::getParams('com_eventshandler');
        $this->setState('params', $params);

        // List state information.
        parent::populateState('a.name', 'asc');
    }

    /**
     * Method to get a store id based on model configuration state.
     *
     * This is necessary because the model is used by the component and
     * different modules that might need different sets of data or different
     * ordering requirements.
     *
     * @param	string		$id	A prefix for the store id.
     * @return	string		A store id.
     * @since	1.6
     */
    protected function getStoreId($id = '') {
        // Compile the store id.
        $id.= ':' . $this->getState('filter.search');
        $id.= ':' . $this->getState('filter.state');

        return parent::getStoreId($id);
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
                        'list.select', 'a.*'
                )
        );
        $query->from('`#__eventshandler_events` AS a');
        
        $query->select('b.name AS place_name');
        $query->leftJoin('#__eventshandler_places AS b ON a.place_id=b.id');
		
        $query->select('c.name AS special_name');
		$query->leftJoin('#__eventshandler_specials AS c ON a.special_id=c.id');
		
    // Join over the users for the checked out user.
    $query->select('uc.name AS editor');
    $query->join('LEFT', '#__users AS uc ON uc.id=a.checked_out');
    
		// Join over the user field 'created_by'
		$query->select('created_by.name AS created_by');
		$query->join('LEFT', '#__users AS created_by ON created_by.id = a.created_by');

        
    // Filter by published state
    $published = $this->getState('filter.state');
    if (is_numeric($published)) {
        $query->where('a.state = '.(int) $published);
    } else if ($published === '') {
        $query->where('(a.state IN (0, 1))');
    }
    
    // Filter by place id
    $place_id= $this->getState('filter.place');
    if ($place_id!=null) {
    	$query->where('(a.place_id='.$place_id.')');
    }
    
    // Filter by special id
    $special_id= $this->getState('filter.special');
    if ($special_id!=null) {
    	$query->where('(a.special_id='.$special_id.')');
    }
    

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

        

		//Filtering date
		$filter_date_from = $this->state->get("filter.date.from");
		if ($filter_date_from) {
			$query->where("a.date >= '".$db->escape($filter_date_from)."'");
		}
		$filter_date_to = $this->state->get("filter.date.to");
		if ($filter_date_to) {
			$query->where("a.date <= '".$db->escape($filter_date_to)."'");
		}


        // Add the list ordering clause.
        $orderCol = $this->state->get('list.ordering');
        $orderDirn = $this->state->get('list.direction');
        if ($orderCol && $orderDirn) {
            $query->order($db->escape($orderCol . ' ' . $orderDirn));
        }

        return $query;
    }

    public function getItems() {
        $items = parent::getItems(); 
        return $items;
    }
	
    public function checkin($id){
    	$model = $this->getInstance( 'event', 'EventshandlerModel' );
    	return $model->checkin($id);
    }
    
    public function publish($id,$state){
    	$model = $this->getInstance( 'event', 'EventshandlerModel' );
    	return $model->publish($id,$state);
    }
    
}
