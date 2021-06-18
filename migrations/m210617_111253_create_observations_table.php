<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%observations}}`.
 */
class m210617_111253_create_observations_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%observations}}', [
            'id' => $this->primaryKey(),
            'doctor_id' => $this->integer()->notNull(),
            'patient_id' => $this->integer()->notNull(),
            'start_date' => $this->date()->notNull(),
            'end_date' => $this->date()->null(),
            'result' => $this->text()->null(),
            'created_at' => "TIMESTAMP NOT NULL default CURRENT_TIMESTAMP",
            'updated_at' => "TIMESTAMP NOT NULL default CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP",
        ], 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB');

        $this->createIndex('observations_doctor_id', 'observations', 'doctor_id');
        $this->createIndex('observations_patient_id', 'observations', 'patient_id');

        $this->addForeignKey('fk_observations_doctor_id', 'observations', 'doctor_id', 'users', 'id');
        $this->addForeignKey('fk_observations_patient_id', 'observations', 'patient_id', 'users', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%observations}}');
    }
}
