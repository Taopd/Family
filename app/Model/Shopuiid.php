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
    
}