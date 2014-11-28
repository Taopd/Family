<?php
App::uses('AppModel', 'Model');
/**
 * Shop Model
 *
 * @property Bill $Bill
 * @property Girl $Girl
 * @property Item $Item
 * @property Member $Member
 * @property TableGirl $TableGirl
 * @property TableItem $TableItem
 * @property TableMember $TableMember
 * @property TableSelection $TableSelection
 * @property Table $Table
 */
class UserShop extends AppModel {
/**
 * Use table
 *
 * @var mixed False or table name
 */
    public $useTable = 'user_shop';

    public $belongsTo = array(
        'Shop' => array(
            'className' => 'Shop',
            'foreignKey' => 'shop_id',
            'conditions' => array('UserShop.shop_id = Shop.id'),
        ),
        'Users' => array(
            'className' => 'Users',
            'foreignKey' => 'user_id',
            'conditions' => array('UserShop.user_id = Users.id'),
        ),
    );

    public function getShop($user_id){
        $list_shop = $this->query("SELECT shop.name, shop.id FROM shop, user_shop WHERE user_shop.user_id = {$user_id} AND user_shop.shop_id = shop.id");
        $list = array();
        foreach ($list_shop as $key => $shop) {
            $list[$shop['shop']['id']] = $shop['shop']['name'];
        }
        return $list;
    }

}
