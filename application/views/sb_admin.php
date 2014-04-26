<?php echo doctype();?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
   <title><?=$title?></title>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <?= $_scripts ?>
</head>
<body>
   <div id="login">
     <?=$login?>
   </div>
   <?php if (isset($login)) { echo $_styles; die(); } ?>
   <!--regions layout in here-->
   <div id="wrapper">
     <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
       <div class="navbar-header">
         <?=$navbar_header?>
       </div><!-- /.navbar-header -->

       <div>
         <?=$navbar_top_links?>
       </div><!-- /.navbar-top-links -->

       <div class="navbar-default navbar-static-side" role="navigation">
         <?=$navbar_static_side?>
       </div><!-- /.navbar-static-side -->
    </nav>
    <div id="page-wrapper">
      <?=$content?>
    </div>
   </div>
   <?= $_styles ?>
</body>
</html>