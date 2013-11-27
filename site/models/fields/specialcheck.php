<?php
/**
 * @version     1.0.0
 * @package     com_eventshandler
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Simone Bestazza <simone.bestazza@gmail.com> - http://
 */

defined('JPATH_BASE') or die;

jimport('joomla.html.html');
jimport('joomla.form.formfield');
jimport('joomla.form.helper');
JFormHelper::loadFieldClass('checkboxes');

/**
 * Supports an HTML select list of categories
 */
class JFormFieldSpecialcheck extends JFormFieldCheckboxes
{
	/**
	 * The form field type.
	 *
	 * @var		string
	 * @since	1.6
	 */
	protected $type = 'specialcheck';
	

	/**
	 * Method to get the field input markup.
	 *
	 * @return	string	The field input markup.
	 * @since	1.6
	 */
	public function getOptions()
	{
		$options = array();
        
        $db     = JFactory::getDbo();
        $query  = $db->getQuery(true);
        
        $query
            ->select('id AS value, name AS text')
            ->from('#__eventshandler_specials')
            ->order("name ASC");
        
        // Get the options.
        $db->setQuery($query);
        
        $options = $db->loadObjectList();
        
        $select = new JObject;
        $select->setProperties(
        		array(
        				'value'=>'0',
        				'text'=>JText::_('COM_EVENTSHANDLER_SELECT_NO_SPECIAL'),
        		)
        );
        
        array_unshift($options, $select);
                
        return  $options;

	}
}