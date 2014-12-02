<?php
App::uses('AppController', 'Controller');
/**
 * Fee Controller
 *
 * @property Fee $Fee
 * @property PaginatorComponent $Paginator
 */
class UserShopController extends AppController {

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
            'UserShop.created_at' => 'desc'
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
        $userShops = $this->Paginator->paginate('UserShop');
        $this->set(array(
            'userShops' => $userShops,
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
            $user = $this->Users->find('first', array('recursive' => -1, 'conditions' => array('id' => $this->request->data['UserShop']['user_id'])));
            if ($user['Users']['role'] == Users::SHOP) {
                $checkUser = $this->UserShop->find('list', array('recursive' => -1, 'conditions' => array('user_id' => $this->request->data['UserShop']['user_id'])));
                if (!empty($checkUser)) {
                    $this->Session->setFlash(__('この店舗は一つの店舗しか使えません.'));
                    return $this->redirect(array('action' => 'add'));
                }
            }
            
            $this->UserShop->create();
            $this->request->data['UserShop']['created_at'] = date('Y-m-d H:i:s');
            $this->request->data['UserShop']['updated_at'] = date('Y-m-d H:i:s');

            if ($this->UserShop->save($this->request->data)) {
                $this->Session->setFlash(__('The UserShop has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The UserShop could not be saved. Please, try again.'));
            }
        }
        $list_user = $this->Users->find('list', array( 'fields'  => array('id','username')));
        $list_shop = $this->Shop->find('list', array( 'fields'  => array('id','name')));

        $this->set('list_user', $list_user);
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
        if (!$this->UserShop->exists($id)) {
            throw new NotFoundException(__('Invalid UserShop'));
        }
        if ($this->request->is(array('post', 'put'))) {
            $this->request->data['UserShop']['updated_at'] = date('Y-m-d H:i:s');
            if ($this->UserShop->save($this->request->data)) {
                $this->Session->setFlash(__('The UserShop has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The UserShop could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('UserShop.id' => $id));
            $this->request->data = $this->UserShop->find('first', $options);
        }
        $list_user = $this->Users->find('list', array( 'fields'  => array('id','username')));
        $list_shop = $this->Shop->find('list', array( 'fields'  => array('id','name')));

        $this->set('list_user', $list_user);
        $this->set('list_shop', $list_shop);
    }

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function delete($id = null) {
        $this->UserShop->id = $id;
        if (!$this->UserShop->exists()) {
            throw new NotFoundException(__('Invalid UserShop'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->UserShop->delete()) {
            $this->Session->setFlash(__('The UserShop has been deleted.'));
        } else {
            $this->Session->setFlash(__('The UserShop could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }
}

