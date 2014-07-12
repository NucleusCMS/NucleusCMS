<?php
/*
 * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/)
 * Copyright (C) 2002-2009 The Nucleus Group
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * (see nucleus/documentation/index.html#license for more info)
 */

/**
 * Part of the code for the Nucleus admin area
 *
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-2009 The Nucleus Group
 * @version $Id$
 */

class ENCAPSULATE {
	/**
	  * Uses $call to call a function using parameters $params
	  * This function should return the amount of entries shown.
	  * When entries are show, batch operation handlers are shown too.
	  * When no entries were shown, $errormsg is used to display an error
	  *
	  * Passes on the amount of results found (for further encapsulation)
	  */
	function doEncapsulate(&$call, &$params, $errorMessage = _ENCAPSULATE_ENCAPSULATE_NOENTRY) {
		// start output buffering
		ob_start();

		$nbOfRows = call_user_func_array($call, $params);

		// get list contents and stop buffering
		$list = ob_get_contents();
		ob_end_clean();

		if ($nbOfRows > 0) {
			$this->showHead();
			echo $list;
			$this->showFoot();
		} else {
			echo $errorMessage;
		}

		return $nbOfRows;
	}
}

/**
  * A class used to encapsulate a list of some sort inside next/prev buttons
  */
class NAVLIST extends ENCAPSULATE {

	function NAVLIST($action, $start, $amount, $minamount, $maxamount, $blogid, $search, $itemid) {
		$this->action = $action;
		$this->start = $start;
		$this->amount = $amount;
		$this->minamount = $minamount;
		$this->maxamount = $maxamount;
		$this->blogid = $blogid;
		$this->search = $search;
		$this->itemid = $itemid;
	}

	function showBatchList($batchtype, &$query, $type, $template, $errorMessage = _LISTS_NOMORE)
	{
		$batch = new BATCH($batchtype);
		$call = array($batch, 'showlist');
		$params = array(&$query, $type, $template);
		$this->doEncapsulate($call, $params, $errorMessage);
	}


	function showHead() {
		$this->showNavigation();
	}
	function showFoot() {
		$this->showNavigation();
	}

	/**
	  * Displays a next/prev bar for long tables
	  */
	function showNavigation() {
		$action = $this->action;
		$start = $this->start;
		$amount = $this->amount;
		$minamount = $this->minamount;
		$maxamount = $this->maxamount;
		$blogid = $this->blogid;
		$search = htmlspecialchars($this->search,ENT_QUOTES,_CHARSET);
		$itemid = $this->itemid;

		$prev = $start - $amount;
		if ($prev < $minamount) $prev=$minamount;

		// maxamount not used yet
	//	if ($start + $amount <= $maxamount)
			$next = $start + $amount;
	//	else
	//		$next = $start;

	?>
	<table class="navigation">
	<tr><td>
		<form method="post" action="index.php"><div>
		<input type="submit" value="&lt;&lt; <?php echo  _LISTS_PREV?>" />
		<input type="hidden" name="blogid" value="<?php echo  $blogid; ?>" />
		<input type="hidden" name="itemid" value="<?php echo  $itemid; ?>" />
		<input type="hidden" name="action" value="<?php echo  $action; ?>" />
		<input type="hidden" name="amount" value="<?php echo  $amount; ?>" />
		<input type="hidden" name="search" value="<?php echo  $search; ?>" />
		<input type="hidden" name="start" value="<?php echo  $prev; ?>" />
		</div></form>
	</td><td>
		<form method="post" action="index.php"><div>
		<input type="hidden" name="blogid" value="<?php echo  $blogid; ?>" />
		<input type="hidden" name="itemid" value="<?php echo  $itemid; ?>" />
		<input type="hidden" name="action" value="<?php echo  $action; ?>" />
		<input name="amount" size="3" value="<?php echo  $amount; ?>" /> <?php echo _LISTS_PERPAGE?>
		<input type="hidden" name="start" value="<?php echo  $start; ?>" />
		<input type="hidden" name="search" value="<?php echo  $search; ?>" />
		<input type="submit" value="&gt; <?php echo _LISTS_CHANGE?>" />
		</div></form>
	</td><td>
		<form method="post" action="index.php"><div>
		<input type="hidden" name="blogid" value="<?php echo  $blogid; ?>" />
		<input type="hidden" name="itemid" value="<?php echo  $itemid; ?>" />
		<input type="hidden" name="action" value="<?php echo  $action; ?>" />
		<input type="hidden" name="amount" value="<?php echo  $amount; ?>" />
		<input type="hidden" name="start" value="0" />
		<input type="text" name="search" value="<?php echo  $search; ?>" size="7" />
		<input type="submit" value="&gt; <?php echo  _LISTS_SEARCH?>" />
		</div></form>
	</td><td>
		<form method="post" action="index.php"><div>
		<input type="submit" value="<?php echo _LISTS_NEXT?> &gt; &gt;" />
		<input type="hidden" name="search" value="<?php echo  $search; ?>" />
		<input type="hidden" name="blogid" value="<?php echo  $blogid; ?>" />
		<input type="hidden" name="itemid" value="<?php echo  $itemid; ?>" />
		<input type="hidden" name="action" value="<?php echo  $action; ?>" />
		<input type="hidden" name="amount" value="<?php echo  $amount; ?>" />
		<input type="hidden" name="start" value="<?php echo  $next; ?>" />
		</div></form>
	</td></tr>
	</table>
	<?php	}


}


