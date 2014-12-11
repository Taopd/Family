<?php
App::uses('AppModel', 'Model');
/**
 * Shop Model
 *
 * @property Bill $Bill
 * @property Girl $Girl
 * @property Item $Item
 * @property Member $Member
 * @property TableGirl $TableGirl
 * @property TableItem $TableItem
 * @property TableMember $TableMember
 * @property TableSelection $TableSelection
 * @property Table $Table
 */
class Users extends AppModel {
    const SHOP = 0;
    const MANAGER = 1;
    const ADMIN = 2;
/**
 * Use table
 *
 * @var mixed False or table name
 */
    public $useTable = 'user';

/**
 * Validation rules
 *
 * @var array
 */
    public $validate = array(
        'username' => array(
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
        'email' => array(
            'nonEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Email is required.',
                'allowEmpty' => false
            ),
            'unique' => array(
                'rule' => array('isUniqueEmail'),
                'message' => 'This Email is already in use.'
            )
        ),
        'name' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
            ),
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
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A password is required.'
            ),
            'min_length' => array(
                'rule' => array('minLength', '6'),
                'message' => 'Password must have a mimimum of 6 characters.'
            )
        ),
        'password_confirm_update' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Please confirm your password.'
            ),
             'equaltofield' => array(
                'rule' => array('equaltofield', 'password_update'),
                'message' => 'Both passwords must match.'
            )
        )
    );

    public function alphaNumericDashUnderscore($check) {
        // $data array is passed using the form field name as the key
        // have to extract the value to make the function generic
        $value = array_values($check);
        $value = $value[0];

        return preg_match('/^[a-zA-Z0-9_ \-]*$/', $value);
    }


    function isUniqueUsername($check) {

        $username = $this->find(
            'first',
            array(
                'fields' => array(
                    'Users.id',
                    'Users.username'
                ),
                'conditions' => array(
                    'Users.username' => $check['username']
                )
            )
        );
        if (!empty($username)) {
            if (isset($this->data[$this->alias]['id']) && ($this->data[$this->alias]['id'] == $username['Users']['id'])) {
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
                    'Users.id',
                    'Users.email'
                ),
                'conditions' => array(
                    'Users.email' => $check['email']
                )
            )
        );
        if (!empty($email)) {
            if (isset($this->data[$this->alias]['id']) && ($this->data[$this->alias]['id'] == $email['Users']['id'])) {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
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

    public function findByCondition($condition) {
        $shopConditions = array();
        foreach ($condition as $k => $v) {
            $shopConditions['Users.' . $k] = $v;
        }
        $user = $this->find('first', array(
            'conditions' => $shopConditions
        ));
        if (empty($user)) {
            return false;
        }        
        return $user;
    }


}
