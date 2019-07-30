<?php

use yii\db\Migration;
use common\models\User;

/**
 * Class m190729_144048_create_rbac_data
 */
class m190729_144048_create_rbac_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        /**
         * Добавление разрешений
         */

        $refreshAtmDevicesListPermission = $auth->createPermission('refreshAtmDevicesList');
        $auth->add($refreshAtmDevicesListPermission);

        $deleteAtmDevicesPermission = $auth->createPermission('deleteAtmDevices');
        $auth->add($deleteAtmDevicesPermission);

        $editAtmDevicesPermission = $auth->createPermission('editAtmDevices');
        $auth->add($editAtmDevicesPermission);

        $viewAtmDevicesPermission = $auth->createPermission('viewAtmDevices');
        $auth->add($viewAtmDevicesPermission);

        /**
         * Добавление ролей
         */

        $moderatorRole = $auth->createRole('moderator');
        $auth->add($moderatorRole);

        $adminRole = $auth->createRole('admin');
        $auth->add($adminRole);

        $userRole = $auth->createRole('user');
        $auth->add($userRole);

        /**
         * Установка связей между ролями и разрешениями
         */

        $auth->addChild($moderatorRole, $editAtmDevicesPermission);
        $auth->addChild($moderatorRole, $deleteAtmDevicesPermission);

        /*$auth->addChild($adminRole, $moderatorRole);*/
        $auth->addChild($adminRole, $refreshAtmDevicesListPermission);

        $auth->addChild($userRole, $viewAtmDevicesPermission);

        /**
         * Создание пользователей
         */

        $admin = new User([
            'email' => 'admin@mail.com',
            'username' => 'admin',
            'password_hash' => Yii::$app->security->generatePasswordHash('1234567'),
            'status' => User::STATUS_ACTIVE,
        ]);
        $admin->generateAuthKey();
        $admin->save();


        $moderator = new User([
            'email' => 'moderator@mail.com',
            'username' => 'moderator',
            'password_hash' => Yii::$app->security->generatePasswordHash('1234567'),
            'status' => User::STATUS_ACTIVE,
        ]);
        $moderator->generateAuthKey();
        $moderator->save();

        $user = new User([
            'email' => 'user@mail.com',
            'username' => 'user',
            'password_hash' => Yii::$app->security->generatePasswordHash('1234567'),
            'status' => User::STATUS_ACTIVE,
        ]);
        $user->generateAuthKey();
        $user->save();

        /**
         * Добавление ролей пользователям
         */

        $auth->assign($adminRole, $admin->getId());
        $auth->assign($moderatorRole, $moderator->getId());
        $auth->assign($userRole, $user->getId());


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190729_144048_create_rbac_data cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190729_144048_create_rbac_data cannot be reverted.\n";

        return false;
    }
    */
}
