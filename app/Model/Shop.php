<?php

class Shop extends AppModel {

    public $useTable = 'shop';

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
                'rule' => array('notEmpty'),
                'message' => 'Email is required.'
            ),
            'email' => array(
                'rule' => 'email',
                'message' => 'Please input correct email.'
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
    );

    /**
     * Before isUniqueUsername
     * @param array $options
     * @return boolean
     */
    function isUniqueUsername($check) {

        $shop = $this->find(
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
        if (!empty($shop)) {
            if (isset($this->data[$this->alias]['id']) && ($this->data[$this->alias]['id'] == $shop['Shop']['id'])) {
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

    /**
     * Before Save
     * @param array $options
     * @return boolean
     */
     public function beforeSave($options = array()) {
        // hash our password
        if (isset($this->data[$this->alias]['password'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
        }

        // if we get a new password, hash it
        if (isset($this->data[$this->alias]['password_update']) && !empty($this->data[$this->alias]['password_update'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password_update']);
        }

        // fallback to our parent
        return parent::beforeSave($options);
    }
}