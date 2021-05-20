<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php echo $page["head"]; ?>
<!-- <body class="vertical-layout vertical-content-menu 2-columns   menu-expanded fixed-navbar"
	data-open="click" data-menu="vertical-content-menu" data-col="2-columns"> -->

<body class="vertical-layout vertical-menu 2-columns   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu" data-col="2-columns">
	<?php echo $page["header"]; ?>
	<?php echo $page["sidebar"]; ?>
	<?php echo $page['main_js']; ?>
	<!-- ////////////////////////////////////////////////////////////////////////////-->
	<div class="app-content content">
		<div class="content-wrapper">
			<div class="content-header row">
			</div>
			<div class="content-body">
				<?php echo $content; ?>
			</div>
		</div>
	</div>
	<!-- ////////////////////////////////////////////////////////////////////////////-->
	<?php echo $page["footer"]; ?>
</body>

</html>