<?php

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
/*---------------------------------------------
  MAIAN SURVEY v1.1
  Written by David Ian Bennett
  E-Mail: N/A
  Website: www.maiansurvey.com
----------------------------------------------*/

class keywords {

var $prefix;

function clearKeywords() {
  $connect = mysqli_connect('re9','hans','hanshans','survey');
  mysqli_query($connect,"DELETE FROM ".$this->prefix."keywords
               WHERE key_sur_id = '".(int)$_GET['survey']."'
               ".(isset($_GET['question']) && ctype_digit($_GET['question']) ? 'AND key_que_id = \''.(int)$_GET['question'].'\'' : '')."
               ".(isset($_GET['from']) &&  $_GET['from'] && isset($_GET['to']) && $_GET['to'] ? 'AND key_date BETWEEN \''.$_GET['from'].'\' AND \''.$_GET['to'].'\'' : '')."
               ") or die(db_MSG(__FILE__,__LINE__,$connect));
}

}

?>
