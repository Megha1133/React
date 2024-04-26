<?php

namespace Drupal\FoodMenu\Controller;
use Drupal\Core\Controller\ControllerBase;

class FoodMenu extends ControllerBase {
  public function Menu(){
    $MainMenu = [
      ['name'=> 'Dosa'],
      ['name'=> 'Idly'],
      ['name'=>'puri'],
      ['name'=>'roti'],
    ];

    $MenuList = '<ul>';
    foreach($MainMenu as $MenuName){
      $MenuList .='<li>' .$MenuName['name'].'</li>';
    }
  $MenuList .= '</ul>';
  return [
    ['#type'=> 'markup'],
    ['#markup'=> $MenuList],
  ];
  }
}










