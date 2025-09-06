<?php
    $mydata = isset($mydata) ? $mydata : [];

    // $thelist = isset($mydata['thelist']) ? $mydata['thelist'] : ["no list passed"];
    $thelist = isset($thelist) ? $thelist : ["no list passed"];
    $heading = isset($mydata['heading']) ? $mydata['heading'] : "your list";
    $backlink = isset($mydata['backlink']) ? $mydata['backlink'] : "./";
    $includeheader = isset($mydata['includeheader']) ? $mydata['includeheader'] : true;
    $xtraclass = isset($mydata['xtraclass']) ? $mydata['xtraclass'] : "";
    $attribs = isset($mydata['attribs']) ? $mydata['attribs'] : "";

    $outdata = "<div class=\"itemslist\">";

    for ($i=0; $i < count($thelist); $i++) {
        $item = $thelist[$i];
        $outdata .= announce("$i - $item");
    }

    $outdata .= "</div>";
?>

<?php
    if($includeheader){
        include 'common_header.php';
    }
?>
    <div class="content t2 centroid devlist <?=$xtraclass?>" <?=$attribs?>>
        <div class="formguy w3-animate-zoom" data-shown="1" id="forget">
            <div class="hd">
                <span class="h3"><?=$heading?></span>
                <?=$outdata?>
            </div>

            <div class="spacy-md">
                <a href="<?=$backlink?>" class="login btn in_fullwidth"><i class="fa fa-chevron-left"></i> go back</a>
            </div>
        </div>
    </div>