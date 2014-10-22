<?php

class ShopsController extends AppController {

    const ITEMS_PER_PAGE = 20;

    public $components = array('Paginator');

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
            '_serialize' => array('shops')
        ));
    }

    public function view($id) {
        $shop = $this->Shop->findById($id);
        if (empty($shop)) {
            throw new NotFoundException(__('Invalid shop'));
        }
        $this->set(array(
            'shop' => $shop,
            '_serialize' => array('shop')
        ));
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->Shop->create();
            if ($this->Shop->save($this->request->data)) {
                $message = 'Saved';
            } else {
                $message = 'Error';
            }
            $this->set(array(
                'message' => $message,
                '_serialize' => array('message')
            ));
        }
    }

    public function edit($id) {
        if (!$this->Shop->exists($id)) {
			throw new NotFoundException(__('Invalid shop'));
		}
        $this->Shop->id = $id;
        if ($this->Shop->save($this->request->data)) {
            $message = 'Saved';
        } else {
            $message = 'Error';
        }
        $this->set(array(
            'message' => $message,
            '_serialize' => array('message')
        ));
    }

    public function delete($id) {
        if (!$this->Shop->exists($id)) {
			throw new NotFoundException(__('Invalid shop'));
		}
        if ($this->Shop->delete($id)) {
            $message = 'Deleted';
        } else {
            $message = 'Error';
        }
        $this->set(array(
            'message' => $message,
            '_serialize' => array('message')
        ));
    }
}
