<?php
    //  writes to a log file
    $daytamp = date("dmy");
    $tstamp = date("dmy-h:i:s");
    $logfile = __DIR__."/../logfiles/[{$daytamp}]_eventslog.log";
    $logline = isset($logline) ? $logline : "blank log request";

    // include __DIR__.'/fileops.php';

    $fylops = null;
    load_packages('fileops','fileops',$fylops);

    $createres = $fylops::create_file_if_missing($logfile);

    if($createres){
        file_put_contents($logfile, "\n[$tstamp] - $logline", FILE_APPEND | LOCK_EX);
    } else {
        echo "error creating logfile. try again";
        exit();
    }
?>