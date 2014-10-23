<?php

class ApiController extends AppController {

    public function registerShop() {
        if ($this->request->is('post')) {
            $this->Shop->create();
            if ($this->Shop->save($this->request->data)) {
                $this->Session->setFlash(__('Your shop has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Unable to add your shop.'));
        }
    }
}