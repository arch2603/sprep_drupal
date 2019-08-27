<?php

namespace Drupal\drupalform\Controller;

use Drupal\Core\Controller\ControllerBase;

class MyPageController extends ControllerBase{

  public function customPage()
  {
    return [
      '#markup' => t('Welcome Archie Sua, Hello World'),
    ];
  }


}



?>
