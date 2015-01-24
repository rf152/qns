<?php
/**
 * Round model for QNS
 * 
 * This file is a model representing a Quiznight Round.
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
 * Round Model
 *
 * @package       qns.Model
 */
class Round extends AppModel {
	/// Relationships
	public $belongsTo = array(
		'Round_Game' => array(
			'className' => 'Game',
			'foreignKey' => 'game_id',
		),
	);
	
	public $hasMany = array(
		'Round_Score' => array(
			'className' => 'Score',
			'foreign_key' => 'team_id',
		),
	);
}
?>
