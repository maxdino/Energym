<style type="text/css">
	.nav-tabs li.active a, .nav-tabs li.active a:focus, .nav-tabs li.active a:hover {
    background-color: transparent;
    color: #D63138;
}
</style>
<body data-spy="scroll" data-target=".navbar">
	<!-- ======= preloader start ======= -->
	<div class="preloader-area">
		<div class="preloader"></div>
	</div>
	<!-- ======= preloader end ======= -->
	<!-- ======= Header part start ======= -->
	<header class="header-area">
		<div class="container">
			<div class="row">
				<div class="col-xs-5 col-sm-2 col-md-2">
					<!-- Header logo -->
					<div class="logo">
						<a href="#">
							<img src="<?php echo base_url();?>public/portada/images/logo.png" alt="">
						</a>
					</div>
				</div>
				<div class="col-xs-7 col-sm-10 col-md-10">
					<!-- Header menu -->
					<nav class="navbar menu-part">
						<ul class="nav nav-tabs" id="menu">
							<li class="active"><a class="smooth-scroll" href="#top">Inicio</a></li>
							<li><a class="smooth-scroll" href="#services"><span class="separet">/</span> servicio</a></li>
							<li><a class="smooth-scroll" href="#portfolio"><span class="separet">/</span> Galeria</a></li>
							<li><a class="smooth-scroll" href="#about"><span class="separet">/</span> Nosotros</a></li>
							<li><a class="smooth-scroll" href="#trainer"><span class="separet">/</span> Trainer</a></li>
							<li><a class="smooth-scroll" href="#price"><span class="separet">/</span> Precio</a></li>
							<li><a class="smooth-scroll" href="#schedule"><span class="separet">/</span> Horario</a></li> 
						</ul>
					</nav>
					<a href="<?php echo base_url() ?>Login/" class="gym-btn join-btn hvr-shutter-out-vertical none-border">Login</a>
				</div>
			</div>
		</div>
	</header>


		<section id="carousel-example-generic" class="carousel slide" data-ride="carousel">
		<!-- Indicators -->
		<ol class="carousel-indicators">
			<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
			<li data-target="#carousel-example-generic" data-slide-to="1"></li>
			<li data-target="#carousel-example-generic" data-slide-to="2"></li>
		</ol>
		<!-- Wrapper for slides -->
		<div id="top" class="carousel-inner" role="listbox">
			<div class="item active">
				<img src="<?php echo base_url();?>public/portada/images/slider/01.jpg" alt="..." class="animated fadeIn">
				<div class="carousel-caption">
					<div class="gym-slider">
						<div class="gym-single-slider">
							<h1 class="animated fadeInDown">ES HORA<span> DE IR AL</span> GIMNASIO<span></span></h1>
							<h2 class="animated slideInRight">ESTAMOS LISTOS<span> PARA</span> TÍ</h2>
							<a href="#services" class="gym-btn transparent-btn btn-padding hvr-shutter-in-vertical animated fadeIn">APRENDER MÁS</a>
						</div>
					</div>
				</div>
			</div>
			<!-- single slider part -->
			<div class="item">
				<img src="<?php echo base_url();?>public/portada/images/slider/02.jpg" alt="..." class="animated fadeIn">
				<div class="carousel-caption">
					<div class="gym-slider">
						<div class="gym-single-slider">
							<h1 class="animated fadeInDown">QUE CREE<span> TU</span> MENTE</h1>
							<h2 class="animated slideInRight">SÍ,<span> ¡PUEDES</span><span> HACERLO!</span></h2>
							<a href="#services" class="gym-btn transparent-btn btn-padding hvr-shutter-in-vertical animated fadeIn">APRENDER MÁS</a>
						</div>
					</div>
				</div>
			</div>
			<!--  single slider part -->
			<div class="item">
				<img src="<?php echo base_url();?>public/portada/images/slider/03.jpg" alt="..." class="animated fadeIn">
				<div class="carousel-caption">
					<div class="gym-slider">
						<div class="gym-single-slider">
							<h1 class="animated fadeInDown">HAZ<span> QUE</span> SUCEDA</h1>
							<h2 class="animated slideInRight">¡ES MÁS<span> FÁCIL DE LO QUE</span> PIENSAS!</h2>
							<a href="#services" class="gym-btn transparent-btn btn-padding hvr-shutter-in-vertical animated fadeIn">APRENDER MÁS</a>
						</div>
					</div>
				</div>
			</div>
			<!--  single slider part -->
		</div>
	</section>

	
