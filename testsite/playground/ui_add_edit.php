<?php
    class inputdata{
        public $label = '';
        public $type = '';
        public $required = '';
        public $placeholder = '';
        public $name = '';
        public $id = '';
        public $value = '';
        public $field = '';
        public $myid = 0;

        function __construct(
            $label = 'label',
            $type="text",
            $required=true,
            $placeholder="enter here",
            $field="id",
            $val="none",
            $id=0
        ){
            $this->type = $type;
            $this->required = $required;
            $this->placeholder = $placeholder;
            $this->name = $field;
            $this->id = $field;
            $this->field = $field;
            $this->value = $val;
            $this->myid = $id;
            $this->label = $label;
        }
    }

    function mekinput($idata=new inputdata()){
        $typ = $idata->type;
        $required = $idata->required;
        $placeholder = $idata->placeholder;
        $name = $idata->name;
        $id = $idata->id;
        $val = $idata->value;
        $field = $idata->field;
        $myid = $idata->myid;
        $label = $idata->label;

        $res = "
            <div class=\"form-group\">
                <label for=\"$field\"
                       class=\"control-label\">$label</label>
                <div>
                    <input type=\"$typ\" data-rule-required=\"$required\" aria-required=\"$required\" class=\"form-control\"
                           placeholder=\"$placeholder\"
                           name=\"$field\"
                           id=\"$field\" 
                           value=\"$val\">
                </div>
            </div>
        ";

        return $res;
    }

    // default data to prevent errors
    $debught = "";
    $outht = "";
    $jsondata = "";
    $items = [];
    $itemscounter = 0;

    $passeddataht = json_encode($_DATA);
?>

<?php
    // edit with whatever module, just make sure you know the data that should be passed in the edit() and create() method in the class
    $classname = "Staff";
    $title = isset($_DATA) ? $t_['edit_staff'] : $t_['create_new_staff'];

    // [field item] ----------------------------------------
        $fn = "name";
        $lang = $t_['staff_name'];
        $typ = "text";

        $val = isset($_DATA) ? $_DATA[$fn] : "";
        $thedata = new inputdata(
            $lang,
            $typ,
            true,
            "$lang goes here",
            $fn,
            $val,
            $itemscounter++
        );
        array_push($items, $thedata);
    // [fend] ---


    // [field item] ----------------------------------------
        $fn = "staff_id";
        $lang = $t_['staff_staff_id'];
        $typ = "text";

        $val = isset($_DATA) ? $_DATA[$fn] : "";
        $thedata = new inputdata(
            $lang,
            $typ,
            true,
            "$lang goes here",
            $fn,
            $val,
            $itemscounter++
        );
        array_push($items, $thedata);
    // [fend] ---


    // [field item] ----------------------------------------
        $fn = "address";
        $lang = $t_['staff_address'];
        $typ = "text";

        $val = isset($_DATA) ? $_DATA[$fn] : "";
        $thedata = new inputdata(
            $lang,
            $typ,
            true,
            "$lang goes here",
            $fn,
            $val,
            $itemscounter++
        );
        array_push($items, $thedata);
    // [fend] ---


    // [field item] ----------------------------------------
        $fn = "department";
        $lang = $t_['staff_department'];
        $typ = "text";

        $val = isset($_DATA) ? $_DATA[$fn] : "";
        $thedata = new inputdata(
            $lang,
            $typ,
            true,
            "$lang goes here",
            $fn,
            $val,
            $itemscounter++
        );
        array_push($items, $thedata);
    // [fend] ---

    /*
        fields
            name
            staff_id
            address
            department

    */
?>

<?php
    // mek the ui based on the fields required

    foreach ($items as $item) {
        $theinput = mekinput($item);

        $outht .= $theinput;
        $debught .= json_encode($item)."<br>";
    }

    $jsondata = json_encode($items);
?>

<style>
    
</style>

<div class="row-fluid ess_action_bar zoomIn animated">
    <span class="utility-buttons ess_ub">
        <button class="btn is-link ess_act_btn ess_secondary" id="btn-back">
            <i class="ace-icon fa fa-chevron-left icon-on-right "></i>&nbsp;&nbsp;
            Back
        </button>
        
        <button class="btn is-link ess_act_btn ess_secondary" id="btn-edit" style="<?php echo (isset($_EDIT) && $_EDIT == 1) ? "" : "display:none;"; ?>">
            <i class="ace-icon fa fa-pencil-square-o icon-on-right "></i>&nbsp;&nbsp;
            <?php echo $t_['Edit']; ?>
        </button>
        <button class="btn is-link ess_act_btn ess_secondary" id="btn-add" style="<?php echo (isset($_EDIT) && $_EDIT == 1) ? "display:none;" : ""; ?>">
            <i class="ace-icon fa fa-save icon-on-right"></i>&nbsp;&nbsp;
            <?php echo $t_['Save']; ?>
        </button>
        
        <button class="btn is-link ess_act_btn ess_secondary" id="refresh-icon" >
            <i class="ace-icon fa fa-refresh icon-on-right"></i>&nbsp;&nbsp;
            <?php echo $t_['Refresh']; ?>
        </button>
    </span>
