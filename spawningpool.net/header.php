<h1 class="site-title">The Spawning Pool</h1>

<div class="main_header">
   <ul>
    <?php
        foreach($content_files as $content_key => $content_value)
        {
            $link_name = $content_key;
            echo '<li><a class="header_link" href="/?page=' . $link_name . '">[' . $link_name . ']</a></li>';
        }
    ?>
</div>