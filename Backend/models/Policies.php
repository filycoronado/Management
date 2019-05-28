<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "policies".
 *
 * @property int $Id
 * @property int $id_cliente
 * @property string $date_alta
 * @property int $pago_mensual
 * @property int $policy_type
 * @property int $dealer_id
 * @property int $company_id
 * @property string $policynumber
 * @property string $adc_number
 * @property int $status_policy
 * @property string $fech_mod_status
 * @property string $date_cancellation
 * @property string $date_expiration
 * @property string $date_effective
 * @property int $pago_menusal_drviers
 * @property int $location
 * @property int $id_user
 * @property string $CancelForPending
 * @property string $DateModifyDaysP
 * @property int $CountPendingDays
 * @property string $date_exp_adc
 * @property int $aplication
 * @property int $phoneNumber
 * @property int $driverLicense
 * @property int $registration
 * @property int $pictures
 * @property int $proofop
 * @property int $adcsinged
 * @property int $languajePrefernce
 * @property int $bank_info
 * @property int $email_info
 * @property string $id_user_update
 * @property string $date_update
 */
class Policies extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'policies';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_cliente', 'date_alta', 'pago_mensual', 'policy_type', 'dealer_id', 'company_id', 'policynumber', 'status_policy', 'fech_mod_status', 'date_cancellation', 'date_expiration', 'date_effective', 'pago_menusal_drviers', 'location', 'id_user', 'CancelForPending', 'DateModifyDaysP', 'CountPendingDays', 'driverLicense', 'id_user_update', 'date_update'], 'required'],
            [['id_cliente', 'pago_mensual', 'policy_type', 'dealer_id', 'company_id', 'status_policy', 'pago_menusal_drviers', 'location', 'id_user', 'CountPendingDays', 'aplication', 'phoneNumber', 'driverLicense', 'registration', 'pictures', 'proofop', 'adcsinged', 'languajePrefernce', 'bank_info', 'email_info'], 'integer'],
            [['date_alta', 'fech_mod_status', 'date_cancellation', 'date_expiration', 'date_effective', 'CancelForPending', 'DateModifyDaysP', 'date_exp_adc', 'date_update'], 'safe'],
            [['policynumber', 'adc_number'], 'string'],
            [['id_user_update'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'id_cliente' => 'Id Cliente',
            'date_alta' => 'Date Alta',
            'pago_mensual' => 'Pago Mensual',
            'policy_type' => 'Policy Type',
            'dealer_id' => 'Dealer ID',
            'company_id' => 'Company ID',
            'policynumber' => 'Policynumber',
            'adc_number' => 'Adc Number',
            'status_policy' => 'Status Policy',
            'fech_mod_status' => 'Fech Mod Status',
            'date_cancellation' => 'Date Cancellation',
            'date_expiration' => 'Date Expiration',
            'date_effective' => 'Date Effective',
            'pago_menusal_drviers' => 'Pago Menusal Drviers',
            'location' => 'Location',
            'id_user' => 'Id User',
            'CancelForPending' => 'Cancel For Pending',
            'DateModifyDaysP' => 'Date Modify Days P',
            'CountPendingDays' => 'Count Pending Days',
            'date_exp_adc' => 'Date Exp Adc',
            'aplication' => 'Aplication',
            'phoneNumber' => 'Phone Number',
            'driverLicense' => 'Driver License',
            'registration' => 'Registration',
            'pictures' => 'Pictures',
            'proofop' => 'Proofop',
            'adcsinged' => 'Adcsinged',
            'languajePrefernce' => 'Languaje Prefernce',
            'bank_info' => 'Bank Info',
            'email_info' => 'Email Info',
            'id_user_update' => 'Id User Update',
            'date_update' => 'Date Update',
        ];
    }
}