</div>

<div class="gapper" data-role="debugdata">
    nkjnwjfnjkwefnew<br>
    nkjnwjfnjkwefnew<br>
    nkjnwjfnjkwefnew<br>
    nkjnwjfnjkwefnew<br>
</div>

<!-- debug html -->

<div class="alert bg-blue white" data-role="debugdata">
    <h3>passed data as JSON</h3>
    <?=$passeddataht?>
</div>

<div class="alert bg-blue white" data-role="debugdata">
    <h3>Debug Data</h3>
    <?=$debught?>
</div>

<div class="alert bg-blue white" data-role="debugdata">
    <h3>JSON</h3>
    <?=$jsondata?>
</div>

<div class="row-fluid">
    <div class="col-xs-12 ess_padding_lr ess_list_mt">
        <div class="row">
            <div class="col-xs-12 zoomIn animated dashboard_tab">
                <div id="ess_right_card" class="row ess_card ess_padding_top">
                    <h4 class="ess_title ess_ae_pl"><?= $ntitle; ?></h4>
                    <div class="col-xs-12 ess_no_padding">
                        <!-- PAGE CONTENT BEGINS -->
                        <form id="theform" class="form-horizontal" novalidate="novalidate">
                            <fieldset>
                                <div class="col-md-6 ess_ae">
                                    <!-- start FORM ELEMENTS -->
                                 
                                    <h3 class="lighter block green"><?=$title?></h3>

                                    <div class="form-group">
                                        <label for="selectbasic"
                                               class="control-label"></i></label>
                                        <div>
                                            <span class="black"><i class="fa fa-info-circle"></i>&nbsp;<?php echo  $t_['provide_the_following_details']; ?></span>
                                        </div>
                                    </div>

                                    <!-- Generated UI -->

                                    <?=$outht?>

                                    <!-- end FORM ELEMENTS -->
                                </div>
                                
                               
                                
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div><!--/span-->

<!-- /.row -->

<!-- UI shakeup codes -->
<script>
    // [UI shakeup codes]---------------------------------------------------------------------------
    let debugsel = '[data-role="debugdata"]';
    let moduleName = "<?=$classname?>";

    let firestarter = () => {
        $(debugsel).hide(); // uncomment to hide the debug data
        $(debugsel).click(() => {$(debugsel).hide()});

        return;
        // make the back button wirk
        if(backbtn != undefined){
            backbtn.addEventListener('click',() => {
                // console.log(typeof(loadPage),loadPage,`${moduleName}/index`,ajaxRequest);
                // ajaxRequest(`${moduleName}/`, loadPage);
                // loadPage();
            });
        }
    };

    firestarter();

    // [end of ui shakeup]--------------------------------------------------------------------------

    //
    var rid = "<?= isset($_DATA) ? $_DATA['id'] : "0"; ?>";

    let formid = "#theform";

    // pre_ui_load_FX
    $('.chzn-select').chosen();
    $(".footer").hide();

    //in navigation
    utilNavigation(`${moduleName}/addEditView`);

    //variables to be used
    var formObject = $(formid);

    function updateUiAfterAjax($data) {
        console.log($data);
        showGritter($data.title, $data.message, $data.type);
        
        if($data.type == "success"){
            ajaxRequest(`${moduleName}`, loadPage);
        }
    }

    
    //
    $(document).ready(function () {
        //
        var newheight = $("#ess_right_card").height() + 15;
        console.log(newheight);
        console.log(" newheight ------ " + newheight);
        $("#ess_general_info").height(newheight);
        //
        $("#btn-back").click(function () {
            ajaxRequest(`${moduleName}`, loadPage);
        });
        //
        $("#btn-add").click(function () {
            if (!$(formid).valid()) {
                return false;
            } else {
                
                bootbox.confirm("Are you sure?", function (result) {
                    if (result == true) {
                        $data = $(formid).serialize();
                        ajaxRequest(`${moduleName}/create`, updateUiAfterAjax, $data, "POST", "json");
                    }
                });
            }
        });

        $("#btn-edit").click(function () {
            if (!$(formid).valid()) {
                return false;
            } else {
                bootbox.confirm("Are you sure?", function (result) {
                    if (result == true) {
                        $data = $(formid).serialize();
                        ajaxRequest(`${moduleName}/update`, updateUiAfterAjax, $data + "&id=" + rid+"&status=1", "POST", "json");
                    }
                });
            }
        });
        //
        $(formid).validate({
            focusInvalid: false,
            ignore: "",
                
            rules: {},
    
            messages: {},
    
                
                // Define how errors are highlighted and displayed
                errorElement: 'div',
                errorClass: 'help-block',
                highlight: function (element) {
                    $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
                },
                success: function (element) {
                    $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
                    element.remove();
                },
                errorPlacement: function (error, element) {
                    if (element.parent('.input-group').length || element.prop('type') === 'checkbox' || element.prop('type') === 'radio') {
                        error.insertAfter(element.parent());
                    } else {
                        error.insertAfter(element);
                    }
                }
            });
    });
</script>
