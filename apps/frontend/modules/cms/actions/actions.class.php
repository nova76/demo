<?php

/**
 * cms actions.
 *
 * @package    demo1
 * @subpackage cms
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class cmsActions extends sfActions
{
 /**
  * Executes show action
  *
  * @param sfRequest $request A request object
  */
  public function executeShow(sfWebRequest $request)
  {
    $this->page = $this->getRoute()->getObject();
    if ($this->page->get('is_module'))
    {
      $this->redirect($this->page->get('route'));
    }
  }  
}
