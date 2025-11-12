<?php

//header('Content-Type: application/javascript');
//$res=0;
//if (! $res && file_exists("../../main.inc.php")) $res=@include("../../main.inc.php");		// For root directory
//if (! $res && file_exists("../../../main.inc.php")) $res=@include("../../../main.inc.php");	// For "custom" directory
//dol_include_once('/subscriptionreceipt/functions.inc.php');
////remplacement de liens vers pdf
//$referer = $_SERVER['HTTP_REFERER'];
//$backlinks=array('/subscriptionreceipt/tabs/subscriptionreceipt.php','/subscriptionreceipt/admin/setup.php');//Link to backlink from parameterizing page
//$id = (int) substr($referer, strpos($referer, 'id=') + 3, 10);
//$found=false;
////recherche dans le lien actuel
//foreach ($backlinks as $bl) {
//    if (strpos($referer, $bl)) {
//        $backlink = $bl;
//        $found = strpos($referer, $backlink);
//        break;
//    }
//}
//if($found) {
//    //insertion de la section de paramétrage
//    ?>//
//    $(document).ready(function() {
//        $('body').append('<div id="params"></div>');
//        $('#params').load('<?php //print dol_buildpath(  "/subscriptionreceipt/subscriptionreceipt_parametrage_page.php",1)."?backlink=$backlink&paramvalue=$id";?>//');
//        $("#params").delegate("form input[type=submit]","click",function(){
//            var form = $(this).parents("form");
//            var data = form.serialize();
//            var attr = $(this).attr("name");
//            if (typeof attr !== "undefined" && attr !== false)  data+="&" +attr + "=" + $(this).val();
//            $.post(form.attr("action"), data,function(result){ $("#params").html(result); })
//            return false;
//        });
//    });
//    <?php
//}
