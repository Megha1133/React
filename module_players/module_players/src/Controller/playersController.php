<?php
namespace Drupal\module_players\Controller;
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

        // $playersList = '<ul>';
        // foreach($players as $player) {
        //     $playersList .= '<li>' . $player['name'] .'</li>';
        // }
        // $playersList .= '</ul>';

        return [
            '#theme' => 'players_list',
            '#items' => $players,
            '#title' => 'My list Of Players',
            '#attached' => [
              'library' => [
                'module_players/custom',
                ],
            ]
        ];
    }
}