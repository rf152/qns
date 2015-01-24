<?php
/**
 * Score model for QNS
 * 
 * This file is a model representing a Quiznight Score.
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
 * Score Model
 *
 * @package       qns.Model
 */
class Score extends AppModel {
	/// Relationships
	public $belongsTo = array(
		'Score_Team' => array(
			'className' => 'Team',
			'foreignKey' => 'team_id',
		),
		'Score_Round' => array(
			'className' => 'Round',
			'foreignKey' => 'round_id',
		),
	);
}
?>
