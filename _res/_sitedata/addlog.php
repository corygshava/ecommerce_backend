<?php
    //  writes to a log file
    $daytamp = date("dmy");
    $tstamp = date("dmy-h:i:s");
    $logfile = __DIR__."/../logfiles/[{$daytamp}]_eventslog.log";
    $logline = isset($logline) ? $logline : "blank log request";

    require_once __DIR__.'/../../_packages/loadpackages.php';

    load_package('fileops');
    $fylops = new fileops();

    $createres = $fylops::create_file_if_missing($logfile);

    if($createres){
        file_put_contents($logfile, "\n[$tstamp] - $logline", FILE_APPEND | LOCK_EX);
        say("line: $logline","addlog");
    } else {
        throw new Exception("error creating logfile. retry request", 1);
    }
?>