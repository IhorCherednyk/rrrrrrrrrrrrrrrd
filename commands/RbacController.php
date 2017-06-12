<?php

namespace app\commands;
use Yii;
use yii\console\Controller;
use \app\rbac\UserGroupRule;

class RbacController extends Controller{
    
    public function actionInit() {
        $authManager = \Yii::$app->authManager;
        // Create roles
        $user = $authManager->createRole('USER');
        $admin = $authManager->createRole('admin');

        // Create simple, based on action{$NAME} permissions
        $login = $authManager->createPermission('login');
        $logout = $authManager->createPermission('logout');


        // Add permissions in Yii::$app->authManager
        $authManager->add($login);
        $authManager->add($logout);

        // Add rule, based on UserExt->group === $user->group
        $userGroupRule = new UserGroupRule();
        $authManager->add($userGroupRule);

        // Add rule "UserGroupRule" in roles
//        $guest->ruleName = $userGroupRule->name;
        $user->ruleName = $userGroupRule->name;
        $admin->ruleName = $userGroupRule->name;

        // Add roles in Yii::$app->authManager
        $authManager->add($user);
        $authManager->add($admin);
        
        // Add permission-per-role in Yii::$app->authManager
        
        // Guest
        $authManager->addChild($user, $login);
        $authManager->addChild($user, $logout);
        
        //User
        $authManager->addChild($admin, $user);
        


    }

}
