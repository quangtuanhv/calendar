<?php
$class = isset($class) ? $class : null;
$escape = isset($escape) ? $escape : true;

if ($escape):
	$message = h($message);
endif;
?>
<div class="<?php echo $class; ?>"><a href="#" class="close" data-dismiss="alert" aria-label="close">×</a><?php echo $message; ?></div>
