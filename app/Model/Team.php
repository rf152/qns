<?php
/**
 * Team model for QNS
 * 
 * This file is a model representing a Quiznight Team.
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
 * @package       qns.Model
 * @since         QNS 0.1
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('AppModel', 'Model');

/**
 * Team Model
 *
 * @package       qns.Model
 */
class Team extends AppModel {
	/// Relationships
	public $belongsTo = array(
		'Team_Game' => array(
			'className' => 'Game',
			'foreignKey' => 'game_id',
		),
	);
	
	public $hasMany = array(
		'Team_Score' => array(
			'className' => 'Score',
			'foreign_key' => 'team_id',
			'order' => 'Team_Score.round_id ASC',
		),
	);
	
	/// Default order
	public $order = array('id');
	
	/**
	 * Re-calculate the totals for the current game
	 */
	public function calculateTotals() {
		$score = ClassRegistry::init('Score');
		$score->recursive = -1;
		if ($this->id)
			$this->create();
		
		$gid = CakeSession::read('qns.game_id');
		
		$this->recursive = -1;
		$mTeams = $this->findAllByGameId($gid);
		foreach ($mTeams as $mTeam) {
			$score->virtualFields['total'] = 0;
			$result = $score->find(
				'first',
				array(
					'conditions' => array(
						'team_id' => $mTeam['Team']['id'],
					),
					'fields' => array(
						'SUM(value) AS Score__total',
					),
				)
			);
			$this->read(null, $mTeam['Team']['id']);
			$this->set('total', $result['Score']['total']);
			$this->save();
		}
	}
}
?>
