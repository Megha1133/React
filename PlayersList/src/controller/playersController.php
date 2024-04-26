<?php 
namespace Drupal\PlayersList\Controller;
use Drupal\Core\Controller\ControllerBase;

class playersController extends ControllerBase {
  
    public function PlayersList(){
        $players = [
            ['name'=> 'Rohit'],
            ['name'=> 'virat'],
            ['name'=> 'Ravindra'],
            ['name'=> 'Ashwin'],
            ['name'=> 'Jasprith'],
        ];

        $playersList = '<ul>';
        foreach($players as $player) {
            $playersList .= '<li>' . $player['name'] .'</li>';
        }
        $playersList .= '</ul>';
        return [
            ['#type' => 'markup'],
            ['#markup' => $playersList],
        ];
    }
}

