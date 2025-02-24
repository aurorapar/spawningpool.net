<?php
    $web_contents = array();
    $content =[
         ['Home', get_web_content('../home.php')]
        ,['About', get_web_content('../about.php')]
        ,['Servers', get_web_content('../servers.php')]
        ,['Songs', get_web_content('../songs.php')]
    ];


    function get_web_content($file_path)
    {
        $link_title = explode('/', $file_path)[1];
        $link_title = ucwords(explode('.', $link_title)[0]);
        if(!file_exists($file_path))
        {
            return sprintf('No content for link %s exists', $link_title);
        }
        require($file_path);
        return $web_contents[$link_title];
    }
?>
