<?php
if (!defined('INC')) { die('Error! You don`t have permission to view this file!'); }
?>		
		
		<div class="content">

			<h1><?php echo $msg_header8; ?></h1>
			
      <p><?php echo $msg_settings; ?></p>
      
      <form method="post" action="index.php?cmd=settings">
      <input type="hidden" name="process" value="1" />
      
      <div class="formOptionWrap">
      <label class="first"><?php echo $msg_settings2; ?>:</label>
      <input disabled="true" type="text" class="box" name="cfg_wname" value="<?php echo (isset($_POST['cfg_wname']) ? cleanDataEnt($_POST['cfg_wname']) : cleanDataEnt($SETTINGS->cfg_wname)); ?>" />
      <?php echo (isset($N_ERROR) ? '<span class="error">'.$N_ERROR.'</span>' : ''); ?>
      </div>
      
      <div class="formOptionWrap">
      <label><?php echo $msg_settings3; ?>:</label>
      <input disabled="true" type="text" class="box" name="cfg_wemail" value="<?php echo (isset($_POST['cfg_wemail']) ? cleanDataEnt($_POST['cfg_wemail']) : cleanDataEnt($SETTINGS->cfg_wemail)); ?>" />
      <?php echo (isset($E_ERROR) ? '<span class="error">'.$E_ERROR.'</span>' : ''); ?>
      </div>
      
      <div class="formOptionWrap">
      <label><?php echo $msg_settings4; ?>:</label>
      <input disabled="true" type="text" class="box" name="cfg_wurl" value="<?php echo (isset($_POST['cfg_wurl']) ? cleanDataEnt($_POST['cfg_wurl']) : cleanDataEnt($SETTINGS->cfg_wurl)); ?>" /> <?php echo toolTip($msg_javascript2,$msg_javascript3); ?>
      <?php echo (isset($U_ERROR) ? '<span class="error">'.$U_ERROR.'</span>' : ''); ?>
      </div>
      
      <div class="formOptionWrap">
      <label><?php echo $msg_settings14; ?>:</label>
      <input disabled="true" type="text" class="box" name="cfg_afflink" value="<?php echo (isset($_POST['cfg_afflink']) ? cleanDataEnt($_POST['cfg_afflink']) : cleanDataEnt($SETTINGS->cfg_afflink)); ?>" /> <?php echo toolTip($msg_javascript2,$msg_javascript18); ?>
      </div>
      
      <br />
      <input disabled="true" type="submit" class="button" value="<?php echo cleanDataEnt($msg_settings5); ?>" title="<?php echo cleanDataEnt($msg_settings5); ?>" />
      
      </form>

		</div>

		<div class="sidenav">
		
		  <h2><?php echo $msg_home7; ?></h2>
			<ul>
				<li><a href="index.php?cmd=create-survey" title="<?php echo cleanDataEnt($msg_survey2); ?>"><img src="templates/img/links/create.gif" alt="" title="" />&nbsp;&nbsp;<?php echo $msg_survey2; ?></a></li>
				<li><a href="index.php?cmd=create-colour-scheme" title="<?php echo cleanDataEnt($msg_colours2); ?>"><img src="templates/img/links/new-color-scheme.gif" alt="" title="" />&nbsp;&nbsp;<?php echo $msg_colours2; ?></a></li>
				<li><a href="../docs/setup/index.php" title="<?php echo cleanDataEnt($msg_home6); ?>" target="_blank"><img src="templates/img/links/docs.gif" alt="" title="" />&nbsp;&nbsp;<?php echo $msg_home6; ?></a></li>
			</ul>
		
		</div>

		
