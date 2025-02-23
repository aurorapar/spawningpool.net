<?php
    $return_result = '';

    require('../main_body.php');

    $body_requested = $_REQUEST["body_requested"];
    foreach($content as $content_key => $content_value)
    {
        if($content_value[0] == $body_requested)
        {
            $return_result = $return_result . $content_value[1];
            break;
        }
    }
    if(strlen($return_result) < 1)
    {
        $return_result = $return_result . 'Link unavailable :/';
    }

    echo $return_result;
?>