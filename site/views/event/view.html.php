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

$helperDir = JPATH_SITE . DIRECTORY_SEPARATOR. "components" . DIRECTORY_SEPARATOR ."com_eventshandler". DIRECTORY_SEPARATOR . "helpers";
JLoader::register("EventshandlerHelper", $helperDir . DIRECTORY_SEPARATOR . "eventshandler.php");


/**
 * View to edit
 */
class EventshandlerViewEvent extends JViewLegacy {

    protected $state;
    protected $item;
    protected $form;
    protected $option;
    protected $params;
    
    public function __construct($config) {
    	parent::__construct($config);
    	$this->option = JFactory::getApplication()->input->get("option");
    }

    /**
     * Display the view
     */
    public function display($tpl = null) {
        
		$app	= JFactory::getApplication();
        $user		= JFactory::getUser();
        
        $this->state = $this->get('State');
        $this->item = $this->get('Data');
        $this->params = $app->getParams('com_eventshandler');
   		

        // Check for errors.
        if (count($errors = $this->get('Errors'))) {
            throw new Exception(implode("\n", $errors));
        }
        
        
        
        if($this->_layout == 'edit') {
            
            $authorised = $user->authorise('core.create', 'com_eventshandler');

            if ($authorised !== true) {
                throw new Exception(JText::_('JERROR_ALERTNOAUTHOR'));
            }
        }
        
        $this->_prepareDocument();

        parent::display($tpl);
    }


	/**
	 * Prepares the document
	 */
	protected function _prepareDocument()
	{
		$app	= JFactory::getApplication();
		$menus	= $app->getMenu();
		$title	= null;
		
		$this->color1		= $this->params->get('color1');
		$this->color2		= $this->params->get('color2');
		$this->color3		= $this->params->get('color3');
		
		$special=EventshandlerHelper::getSpecial($this->item->special_id);
		if($special){
			if($special->color1)
				$this->color1=$special->color1;
			if($special->color2)
				$this->color2=$special->color2;
			if($special->color3)
				$this->color3=$special->color3;
			$this->special=$special;
		}
		
		$place=EventshandlerHelper::getPlace($this->item->place_id);
		$this->place=$place;
		// Add styles
		$this->document->addStyleSheet('media/'.$this->option.'/css/eventshandler.css');
		$this->document->addStyleSheet('media/'.$this->option.'/css/event.css');
		
		// Because the application sets a default page title,
		// we need to get it from the menu item itself
		$menu = $menus->getActive();
		if($menu)
		{
			$this->params->def('page_heading', $this->params->get('page_title', $menu->title));
		} else {
			$this->params->def('page_heading', JText::_('com_eventshandler_DEFAULT_PAGE_TITLE'));
		}
		$title = $this->params->get('page_title', '');
		if (empty($title)) {
			$title = $app->getCfg('sitename');
		}
		elseif ($app->getCfg('sitename_pagetitles', 0) == 1) {
			$title = JText::sprintf('JPAGETITLE', $app->getCfg('sitename'), $title);
		}
		elseif ($app->getCfg('sitename_pagetitles', 0) == 2) {
			$title = JText::sprintf('JPAGETITLE', $title, $app->getCfg('sitename'));
		}
		$this->document->setTitle($title);

		if ($this->params->get('menu-meta_description'))
		{
			$this->document->setDescription($this->params->get('menu-meta_description'));
		}

		if ($this->params->get('menu-meta_keywords'))
		{
			$this->document->setMetadata('keywords', $this->params->get('menu-meta_keywords'));
		}

		if ($this->params->get('robots'))
		{
			$this->document->setMetadata('robots', $this->params->get('robots'));
		}
	}        
    
}
