<?php
header('Content-Type: application/json');

// Path to your JSON file
$file = 'projectsdata.json';

// Check if file exists
if (file_exists($file)) {
    $json = file_get_contents($file);
    echo $json;
} else {
    // fallback if file not found
    echo "[]";
}
