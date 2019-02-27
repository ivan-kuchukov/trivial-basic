<?php

namespace app\models;
use trivial\controllers\App;

/**
 * Model for User
 *
 * @author Ivan Kuchukov <ivan.kuchukov@gmail.com>
 */
class User {

    public function getList(int &$start, $size=10, int $count) {
        $start=($count && $start>$count) ? $count : $start;
        $start=floor(($start-1)/$size)*$size+1;
        return App::db()->exec(
            'SELECT login FROM users LIMIT :start,:size',
            ['start'=>[$start-1,'i'],'size'=>[$size,'i']])->getAll();
    }

    public function getCount() {
        return App::db()->exec('SELECT count(*) FROM users')->getScalar();
    }

}
