<?php
    $web_contents = array();

    $content_files = [];
    $content_files['Home'] = 'home.php';
    $content_files['About'] = 'about.php';
    $content_files['Servers'] = 'servers.php';
    $content_files['Songs'] = 'songs.php';


    function get_web_content($content_name)
    {
        $output = [];
        global $content_files, $web_contents;

        if(!array_key_exists($content_name, $content_files) || !file_exists($content_files[$content_name]))
           return sprintf('No content for link %s exists<br>', $content_name);

        require($content_files[$content_name]);
        return $web_contents[$content_name];
    }
?>
