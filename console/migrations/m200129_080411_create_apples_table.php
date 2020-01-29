<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%apples}}`.
 */
class m200129_080411_create_apples_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%apples}}', [
            'id' => $this->primaryKey(),
            'color' => $this->string()->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(0),
            'size' => $this->double()->notNull()->defaultValue(1.0),
            'created_at' => $this->integer()->notNull(),
            'fell_at' => $this->integer()->notNull(),
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
