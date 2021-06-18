<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%observations_data}}`.
 */
class m210617_112609_create_observations_data_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%observations_data}}', [
            'id' => $this->primaryKey(),
            'observation_id' => $this->integer()->notNull(),
            'top_pressure' => $this->integer()->notNull(),
            'bottom_pressure' => $this->integer()->notNull(),
            'pulse' => $this->integer()->notNull(),
            'created_at' => "TIMESTAMP NOT NULL default CURRENT_TIMESTAMP",
            'updated_at' => "TIMESTAMP NOT NULL default CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP",
        ], 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB');

        $this->createIndex('observations_data_observation_id', 'observations_data', 'observation_id');

        $this->addForeignKey('fk_observations_data_observation_id', 'observations_data', 'observation_id', 'observations', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%observations_data}}');
    }
}
