<?php 
require_once 'config/config.php';
err([2]);
$db->trun('questions');
$db->trun('answers');
$db->trun('scores');
jump('exam.php');