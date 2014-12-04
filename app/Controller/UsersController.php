<?php
App::uses('AppController', 'Controller');
/**
 * Fee Controller
 *
 * @property Fee $Fee
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

    const ITEMS_PER_PAGE = 20;
/**
 * Helpers
 *
 * @var array
 */
    public $helpers = array('Html', 'Form');
    public $uses = array('UserShop', 'Users','Shop');
    public $paginate = array(
        'limit' => self::ITEMS_PER_PAGE,
        'order' => array(
            'Users.created_at' => 'desc'
        )
    );

/**
 * Components
 *
 * @var array
 */
    public $components = array('Paginator');
/**
 * index method
 *
 * @return void
 */
    public function index() {
        $this->Paginator->settings = $this->paginate;
        $users = $this->Paginator->paginate('Users');
        $this->set(array(
            'users' => $users,
            'items_per_page' => self::ITEMS_PER_PAGE,
        ));
        $this->set('role' , array(Users::SHOP => '店舗',Users::MANAGER => 'エリアマネージャ', Users::ADMIN => 'オーナー'));
    }

/**
 * add method
 *
 * @return void
 */
    public function add() {
        if ($this->request->is('post')) {
            $this->Users->create();
            $data = $this->request->data;
            $data['Users']['created_at'] = date('Y-m-d H:i:s');
            $data['Users']['updated_at'] = date('Y-m-d H:i:s');
            if ($this->Users->save($data)) {
                if ($data['Users']['role'] != Users::SHOP) {
                    foreach ($data['Shop']['shop_id'] as $key => $shop_id) {
                        $this->UserShop->create();
                        $addUserShop = array(
                            'user_id' => $this->Users->getLastInsertId(),
                            'shop_id' => $shop_id,
                            'created_at' => $data['Users']['created_at'],
                            'updated_at' => $data['Users']['updated_at']
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

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function edit($id = null) {
        if (!$this->Users->exists($id)) {
            throw new NotFoundException(__('Invalid Users'));
        }
        $this->set('list_role' , array(Users::SHOP => '店舗',Users::MANAGER => 'エリアマネージャ', Users::ADMIN => 'オーナー'));
        if ($this->request->is(array('post', 'put'))) {
            $this->request->data['Users']['updated_at'] = date('Y-m-d H:i:s');
            $this->request->data['Users']['password'] = $this->request->data['Users']['password_confirm_update'];
            if ($this->Users->save($this->request->data)) {
                $this->Session->setFlash(__('The Users has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The Users could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Users.id' => $id));
            $this->request->data = $this->Users->find('first', $options);
            
        }
    }

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function delete($id = null) {
        $this->Users->id = $id;
        if (!$this->Users->exists()) {
            throw new NotFoundException(__('Invalid User'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Users->delete()) {
            $this->Session->setFlash(__('The User has been deleted.'));
        } else {
            $this->Session->setFlash(__('The User could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }
}

