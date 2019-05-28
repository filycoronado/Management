<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "policy_type".
 *
 * @property int $id
 * @property string $name
 * @property string $ico_class
 */
class PolicyType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'policy_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'ico_class'], 'required'],
            [['ico_class'], 'string'],
            [['name'], 'string', 'max' => 32],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'ico_class' => 'Ico Class',
        ];
    }
}
