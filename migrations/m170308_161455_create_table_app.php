<?php

use yii\db\Migration;

class m170308_161455_create_table_app extends Migration
{
    public function up()
    {

        $this->createTable('{{%app}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
            'description' => $this->string(),
            'client_id' => $this->string()->unique(),
            'client_secret' => $this->string()->unique(),

            'grant_types' => $this->string(),
            'response_types' => $this->string(),
            'subject_type' => $this->string(),
            'application_type' => $this->string(),
            'registration_client_uri' => $this->string(),
            'redirect_uris' => $this->string()->notNull()->unique(),
            'registration_access_token' => $this->string(),
            'token_endpoint_auth_method' => $this->string(),
            'client_secret_expires_at' => $this->integer(),
            'client_id_issued_at' => $this->integer(),
            'id_token_signed_response_alg' => $this->string(),
            'created_at' => $this->integer(),
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
