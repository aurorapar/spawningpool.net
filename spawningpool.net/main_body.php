<?php
    $content =[
         ['Home', 'You can check out my <a href="http://github.com/aurorapar">code repositories here</a>.']
        ,['About', get_web_content('../about.php')]
        ,['Servers', get_web_content('../servers.php')]
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
        return $web_contents;
    }
?>
