<?php

namespace app\models;
use trivial\controllers\App;

/**
 * Model for User
 *
 * @author Ivan Kuchukov <ivan.kuchukov@gmail.com>
 */
class User {

    public function getList() {
        return App::db()->exec('SELECT login FROM users')->getAll();
    }
    
}
