<?php

use yii\db\Migration;
use common\models\FruitStatus;

/**
 * Handles the creation of table `{{%apples}}`.
 */
class m210201_181631_create_apples_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%apples}}', [
            'id' => $this->primaryKey(),
            'color' => $this->tinyInteger(2),
            'status' => $this->tinyInteger(1)->defaultValue(FruitStatus::ON_TREE),
            'size' => $this->tinyInteger(3)->defaultValue(FruitStatus::DEFAULT_SIZE),
            'created_at' => $this->integer(),
            'fell_at' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%apples}}');
    }
}
