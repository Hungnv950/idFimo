<?php

use yii\db\Migration;

class m170218_124906_create_table_app extends Migration
{
    public function up()
    {

        $this->createTable('{{%app}}', [
            'id' => $this->primaryKey(),
            'clientID' => $this->string()->notNull()->unique(),
            'clientSecret' => $this->string(32)->notNull()->unique(),
            'name' => $this->string()->notNull()->unique(),
            'description' => $this->string()->unique(),

            'created_at' => $this->integer()->notNull(),
        ]);

    }

    public function down()
    {
        $this->dropTable('{{%app}}');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
