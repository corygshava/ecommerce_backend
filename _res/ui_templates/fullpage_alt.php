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
    <div class="content t2 centroid">
        <div class="formguy w3-animate-zoom" data-shown="1" id="forget">
            <div class="hd">
                <span class="h3"><?=$heading?></span>
                <p style="text-wrap: auto;line-break: anywhere;"><?=json_encode($alert)?></p>
            </div>

            <div class="spacy-md">
                <a href="<?=$backlink?>" class="login btn in_fullwidth"><i class="fa fa-chevron-left"></i> go back</a>
            </div>
        </div>
    </div>