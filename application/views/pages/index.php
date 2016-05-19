<?php 
$site = $this->config->item('site');

$theme_url = base_url('assets/agrotheme'); 
$site_url = base_url(); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo $title ?></title>

    <!-- Bootstrap core CSS 
    <link href="<?php echo $theme_url; ?>/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
    
    <link href='http://fonts.googleapis.com/css?family=Engagement' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Julius+Sans+One' rel='stylesheet' type='text/css'>
    <link href="<?php echo $theme_url; ?>/css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all" />
    <link href="<?php echo $theme_url; ?>/css/style.css" rel="stylesheet" type="text/css" media="all" />
    <!--start slider -->
    <link href="<?php echo $theme_url; ?>/css/camera.css" rel="stylesheet" type="text/css" media="all" />
    <script type='text/javascript' src="<?php echo $theme_url; ?>/js/jquery.min.js"></script>
    <script type='text/javascript' src="<?php echo $theme_url; ?>/js/jquery.mobile.customized.min.js"></script>
    <script type='text/javascript' src="<?php echo $theme_url; ?>/js/jquery.easing.1.3.js"></script> 
    <script type='text/javascript' src="<?php echo $theme_url; ?>/js/camera.min.js"></script> 
    <?php
    if(!empty($autocomplete)) { ?>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCT6UOhwxDZqAvOLjkLSdWpMgQZ42JHvEM&sensor=false&libraries=places"></script>
    <script type="text/javascript">
        google.maps.event.addDomListener(window, 'load', function () {
            var places = new google.maps.places.Autocomplete(document.getElementById('address'));
            google.maps.event.addListener(places, 'place_changed', function () {
                var place = places.getPlace();
                var address = place.formatted_address;
              /*  var latitude = place.geometry.location.lat();
                var longitude = place.geometry.location.lng();
                var mesg = "Address: " + address;
                mesg += "\nLatitude: " + latitude;
                mesg += "\nLongitude: " + longitude;
                alert(mesg);*/
            });
        });
    </script>
<?php
  }
  ?>

    <script>
      jQuery(function(){
        jQuery('#camera_wrap_1').camera({
          height: '400px',
          loader: 'bar',
          pagination: false,
          thumbnails: true
        });
      });
    </script>

    <link rel="shortcut icon" href="<?php echo $theme_url; ?>/custom/ico/favicon.ico">
  </head>
<!-- NAVBAR
================================================== -->
 <body id="<?php if($this->uri->uri_string) { echo $this->uri->uri_string; } else { echo 'home'; } ?>">
 <?php 
 if(current_url() == $site_url): ?>
<!-- start slider 
<div class="slider">
  <!-- #camera_wrap_1 
  <div class="fluid_container">
        <div class="camera_wrap camera_azure_skin" id="camera_wrap_1">
            <div  data-src="<?php echo $theme_url; ?>/images/slider1.jpg">
            </div>
            <div  data-src="<?php echo $theme_url; ?>/images/slider2.jpg">
            </div>
            <div  data-src="<?php echo $theme_url; ?>/images/slider3.jpg">
            </div>
             </div><!-- #camera_wrap_1 
         <div class="clear"></div>
  </div>
  -->
  <!-- end #camera_wrap_1 -->
</div>
<?php endif; ?>
<!-- start header -->
<div class="header_bg">
<div class="wrap">
<div class="wrapper1">  
  <div class="menu">  
  <nav id="nav" role="navigation">
        <ul class="top-nav">
          <li  class="active"><a href="<?php echo $site_url; ?>">Home</a></li>
          <li>
            <a class="hsubs" href="#" aria-haspopup="true">Information &#x25BC;</a>
            <ul class="dropdown">
              <li><a class="hsubs" href="<?php echo $site_url; ?>area-quantity">Area & Quantity </a></li>
              <li><a class="hsubs" href="<?php echo $site_url; ?>service-rules">Service Rules </a></li>
              <li><a class="hsubs" href="<?php echo $site_url; ?>guidelines">Guidelines</a></li>
              <li><a class="hsubs" href="<?php echo $site_url; ?>fees-charges">Fee / Charges</a></li>
              <li><a class="hsubs" href="<?php echo $site_url; ?>organisation">Organisation</a></li>
            </ul>
          </li>
          <li><a class="hsubs" href="<?php echo $site_url; ?>testing-labs">Testing Labs</a></li>
          <li><a class="hsubs" href="<?php echo $site_url; ?>crops">Crops</a></li>
          <li>
            <a class="hsubs" href="#" aria-haspopup="true">PSSCA Statistics &#x25BC;</a>
            <ul class="dropdown">
              <li><a class="hsubs" href="<?php echo $site_url; ?>achievements">Achievements</a></li>
              <li><a class="hsubs" href="<?php echo $site_url; ?>activities">Activities</a></li>
              <li><a class="hsubs" href="<?php echo $site_url; ?>tenders">Tenders</a></li>
              <li><a class="hsubs" href="<?php echo $site_url; ?>downloads">Downloads</a></li>
            </ul>
          </li>

          <li><a href="<?php echo $site_url ?>about-us">About US</a></li>
          <li><a href="<?php echo $site_url ?>contact">Contact US</a></li>
          <div class="clear"></div>
        </ul>
    <div class="clear"></div>
  </nav>
  </div>
</div>
</div>
</div>
<!-- start main -->
<div class="main_bg">
<div class="wrap">
<div class="wrapper"> 
  <div class="main">
    
    <!-- Page Views -->
    <?php $this->load->view($view); ?>

  </div>
  <div class="clear"></div>
</div>
</div>
<!-- start footer -->
<div class="footer_bg">
<div class="wrap">
<div class="wrapper">
  <div class="footer">
    <ul class="f_nav">
      <li><a href="mailto:<?php echo $site['email'];?>"><?php echo $site['email'];?></a></li>
    </ul>
    <div class="f_call"> 
      <h3>: <a style="color: #fff;" href="tel:<?php echo $site['phone'];?>"><?php echo $site['phone'];?></a></h3>
    </div>
    <div class="clear"></div>
    <h2><a href="<?php echo $site_url?>"><?php echo $site['short_name'];?></a></h2>
    <div class="copy">
      <p class="w3-link">© All Rights Reserved</a></p>
    </div>
  </div>
</div>
<div class="clear"></div>
</div>
</div>

</body>
</html>