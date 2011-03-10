<!doctype html>
<html> 
    <head> 
        <!--[if lte IE 8]>
            <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script> 
        <![endif]--> 
        <title>
        <?php
        if (isset($title_for_layout)) {
            echo $title_for_layout;
        } else {
        ?>
            SLAPP!
        <?php
        }
        ?>
        </title> 
        <link rel="stylesheet" href="<?php echo site_url(); ?>css/style.css" type="text/css" media="screen" />
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo site_url(); ?>js/jquery.jseditable.js"></script>
        <script type="text/javascript" src="<?php echo site_url(); ?>js/alljs.js"></script>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    </head> 
    <body> 
        <div id="main">
            <?php
            echo $content_for_layout;
            ?>
        </div>        
    </body> 
</html>