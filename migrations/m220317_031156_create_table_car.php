<?php

use yii\db\Migration;

/**
 * Class m220317_031156_create_table_car
 */
class m220317_031156_create_table_car extends Migration
{


    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%car}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'vin' => $this->string()->notNull(),
            'type' => $this->integer()->notNull(),
            'miles' => $this->integer(),
            'in_date' => $this->date()->notNull(),
            'out_date' => $this->date(),
            'sold' => $this->boolean(),
            'cost' => $this->double(),
            'sell' => $this->double(),
        ]);

        $this->alterColumn('{{%car}}', 'id', $this->smallInteger(8) . ' NOT NULL AUTO_INCREMENT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%car}}');
    }
    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220317_031156_create_table_car cannot be reverted.\n";

        return false;
    }
    */
}
