<?php
/**
 * Game model for QNS
 * 
 * This file is a model representing a Quiznight Game.
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
 * Game Model
 *
 * @package       qns.Model
 */
class Game extends AppModel {
	/// Relationships
	public $belongsTo = array(
		'Game_User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
		),
	);
	
	public $hasMany = array(
		'Game_Team' => array(
			'className' => 'Team',
			'foreign_key' => 'game_id',
			'order' => 'total DESC',
		),
		'Game_Round' => array(
			'className' => 'Round',
			'foreign_key' => 'game_id',
		),
	);
}
?>
