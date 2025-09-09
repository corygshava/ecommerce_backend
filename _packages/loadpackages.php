<?php
	function load_package($pkg,$classname=null,&$instance=null){
		$pkgfile = __DIR__."/$pkg/main.php";

		$classname = $classname == null ? $pkg : $classname;

		if(!file_exists($pkgfile)){
			say('>> the model doesnt seem to exist',"loadpackages");
		}

		if(!is_readable($pkgfile)){
			say('>> the model file is unreadable, check its permissions',"loadpackages");
		}

		require_once $pkgfile;
		say_silent("package loaded : ($pkg)","loadpackages");

		if($instance != null){
			if(class_exists($classname)){
				$instance = new $classname();
			} else {
				say(">> invalid classname given","loadpackages");
			}
		}
	}

	// load necessary packages (removed for performance reasons)

	// end of loaders

	say(">> packages loaded","loadpackages");
?>