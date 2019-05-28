<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%customer}}`.
 */
class m190509_161844_create_customer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%customers}}', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(),
            'last_name'=>$this->string(),
            'email'=>$this->string(),
            'phone'=>$this->string(),
            'code'=>$this->String(),
            'create_date'=>$this->date(),
            'birth_date'=>$this->date(),
            'active'=>$this->boolean(),
            'created_by'=>$this->integer(),
        ]);

              // add foreign key for table `user`
              $this->addForeignKey(
                'fk-customer-usurio-id',
                'customers',
                'created_by',
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
        $this->dropTable('{{%customers}}');
    }
}
