<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\UserPersonalInfo;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\base\Controller;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    // /**
    //  * {@inheritdoc}
    //  */
    // public function behaviors()
    // {
    //     return [
    //         'access' => [
    //             'class' => AccessControl::className(),
    //             'rules' => [
    //                 [
    //                     'allow' => true,
    //                     'actions' => ['index', 'view', 'edit-max-active-users'],
    //                     'roles' => ['manageUser'],
    //                 ],
    //                 [
    //                     'allow' => true,
    //                     'actions' => ['create'],
    //                     'roles' => ['createUser'],
    //                 ],
    //                 [
    //                     'allow' => true,
    //                     'actions' => ['update'],
    //                     'roles' => ['editUser'],
    //                 ],
    //                 [
    //                     'allow' => true,
    //                     'actions' => ['profile'],
    //                     'roles' => ['@'],
    //                 ],
    //             ],
    //         ],
    //     ];
    // }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionSignUp()
    {
        $this->layout = 'sign-up';

        $model = new UserPersonalInfo();

        if (Yii::$app->request->post()) {
            if ($model->load(Yii::$app->request->post())) {
                if (Yii::$app->request->post('User[password]') === Yii::$app->request->post('User[confirm_password]')) {
                    $user_model = new User();
                    $user_model->username = $model->email;
                    $user_model->password =
                        Yii::$app->getSecurity()->generatePasswordHash(Yii::$app->request->post('User[password]'));
                    $user_model->role = 'student';
                    $user_model->reg_date = date("Y-m-d H:i:s");
                    $user_model->active_status = 1;
                    
                    if ($user_model->save()) {
                        $model->user_id = $user_model->id;
                        if ($model->save()) {
                            return $this->redirect(['']);
                        }
                    } else {
                        // echo '<pre>' . var_export($user_model, true) . '</pre>';
                        echo "Error while using user_personal_info model";
                    }
                } else {
                    echo "Passwords are not equal!";
                }
            } else {
                echo '<pre>' . var_export($model, true) . '</pre>'; die();
            }
        }

        return $this->render('sign-up', [
            'model' => $model,
        ]);
    }

    public function actionProfile()
    {
        $model = $this->findModel(Yii::$app->user->id);

        if ($model->load(Yii::$app->request->post())) {
            if (!empty($model->new_password) && $model->new_password == $model->renew_password) {
                $model->password = $model->generatePassword($model->new_password);
            }
            if ($model->save()) {
                // Logs::create("Пользователи", "Изменил пользователя: " . $model->username);
                //                Yii::$app->session->setFlash('success', 'Запись сохранена!');
                return $this->redirect(['/profile']);
            }
        }

        return $this->render('profile', [
            'model' => $model,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();
        $model->scenario = 'create';
        $model->delete_status = 0;
        if ($model->load(Yii::$app->request->post())) {
            $model->authKey = $model->generateAuthKey();
            $model->accessToken = $model->generateAccessToken();
            $model->reg_date = date("Y-m-d H:i:s");
            $model->password = $model->generatePassword($model->password);

            if ($model->save()) {
                $model->setRoles();
                // Logs::create("Пользователи", "Добавил новый пользователь: " . $model->username);
                Yii::$app->session->setFlash('success', 'Запись сохранена!');
                return $this->redirect(['index']);
            }
            // echo '<pre>' . var_export($model, true) . '</pre>';die();
        }

        return $this->render('create', [
            'model' => $model
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
            if (!empty($model->new_password) && $model->new_password == $model->renew_password) {
                $model->password = $model->generatePassword($model->new_password);
            }
            if ($model->save()) {
                $model->setRoles();
                // Logs::create("Пользователи", "Изменил пользователя: " . $model->username);
                Yii::$app->session->setFlash('success', 'Запись сохранена!');
                return $this->redirect(['index']);
            }
        }
        return $this->render('update', [
            'model' => $model,
            'active_disable' => $active_disable,
        ]);
    }
}
