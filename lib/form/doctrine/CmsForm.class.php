<?php

/**
 * Cms form.
 *
 * @package    demo1
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CmsForm extends BaseCmsForm
{
  public function configure()
  {
    $this->widgetSchema['root_id']  = new sfWidgetFormInputHidden();
    $this->widgetSchema['rgt']      = new sfWidgetFormInputHidden();
    $this->widgetSchema['lft']      = new sfWidgetFormInputHidden();
    $this->widgetSchema['level']    = new sfWidgetFormInputHidden();    
  }
}
