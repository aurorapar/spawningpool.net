<!DOCTYPE html>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" href="css/styles.css">
    </head>

    <body>
        <header>
            <?php require("header.php"); ?>
        </header>

        <div class="main_body">
            <?php
                echo $content[0][1];
            ?>
    </body>

    <footer>
        <?php require("footer.php"); ?>
    </footer>
</html>