<?php
App::uses('Users', 'Model');
App::uses('UserShop', 'Model');
App::uses('Shop', 'Model');
App::uses('AuthComponent', 'Controller/Component');

class Shopuiid extends AppModel {

    public $useTable = 'shop_uiid';

    public $belongsTo = array(
        'Shop' => array(
            'className' => 'Shop',
            'foreignKey' => 'shop_id'
        )
    );

    public function findByUiid($uiid) {
        $shopuiid = $this->find('first', array(
            'conditions' => array(
                'Shopuiid.uiid' => $uiid,
            )
        ));

        return $shopuiid;
    }

    public function checkAndSave($data) {
        $checkuiid = $this->findByUiid($data['uiid']);
        $users = new Users();
        $userShop = new UserShop();
        $shop = new Shop();
        $user = $users->find('first', array('recursive' => -1,'conditions' => array('id' => $data['user_id'])));
//        if ($user['Users']['role'] != 0) {
//            return array(
//                'status' => 'NG',
//                'message' => 'User is not Shop',
//            );
//        }
        $userShop = $userShop->find('first', array('recursive' => -1, 'conditions' => array('user_id' => $user['Users']['id'])));
        if (empty($userShop['UserShop']['shop_id'])) {
            return array(
                'status' => 'NG',
                'message' => 'User does not have any shop',
            );
        }
        $shop = $shop->find('first', array('recursive' => -1, 'conditions' => array('id' => $userShop['UserShop']['shop_id'])));
        if (empty($shop['Shop']['id'])) {
            return array(
                'status' => 'NG',
                'message' => 'User does not have any shop',
            );
        }
        if ($checkuiid && ($checkuiid['Shopuiid']['shop_id'] != $shop['Shop']['id'])) {
            return array(
                'status' => 'NG',
                'message' => 'UIIDは他の店舗で登録してしまいました',
            );
        }
        $shopuiid = $this->find('first', array(
            'conditions' => array(
                'Shopuiid.shop_id' => $shop['Shop']['id'],
            )
        ));

        if ($shopuiid) {
//            $this->id = $shopuiid['Shopuiid']['id'];
//            $requestData = array(
//                'uiid'      =>   $data['uiid'],
//                'status'    =>   1,
//            );
            $successMessage = 'UIIDは既存しました';
            return array(
                'status' => 'NG',
                'message' => $successMessage,
            );
        } else {
            $this->create();
            $requestData = array(
                'shop_id'   =>   $shop['Shop']['id'],
                'uiid'      =>   $data['uiid'],
                'status'    =>   1,
                'created_at' =>   date('Y-m-d H:i:s')
            );
            $successMessage = 'データ登録が完了いたしました';
        }
        
        if ($this->save($requestData)) {
            return array(
                'status' => 'OK',
                'message' => $successMessage,
            );
        }
        
        return array(
            'status' => 'NG',
            'message' => $this->Shopuiid->invalidFields(),
        );
    }

    public function getShopId ($UIID) {
        $foundShopId = $this->find('first', array(
                'recursive' => -1,
                'conditions' => array('uiid' => $UIID),
                'fields' => array('shop_id'))
        );

        return $foundShopId['Shopuiid']['shop_id'];
    }
}