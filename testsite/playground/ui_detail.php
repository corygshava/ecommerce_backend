<?php
    function getUserStatusName($bool,$t_){
        $name = "";
        switch ($bool){
            case 1:
                $name = $t_['Active'];
                break;
            default:
                $name = $t_['Inactive'];
        }
        return $name;
    }
?>

<?php
    // detail agnosticiser attempt

    class viewitem{
        public $caption = "";
        public $value = "";
        public $myid = 0;

        function __construct($cap='caption',$val='sample',$id=0){
            $this->caption = $cap;
            $this->value = $val;
            $this->myid = $id;
        }
    }

    $itemscounter = 0;

    $items = [];

    // edit with whatever class, just make sure you know the data that will be passed in the view() method
    $classname = "Staff";
    $title = $t_['staff'];

    array_push($items, new viewitem($t_['Status'],getUserStatusName($_DATA['user_status'],$t_),$itemscounter++));
    array_push($items, new viewitem($t_['staff_name'],$_DATA['name'],$itemscounter++));
    array_push($items, new viewitem($t_['staff_id'],$_DATA['staff_id'],$itemscounter++));
    array_push($items, new viewitem($t_['staff_address'],$_DATA['address'],$itemscounter++));
    array_push($items, new viewitem($t_['staff_department'],$_DATA['department'],$itemscounter++));

    /*
        fields
            name
            staff_id
            address
            department
    */

    $jsondata = json_encode($items);
?>

<?php
    // mek UI based on the fields
    $outht = "
    <table>
        <tbody>";

    $debught = "";

    foreach ($items as $item) {
        $thecaption = $item->caption;
        $thevalue = $item->value;

        $debught .= "<br>".json_encode($item);

        $outht .= "
            <tr>
                <td class=\"_right\"><label
                        class=\"label_1\">$thecaption</label>
                </td>
                <td class=\"p_2 _left\">$thevalue</td>
            </tr>
        ";
    }

    $outht .= "
        </tbody>
    </table>";
?>

<div class="page-header">
    <h1>
        <?php echo $accountLabel; ?>
    </h1>
    <?php include 'views/widgets/utility_menu_buttons_ustp.php' ?>
</div>
<!-- /.page-header -->

<!-- debug html -->
<div class="alert bg-blue white" data-role="debugdata">
    <h3>Debug Data</h3>
    <?=$debught?>
</div>

<div class="alert bg-blue white" data-role="debugdata">
    <h3>JSON</h3>
    <?=$jsondata?>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="widget-box">
            <div class="widget-body">
                <div class="widget-main">
                    <div id="neededprint">
                        <div class="row">
                            <div class="col-xs-7 widget-container-span ui-sortable">
                                <div class="widget-box transparent">
                                    <div class="widget-header">
                                        <h4 class="lighter"><i
                                                class="fa fa-user grey"></i>&nbsp;<?=$title?>
                                        </h4>
                                    </div>

                                    <div class="widget-body">
                                        <div class="widget-main padding-6 no-padding-left no-padding-right">
                                            <?=$outht?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- PAGE CONTENT ENDS -->
</div>

<!-- UI shakeup codes -->
<script>
    let debugsel = '[data-role="debugdata"]';

    $(document).ready(() => {
        $(debugsel).hide(); // uncomment to hide the debug data
        $(debugsel).click(() => {$(debugsel).hide()});
    })
</script>

<script>

    var blat = "<?php echo $lat; ?>";
    var blon = "<?php echo $lon; ?>";
    var map;
    var marker;
    var t;
    //
    function initMap() {
        
        // The location of Pickup point
        var bloc = {lat: parseFloat(blat), lng: parseFloat(blon)};
        
        map = new google.maps.Map(document.getElementById('map-locationn'), {
          center: bloc,
          zoom: 15,
          clickableIcons: false,
          disableDefaultUI: true,
          gestureHandling: 'none',
          zoomControl: true
        });
        
        // The main marker
        if(blat == "0" && blon == "0"){
            
        } else {
            marker = new google.maps.Marker({
                map: map,
                draggable: true,
                animation: google.maps.Animation.DROP,
                position: bloc,
                
            });
            
            setTimeout(function(){ 
                toggleBounce();
                
            }, 1000);
        }
            
  
    }
    
    function toggleBounce() {
      if (marker.getAnimation() !== null) {
        marker.setAnimation(null);
      } else {
        marker.setAnimation(google.maps.Animation.BOUNCE);
      }
    }
    
    function removeMarkers(){
        if(markers.length > 0){
            for(i=0; i < markers.length; i++){
                markers[i].setMap(null);
            }
        }
    } 
    //
