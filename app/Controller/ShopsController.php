<?php

class ShopsController extends AppController {

    const ITEMS_PER_PAGE = 20;

    public $components = array('Paginator');
    public $helpers = array('Html', 'Form');
    public $paginate = array(
        'limit' => self::ITEMS_PER_PAGE,
        'order' => array(
            'Shop.created_at' => 'desc'
        )
    );

    public $uses = array('Users','Shop','UserShop');

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
            $data = $this->request->data;

            $data['Shop']['created_at'] = date('Y-m-d H:i:s');
            $data['Shop']['updated_at'] = date('Y-m-d H:i:s');
            if ($this->Shop->save($data)) {

                $addUser = array(
                    'name' => $data['Shop']['name'],
                    'username' => $data['Shop']['login_id'],
                    'password' => $data['Shop']['password'],
                    'role'  => $data['Shop']['role'],
                    'created_at' => $data['Shop']['created_at'],
                    'updated_at' => $data['Shop']['updated_at']
                    );
                $this->Users->create();                
                $this->Users->save($addUser);

                $user_id = $this->Users->getLastInsertId();
                $this->UserShop->create();
                $addUserShop = array(
                    'user_id' => $user_id,
                    'shop_id' => $this->Shop->getLastInsertId(),
                    'created_at' => $data['Shop']['created_at'],
                    'updated_at' => $data['Shop']['updated_at']
                );
                $this->UserShop->save($addUserShop);
                if ($data['Shop']['role'] != Users::SHOP) {
                    foreach ($data['Shop']['shop_id'] as $key => $shop_id) {
                        $this->UserShop->create();
                        $addUserShop = array(
                            'user_id' => $this->Users->getLastInsertId(),
                            'shop_id' => $shop_id,
                            'created_at' => $data['Shop']['created_at'],
                            'updated_at' => $data['Shop']['updated_at']
                        );
                        $this->UserShop->save($addUserShop);
                    }
                    // $this->Session->setFlash(__('Your shop has been saved.'));
                    // return $this->redirect(array('action' => 'add_owner/'.$user_id));

                };
                $this->Session->setFlash(__('Your shop has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }

            $this->Session->setFlash(__('Unable to add your shop.'));
        }
        $list_shop = $this->Shop->find('list', array( 'fields'  => array('id','name')));
        $this->set('list_shop', $list_shop);
    }

    public function add_owner($user_id) {
        $user = $this->Users->find('first' , array('conditions' => array('id' => $user_id)));
        if (empty($user)) {
            $this->Session->setFlash(__('Connection False!'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->set('user' , $user);
        if ($this->request->is('post')) {
            $this->Shop->create();
            $data = $this->request->data;
            $data['Shop']['created_at'] = date('Y-m-d H:i:s');
            $data['Shop']['updated_at'] = date('Y-m-d H:i:s');
            if ($this->Shop->save($data)) {
                $this->UserShop->create();
                $addUserShop = array(
                    'user_id' => $user_id,
                    'shop_id' => $this->Shop->getLastInsertId(),
                    'created_at' => $data['Shop']['created_at'],
                    'updated_at' => $data['Shop']['updated_at']
                );
                $this->UserShop->save($addUserShop);
                $this->Session->setFlash(__('Your shop has been saved.'));
                return $this->redirect(array('action' => 'add_owner/'.$user_id));
            };
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
            $data = $this->request->data;
            $data['Shop']['updated_at'] = date('Y-m-d H:i:s');
            if ($this->Shop->save($data)) {
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

        $this->layout = 'ajax';
        $this->set('responseData', json_encode($responseData));
    }
}