<?php
/*------------------------------------------------------------------------
# Characters Model for RaidPlanner Component
# com_raidplanner - RaidPlanner Component
# ------------------------------------------------------------------------
# author    Taracque
# copyright Copyright (C) 2011 Taracque. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Website: http://www.taracque.hu/raidplanner
-------------------------------------------------------------------------*/
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
 
jimport( 'joomla.application.component.model' );
 
class RaidPlannerModelDKP extends JModel
{
    /**
     * Data array
     *
     * @var array
     */
  var $_data;
 	var $_total = null;
	var $_pagination = null;

	function __construct()
	{
		parent::__construct();
		
		$option = JRequest::getCmd('option');
		$app = &JFactory::getApplication();


		
		// In case limit has been changed, adjust it
		$this->setState('filter_char_level_min', 50);
		$this->setState('filter_char_level_max', 150);
	}

	function _buildContentOrderBy()
	{
		$orderby = '';
		$filter_order     = $this->getState('filter_order');
		$filter_order_Dir = $this->getState('filter_order_Dir');
		
		/* Error handling is never a bad thing*/
		if (
			(!empty($filter_order) && !empty($filter_order_Dir) ) &&
			(in_array($filter_order, array('c.char_name', 'u.name', 'cl.class_name', 'c.rank', 'c.gender_id', 'rc.race_name', 'c.char_level','g.guild_name','c.dkp') ) ) &&
			(in_array($filter_order_Dir, array('asc', 'desc') ) )
		) {
		
			$orderby = ' ORDER BY '.$filter_order.' '.$filter_order_Dir;
		}

		return $orderby;
	}

	
    /**
     * Returns the query
     * @return string The query to be used to retrieve the rows from the database
     */
    function _buildQueryWhere()
	{
		$db	=& JFactory::getDBO();
		
		$filter_char_level_min = $this->getState('filter_char_level_min');
		$filter_char_level_max = $this->getState('filter_char_level_max');

		$where = '';
		
		$where_arr = array();
		if ($filter_char_level_min>0) {
			$where_arr[] = "c.char_level >= ".$db->Quote($filter_char_level_min);
		}
		if ($filter_char_level_max!='') {
			$where_arr[] = "c.char_level <= ".$db->Quote($filter_char_level_max);
		}
		if (!empty($where_arr)) {
			$where = " WHERE ".implode(" AND ",$where_arr);
		}
		
		return $where;
	}

    /**
     * Returns the query
     * @return string The query to be used to retrieve the rows from the database
     */
    function _buildQuery()
    {
        $query = ' SELECT c.*, u.name AS user_name, cl.class_name, rc.race_name, ge.gender_name, cl.class_color, g.guild_name'
            . ' FROM #__raidplanner_character AS c'
            . ' LEFT JOIN #__users AS u ON u.id = c.profile_id'
            . ' LEFT JOIN #__raidplanner_class AS cl ON cl.class_id = c.class_id'
            . ' LEFT JOIN #__raidplanner_race AS rc ON rc.race_id = c.race_id'
            . ' LEFT JOIN #__raidplanner_gender AS ge ON ge.gender_id = c.gender_id'
            . ' LEFT JOIN #__raidplanner_guild AS g ON g.guild_id = c.guild_id'
            . $this->_buildQueryWhere();
        return $query;
    }
 
    /**
     * Retrieves the data
     * @return array Array of objects containing the data from the database
     */
    function getData()
    {
        // Lets load the data if it doesn't already exist
        if (empty( $this->_data ))
        {
            $query = $this->_buildQuery(). $this->_buildContentOrderBy();
            $this->_data = $this->_getList( $query , $this->getState('limitstart'), $this->getState('limit') );
        }

        return $this->_data;
    }
    
	function getTotal()
	{
		// Load the content if it doesn't already exist
		if (empty($this->_total)) {
			$query = $this->_buildQuery();
			$this->_total = $this->_getListCount($query);    
		}
		return $this->_total;
	}

	function getPagination()
	{
		// Load the content if it doesn't already exist
		if (empty($this->_pagination)) {
			jimport('joomla.html.pagination');
			$this->_pagination = new JPagination($this->getTotal(),0,350);
		}
		return $this->_pagination;
	}

}
