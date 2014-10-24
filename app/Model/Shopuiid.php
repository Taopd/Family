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

    public function findByUiid($uiid) {
        $shopuiid = $this->find('first', array(
            'conditions' => array(
                'Shopuiid.uiid' => $uiid,
            )
        ));

        return $shopuiid;
    }

    public function checkAndSave($data) {
        $shopuiid = $this->findByUiid($data['uiid']);
        $isNew = false;
        $requestData = array();
        $successMessage = '';
        if ($shopuiid) {
            if ($shopuiid['Shopuiid']['shop_id'] != $data['shop_id']) {
                return array(
                    'status' => 'NG',
                    'message' => 'UIIDは他の店舗で登録してしまいました',
                );
            }
            $isNew = true;
            $this->id = $shopuiid['Shopuiid']['id'];
            $requestData = array(
                'status' => 1,
            );
            $successMessage = 'UIIDは既存しました';
        } else {
            $this->create();
            $requestData = array(
                'shop_id'   =>   $data['shop_id'],
                'uiid'      =>   $data['uiid'],
                'status'    =>   1,
                'create_at' =>   date('Y-m-d H:i:s')
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
}