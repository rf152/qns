<?php
/**
 * Scoresheet Controller
 * 
 * This controller is responsible for drawing the scoresheet
 * 
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
 * Scoresheet Controller
 *
 * @package qns.Controller
 */
class ScoresheetController extends AppController {
	public function index() {
		if ($this->gid === false) {
			$this->redirect(
				array(
					'controller' => 'games',
					'action' => 'load',
				)
			);
		}
		$this->loadModel('Game');
		$this->loadModel('Team');
		$this->Team->calculateTotals();
		
		$this->Game->recursive = 2;
		$game = $this->Game->findById($this->gid);
		if (isset($this->passedArgs['ajax'])) {
			$this->layout = 'ajax';
		}
		$this->set('game', $game);
	}
	
	public function display() {
		$this->Session->write('qns.display', 1);
		$this->redirect(array('action' => 'index'));
	}
	public function admin() {
		$this->Session->write('qns.display', 0);
		$this->redirect(array('action' => 'index'));
	}
}

?>
