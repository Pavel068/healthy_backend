<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%patients_data}}`.
 */
class m210617_110355_create_patients_data_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%patients_data}}', [
            'id' => $this->integer(),
            'birthday' => $this->date()->notNull(),
            'height' => $this->integer()->notNull(),
            'weight' => $this->float()->notNull(),
            'extra' => $this->text()->null(),
            'created_at' => "TIMESTAMP NOT NULL default CURRENT_TIMESTAMP",
            'updated_at' => "TIMESTAMP NOT NULL default CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP",
        ], 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB');

        $this->addPrimaryKey('pk_patients_data', 'patients_data', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%patients_data}}');
    }
}
