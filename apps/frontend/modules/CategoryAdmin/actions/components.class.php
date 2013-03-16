<?php
  /**
   * megjeleniti a kategoria listat
   *
   * @param sfWebRequest $request
   */
class CategoryAdminComponents extends sfComponents
{
  public function executeMenu(sfWebRequest $request)
  {
    $this->selectedCategory = null;
    if ($request->getParameter('category'))
    {
      $this->selectedCategory = CategoryTable::getInstance()->find($request->getParameter('category'));  
    }
    $this->categories = CategoryTable::getInstance()->findAll();
  }
}