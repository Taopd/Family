<?php

App::uses('AuthComponent', 'Controller/Component');

class Shopuiid extends AppModel {

    public $useTable = 'shop_uiid';

    public $belongsTo = array(
        'Shop' => array(
            'className' => 'Shop',
            'foreignKey' => 'shop_id'
        )
    );

    public function findByUiid($shop_id, $uiid) {
        $shopuiid = $this->find('first', array(
            'conditions' => array(
                'Shopuiid.shop_id' => $shop_id,
                'Shopuiid.uiid' => $uiid,
            )
        ));

        return $shopuiid;
    }

    public function checkAndSave($data) {
        $shopuiid = $this->findByUiid($data['shop_id'], $data['uiid']);
        if ($shopuiid) {
            $this->id = $shopuiid['Shopuiid']['id'];
            $requestData = array(
                'status' => 1,
            );
            if ($this->save($requestData)) {
                return array(
                    'status' => 'OK',
                    'message' => 'UIIDは既存しました',
                );
            }
            return array(
                'status' => 'NG',
                'message' => $this->Shopuiid->invalidFields(),
            );
        }
        $this->create();
        $requestData = array(
            'shop_id'   =>   $data['shop_id'],
            'uiid'      =>   $data['uiid'],
            'status'    =>   1,
            'create_at' =>   date('Y-m-d H:i:s')
        );
        if ($this->save($requestData)) {
            return array(
                'status' => 'OK',
                'message' => 'データ登録が完了いたしました',
            );
        }
        
        return array(
            'status' => 'NG',
            'message' => $this->Shopuiid->invalidFields(),
        );
    }
}