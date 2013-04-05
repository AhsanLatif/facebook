<html>
    <head>
        <title>Welcome to Facebook</title>





        <link href=<?php echo "" . $base . "/media/bootstrap.min.css" ?> rel="stylesheet" media="all">
        <link href=<?php echo "" . $base . "/media/datepicker.css" ?> rel="stylesheet" type="text/css" media="all"/>
        <link href=<?php echo "" . $base . "/" . $css ?> rel="stylesheet" type="text/css" media="all"/>
        <link rel="shortcut icon" type="image/x-icon" href=<?php echo "" . $base . "/" . $images . "/favicon.ico" . ""; ?>>
        <script type="text/javascript" src=<?php echo $base . "/" . $js . "jquery.js" ?>></script>
        <script type="text/javascript" src=<?php echo $base . "/" . $js . "jquery.imgareaselect.min.js" ?>></script>
        <link href=<?php echo "" . $base . "/media/imgareaselect-animated.css" ?> rel="stylesheet" type="text/css" media="all"/>
		 <script type="text/javascript" src=<?php echo $base . "/" . $js . "jquery.filedrop.js" ?>></script>
        <script type="text/javascript" src=<?php echo $base . "/" . $js . "mainJava.js" ?>></script>
        <script src=<?php echo $base . "/" . $js . "bootstrap.min.js" ?>></script>
        <script type="text/javascript" src=<?php echo $base . "/" . $js . "bootstrap-datepicker.js" ?>></script>


    </head>
    <div id="header">
        <?php
        if (isset($id) || isset($currid)) {
            $path = $base . "/index.php/profile";
        } else {
            $path = $base . "/index.php/home";
        }
        ?>
        <a href=<?php echo $path ?>><img id="logo" src=<?php echo "" . $base . "/" . $images . "/login/logo.jpg" . ""; ?> ></a>


    </div>

</html>
