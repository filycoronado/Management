<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%payments}}`.
 */
class m190509_164206_create_payments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%payments}}', [
            'id' => $this->primaryKey(),
            'payment'=>$this->double(),
            'paid'=>$this->double(),
            'promosion'=>$this->integer(),
            'type'=>$this->integer(),
            'type_member'=>$this->integer(), 
            'create_date'=>$this->date(),
            'active'=>$this->boolean(),
            'usuario_id'=>$this->integer(),
            'servicio_id'=>$this->integer(),
        ]);


        $this->addForeignKey(
            'fk-payments-service-id',
            'payments',
            'servicio_id',
            'services',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-payments-usuario-id',
            'payments',
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
        $this->dropTable('{{%payments}}');
    }
}
