<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\mssql\PDO;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $active_status
 * @property string $delete_status
 * @property string $role
 * @property string $reg_date
 * @property string $last_visit
 * @property string $last_visit_system
 * @property string $authKey
 * @property string $accessToken
 *
 * @property Roles $roles
 */

class User extends ActiveRecord implements IdentityInterface
{
    
    public $new_password;
    public $renew_password;

    private $active_status = [
        0 => 'Not active',
        1 => 'Active',
        2 => 'Need confirmation' //individual foreign through sms verification, individual citizen through one id
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role', 'username'], 'required'],
            [['password', 'renew_password'], 'required', 'on' => 'create'],
            [['active_status', 'delete_status'], 'integer'],
            [['role', 'reg_date','lastVisit', 'new_password', 'renew_password'], 'safe'],
            [['username'], 'string', 'max' => 30],
            [['password'], 'string', 'max' => 150],
            [['last_visit_system'], 'string', 'max' => 50],
            [['authKey', 'accessToken'], 'string', 'max' => 255],
            [['username'], 'unique', 'message' => 'Такой логин уже занят'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'active_status' => 'Актив',
            'delete_status' => 'Удалено',
            'role' => 'Роль',
            'username' => 'Пользователь',
            'password' => 'Пароль',
            'authKey' => 'Код авторизации',
            'accessToken' => 'Токен',
            'reg_date' => 'Дата регистрации',
            'last_visit' => 'Последний визит',
            'last_visit_system' => 'Система последного визита',
            'new_password' => 'Новый пароль',
            'renew_password' => 'Повторите пароль',
        ];
    }

    /**
     * Finds an identity by the given ID.
     * @param string|integer $id the ID to be looked for
     * @return IdentityInterface the identity object that matches the given ID.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentity($id)
    {
        // TODO: Implement findIdentity() method.
        return static::findOne($id);
    }

    /**
     * Finds an identity by the given token.
     * @param mixed $token the token to be looked for
     * @param mixed $type the type of the token. The value of this parameter depends on the implementation.
     * For example, [[\yii\filters\auth\HttpBearerAuth]] will set this parameter
     * to be `yii\filters\auth\HttpBearerAuth`.
     * @return IdentityInterface the identity object that matches the given token.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.
     * )
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        // TODO: Implement findIdentityByAccessToken() method.
        return static::findOne(['accessToken' => $token]);
    }

    /**
     * Finds user by username
     *
     * @param  string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'delete_status' => 0]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoles()
    {
        return $this->hasOne(Roles::className(), ['name' => 'role']);
    }

    public function generatePassword($password)
    {
        return Yii::$app->security->generatePasswordHash($password);
    }

    public function generateAuthKey()
    {
        return Yii::$app->security->generateRandomString();
    }

    public function generateAccessToken()
    {
        return Yii::$app->security->generateRandomString();
    }

    public function getName()
    {
        return $this->first_name . ' ' . $this->second_name;
    }

    public static function getList($role = [])
    {
        if (empty($role)) {
            return ArrayHelper::map(self::find()
                ->orderBy(['first_name' => SORT_ASC])
                ->asArray()->all(), 'id', function ($model) {
                    return $model['first_name'] . ' ' . $model['second_name'];
                });
        } else {
            $query = self::find()
                ->leftJoin('auth_assignment', '`auth_assignment`.`user_id` = `user`.`id`')
                ->where(['auth_assignment.item_name' => $role])
                ->orderBy(['user.first_name' => SORT_ASC])
                ->asArray();
           
            return ArrayHelper::map($query->all(), 'id', function ($model) {
                return $model['first_name'] . ' ' . $model['second_name'];
            });
        }
    }

    public function setRoles()
    {
        $auth = Yii::$app->authManager;
        Yii::$app->db->createCommand("delete from auth_assignment where user_id=:id")
            ->bindValue(":id", $this->id, PDO::PARAM_INT)
            ->execute();
        $roleModel = $auth->getRole($this->role);
        $auth->assign($roleModel, $this->id);
    }
    
    public static function getUniqueUsername()
    {
        
        $trial_username = self::generateRandomString();
        while (!self::checkUsernameForUnique($trial_username)) {
            $trial_username = self::generateRandomString();
        }
        return $trial_username;
    }

    public static function checkUsernameForUnique($username)
    {
        $user_object = self::findOne(['username' => $username]);
        if ($user_object == null) {
            return true;
        } else {
            return false;
        }
    }

    public static function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
