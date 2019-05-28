<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dealers".
 *
 * @property int $id
 * @property string $nombre
 * @property int $agency
 * @property string $password
 * @property string $latitud
 * @property string $long
 * @property int $habilitado
 * @property string $location
 */
class Dealers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dealers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre'], 'string'],
            [['agency', 'habilitado'], 'integer'],
            [['location'], 'required'],
            [['password'], 'string', 'max' => 25],
            [['latitud', 'long'], 'string', 'max' => 50],
            [['location'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'agency' => 'Agency',
            'password' => 'Password',
            'latitud' => 'Latitud',
            'long' => 'Long',
            'habilitado' => 'Habilitado',
            'location' => 'Location',
        ];
    }
}
