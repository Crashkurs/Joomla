<?php
/*------------------------------------------------------------------------
# Characters List Template for RaidPlanner Component
# com_raidplanner - RaidPlanner Component
# ------------------------------------------------------------------------
# author    Taracque
# copyright Copyright (C) 2011 Taracque. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Website: http://www.taracque.hu/raidplanner
-------------------------------------------------------------------------*/
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
?>
<form action="index.php" method="post" name="adminForm">
<div id="editcell">
		Dieser Bereich funktioniert zurzeit nur zum Anzeigen von DKP! Bitte benutze die Character&uuml;bersicht, um DKP zu editieren.<br><br>
  <table class="adminlist">
  <thead><tr>
    <th width="20">
		  <input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->characters ); ?>);" />
	  </th>
    <th width="5">
      <?php echo JText::_( 'JGRID_HEADING_ID' ); ?>
    </th>
    <th>
      <?php echo JHTML::_( 'grid.sort', 'COM_RAIDPLANNER_CHARACTER_NAME', 'c.char_name', $this->lists['order_Dir'], $this->lists['order']); ?>
    </th>
    <th>
      <?php echo JHTML::_( 'grid.sort', 'JGLOBAL_USERNAME', 'u.name', $this->lists['order_Dir'], $this->lists['order']); ?>
    </th>
    <th>
      <?php echo JHTML::_( 'grid.sort', 'COM_RAIDPLANNER_DKP', 'c.dkp', $this->lists['order_Dir'], $this->lists['order']); ?>
    </th>
  </tr></thead>
  <tbody>
  <?
  $i = 0;
  $k = 0;
  
  foreach($this->characters as $char)
  {
    $checked    = JHTML::_( 'grid.id', $i++, $char->character_id );
    ?>
    <tr>
      <td width="20"><center><? echo $checked; ?></center></td>
      <td width="5"><center><? echo $char->character_id; ?></center></td>
      <td width="180"><center><? echo $char->char_name; ?></center></td>
      <td width="150"><center><? echo $char->user_name; ?></center></td>
      <td width="90"><center><input type="textfield" value=<? echo $char->dkp; ?> /></center></td>
    </tr>
    
    
    <?
  }
  ?>
  </tbody>
  </table>
</div>
<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
<input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />
<input type="hidden" name="option" value="com_raidplanner" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="controller" value="dkp" />
<input type="hidden" name="view" value="dkp" />
</form>
