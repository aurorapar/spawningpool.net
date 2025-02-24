<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script type="text/javascript" src="js/ajax_calls.js"></script>

<?php
    require("main_body.php")
?>

<h1 class="site-title">The Spawning Pool</h1>

<div class="main_header">
   <ul>
    <?php
        foreach($content as $content_key => $content_value)
        {
            $link_name = $content_value[0];
            echo '<li><a class="header_link" id="' . $link_name . '-link" href="#">[' . $link_name . ']</a></li>';
        }
    ?>
</div>