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
 * Scores Controller
 *
 * @package qns.Controller
 */
class ScoresController extends AppController {
	public function edit($roundid = false) {
		if (!empty($this->request->data)) {
			foreach ($this->request->data['Score'] as $score) {
				if ($score['value'] == '') {
					continue;
				}
				$this->Score->create();
				$this->Score->save($score);
			}
			$this->redirect(
				array(
					'controller' => 'scoresheet',
					'action' => 'index',
				)
			);
			die();
		} else {
			$this->loadModel('Round');
			$this->loadModel('Team');
			$this->Team->recursive = -1;
			$teams = $this->Team->findAllByGameId($this->gid);
			$this->Round->recursive = -1;
			$this->Round->contain('Round_Score.Score_Team.name');
			$rounds = $this->Round->findAllByGameId($this->gid);
			
			
			foreach ($rounds as $key=>$round) {
				if (empty($round['Round_Score'])) {
					$scores = array();
					foreach($teams as $team) {
						$scores[] = array(
							'team_id' => $team['Team']['id'],
							'round_id' => $round['Round']['id'],
							'value' => '',
							'joker' => 0,
							'chicken' => 0,
							'Score_Team' => $team['Team'],
						);
					}
					$rounds[$key]['Round_Score'] = $scores;
					if ($round['Round']['id'] == $roundid) {
						$roundid = $round['Round']['id'];
					}
				}
			}
			if ($roundid === false) {
				$roundid = 0;
			}
			$this->set('roundid', $roundid);
			$this->set('rounds', $rounds);
		}
	}
}

?>
