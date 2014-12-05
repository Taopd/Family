<?php

class Shop extends AppModel {

    public $useTable = 'shop';

    public $hasMany = array(
        'Shopuiid' => array(
            'className' => 'Shopuiid',
        ),
    );

    public $validate = array(        
        'name' => array(
            'nonEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Name is required.',
                'allowEmpty' => false
            ),
            'unique' => array(
                'rule' => array('isUniqueName'),
                'message' => 'This Name is already in use.'
            ),
        ),
    );

    /**
     * Before isUniqueUsername
     * @param array $options
     * @return boolean
     */
    function isUniqueUsername($check) {

        $login_id = $this->find(
            'first',
            array(
                'fields' => array(
                    'Shop.id',
                    'Shop.login_id'
                ),
                'conditions' => array(
                    'Shop.login_id' => $check['login_id']
                )
            )
        );
        if (!empty($login_id)) {
            if (isset($this->data[$this->alias]['id']) && ($this->data[$this->alias]['id'] == $login_id['Shop']['id'])) {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    }

    function isUniqueName($check) {

        $login_id = $this->find(
            'first',
            array(
                'fields' => array(
                    'Shop.id',
                    'Shop.name'
                ),
                'conditions' => array(
                    'Shop.name' => $check['name']
                )
            )
        );
        if (!empty($login_id)) {
            if (isset($this->data[$this->alias]['id']) && ($this->data[$this->alias]['id'] == $login_id['Shop']['id'])) {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    }

    function isUniqueEmail($check) {

        $email = $this->find(
            'first',
            array(
                'fields' => array(
                    'Shop.id'
                ),
                'conditions' => array(
                    'Shop.email' => $check['email']
                )
            )
        );

        if (!empty($email)) {
            if (isset($this->data[$this->alias]['id']) && ($this->data[$this->alias]['id'] == $email['Shop']['id'])) {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    }

    public function alphaNumericDashUnderscore($check) {
        // $data array is passed using the form field name as the key
        // have to extract the value to make the function generic
        $value = array_values($check);
        $value = $value[0];

        return preg_match('/^[a-zA-Z0-9_ \-]*$/', $value);
    }

    public function equaltofield($check,$otherfield) {
        //get name of field
        $fname = '';
        foreach ($check as $key => $value) {
            $fname = $key;
            break;
        }

        return $this->data[$this->name][$otherfield] === $this->data[$this->name][$fname];
    }

//    /**
//     * Before Save
//     * @param array $options
//     * @return boolean
//     */
//     public function beforeSave($options = array()) {
//        // hash our password
//        if (isset($this->data[$this->alias]['password'])) {
//            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
//        }
//
//        // if we get a new password, hash it
//        if (isset($this->data[$this->alias]['password_update']) && !empty($this->data[$this->alias]['password_update'])) {
//            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password_update']);
//        }
//
//        // fallback to our parent
//        return parent::beforeSave($options);
//    }

    public function findByCondition($condition) {
        $shopConditions = array();
        foreach ($condition as $k => $v) {
            $shopConditions['Shop.' . $k] = $v;
        }
        $shop = $this->find('first', array(
            'conditions' => $shopConditions
        ));
        if (empty($shop)) {
            return false;
        }
        
        return $shop;
    }
}
