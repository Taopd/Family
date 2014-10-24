<?php

class Shop extends AppModel {

    public $useTable = 'shop';

    public $hasMany = array(
        'Shopuiid' => array(
            'className' => 'Shopuiid',
        ),
    );

    public $validate = array(
        'login_id' => array(
            'nonEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Login ID is required.',
                'allowEmpty' => false
            ),
            'between' => array(
                'rule' => array('between', 5, 15),
                'required' => true,
                'message' => 'Login ID must be between 5 to 15 characters.'
            ),
            'unique' => array(
                'rule' => array('isUniqueUsername'),
                'message' => 'This Login ID is already in use.'
            ),
            'alphaNumericDashUnderscore' => array(
                'rule' => array('alphaNumericDashUnderscore'),
                'message' => 'Login ID can only be letters, numbers and underscores.'
            ),
        ),
        'name' => array(
            'nonEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Name is required.',
                'allowEmpty' => false
            ),
        ),
        'email' => array(
            'required' => array(
                'rule' => array('email', true),
                'message' => 'Please provide a valid email address.'
            ),
             'unique' => array(
                'rule'    => array('isUniqueEmail'),
                'message' => 'This email is already in use.',
            ),
            'between' => array(
                'rule' => array('between', 6, 60),
                'message' => 'Email must be between 6 to 60 characters.'
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A password is required.'
            ),
            'min_length' => array(
                'rule' => array('minLength', '6'),
                'message' => 'Password must have a mimimum of 6 characters.'
            )
        ),
        'password_confirm' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Please confirm your password.'
            ),
             'equaltofield' => array(
                'rule' => array('equaltofield', 'password'),
                'message' => 'Both passwords must match.'
            )
        ),
        'password_update' => array(
            'min_length' => array(
                'rule' => array('minLength', '6'),
                'message' => 'Password must have a mimimum of 6 characters',
                'allowEmpty' => true,
                'required' => false
            )
        ),
        'password_confirm_update' => array(
             'equaltofield' => array(
                'rule' => array('equaltofield','password_update'),
                'message' => 'Both passwords must match.',
                'required' => false,
            )
        )
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
