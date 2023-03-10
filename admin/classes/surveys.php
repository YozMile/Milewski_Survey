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

class surveys {

var $prefix;

function addSurvey () {
$connect = mysqli_connect('re9','hans','hanshans','survey');
  $_POST = array_map('safeImport',$_POST);
  mysqli_query($connect,"INSERT INTO ".$this->prefix."surveys (
               sur_title,
               sur_display_type,
               sur_title_should_display,
               sur_captcha,
               sur_email_request,
               sur_email_request_message,
               sur_view_summary,
               sur_date_expire,
               sur_complete_goto_url,
               sur_complete_url,
               sur_complete_message,
               sur_allow_multiple_votes,
               sur_notification_email,
               sur_status,
               sur_dare_created,
               sur_color_scheme,
               uniCode,
               en_keys
               ) VALUES (
               '".$_POST['sur_title']."',
               '".(isset($_POST['sur_display_type']) ? $_POST['sur_display_type'] : '0')."',
               '".(isset($_POST['sur_title_should_display']) ? $_POST['sur_title_should_display'] : '1')."',
               '".(isset($_POST['sur_captcha']) ? $_POST['sur_captcha'] : '1')."',
               '".(isset($_POST['sur_email_request']) ? $_POST['sur_email_request'] : '1')."',
               '".$_POST['sur_email_request_message']."',
               '".(isset($_POST['sur_view_summary']) ? $_POST['sur_view_summary'] : '0')."',
               '".($_POST['year']>0 && $_POST['month']>0 && $_POST['day']>0 ? $_POST['year'].'-'.$_POST['month'].'-'.$_POST['day'] : '1000-01-01')."',
               '".(isset($_POST['sur_complete_goto_url']) && $_POST['sur_complete_goto_url'] ? '1' : '0')."',
               '".$_POST['sur_complete_url']."',
               '".$_POST['sur_complete_message']."',
               '".(isset($_POST['sur_allow_multiple_votes']) ? $_POST['sur_allow_multiple_votes'] : '0')."',
               '".$_POST['sur_notification_email']."',
               '".(isset($_POST['sur_status']) ? $_POST['sur_status'] : '1')."',
               now(),
               '".$_POST['sur_color_scheme']."',
               '".substr(md5(uniqid(rand(),1)), 2, 7)."',
               '".(isset($_POST['en_keys']) ? $_POST['en_keys'] : '0')."'
               )") or die(db_MSG(__FILE__,__LINE__,$connect));
}

function updateSurvey () {
$connect = mysqli_connect('re9','hans','hanshans','survey');
  $_POST = array_map('safeImport',$_POST);
  mysqli_query($connect,"UPDATE ".$this->prefix."surveys SET
               sur_title                 = '".$_POST['sur_title']."',
               sur_display_type          = '".(isset($_POST['sur_display_type']) ? $_POST['sur_display_type'] : '0')."',
               sur_title_should_display  = '".(isset($_POST['sur_title_should_display']) ? $_POST['sur_title_should_display'] : '1')."',
               sur_captcha               = '".(isset($_POST['sur_captcha']) ? $_POST['sur_captcha'] : '1')."',
               sur_email_request         = '".(isset($_POST['sur_email_request']) ? $_POST['sur_email_request'] : '1')."',
               sur_email_request_message = '".$_POST['sur_email_request_message']."',
               sur_view_summary          = '".(isset($_POST['sur_view_summary']) ? $_POST['sur_view_summary'] : '0')."',
               sur_date_expire           = '".($_POST['year']>0 && $_POST['month']>0 && $_POST['day']>0 ? $_POST['year'].'-'.$_POST['month'].'-'.$_POST['day'] : '1000-01-01')."',
               sur_complete_goto_url     = '".(isset($_POST['sur_complete_goto_url']) && $_POST['sur_complete_goto_url'] ? '1' : '0')."',
               sur_complete_url          = '".$_POST['sur_complete_url']."',
               sur_complete_message      = '".$_POST['sur_complete_message']."',
               sur_allow_multiple_votes  = '".(isset($_POST['sur_allow_multiple_votes']) ? $_POST['sur_allow_multiple_votes'] : '0')."',
               sur_notification_email    = '".$_POST['sur_notification_email']."',
               sur_status                = '".(isset($_POST['sur_status']) ? $_POST['sur_status'] : '1')."',
               sur_color_scheme          = '".$_POST['sur_color_scheme']."',
               en_keys                   = '".(isset($_POST['en_keys']) ? $_POST['en_keys'] : '0')."'
               WHERE sur_id              = '".(int)$_POST['edit']."'
               ") or die(db_MSG(__FILE__,__LINE__,$connect));
}

function deleteSurvey ($id) {
$connect = mysqli_connect('re9','hans','hanshans','survey');
  $id = (int)$id;
  // Clear survey..
  mysqli_query($connect,"DELETE FROM ".$this->prefix."surveys 
               WHERE sur_id = '$id' LIMIT 1
               ") or die(db_MSG(__FILE__,__LINE__,$connect));
  // Clear visitor data..
  mysqli_query($connect,"DELETE FROM ".$this->prefix."users 
               WHERE usr_sur_id = '$id'
               ") or die(db_MSG(__FILE__,__LINE__,$connect));
  // Clear keywords..
  mysqli_query($connect,"DELETE FROM ".$this->prefix."keywords 
               WHERE key_sur_id = '$id'
               ") or die(db_MSG(__FILE__,__LINE__,$connect));             
  // Clear answers and variants..             
  $q_clear = mysqli_query($connect,"SELECT * FROM ".$this->prefix."questions 
                          WHERE que_sur_id = '$id'
                          ") or die(db_MSG(__FILE__,__LINE__,$connect));
  while ($CLEAR = mysqli_fetch_object($q_clear)) {
    mysqli_query($connect,"DELETE FROM ".$this->prefix."answers 
                 WHERE ans_que_id = '".$CLEAR->que_id."'
                 ") or die(db_MSG(__FILE__,__LINE__,$connect));
    mysqli_query($connect,"DELETE FROM ".$this->prefix."variants 
                 WHERE var_que_id = '".$CLEAR->que_id."'
                 ") or die(db_MSG(__FILE__,__LINE__,$connect));
  } 
  // Finally clear questions..
  mysqli_query($connect,"DELETE FROM ".$this->prefix."questions 
               WHERE que_sur_id = '$id'
               ") or die(db_MSG(__FILE__,__LINE__,$connect));                                     
}

function clearResults($id) {
$connect = mysqli_connect('re9','hans','hanshans','survey');
  $id = (int)$id;
  mysqli_query($connect,"DELETE FROM ".$this->prefix."users WHERE usr_sur_id = '$id'") or die(db_MSG(__FILE__,__LINE__,$connect));
  mysqli_query($connect,"DELETE FROM ".$this->prefix."answers WHERE ans_sur_id = '$id'") or die(db_MSG(__FILE__,__LINE__,$connect));
}

function clearContacts($id) {
$connect = mysqli_connect('re9','hans','hanshans','survey');
  $id = (int)$id;
  mysqli_query($connect,"DELETE FROM ".$this->prefix."users WHERE usr_sur_id = '$id'") or die(db_MSG(__FILE__,__LINE__,$connect));
}

function getSurvey ($id) {
$connect = mysqli_connect('re9','hans','hanshans','survey');
  $id = (int)$id;
  $query = mysqli_query($connect,"SELECT * FROM ".$this->prefix."surveys 
                        WHERE sur_id = '$id' LIMIT 1
                        ") or die(db_MSG(__FILE__,__LINE__,$connect));
  return mysqli_fetch_object($query);
}

function checkTitle ($title,$id='') {
$connect = mysqli_connect('re9','hans','hanshans','survey');
  $query = mysqli_query($connect,"SELECT * FROM ".$this->prefix."surveys 
                        WHERE sur_title = '".safeImport($title)."'
                        ".($id ? 'AND sur_id != \''.(int)$id.'\'' : '')."
                        LIMIT 1
                        ") or die(db_MSG(__FILE__,__LINE__,$connect));
  return (mysqli_num_rows($query)>0 ? true : false);
}

}

?>
