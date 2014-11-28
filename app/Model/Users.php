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
            'notEmpty' => array(
                'rule' => array('notEmpty'),
            ),
        ),
        'password' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
            ),
        ),
    );

}
