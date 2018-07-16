<?php
$this->set(compact('block'));
$b = $block['Block'];
$class = 'block block-' . $b['alias'];
if ($block['Block']['class'] != null) {
	$class .= ' ' . $b['class'];
}
?>
<div class="panel panel-info">
<?php if ($b['show_title'] == 1): ?>
	<div class="panel-heading"><h3 class="panel-title"><b><?php echo $b['title']; ?></b></h3></div>
<?php endif; ?>
	<div class="panel-body">
<?php
	echo $this->Layout->filter($b['body'], array(
		'model' => 'Block', 'id' => $b['id']
	));
?>
	</div>
</div>