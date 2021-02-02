<?php

use common\models\User;
use yii\db\Migration;

/**
 * Class m210201_175104_add_user
 */
class m210201_175104_add_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $user = new User();
        $user->username = 'user_test';
        $user->email = 'user@gmail.com';
        $user->status = User::STATUS_ACTIVE;
        $user->setPassword('user123456');
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        return $user->save();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210201_175104_add_user cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210201_175104_add_user cannot be reverted.\n";

        return false;
    }
    */
}
