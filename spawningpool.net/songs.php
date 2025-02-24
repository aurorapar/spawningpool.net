<?php
    $catalog = scandir('../songs/');
    if(!$catalog)
    {
        $web_contents['Songs'] = 'No songs at this time';
    }
    else
    {
        $output = '<ul class="song_list">';
        foreach($catalog as $catalog_item)
        {
            $catalog_item_parts = explode('.', $catalog_item);
            $extension = $catalog_item_parts[1];
            if($extension == "html")
            {
                $catalog_title = $catalog_item_parts[0];
                $catalog_title = str_replace('_', ' ', $catalog_title);
                $catalog_title = ucwords($catalog_title);
                $output = $output . '<li>';
                $output = $output . '<a href="../songs/'. $catalog_item . '">&gt;&gt;</a><br>';
                $output = $output . '<iframe src="../songs/'. $catalog_item . '" width="800" height="200"></iframe></li>';
            }
        }
        $output = $output . '</ul>';

        $web_contents['Songs'] = $output;
    }
?>