<?php
	$className = 'MyClass'; // Example class name
	$filename = $className . '.class.php';

	if (file_exists($filename) && is_readable($filename)) {
		include_once $filename;
		if (class_exists($className)) {
			$instance = new $className();
			
			echo "Instance of '$className' created successfully from '$filename'.\n";
		} else {
			echo "Error: File '$filename' does not contain the class '$className'.\n";
		}
	} else {
		echo "Error: File '$filename' does not exist or is not readable.\n";
	}

?>