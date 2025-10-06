<!DOCTYPE html>
<html lang="en">

<?php echo $page["head"]; ?>

<body oncontextmenu="return false;">



	<?php echo $page["header"]; ?>
	<?php echo $page["navbar"]; ?>

	<?php echo $content; ?>

	<?php echo $page["footer"]; ?>

	<!--/#app -->
	<?php echo $page['main_js']; ?>
	<script type="text/javascript">
		<?php if (isset($javascript)) {
			echo $javascript;
		} ?>
	</script>
</body>

</html>