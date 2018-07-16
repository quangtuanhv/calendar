<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php echo $title_for_layout; ?> | <?php echo Configure::read('Site.title'); ?></title>

		<!-- Bootstrap CSS -->
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="<?php echo $this->base; ?>/managers/css/styles.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $this->base; ?>/managers/css/font-awesome.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $this->base; ?>/managers/css/fullcalendar.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $this->base; ?>/managers/css/bootstrap-datetimepicker.min.css">
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
		<script src="<?php echo $this->base; ?>/managers/js/moment.min.js"></script>
		<script src="<?php echo $this->base; ?>/managers/js/fullcalendar.min.js"></script>
		<script src="<?php echo $this->base; ?>/managers/js/bootstrap-datetimepicker.min.js"></script>
	</head>
	<body>
		<?php 
			echo $this->element('menu');
		?>
		<div id="main">
			<div class="container-fluid">
				<div class="row">
					<div class="col-xs-12 col-sm-8 col-md-8 col-lg-9">					
						<?php
							echo $this->Layout->sessionFlash();
							echo $content_for_layout;
						?>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">
						<?php echo $this->Regions->blocks('right'); ?>
					</div>
				</div>
			</div>
		</div>
		<footer id="footer">
			<div class="container">
				<p class="text-center">
					<i class="glyphicon glyphicon-copyright-mark"></i> Copyright 2017 Oison Company
				</p>
			</div>
		</footer>
		<?php echo $this->element('doing-tasks'); ?>
		<script src="<?php echo $this->base; ?>/managers/js/custom.js"></script>
		<a id="back-to-top" href="#" class="btn btn-info btn-sm btn-lg back-to-top" role="button" title="Return to top" data-toggle="tooltip" data-placement="top"><span class="glyphicon glyphicon-chevron-up"></span></a>
	</body>
</html>