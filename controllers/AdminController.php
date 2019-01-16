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
        $user = new User();
        $this->render( "adminReport", ['report'=>$user->getList()] );
    }
    
}
