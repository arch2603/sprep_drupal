<?php

namespace Drupal\drupalsprep\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Drupal\Core\Database\Database;

class EOIController extends ControllerBase
{
  public function successpage()
  {
    $element = array(
      '#markup' => 'Form data submitted',
    );

    return $element;

  }//sucesspage

  public function getData()
  {
    return 'getData';
  }//getData



}//end-class




?>
