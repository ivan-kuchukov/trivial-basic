<?php

namespace app\fixtures;
use trivial\controllers\App;

/**
 * Fixture
 *
 * @author Ivan Kuchukov <ivan.kuchukov@gmail.com>
 */
class fixtureUsers {
    
    public function load() {
        $users = '';
        for ($i=1;$i<=50;$i++) {
            $users .= (empty($users) ? "" : ",") . "('user${i}')";
        }
        App::db()->exec("INSERT INTO users (login) VALUES ${users}");
        return true;
    }
    
    public function clear() {
        App::db()->exec("DELETE FROM users");
        return true;
    }
}
