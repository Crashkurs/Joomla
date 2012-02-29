<?php
/*------------------------------------------------------------------------
# Characters Controller for RaidPlanner Component
# com_raidplanner - RaidPlanner Component
# ------------------------------------------------------------------------
# author    Taracque
# copyright Copyright (C) 2011 Taracque. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Website: http://www.taracque.hu/raidplanner
-------------------------------------------------------------------------*/
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class RaidPlannerControllerDKP extends RaidPlannerController
{
	/**
	 * constructor (registers additional tasks to methods)
	 * @return void
	 */
	function __construct()
	{
		parent::__construct();

		// Register Extra tasks
		$this->registerTask( 'apply'  , 	'apply' );
    $this->registerTask( 'cancel' , 'cancel' );
	}

	/**
	 * display the edit form
	 * @return void
	 */
	function apply()
	{
		JRequest::setVar( 'view', 'dkp' );
		JRequest::setVar( 'layout', 'form'  );

    $msg = JText::_( 'DKP gespeichert' );
		$this->setRedirect( 'index.php?option=com_raidplanner&view=dkp', $msg );
	}

	/**
	 * cancel editing a record
	 * @return void
	 */
	function cancel()
	{
		$msg = JText::_( 'COM_RAIDPLANNER_OPERATION_CANCELLED' );
		$this->setRedirect( 'index.php?option=com_raidplanner&view=dkp', $msg );
	}
	
}