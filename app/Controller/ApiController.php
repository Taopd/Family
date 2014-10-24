<?php

class ApiController extends AppController {
    public $uses = array('Shop', 'Shopuiid');

    public $components = array('Json');

    public $layout = 'api';

    public function beforeFilter() {
        $this->Auth->allow();
        parent::beforeFilter();
    }

    private function _responseJson($data) {
        $this->set('result', json_encode($data));
        $this->render('default_api');
        return true;
    }

    private function _validateDataRegisterShop($data) {
        $validation_params = array(
            'login_id', 'password', 'uiid'
        );
        $errors = array();
        foreach ($validation_params as $v) {
            if (empty($data[$v])) {
                $errors[] = 'Missing ' . $v;
            }
        }

        return $errors;
    }

    public function registerShop() {
        if (!$this->request->is('post')) {
            return $this->_responseJson(array(
                'status' => 'NG',
                'message' => __('Method not allowed'),
            ));
        }
        $data = $this->request->data;
        $errors = $this->_validateDataRegisterShop($data);
        if (!empty($errors)) {
            return $this->_responseJson(array(
                'status' => 'NG',
                'message' => $errors,
            ));
        }
        $shop = $this->Shop->findByCondition(array(
            'login_id' => $data['login_id'],
            'password' => $data['password'],
        ));
        if (!$shop) {
            return $this->_responseJson(array(
                'status' => 'NG',
                'message' => __('Shop not found'),
            ));
        }
        $this->Shopuiid->create();
        $shop_uiid_data = array(
            'Shopuiid' => array(
                'shop_id'   =>   $shop['Shop']['id'],
                'uiid'      =>   $data['uiid'],
                'status'    =>   1,
                'create_at' =>   date('Y-m-d H:i:s')
            )
        );
        if ($this->Shopuiid->save($shop_uiid_data)) {
            return $this->_responseJson(array(
                'status' => 'OK',
                'message' => 'データ登録が完了いたしました',
            ));
        } else {
            return $this->_responseJson(array(
                'status' => 'NG',
                'message' => $this->Shopuiid->invalidFields(),
            ));
        }
    }

    public function getSendUrl($UIID) {
        $this->Shopuiid->primaryKey = 'uiid';
        if ($this->Shopuiid->exists($UIID)) {
            $response_json = json_encode(array("url" => Configure::read('real_server')));
            $this->set('result',$response_json);
        } else {
            $response_json = json_encode(array("url" => Configure::read('test_server')));
            $this->set('result',$response_json);
        }

        $this->render('default_api');
    }
}