<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "customers".
 *
 * @property int $id
 * @property int $id_usuario
 * @property string $nombre
 * @property string $apellido
 * @property string $fechaalta
 * @property int $agencia
 * @property string $tel
 * @property string $mail
 * @property string $addemail
 * @property string $addphone
 * @property string $homephone
 * @property string $workphone
 * @property int $status
 * @property string $city
 * @property string $zipcode
 * @property string $address
 * @property string $dob
 * @property int $languajePrefernce
 * @property string $id_user_update
 * @property string $date_update
 */
class Customers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_usuario', 'nombre', 'apellido', 'fechaalta', 'agencia', 'tel', 'mail', 'addemail', 'addphone', 'status', 'city', 'address', 'dob', 'id_user_update', 'date_update'], 'required'],
            [['id_usuario', 'agencia', 'status', 'languajePrefernce'], 'integer'],
            [['nombre', 'apellido', 'tel', 'mail', 'addemail', 'addphone', 'homephone', 'workphone'], 'string'],
            [['fechaalta', 'dob', 'date_update'], 'safe'],
            [['city', 'address'], 'string', 'max' => 40],
            [['zipcode'], 'string', 'max' => 16],
            [['id_user_update'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_usuario' => 'Id Usuario',
            'nombre' => 'Nombre',
            'apellido' => 'Apellido',
            'fechaalta' => 'Fechaalta',
            'agencia' => 'Agencia',
            'tel' => 'Tel',
            'mail' => 'Mail',
            'addemail' => 'Addemail',
            'addphone' => 'Addphone',
            'homephone' => 'Homephone',
            'workphone' => 'Workphone',
            'status' => 'Status',
            'city' => 'City',
            'zipcode' => 'Zipcode',
            'address' => 'Address',
            'dob' => 'Dob',
            'languajePrefernce' => 'Languaje Prefernce',
            'id_user_update' => 'Id User Update',
            'date_update' => 'Date Update',
        ];
    }
}
