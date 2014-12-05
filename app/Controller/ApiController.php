<?php

class ApiController extends AppController {
    public $uses = array('Shop', 'Shopuiid', 'TrstAppVersion','Users');

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
        $users = $this->Users->findByCondition(array(
            'username' => $data['login_id'],
            'password' => $data['password'],
        ));
        if (!$users) {
            return $this->_responseJson(array(
                'status' => 'NG',
                'message' => __('Users not found'),
            ));
        }
        $shop_uiid_data = array(
            'user_id'   =>   $users['Users']['id'],
            'uiid'      =>   $data['uiid'],
        );
        $responseData = $this->Shopuiid->checkAndSave($shop_uiid_data);
        
        return $this->_responseJson($responseData);
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

    public function getLatestVersion() {
        if (!$this->request->is('get')) {
            return $this->_responseJson(array(
                'status' => 'NG',
                'message' => __('Method not allowed'),
            ));
        }
        try {
            $version = $this->TrstAppVersion->getLatestVersion();
        } catch (CakeException $e) {
            return $this->_responseJson(array(
                'status' => 'NG',
                'message' => $e->getMessage(),
            ));
        }

        return $this->_responseJson(array(
            'version' => $version,
        ));
    }
}