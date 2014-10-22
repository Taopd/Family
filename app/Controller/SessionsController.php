<?php

class SessionsController extends AppController {

    public function login() {
        // if already logged-in, redirect
        if ($this->Session->check('Auth.User')) {
            $this->redirect(array('controller' => 'shops', 'action' => 'index'));
        }

        // if we get the post information, try to authenticate
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->Session->setFlash(__('Welcome, ' . $this->Auth->user('username')));
                $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Session->setFlash(__('Invalid username or password'));
            }
        }
    }

    public function logout() {
        $this->redirect($this->Auth->logout());
    }
    
}