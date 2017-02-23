<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>@yield('title') </title>
<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" media="all" />
<link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css">
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

<script>
var BASE_URL = "{{ URL::to('/') }}";
var CSRF_TOKEN = "{{ csrf_token() }}";
</script>
<script type="text/javascript" src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<!--<script type="text/javascript" src="{{ asset('assets/js/jquery.js') }}"></script>-->
<script type="text/javascript" src="{{ asset('assets/js/script.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/custom_functions.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/jquery.validate.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/jquery.validate.my-methods.js') }}"></script>


  
<meta name="csrf-token" content="{{ csrf_token() }}"/>
</head>
<body>
<div class="page">
  <div class="header">
  	<div class="headerTop">
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<ul class="dt-sc-social-icons">
							<li class="google"><a target="_blank" href="https://plus.google.com/u/0/b/104165553927470716042/104165553927470716042/posts"><img alt="google.png" src="https://vascorx.com/wp-content/themes/soulmedic/images/sociable/hover/google.png"><img alt="google.png" src="https://vascorx.com/wp-content/themes/soulmedic/images/sociable/google.png">	</a></li>
							<li class="youtube"><a target="_blank" href="https://www.youtube.com/channel/UCjb1alFnM4WqC3ccfRrFboQ/feed?view_as=public"><img alt="youtube.png" src="https://vascorx.com/wp-content/themes/soulmedic/images/sociable/hover/youtube.png"><img alt="youtube.png" src="https://vascorx.com/wp-content/themes/soulmedic/images/sociable/youtube.png">	</a></li>
							<li class="facebook"><a target="_blank" href="https://www.facebook.com/pages/Vasco-Rx-Specialty-Pharmacy/283395465175584"><img alt="facebook.png" src="https://vascorx.com/wp-content/themes/soulmedic/images/sociable/hover/facebook.png"><img alt="facebook.png" src="https://vascorx.com/wp-content/themes/soulmedic/images/sociable/facebook.png">	</a></li>
							<li class="twitter"><a target="_blank" href="https://twitter.com/VascoRx"><img alt="twitter.png" src="https://vascorx.com/wp-content/themes/soulmedic/images/sociable/hover/twitter.png"><img alt="twitter.png" src="https://vascorx.com/wp-content/themes/soulmedic/images/sociable/twitter.png">	</a></li>
							<li class="linkedin"><a target="_blank" href="//www.linkedin.com/pub/vasco-rx-specialty-pharmacy/18/135/abb/"><img alt="linkedin.png" src="https://vascorx.com/wp-content/themes/soulmedic/images/sociable/hover/linkedin.png"><img alt="linkedin.png" src="https://vascorx.com/wp-content/themes/soulmedic/images/sociable/linkedin.png">	</a></li>
						</ul>
					</div>
					<div class="col-sm-6">
						<div class="rightCall">
							<a class="telNum" href="tel:8779713001">
							<span class="fa fa-phone-square"> </span>
877-971-3001 </a><a href="#" class="portalBtn">MD Portal</a>
						</div>
					</div>
				</div>
				</div>
			</div>
			<div class="headerBtm">
				<div class="container">
					<div class="logo"><a href="../"><img src="{{ asset('assets/Images/logo.png') }}"></a></div>
					<div class="nav">
						<ul>
							<!--<li class="active"><a href="#">Home</a></li>
							<li><a href="#">Specialties</a></li>
							<li><a href="#">Patients</a></li>
							<li><a href="#">Infusion Suite</a></li>
							<li><a href="#">Practitioners</a></li>
							<li><a href="#">Payors</a></li>
							<li><a href="#">About us</a></li>
							<li><a href="#">News</a></li>-->
							<li><a href="https://vascorx.com/">Back to Main Website</a></li>
							<li><a href="https://vascorx.com/home/contact-vascorx-pharmacy/">Contact</a></li>
						</ul>
					</div>
				</div>
			</div>
  </div>
  <div class="main">
  <div class="container">
  @yield('content')
  </div>
  </div>
  <div class="footer">
    <div class="container">
      <div class="footerTop clearfix">
	<div class="row">
	  <div class="col-sm-3">
	    <h4>Contact Information</h4>
	    <div class="contactInfo">
	      <ul>
		<li><i class="fa fa-home"></i><span>4045 E. Bell Rd., Suite 163<br>Phoenix, AZ 85032</span></li>
		<li><i class="fa fa-phone"></i>Phone :<span>602-971-6950</span></li>
		<li><i class="fa fa-print"></i>Fax:<span>602-404-2504</span></li>
		<li><i class="fa fa-envelope-o"></i>Email :<a href="mailto:admin@vascorx.com">admin@vascorx.com </a> </li>
	      </ul>
	    </div>
	  </div>
	    
	  <div class="col-sm-3">
	    <h4>Business Hours</h4>
	    <div class="businesshour">
	      <ul>
		<li><strong>Mon - Fri</strong> 7:30AM - 5:30PM <br /> Sat 9:00AM - 1:00PM</li>
		<li><strong>Infusion Suite</strong> <br /> <strong>Mon - Fri</strong> 9:00AM - 5:30PM</li>
		<li><strong>24 Hour Support</strong></li>
		
	      </ul>
	    </div>
	  </div>
	    
	  <div class="col-sm-3">
	    <h4>Location Map</h4>
	    <div class="map">
	      <a title="Click to open a larger map" href="#gmw-dialog-googlemapswidget-2" class="gmw-thumbnail-map gmw-lightbox-enabled" data-gmw-id="googlemapswidget-2"><img width="250px" height="250px" src="//maps.googleapis.com/maps/api/staticmap?scale=1&amp;format=png&amp;zoom=11&amp;size=250x250&amp;language=en&amp;maptype=roadmap&amp;markers=size%3Adefault%7Ccolor%3A0xff0000%7Clabel%3AA%7C4045+E.+Bell+Rd.%2C+Suite+163+Phoenix%2C+AZ+85032&amp;center=4045+E.+Bell+Rd.%2C+Suite+163+Phoenix%2C+AZ+85032&amp;visual_refresh=true" title="Click to open a larger map" alt="Click to open a larger map"></a>
	    </div>
	  </div>
	    
	  <div class="col-sm-3">
	    <h4>Like Us on Facebook</h4>
	    <div class="social">
	      <img width="220" height="83" src="//vascorx.com/wp-content/uploads/2013/11/bbb-lgo.png" alt="bbb-lgo" class="alignnone size-full wp-image-1065">
	    </div>
	  </div>
	</div>
      </div>	
      <div class="footerBtm clearfix"></div>
      <div class="col-sm-8">
        <div class="row">
	  <div class="copyright">Website Development and Maintenance by <a href="//websitedesignphoenix.com/" target="_blank">Website Design Phoenix</a> | All rights reserved | <a target="_blank" href="//websitedesignphx.com/vasco/privacy-policy/">Privacy Policy</a>
	  </div>
	</div>
      </div>
      <div class="col-sm-4">
        <div class="row">
	<a class="ftrlogo" href="https://vascorx.com"><img title="Vasco Rx Specialty Pharmacy" alt="Vasco Rx Specialty Pharmacy" src="https://vascorx.com/wp-content/uploads/2015/12/logo1.png"></a>
	</div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
