<?php
ini_set('display_errors', 'off');

//error_reporting(E_ALL);
//ini_set('display_errors', 'on');
// Include the Xataface API
require_once 'xataface/dataface-public-api.php';

// Initialize Xataface framework
df_init(__FILE__, 'xataface');
    // first parameter is always the same (path to the current script)
    // 2nd parameter is relative URL to xataface directory (used for CSS files and javascripts)

// Create a new application
$app =& Dataface_Application::getInstance();

// Display the application
$app->display();


function before_form(){
    $jt = Dataface_JavascriptTool::getInstance();
    $jt->import('test/plugin.js');
}

?>