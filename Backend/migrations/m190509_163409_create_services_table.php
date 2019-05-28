<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%services}}`.
 */
class m190509_163409_create_services_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%services}}', [
            'id' => $this->primaryKey(),
            'promosion'=>$this->integer(),
            'type'=>$this->integer(),
            'type_member'=>$this->integer(), 
            'create_date'=>$this->date(),
            'start_date'=>$this->date(),
            'finish_date'=>$this->date(),
            'active'=>$this->boolean(),
            'customer_id'=>$this->integer(),
            'usuario_id'=>$this->integer(),
    

        ]);


        $this->addForeignKey(
            'fk-service-customer-id',
            'services',
            'customer_id',
            'customers',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-service-usuario-id',
            'services',
            'usuario_id',
            'usuarios',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%services}}');
    }
}
