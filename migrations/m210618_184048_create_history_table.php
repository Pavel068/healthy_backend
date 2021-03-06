<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%history}}`.
 */
class m210618_184048_create_history_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%history}}', [
            'id' => $this->primaryKey(),
            'observation_id' => $this->integer()->notNull(),
            'patient_id' => $this->integer()->notNull(),
            'drug' => $this->string(255),
            'drug_meta' => $this->string(255),
            'created_at' => "TIMESTAMP NOT NULL default CURRENT_TIMESTAMP",
            'updated_at' => "TIMESTAMP NOT NULL default CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP",
        ], 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB');

        $this->createIndex('history_observation_id', 'history', 'observation_id');
        $this->createIndex('history_patient_id', 'history', 'patient_id');

        $this->addForeignKey('fk_history_observation_id', 'history', 'observation_id', 'observations', 'id');
        $this->addForeignKey('fk_history_patient_id', 'history', 'patient_id', 'users', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%history}}');
    }
}
