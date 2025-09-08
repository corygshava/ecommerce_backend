<?php
    $passdata = isset($passdata) ? $passdata : 'none';
    $model = isset($model) ? $model : "";

    $alert = isset($alert) ? $alert : "alert information";
    $heading = isset($heading) ? $heading : "heading";

    $modelfile = __DIR__."/../../models/$model.class.php";

    global $genui;

    if(!file_exists($modelfile)){
        $genui->gen_alert2('the model doesnt seem to exist',"Record creation attempt error");
        exit();
    }

    if(!is_readable($modelfile)){
        $genui->gen_alert2('the model file is unreadable, check its permissions',"Record creation attempt error");
        exit();
    }

    require_once $modelfile;

    if(!class_exists($model)){
        $genui->gen_alert2('invalid class name, check the model code',"Record creation attempt error");
        exit();
    }

    $instance = new $model();

    $fields = $instance::getmycolumns();

    echo <<<HTML
        <div class="spacy-md">
            <span class="h2">Add $model</span>
            <hr>
            <div class="formholder">
                <!-- .inputholder>label[for="envalue"]{enter this}+input:text[name="envalue",id="envalue"] -->
                <div class="inputholder spacy-sm">
                    <label for="envalue">enter this</label>
                    <input type="text" name="envalue" id="envalue">
                </div>
                <div class="inputholder spacy-sm">
                    <button class="btn login"><i class="fa fa-plus"></i> Add item</button>
                </div>
            </div>
            <span>$alert</span>
        </div>
    HTML;
?>
