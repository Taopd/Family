<?php

class ApiController extends AppController {
    public $uses = array('Shop', 'Shopuiid');

    public $components = array('Json');

    public $layout     = 'api';

    public function beforeFilter() {
        $this->Auth->allow();
        parent::beforeFilter();
    }
    public function registerShop() {

        if ($this->request->is('post')) {
            $this->Shop->create();
            $data = $this->request->data;
            $validation_params = array(
                "login_id",
                "password",
                "uiid"
            );
            $error = array();
            foreach($validation_params as $param) {
                if(!array_key_exists($param, $data) || empty($data[$param])) {
                    $error[] = "Missing ".$param;
                }
            }
            if(count($error) > 0) {
                $response = array('status' => 'NG', 'message' => $error);
            } else {
                $shop_data = array(
                    "Shop" => array(
                        "login_id" => $data["login_id"],
                        "password" => $data["password"]
                    ),
                );
                if ($this->Shop->save($shop_data)) {
                    $this->Shopuiid->create();
                    $shop_uiid_data = array(
                        "Shopuiid" => array(
                            "shop_id"   =>   $this->Shop->id,
                            "uiid"      =>   $data["uiid"],
                            "status"    =>   1,
                            "create_at" =>   date("Y-m-d H:i:s")
                        )
                    );
                    $this->Shopuiid->save($shop_uiid_data);
                    $response = array('status' => 'OK','message' => 'データ登録が完了いたしました');
                } else {
                    $response = array('status' => 'NG','message' => $this->Shop->invalidFields());
                }
            }
            $this->set('result', json_encode($response));
            $this->render('default_api');
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