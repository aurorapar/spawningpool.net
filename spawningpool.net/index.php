<!DOCTYPE html>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" href="css/styles.css">
    </head>

    <body>
        <header>
            <?php require("main_body.php"); ?>
            <?php require("header.php"); ?>
        </header>

        <div class="main_body">
            <?php
                if(array_key_exists("page", $_GET) && strlen($_GET["page"]) > 0)
                    $requested_page = ucwords($_GET["page"]);
                else
                    $requested_page = "Home";
                echo get_web_content($requested_page);

            ?>
        </div>
    </body>

    <footer>
        <?php require("footer.php"); ?>
    </footer>
</html>