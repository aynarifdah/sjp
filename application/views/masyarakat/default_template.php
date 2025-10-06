<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr" oncontextmenu="return false;">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<?php echo $page["head"]; ?>
<style type="text/css">
    <?php if(isset($css)){ echo $css; } ?>
</style>

	<?php echo $page["header"]; ?>
	<?php echo $page["navbar"]; ?>

	<?php echo $content;?>

	<?php echo $page["footer"]; ?>

<?php echo $page['main_js'];?>
<script type="text/javascript">
    <?php if(isset($javascript)){ echo $javascript; } ?>
</script>

</body>
</html>