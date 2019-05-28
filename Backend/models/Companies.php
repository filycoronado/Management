<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "companyes".
 *
 * @property int $id
 * @property string $nombre
 * @property int $agency
 * @property double $comision
 * @property int $agcode
 * @property double $loss
 * @property string $ImageRoute
 * @property int $NextPaymentPeriod
 * @property int $SecondaryNextPaymentPeriod
 * @property int $Type
 * @property int $active
 */
class Companies extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'companyes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'ImageRoute'], 'string'],
            [['agency', 'agcode', 'NextPaymentPeriod', 'SecondaryNextPaymentPeriod', 'Type', 'active'], 'integer'],
            [['comision', 'agcode', 'loss', 'ImageRoute', 'NextPaymentPeriod', 'SecondaryNextPaymentPeriod', 'Type'], 'required'],
            [['comision', 'loss'], 'number'],
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
            'comision' => 'Comision',
            'agcode' => 'Agcode',
            'loss' => 'Loss',
            'ImageRoute' => 'Image Route',
            'NextPaymentPeriod' => 'Next Payment Period',
            'SecondaryNextPaymentPeriod' => 'Secondary Next Payment Period',
            'Type' => 'Type',
            'active' => 'Active',
        ];
    }
}
