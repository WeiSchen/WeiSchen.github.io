<!DOCTYPE html>
<html>
    <head>
        <title>Page PHP</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    </head>
    <body> 
        <?php
            function affiche() {
                global $var1;
                echo "<p>Hello ".$var1." !!!</p>\n";
            }
        ?>
        <?php
            $var1="John";
            affiche();
        ?>
    </body>
</html>