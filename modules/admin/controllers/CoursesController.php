<?php

namespace app\modules\admin\controllers;

use yii\web\Controller;

/**
 * Default controller for the `Admin` module
 */
class CoursesController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