/**
 * A class used to encapsulate a list of some sort in a batch selection
 */
class BATCH extends ENCAPSULATE {
	function BATCH($type) {
		$this->type = $type;
	}

	function showHead() {
		?>
			<form method="post" action="index.php">
		<?php
// TODO: get a list op operations above the list too
// (be careful not to use the same names for the select...)
//		$this->showOperationList();
	}

	function showFoot() {
		$this->showOperationList();
		?>
			</form>
		<?php	}

	function showOperationList() {
		global $manager;
		?>
		<div class="batchoperations">
			<?php echo _BATCH_WITH_SEL ?>
			<select name="batchaction">
			<?php				$options = array();
				switch($this->type) {
					case 'item':
						$options = array(
							'delete'	=> _BATCH_ITEM_DELETE,
							'move'		=> _BATCH_ITEM_MOVE
						);
						break;
					case 'member':
						$options = array(
							'delete'	=> _BATCH_MEMBER_DELETE,
							'setadmin'	=> _BATCH_MEMBER_SET_ADM,
							'unsetadmin' => _BATCH_MEMBER_UNSET_ADM
						);
						break;
					case 'team':
						$options = array(
							'delete' 	=> _BATCH_TEAM_DELETE,
							'setadmin'	=> _BATCH_TEAM_SET_ADM,
							'unsetadmin' => _BATCH_TEAM_UNSET_ADM,
						);
						break;
					case 'category':
						$options = array(
							'delete'	=> _BATCH_CAT_DELETE,
							'move'		=> _BATCH_CAT_MOVE,
						);
						break;
					case 'comment':
						$options = array(
							'delete'	=> _BATCH_COMMENT_DELETE,
						);
					break;
				}
				foreach ($options as $option => $label) {
					echo '<option value="',$option,'">',$label,'</option>';
				}
			?>
			</select>
			<input type="hidden" name="action" value="batch<?php echo $this->type?>" />
			<?php
				$manager->addTicketHidden();

				// add hidden fields for 'team' and 'comment' batchlists
				if ($this->type == 'team')
				{
					echo '<input type="hidden" name="blogid" value="',intRequestVar('blogid'),'" />';
				}
				if ($this->type == 'comment')
				{
					echo '<input type="hidden" name="itemid" value="',intRequestVar('itemid'),'" />';
				}

				echo '<input type="submit" value="',_BATCH_EXEC,'" />';
			?>(
			 <a href="" onclick="if (event &amp;&amp; event.preventDefault) event.preventDefault(); return batchSelectAll(1); "><?php echo _BATCH_SELECTALL?></a> -
			 <a href="" onclick="if (event &amp;&amp; event.preventDefault) event.preventDefault(); return batchSelectAll(0); "><?php echo _BATCH_DESELECTALL?></a>
			)
		</div>
		<?php	}

	// shortcut :)
	function showList($query, $type, $template, $errorMessage = _LISTS_NOMORE)
	{
		$call = 'showlist';
		$params = array($query, $type, $template);
		return $this->doEncapsulate($call, $params, $errorMessage);
	}
}
?>
