<?php $content = ''; ?>
<?php foreach ($root->getNode()->getChildren() as $child) : ?>
	<?php $content .= get_component('cms', $template, compact('child', 'template')) ; ?>   
<?php endforeach; ?>
<?php echo html_entity_decode(sprintf($layout, $content)) ; ?>   