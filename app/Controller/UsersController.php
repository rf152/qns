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
 * Users Controller
 *
 * @package qns.Controller
 */

class UsersController extends AppController {
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('login');
		$this->Auth->allow('blah');
	}
	
	public function login() {
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Auth->login()) {
				if ($this->request->data['User']['display']) {
					$this->Session->write('qns.display', 1);
				}
				return $this->redirect($this->Auth->redirectUrl());
			}
			$this->Session->setFlash(
				'Username or password incorrect',
				'default',
				array(),
				'auth'
			);
		}
		if ($this->Auth->user('id')) {
			return $this->redirect($this->Auth->redirectUrl());
		}
	}
	
	public function logout() {
		$this->Session->delete('qns');
		return $this->redirect($this->Auth->logout());
	}
	
	public function edit($id = false) {
		if ($this->request->is(array('post', 'put'))) {
			if (
				!$this->Auth->user('superadmin') &&
				$this->request->data['User']['id'] <> $this->Auth->user('id')
			) {
				throw new NotAuthorizedException();
			}
			if ($this->request->data['User']['password'] == '') {
				unset($this->request->data['User']['password']);
			}
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash("User Saved");
				
				return $this->redirect(
					array(
						'controller' => 'scoresheet',
						'action' => 'index',
					)
				);
			}
		}
		if ($id === false) {
			$id = $this->Auth->user('id');
		} else {
			if (!$this->Auth->user('superadmin')) {
				throw new NotAuthorizedExeption();
			}
		}
		$this->User->recursive = -1;
		$user = $this->User->findById($id);
		$this->set('superadmin', $this->Auth->user('superadmin'));
		$this->set('user', $user);
	}
}
?>
