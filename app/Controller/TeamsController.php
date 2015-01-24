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
 * Teams Controller
 *
 * @package qns.Controller
 */
class TeamsController extends AppController {
	public function edit($id = false) {
		if (!empty($this->request->data)) {
			foreach($this->request->data['Team'] as $team) {
				if ($team['name'] == '') {
					continue;
				}
				$this->Team->read(null, $team['id']);
				$this->Team->set('name', $team['name']);
				$this->Team->save();
			}
			return $this->redirect(
				array(
					'controller' => 'scoresheet',
					'action' => 'index',
				)
			);
		} else {
			$this->Team->recursive = -1;
			if ($id === false) {
				$teams = $this->Team->findAllByGameId($this->gid);
			} else {
				$teams = array(
					0 => $this->Team->findByIdAndGameId(
						$id,
						$this->gid
					),
				);
				if (!isset($teams[0]['Team'])) {
					throw new NotFoundException('Team not found');
				}
			}
			$this->set('teams', $teams);
		}
		$this->set('title_for_layout', 'Edit Team Names');
	}
}

?>
