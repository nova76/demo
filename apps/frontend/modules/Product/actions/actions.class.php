<?php

require_once dirname(__FILE__).'/../lib/ProductGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/ProductGeneratorHelper.class.php';

/**
 * Product actions.
 *
 * @package    demo1
 * @subpackage Product
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ProductActions extends autoProductActions
{
  /**
   * Minden action eseten szukseg lesz egy slotra,
   * amiben eltaroljuk hogy melyik kategoria van kivalasztva
   *
   */
  public function preExecute()
  {
    parent::preExecute();
    $this->getResponse()->setSlot('sf_admin.extend_url', 'category='.$this->context->getRequest()->getParameter('category'));
  }  
  
  /**
   * redirect eseten is hozza kell tenni a kategoriat a linkhez
   *
   * @param unknown_type $url
   * @param unknown_type $statusCode
   */
  public function redirect($url, $statusCode = 302)
  {
    if ($this->request->hasParameter('category'))
    {
      $query_string_array['category'] = $this->request->getParameter('category');
    } 
  
    if ($object = @$this->getRoute()->getObject() && isset($query_string_array))
    {
      if (is_array($url))
      {
        $url = array_merge($url, $query_string_array);
      }
      else
      {
        if (strpos($url, '?')!==false)
        {
          $url .= '&'. http_build_query($query_string_array);
        }
        else
        {
          $url .= '?'. http_build_query($query_string_array);
        }
      }
    }
  
    parent::redirect($url, $statusCode);
  }  
  
  /**
   * meg kell szurni kategoria szerint a listat
   *
   * @return unknown
   */
  protected function buildQuery()
  {
    $query = parent::buildQuery();
    if (sfContext::getInstance()->getRequest()->hasParameter('category'))
    {
     $category = CategoryTable::getInstance()->find(sfContext::getInstance()->getRequest()->getParameter('category'));
  
     if ($category)
     {
       $query->andWhere('category_id = ?', $category->getId());
     }
  
     $this->category = $category;
    }
  
    return $query;
  }  
  
  /**
   * Uj elem letrhozasakor ki kell valasztani a kategoriat
   *
   * @param sfWebRequest $request
   */
  public function executeNew(sfWebRequest $request)
  {
    parent::executeNew($request);
    $this->form->setDefault('category_id', $request->getParameter('category'));
  }
  
  /**
   * szerkeszteskor adjuk meg a termek nevet, amit szereksztunk
   *
   * @param sfWebRequest $request
   */
  public function executeEdit(sfWebRequest $request)
  {
    parent::executeEdit($request);
    $this->getResponse()->setSlot('sf_admin.title', 'Termék adatlapja ('.(string)$this->product.')');
  }  
  
  /**
   * A lista tablazatanak fejleceben adjuk meg hogy melyik kategoria termekeit listazzuk
   *
   * @param sfWebRequest $request
   */
  public function executeIndex(sfWebRequest $request)
  {
    parent::executeIndex($request);
    $this->getResponse()->setSlot('sf_admin.title', 'Termékek listája' . ($this->category ? '('.(string)$this->category.')' : '' ));
  }    
  
  /**
   * A torles utan az objektum torlesre kerult, így a redirect eseten mar nem tudjuk feldolgozni
   *
   * @param sfWebRequest $request
   */
  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();
  
    $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));
  
    $object = $this->getRoute()->getObject();
  
    $extend = '?category='.$object->getCategoryId();
  
    $object->delete();
  
    $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
  
    $this->redirect('@product_Product'.$extend);
  }  
}
