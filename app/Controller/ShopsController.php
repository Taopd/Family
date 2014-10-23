<?php

class ShopsController extends AppController {

    const ITEMS_PER_PAGE = 20;

    public $components = array('Paginator');
    public $helpers = array('Html', 'Form');
    public $paginate = array(
        'limit' => self::ITEMS_PER_PAGE,
        'order' => array(
            'Shop.login_id' => 'asc'
        )
    );

    public function index() {
        $this->Paginator->settings = $this->paginate;
        $shops = $this->Paginator->paginate('Shop');
        
        $this->set(array(
            'shops' => $shops,
            'items_per_page' => self::ITEMS_PER_PAGE,
        ));
    }

    public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid shop'));
        }
        $shop = $this->Shop->findById($id);
        if (!$shop) {
            throw new NotFoundException(__('Invalid shop'));
        }
        $this->set(array(
            'shop' => $shop,
        ));
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->Shop->create();
            if ($this->Shop->save($this->request->data)) {
                $this->Session->setFlash(__('Your shop has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Unable to add your shop.'));
        }
    }

    public function edit($id) {
        if (!$id) {
            throw new NotFoundException(__('Invalid shop'));
        }
        
        $shop = $this->Shop->findById($id);
        if (!$shop) {
            throw new NotFoundException(__('Invalid shop'));
        }

        if ($this->request->is(array('post', 'put'))) {
            $this->Shop->id = $id;
            if ($this->Shop->save($this->request->data)) {
                $this->Session->setFlash(__('Your shop has been updated.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Unable to update your shop.'));
        }
        
        if (!$this->request->data) {
            $this->request->data = $shop;
        }
    }

    public function delete($id) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }
        
        if (!$id) {
            throw new NotFoundException(__('Invalid shop'));
        }

        $shop = $this->Shop->findById($id);
        if (!$shop) {
            throw new NotFoundException(__('Invalid shop'));
        }

        if ($this->Shop->delete($id)) {
            $this->Session->setFlash(
                __('The shop with id: %s has been deleted.', h($id))
            );
            $responseData = array(
                'success' => true,
            );
        } else {
            $responseData = array(
                'success' => false,
            );
        }

        $this->set('responseData', json_encode($responseData));
    }
}