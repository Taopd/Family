<?php

class ShopuiidsController extends AppController {

    const ITEMS_PER_PAGE = 20;

    public $components = array('Paginator');
    
    public $paginate = array(
        'limit' => self::ITEMS_PER_PAGE,
    );

    public function index() {
        $this->Paginator->settings = $this->paginate;
        $shopuiids = $this->Paginator->paginate('Shopuiid');
        $this->set(array(
            'shopuiids' => $shopuiids,
            'items_per_page' => self::ITEMS_PER_PAGE,
        ));
    }

    public function edit($id) {
        if (!$id) {
            throw new NotFoundException(__('Invalid shop uiid'));
        }
        
        $shopuiid = $this->Shopuiid->findById($id);
        if (!$shopuiid) {
            throw new NotFoundException(__('Invalid shop uiid'));
        }

        if ($this->request->is(array('post', 'put'))) {
            $this->Shopuiid->id = $id;
            if ($this->Shopuiid->save($this->request->data)) {
                $this->Session->setFlash(__('Your shop uiid has been updated.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Unable to update your shop uiid.'));
        }

        if (!$this->request->data) {
            $this->request->data = $shopuiid;
        }
    }

    public function delete($id) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }

        if (!$id) {
            throw new NotFoundException(__('Invalid shop uiid'));
        }

        $shopuiid = $this->Shopuiid->findById($id);
        if (!$shopuiid) {
            throw new NotFoundException(__('Invalid shop uiid'));
        }

        if ($this->Shopuiid->delete($id)) {
            $this->Session->setFlash(
                __('The shop uiid with id: %s has been deleted.', h($id))
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