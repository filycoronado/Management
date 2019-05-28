<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $user
 * @property string $pass
 * @property string $auth_key
 * @property string $name
 * @property string $apellido
 * @property string $dob
 * @property string $address
 * @property string $license_number
 * @property string $phone
 * @property string $email
 * @property string $general_profile
 * @property string $date_login
 * @property string $fecAlta
 * @property string $ip_address
 * @property string $email_date
 * @property string $pass_status
 * @property int $admin_users
 * @property int $finance
 * @property int $policy
 * @property int $isReseller
 * @property int $nivel
 * @property int $can_delete
 * @property int $active
 * @property string $agent_number
 * @property string $date_birth
 * @property int $habilitado
 * @property int $deleted
 * @property int $id_agente
 * @property int $agencia
 * @property string $NameAgency
 * @property int $agcode
 * @property int $id_horario
 * @property int $isCashier
 * @property int $isloggedClock
 * @property string $acesstoekn
 * @property string $photoimage
 * @property string $note_profile
 * @property int $created_at
 * @property int $updated_at
 * @property string $state
 * @property string $city
 * @property string $zipcode
 *
 * @property Clients[] $clients
 */
class Agents extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dob', 'fecAlta', 'date_birth'], 'safe'],
            [['address', 'license_number', 'general_profile', 'NameAgency', 'photoimage', 'note_profile'], 'string'],
            [['fecAlta', 'agent_number', 'agcode', 'state', 'city', 'zipcode'], 'required'],
            [['admin_users', 'finance', 'policy', 'isReseller', 'nivel', 'can_delete', 'active', 'habilitado', 'deleted', 'id_agente', 'agencia', 'agcode', 'id_horario', 'isCashier', 'isloggedClock', 'created_at', 'updated_at'], 'integer'],
            [['user', 'pass', 'name', 'apellido', 'phone', 'email', 'date_login', 'ip_address', 'email_date', 'pass_status', 'agent_number'], 'string', 'max' => 50],
            [['auth_key'], 'string', 'max' => 32],
            [['acesstoekn'], 'string', 'max' => 80],
            [['state', 'city'], 'string', 'max' => 25],
            [['zipcode'], 'string', 'max' => 15],
            [['user'], 'unique'],
            [['email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user' => 'User',
            'pass' => 'Pass',
            'auth_key' => 'Auth Key',
            'name' => 'Name',
            'apellido' => 'Apellido',
            'dob' => 'Dob',
            'address' => 'Address',
            'license_number' => 'License Number',
            'phone' => 'Phone',
            'email' => 'Email',
            'general_profile' => 'General Profile',
            'date_login' => 'Date Login',
            'fecAlta' => 'Fec Alta',
            'ip_address' => 'Ip Address',
            'email_date' => 'Email Date',
            'pass_status' => 'Pass Status',
            'admin_users' => 'Admin Users',
            'finance' => 'Finance',
            'policy' => 'Policy',
            'isReseller' => 'Is Reseller',
            'nivel' => 'Nivel',
            'can_delete' => 'Can Delete',
            'active' => 'Active',
            'agent_number' => 'Agent Number',
            'date_birth' => 'Date Birth',
            'habilitado' => 'Habilitado',
            'deleted' => 'Deleted',
            'id_agente' => 'Id Agente',
            'agencia' => 'Agencia',
            'NameAgency' => 'Name Agency',
            'agcode' => 'Agcode',
            'id_horario' => 'Id Horario',
            'isCashier' => 'Is Cashier',
            'isloggedClock' => 'Islogged Clock',
            'acesstoekn' => 'Acesstoekn',
            'photoimage' => 'Photoimage',
            'note_profile' => 'Note Profile',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'state' => 'State',
            'city' => 'City',
            'zipcode' => 'Zipcode',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClients()
    {
        return $this->hasMany(Clients::className(), ['id_users' => 'user']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomers(){
        return $this->hasMany(Customers::className(), ['id_usuario' => 'customers']);
    }
}