</script>

<!-- ajax based ops -->
<script>
    $(".utility-buttons").removeClass('hidden');
    $("#close-icon-ustp").removeClass('hidden');
    $("#refresh-icon").removeClass('hidden');

    let moduleName = "Staff";

    //in navigation
    utilNavigation(`${moduleName}/addEditView`);

    //in navigation
    // utilNavigation("Staff");
   
    //Varaibles that store data sent from row
    var collectiveDataAc = '<?php echo json_encode($_DATA); ?>';
    var collectiveDataAcObject = JSON.parse(collectiveDataAc);
    
     // Variable to store your files
    var files5;
    var uploadedImageUrl5 = "";
    var setImageDivId5 = "";

    //
    function updateUiAfterAjax5($data) {
        showGritter($data.title, $data.message, $data.type);
    }
    //
    function setUploadedImage5(st,tp){
        ajaxRequest("UserAccount/addPhoto",updateUiAfterAjax5,"id=<?php echo  $_DATA['id'];  ?>&url="+st,"POST","json",false);
        
        
        //alert(last_upload_file_type);
        if(tp == "imagegif" || tp == "imagejpeg" || tp == "imagepng"){
            $image_html = "<image style='width:100%;' src='"+st+"'/>";
            $("#image").html($image_html);
        } else if(tp == "applicationpdf"){
         
            $pdf_html = "<embed src='"+st+"' type='application/pdf' width='100%' height='100%' >";
            $("#image").html($pdf_html);
        }
        
        $('#upload-files-div3').modal('hide');
    }
    //
    // Catch the form submit and upload the files
    function uploadFiles5(event) {

        // Create a formdata object and add the files
        var data = new FormData();
        var ueid = collectiveDataAcObject.id;

        $.each(files5, function (key, value) {
            data.append(key, value);
        });

        $.ajax({
            url: 'FileUpload?files&id='+ueid,
            type: 'POST',
            data: data,
            cache: false,
            dataType: 'json',
            processData: false, // Don't process the files
            contentType: false,
            success: function (data, textStatus, jqXHR) {
                // Handle errors here
                if (data.result == "success") {
                    $('a.remove').trigger('click');
                    //showGritter(data.result, data.message, data.result, "", false);
                    setUploadedImage5(data.filepath,data.filetype);
                } else {
                    showGritter(data.result, data.message, data.result, "", false);
                }
            },
            complete: function () {

            }

        });
    }
    
    // Grab the files and set them to our variable
    function prepareUpload5(event) {
        files5 = event.target.files;

        uploadFiles5();
    } 
    // 
   // $(document).ready(function() {
        //
        initMap();
        //
        $("#close-icon-ustp").on("click", function () {
            var acctype = "<?php echo isset($_stafftype) ? $_stafftype : "0"; ?>";
            if(parseInt(acctype) == 1){
                ajaxRequest("UserAccount/userAgents", loadPage);
            } else if(parseInt(acctype) == 2){
                ajaxRequest("UserAccount/userSupervisors", loadPage);
            } else {
                ajaxRequest("UserAccount", loadPage);
            }
        });
        //
        $('#uploadFilesModal').click(function() {
            $('#upload-files-div3').modal('show');
        });

        //
        $('#id-input-file-5').ace_file_input({
            no_file:'No File ...',
            btn_choose:'Choose',
            btn_change:'Change',
            droppable:false,
           // onchange:prepareUpload5,
            thumbnail:false //| true | large
            //whitelist:'gif|png|jpg|jpeg'
            //blacklist:'exe|php'
            //onchange:''
            //
        });
        $('#id-input-file-5').on('change', prepareUpload5);
    //});
</script>
