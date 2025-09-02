<?php
    $alert = isset($alert) ? $alert : "alert information";
    $heading = isset($heading) ? $heading : "heading";
    $backlink = isset($backlink) ? $backlink : "./";
    $includeheader = isset($includeheader) ? $includeheader : true;
    $mytitile = 'JRM - list display';
?>

<?php
    if($includeheader){
        include 'common_header.php';
    }
?>
    <div class="content">
        <div class="container w3-animate-zoom" data-shown="1" id="forget">
            <div class="hd">
                <span class="h3"><?=$heading?></span>
                <p style="text-wrap: auto;line-break: anywhere;"><?=$alert?></p>
            </div>

            <div class="spacy-md">
                <a href="<?=$backlink?>" class="login btn">go back</a>
            </div>
        </div>
    </div>