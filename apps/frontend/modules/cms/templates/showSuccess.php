<?php include_partial('cms/assets') ?>

<?php slot('title') ?>
  <?php echo $page->getTitle() ?>
<?php end_slot(); ?>

<h1><?php echo $page->getTitle() ?></h1>
<div class="cms-content">
  
  <?php echo html_entity_decode($page->getContent()) ?>
</div>