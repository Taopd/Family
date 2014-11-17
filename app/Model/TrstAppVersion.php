<?php

App::uses('AuthComponent', 'Controller/Component');

class TrstAppVersion extends AppModel {

    public $useTable = 'trst_app_version';

    public function getLatestVersion() {
        $version = $this->find('first', array('order' => array('TrstAppVersion.id DESC')));
        if (empty($version)) {
            throw new CakeException('Version not found');
        }

        return $version['TrstAppVersion']['name'];
    }
}