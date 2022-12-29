<?php
header('Access-Control-Allow-Origin: *');
// header('Access-Control-Allow-Headers:  Content-Type, X-Auth-Token, Authorization, Origin');
// header('Access-Control-Allow-Methods:  POST, PUT, GET');

$GLOBALS['resultsFile'] = "results.csv";

// Sanitize input
$_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

function recordResults() {
    echo "Recording results… "; 
    $myfile = fopen($GLOBALS['resultsFile'], "a") or die("Unable to open file!");
    $data = "Testing\n";
    fwrite($myfile, $data);
    echo "Done!";
    fclose($myfile);
}

recordResults();

echo "Saved2!";

?>