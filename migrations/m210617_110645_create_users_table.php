<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 */
class m210617_110645_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%users}}', [
            'id' => $this->primaryKey(),
            'insurance_number' => $this->string(255)->notNull()->unique(),
            'password' => $this->string(255)->notNull(),
            'full_name' => $this->string(255)->notNull(),
            'role' => "ENUM('admin', 'doctor', 'patient') NOT NULL",
            'patient_id' => $this->integer()->null(),
            'access_token' => $this->string(255)->null(),
            'created_at' => "TIMESTAMP NOT NULL default CURRENT_TIMESTAMP",
            'updated_at' => "TIMESTAMP NOT NULL default CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP",
        ], 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB');

        $this->createIndex('users_patient_id', 'users', 'patient_id');
        $this->addForeignKey('fk_users_patient_id', 'users', 'patient_id', 'patients_data', 'id');

        $this->insert('users', [
            'email' => 'admin@test.com',
            'full_name' => 'Admin Adminov',
            'password' => Yii::$app->security->generatePasswordHash('123456'),
            'role' => 'admin'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%users}}');
    }
}
