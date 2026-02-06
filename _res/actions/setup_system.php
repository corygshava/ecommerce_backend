<?php
	// this code sets up the system's database
	// Array of table names and their corresponding fields
	$tables = array(
		'admins' => array(
			'id INT AUTO_INCREMENT PRIMARY KEY',
			'username TEXT',
			'password TEXT',
			'email text',
			'last_login datetime default NULL',
			'last_logout_request datetime default NULL'
		),
		"products" => array(
			'id INT AUTO_INCREMENT PRIMARY KEY',
			'p_name varchar(30) default null',
			'p_stock int',
			'p_price decimal(10,2)',
			'p_desc text default null',
			'p_photos text'
		)
	);

	$defaults = array(
		'publish int default 1',
		'status int default 1',
		'date_created datetime default CURRENT_TIMESTAMP',
		'created_by int default 1',
		'date_updated datetime default CURRENT_TIMESTAMP',
		'updated_by int default 1'
	);

	// Loop through each table and check if it exists, if not, create it
	foreach ($tables as $tableName => $fields) {
		$allfields = array_merge($fields,$defaults);
		$cols = implode(",", $allfields);
		// say("columns sql code <br>".$cols,"setup_system");

		// continue;
		$createTableQuery = "CREATE TABLE IF NOT EXISTS`$tableName` ($cols)";
		$create = Qrun::run($createTableQuery);

		if ($create["success"] && $create["result"]) {
			say("Table $tableName created successfully.<br>","setup_system");
		} else {
			say("Error creating table $tableName: " . $create["result"] . "<br>","setup_system");
		}

		// say(json_encode($create),"setup_system");
	}

	// Add an admin record in users if not exists
	$adminCheck = Qrun::run("SELECT * FROM admins WHERE username = ?", ['admin']);

	if ($adminCheck["success"] && empty($adminCheck["result"])) {
		$thedate = date("Y-m-d H:i:s");
		$insert = Qrun::run(
				"INSERT INTO admins (username, password, email, last_login, created_by, updated_by
				) VALUES (?,?,?,?,1,1);",
			['admin', md5('1234'), 'admin@houseofjrm.com', $thedate],
			[PDO::PARAM_STR, PDO::PARAM_STR, PDO::PARAM_STR, PDO::PARAM_STR]
		);

		if ($insert["success"] && $insert["result"]) {
			say("Admin user inserted.<br>","setup_system");
		} else {
			say("Error inserting admin user: " . $insert["result"] . "<br>","setup_system");
		}
	} else {
		say("admin user found","setup_system");
	}
?>