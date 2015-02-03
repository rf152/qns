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
	
	public function load() {
		if ($this->request->is(array('post', 'put'))) {
			$game = $this->Game->findById($this->request->data['Game']['id']);
			if (isset($game['Game'])) {
				$this->Session->write('qns.game_id', $game['Game']['id']);
				return $this->redirect(
					array(
						'controller' => 'scoresheet',
						'action' => 'index',
					)
				);
			}
		}
		$this->Game->recursive = -1;
		if ($this->Auth->user('superadmin')) {
			$games = $this->Game->find('all');
		} else {
			$games = $this->Game->findAllByUserId($this->Auth->user('id'));
		}
		$this->set('games', $games);
		$this->set('title_for_layout', 'Load Game');
	}
	
	public function create() {
		if ($this->request->is(array('post', 'put'))) {
			$this->loadModel('Team');
			$this->loadModel('Round');
			$this->Game->create();
			$this->request->data['Game']['user_id'] = $this->Auth->user('id');
			$this->Game->save($this->request->data);
			if (!$this->request->data['Game']['interval_round']) {
				$this->request->data['Game']['interval_round'] = -1;
			}
			$j = 1;
			for ($i = 0; $i < $this->request->data['Game']['num_rounds']; $i++) {
				echo ".";
				$this->Round->create();
				$round = array();
				if ($this->request->data['Game']['interval_round'] == $i+1) {
					// This is the interval round
					$round['Round']['round_name'] = 'I';
				} else {
					$round['Round']['round_name'] = $j;
					$j++;
				}
				$round['Round']['game_id'] = $this->Game->id;
				$round['Round']['round_number'] = $i;
				$this->Round->save($round);
			}
			for ($i = 0; $i < $this->request->data['Game']['num_teams']; $i++) {
				echo "#";
				$team = array();
				$this->Team->create();
				$team['Team']['name'] = 'Team ' . ($i + 1);
				$team['Team']['game_id'] = $this->Game->id;
				$team['Team']['total'] = 0;
				$this->Team->save($team);
			}
			$this->Session->write('qns.game_id', $this->Game->id);
			return $this->redirect(
				array(
					'controller' => 'scoresheet',
					'action' => 'index',
				)
			);/**/
			die("POST");
		}
		$this->set('title_for_layout', 'Create Game');
	}
	
	public function getTick() {
		if ($this->gid === false) {
			throw new NotFoundException();
		}
		$this->Game->recursive = -1;
		$game = $this->Game->findById($this->gid);
		if (!isset($game['Game'])) {
			throw new NotFoundException();
		}
		$this->layout = 'ajax';
		$this->set('tick', $game['Game']['tick']);
	}
	
	public function increaseTick() {
		if ($this->gid === false) {
			throw new NotFoundException();
		}
		$this->Game->recursive = -1;
		$game = $this->Game->findById($this->gid);
		if (!isset($game['Game'])) {
			throw new NotFoundException();
		}
		$game['Game']['tick']++;
		$this->Game->create();
		$this->Game->save($game);
		$this->redirect(
			array(
				'controller' => 'scoresheet',
				'action' => 'index',
			)
		);
	}
}

?>
