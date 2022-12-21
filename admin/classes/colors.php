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

class colorSchemer {

var $prefix;

function addScheme () {
  $connect = mysqli_connect('re9','hans','hanshans','survey');
  $_POST = array_map('safeImport',$_POST);
  mysqli_query($connect,"INSERT INTO ".$this->prefix."colorschemes (
               csc_title,
               csc_width,
               title_background,
               title_color,
               title_font,
               title_size,
               question_background,
               question_color,
               question_font,
               question_size,
               answer_background,
               answer_color,
               answer_font,
               answer_size
               ) VALUES (
               '".$_POST['csc_title']."',
               '".($_POST['csc_width'] ? $_POST['csc_width'] : '600')."',
               '".$_POST['title_background']."',
               '".$_POST['title_color']."',
               '".$_POST['title_font']."',
               '".$_POST['title_size']."',
               '".$_POST['question_background']."',
               '".$_POST['question_color']."',
               '".$_POST['question_font']."',
               '".$_POST['question_size']."',
               '".$_POST['answer_background']."',
               '".$_POST['answer_color']."',
               '".$_POST['answer_font']."',
               '".$_POST['answer_size']."'
               )") or die(db_MSG(__FILE__,__LINE__,$connect));
}

function updateScheme () {
$connect = mysqli_connect('re9','hans','hanshans','survey');
  $_POST = array_map('safeImport',$_POST);
  mysqli_query($connect,"UPDATE ".$this->prefix."colorschemes SET
               csc_title            = '".$_POST['csc_title']."',
               csc_width            = '".($_POST['csc_width'] ? $_POST['csc_width'] : '600')."',
               title_background     = '".$_POST['title_background']."',
               title_color          = '".$_POST['title_color']."',
               title_font           = '".$_POST['title_font']."',
               title_size           = '".$_POST['title_size']."',
               question_background  = '".$_POST['question_background']."',
               question_color       = '".$_POST['question_color']."',
               question_font        = '".$_POST['question_font']."',
               question_size        = '".$_POST['question_size']."',
               answer_background    = '".$_POST['answer_background']."',
               answer_color         = '".$_POST['answer_color']."',
               answer_font          = '".$_POST['answer_font']."',
               answer_size          = '".$_POST['answer_size']."'
               WHERE csc_id         = '".(int)$_POST['edit']."'
               LIMIT 1
               ") or die(db_MSG(__FILE__,__LINE__,$connect));
}

function deleteScheme ($id) {
$connect = mysqli_connect('re9','hans','hanshans','survey');
  $id = (int)$id;
  mysqli_query($connect,"DELETE FROM ".$this->prefix."colorschemes 
               WHERE csc_id = '$id' LIMIT 1
               ") or die(db_MSG(__FILE__,__LINE__,$connect));
}

function getScheme ($id) {
$connect = mysqli_connect('re9','hans','hanshans','survey');
  $id = (int)$id;
  $query = mysqli_query($connect,"SELECT * FROM ".$this->prefix."colorschemes 
                        WHERE csc_id = '$id' LIMIT 1
                        ") or die(db_MSG(__FILE__,__LINE__,$connect));
  return mysqli_fetch_object($query);
}

function checkTitle ($title,$id='') {
$connect = mysqli_connect('re9','hans','hanshans','survey');
  $query = mysqli_query($connect,"SELECT * FROM ".$this->prefix."colorschemes 
                        WHERE csc_title = '".safeImport($title)."'
                        ".($id ? 'AND csc_id != \''.(int)$id.'\'' : '')."
                        LIMIT 1
                        ") or die(db_MSG(__FILE__,__LINE__,$connect));
  return (mysqli_num_rows($query)>0 ? true : false);
}

}

?>
