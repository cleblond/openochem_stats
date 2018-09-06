<?php
require_once "../config.php";

//use \Tsugi\Grades\GradeUtil;

use \Tsugi\Core\LTIX;
use \Tsugi\Util\LTI;
//use \Tsugi\Util\Caliper;

// Retrieve the launch data if present
$LAUNCH = LTIX::requireData();
$p = $CFG->dbprefix;
$displayname = $USER->displayname;


$sql = "SELECT MAX(activity_id) as totalactivities FROM {$p}eo_activities";
$data = $PDOX->rowDie($sql);
$totalactivities = $data['totalactivities'];
//echo $totalactivities;


$sql = "SELECT MAX(question_id) as totalquestions FROM {$p}eo_questions";
$data = $PDOX->rowDie($sql);
$totalquestions = $data['totalquestions']-2400;
//echo $totalquestions;

$sql = "SELECT count(*) as totalsharedquestions FROM {$p}eo_questions WHERE share=1 and review_status = 'publ'";
$data = $PDOX->rowDie($sql);
$totalsharedquestions = $data['totalsharedquestions'];   //remove the zoo doubles
//echo $totalsharedquestions;

$sql = "SELECT max(attempt_id) as totalattempts FROM {$p}eo_activityattempts";
$data = $PDOX->rowDie($sql);
$totalattempts = $data['totalattempts'];   //remove the zoo doubles
//echo $totalattempts;

?>

<div class = "well">

<ul class="list-group">
  <li class="list-group-item">
    <span class="badge"><?=$totalquestions?></span>
    Total Questions
  </li>
  <li class="list-group-item">
    <span class="badge"><?=$totalsharedquestions?></span>
    Total Shared Questions
  </li>
  
  <li class="list-group-item">
    <span class="badge"><?=$totalactivities?></span>
    Total Activities
  </li>
  
  <li class="list-group-item">
    <span class="badge"><?=$totalattempts?></span>
    Total Students Quiz Attempts
  </li>
  
  
  
  
  
  
  
</ul>



</div>





<?php





// Start of the output
$OUTPUT->header();
$OUTPUT->bodyStart();
//$OUTPUT->flashMessages();


$OUTPUT->footer();

