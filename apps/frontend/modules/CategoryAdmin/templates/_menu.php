<?php if (count($categories)) : ?>

  <ul class="menu-left">
  <?php foreach ($categories as $category): ?>
    <li class=".ui-menu-item <?php echo $category->getSlug() ?>"><?php echo link_to($category, '@product_Product?category='.$category->getId()); ?></li>
  <?php endforeach; ?>
  </ul>

  <script type="text/javascript">
    $(function() {
      $( ".menu-left" ).menu();
      <?php if ($selectedCategory):  ?>      
        $( ".menu-left" ).menu( "focus", null, $( ".<?php echo $selectedCategory->getSlug() ?>" ) );
      <?php endif ?>  
    });
  </script>

<?php endif ?>