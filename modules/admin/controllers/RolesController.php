<?php

namespace app\modules\admin\controllers;

use yii\web\Controller;
use app\modules\admin\models\AuthAssignment;
use app\modules\admin\models\AuthItem;
use app\modules\admin\models\AuthItemChild;
use app\modules\admin\models\AuthRule;

/**
 * Default controller for the `Admin` module
 */
class RolesController extends Controller
{

    public $layout = 'default';
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $auth_item_items = AuthItem::find()->all();

        return $this->render('index', [
            'auth_item_items' => $auth_item_items
        ]);
    }
}
