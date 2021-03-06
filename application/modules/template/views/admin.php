<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    
    <title>Scorecard Hero</title>
    <link rel="shortcut icon" href="<?php echo base_url(); ?>images/scorecardhero.ico" type="image/x-icon">
    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>css/bootstrap.css" rel="stylesheet">
    <!-- Bootstrap theme -->
    <link href="<?php echo base_url(); ?>css/bootstrap_darkly.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="<?php echo base_url(); ?>css/custom_theme.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body role="document">

    <!-- Fixed navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo base_url(); ?>home" style="display:inline-block;padding:0px 15px;font-weight:bold;">
          	<img alt="SH" src="<?php echo base_url(); ?>images/scorecardhero.svg" style="display:inline-block; width:60px;">
          	Sample Site
          </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown Menu <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li class=""><a href="<?php echo base_url(); ?>">Sample</a></li>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container" role="main">

      <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="row" style="height:85px;"></div>

      <?php
          if (!isset($module)) {
              $module = $this->uri->segment(1);
          }
          if (!isset($view_file)) {
              $view_file = $this->uri->segment(2);
          }
          if (($module!="") && ($view_file!="")) {
              $path = $module."/".$view_file;
              $this->load->view($path);
          }
      ?>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>js/bootstrap.js"></script>
    <script src="<?php echo base_url(); ?>js/custom_theme.js"></script>
  </body>
</html>