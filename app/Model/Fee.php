<?php
App::uses('AppModel', 'Model');
/**
 * Fee Model
 *
 * @property Fee $Fee
 */
class Fee extends AppModel {

    const FEE_TYPE_BAKKIN = 1;
    const FEE_TYPE_DAILY = 2;
    const FEE_TYPE_BONUS = 3;
    const FEE_TYPE_REWARD = 4;

    const PENALTY_FEE = 1;
    const BAKKIN_LATE_FEE = 2;
    const BAKKIN_MISS_FEE = 3;
    const BAKKIN_ABSENCE_FEE = 4;

    public static $bakkin_list = array(
        self::BAKKIN_LATE_FEE => "遅刻",
        self::BAKKIN_MISS_FEE => "当欠",
        self::BAKKIN_ABSENCE_FEE => "無欠",
    );
    public static $bakkin = array(self::BAKKIN_LATE_FEE, self::BAKKIN_MISS_FEE, self::BAKKIN_ABSENCE_FEE);
    public static $penalty = array(self::PENALTY_FEE);
/**
 * Use table
 *
 * @var mixed False or table name
 */
    public $useTable = 'fee';

/**
 * Display field
 *
 * @var string
 */
    public $displayField = 'name';

/**
 * Validation rules
 *
 * @var array
 */

    public $validate = array(
        'shop_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            ),
        ),
        'fee_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            ),
        ),
        'name' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
            ),
        ),
        'created_at' => array(
            'datetime' => array(
                'rule' => array('datetime'),
            ),
        ),
        'updated_at' => array(
            'datetime' => array(
                'rule' => array('datetime'),
            ),
        ),
    );

}
