<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	public $components = array(
		'Session' => array(
			'timeout' => 120,
			'cookieTimeout' => 1440,
		),
		'Auth' => array(
			'loginRedirect' => array(
				'controller' => 'scoresheet',
				'action' => 'index',
			),
			'logoutRedirect' => array(
				'controller' => 'users',
				'action' => 'login',
			),
			'loginAction' => array(
				'controller' => 'users',
				'action' => 'login',
			),
			'authenticate' => array(
				'Form' => array(
					'passwordHasher' => 'Blowfish',
					'fields' => array(
						'username' => 'email',
					),
					'userFields' => array(
						'id',
						'email',
						'name',
						'superadmin',
					),
				),
			),
		),
	);
	
	public function beforeFilter() {
		
		if (!$this->Session->read('qns.game_id')) {
			if (
				!(
					$this->request->controller == 'games' &&
					(
						$this->request->action == 'load' ||
						$this->request->action == 'create'
					)
				) &&
				!(
					$this->request->controller == 'users' &&
					(
						$this->request->action == 'login' ||
						$this->request->action == 'logout'
					)
				)
			) {
				$this->redirect(
					array(
						'controller' => 'games',
						'action' => 'load',
					)
				);
			}
		} else {
			$this->gid = $this->Session->read('qns.game_id');
		}
		$this->set('authuser', $this->Auth->user());
		parent::beforeFilter();
	}
}
