<?php
namespace app\rbac;
 
use Yii;
use yii\rbac\Rule;
use app\models\User;
 
class UserGroupRule extends Rule
{
    public $name = 'userGroup';
 
    public function execute($user, $item, $params)
    {
        if (!\Yii::$app->user->isGuest) {
            
            $role = \Yii::$app->user->identity->role;
            
            if ($item->name === 'admin') {
                return $role == User::ROLE_ADMIN;
            } elseif ($item->name === 'USER') {
                return $role == User::ROLE_ADMIN || $role == User::ROLE_USER;
            }
        }
        return true;
    }
}