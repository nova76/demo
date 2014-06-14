  protected function getPager()
  {
    $pager = $this->configuration->getPager('<?php echo $this->getModelClass() ?>', $this->limit);
    $pager->setQuery($this->buildQuery());
    $pager->setPage($this->getPage());
    $pager->init();
    
    if ($pager->getLastPage() && $pager->getLastPage()<$this->getPage())
    {
      $this->redirect('@<?php echo $this->getUrlForAction('list') ?>?page='.$pager->getLastPage());
    }

    return $pager;
  }

  protected function setPage($page)
  {
    $this->getUser()->setAttribute('<?php echo $this->getModuleName() ?>.page', $page, 'admin_module');
  }

  protected function getPage()
  {
    return $this->getUser()->getAttribute('<?php echo $this->getModuleName() ?>.page', 1, 'admin_module');
  }

  protected function setLimit($limit)
  {
    $this->getUser()->setAttribute('<?php echo $this->getModuleName() ?>.limit', $limit, 'admin_module');
  }

  protected function getLimit()
  {
    return $this->getUser()->getAttribute('<?php echo $this->getModuleName() ?>.limit', $this->configuration->getPagerMaxPerPage(), 'admin_module');
  }    
  
  protected function buildQuery()
  {
    $tableMethod = $this->configuration->getTableMethod();
<?php if ($this->configuration->hasFilterForm()): ?>
    if (is_null($this->filters))
    {
      $this->filters = $this->configuration->getFilterForm($this->getFilters());
    }

    $this->filters->setTableMethod($tableMethod);

    $query = $this->filters->buildQuery($this->getFilters());
<?php else: ?>
    $query = Doctrine::getTable('<?php echo $this->getModelClass() ?>')
      ->createQuery('a');

    if ($tableMethod)
    {
      $query = Doctrine::getTable('<?php echo $this->getModelClass() ?>')->$tableMethod($query);
    }
<?php endif; ?>

    $this->addSortQuery($query);

    $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_query'), $query);
    $query = $event->getReturnValue();

    return $query;
  }
