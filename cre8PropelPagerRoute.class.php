<?php

class cre8PropelPagerRoute extends sfPropelRoute 
{
  /**
   * @var sfPropelPager
   */
  protected $pager = null;
  
  public function __construct($pattern, array $defaults = array(), array $requirements = array(), array $options = array())
  {
    parent::__construct($pattern, $defaults, $requirements, $options);
  }
  
  public function getPager()
  {
    if (!$this->isBound()) {
      throw new LogicException('The route is not bound.');
    }

    if ('list' != $this->options['type']) {
      throw new LogicException(sprintf('The route "%s" is not of type "list".', $this->pattern));
    }
    
    if($this->pager) {
      return $this->pager;
    }
    
    $this->setPager();
    
    return $this->pager;
    
  }
  
  protected function setPager() {
    $this->pager = new sfPropelPager($this->options['object_model']);
    $this->pager->setCriteria($this->getCriteriaForPager());
    $this->pager->setPage(sfContext::getInstance()->getRequest()->getParameter('page', 1));
    $this->pager->init();
  }
  
  protected function getCriteriaForPager()
  {
    return isset($this->options['criteria']) ? call_user_func(array($this->options['model'], $this->options['criteria'])) : new Criteria();
  }
  
  
  
}