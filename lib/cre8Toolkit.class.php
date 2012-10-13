<?php

/**
 * Usefull helpers
 *
 * @author Bogumil Wrona <b.wrona@cre8newmedia.com>
 */
class cre8Toolkit {
  static public function redirectToSamePlace() {
    sfProjectConfiguration::getActive()->loadHelpers("Url");
    $context = sfContext::getInstance();
    $context->getRequest()->getParameterHolder()->clear();
    $context->getRequest()->setMethod(sfRequest::GET);
    $context->getController()->redirect($context->getRequest()->getUri());
    return sfView::NONE;
  }

  static public function getIP() {

    $ip = $_SERVER['REMOTE_ADDR'];
    if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
      $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    return $ip;
  }

}
?>
