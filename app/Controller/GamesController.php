<?php
/**
 * QNS: Quiznight Scoring System
 * Copyright (c) Richard Franks (https://github.com/rf152/qns)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Richard Franks
 * @link          https://github.com/rf152/qns
 * @package       qns.Controller
 * @since         QNS 0.1
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('AppController', 'Controller');

/**
 * Games Controller
 *
 * @package qns.Controller
 */
class GamesController extends AppController {
	public function index() {
		$games = $this->Game->find('all');
		$this->set('games', $games);
	}
	
	public function badger() {
		$this->Game->create();
		$data = array(
			'Game' => array(
				'name' => 'Test Game',
				'user_id' => 1,
			),
		);
		$this->Game->save($data);
		
		$this->redirect(array('action' => 'index'));
	}
	
	public function load() {
		$game = $this->Game->find('first');
		$this->Session->write('qns.game_id', $game['Game']['id']);
		$this->redirect(
			array(
				'controller' => 'scoresheet',
				'action' => 'index',
			)
		);
	}
}

?>
