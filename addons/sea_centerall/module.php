<?php
defined('IN_IA') or exit('Access Denied');

class Sea_centerallModule extends WeModule {

    public function fieldsFormDisplay($rid = 0) {
    }

    public function fieldsFormSubmit($rid = 0) {
    }

    public function settingsDisplay($settings) {
        include $this->template('setting');
    }
}