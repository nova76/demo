<?php
  /**
   * megjeleniti a kategoria listat
   *
   * @param sfWebRequest $request
   */
class CmsComponents extends sfComponents
{
   /**
   *  template : megadja hogy a menu milyen szerkeszetben jelenjen meg. 
   *  Alapesetben "list" (ul-li) vagy "table" szerkeszet lehet, de keszitheto egyedi szerkeszet is.
   *  Ehhez uj fajl letrehozasa szukseges _showDirectoryEgyedi neven
   */
  public function executeMenu()
  {
    $this->template = isset($this->template) ? $this->template : 'menuItem';
    $this->layout   = isset($this->layout)   ? $this->layout   : '<ul id="fomenu">%s</ul>';
    
    $treeObject = Doctrine_Core::getTable('Cms')->getTree();
    
    $this->root = $treeObject->fetchRoot();
  }
 
  public function executeMenuItem()
  {
    $this->children = $this->child->getNode()->getChildren();
    $this->template = isset($this->template) ? $this->template : 'list';
  }
  
  
}