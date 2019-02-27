<?php

namespace app\controllers;
use trivial\controllers\Controller;
use app\models\User;

/**
 * AdminController
 *
 * @author Ivan Kuchukov <ivan.kuchukov@gmail.com>
 */
class AdminController extends Controller {
    
    public function index() {
        $this->actionHome();
    }

    public function actionHome() {
        $this->render("adminHome");
    }
    
    public function actionReport() {
        $start = (int)filter_input(INPUT_GET, 'start', FILTER_SANITIZE_SPECIAL_CHARS) ?: 1;
        $size = (int)filter_input(INPUT_GET, 'size', FILTER_SANITIZE_SPECIAL_CHARS) ?: 10;
        $user = new User();
        $userCount = $user->getCount();
        $this->render( "adminReport", [
            'report'=>$user->getList($start,$size,$userCount),
            'pagination'=>['count'=>$userCount,'start'=>$start,'size'=>$size]
        ] );
    }

}
