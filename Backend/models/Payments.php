<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "payments".
 *
 * @property int $id
 * @property int $agency
 * @property double $amountpoc
 * @property string $comment
 * @property string $policynumber
 * @property int $company
 * @property int $companytype
 * @property int $dealership
 * @property int $dealertype
 * @property string $fecha
 * @property double $feecompany
 * @property double $feedealer
 * @property double $feeforaz
 * @property double $feeoffice
 * @property int $id_usuario
 * @property int $id_cashier
 * @property string $nameclient
 * @property string $nameentrega
 * @property string $namevendedor
 * @property int $officetype
 * @property int $poc
 * @property int $typeaz
 * @property int $typeDO
 * @property double $total
 * @property double $valponchon
 * @property string $recibo
 * @property int $Dpayment
 * @property int $DeliveryT
 * @property int $id_cliente
 * @property string $horat
 * @property int $agcode
 * @property int $credit
 * @property int $erase
 * @property int $id_policy
 * @property int $recivedcashConfirmation
 */
class Payments extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'payments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['agency', 'company', 'companytype', 'dealership', 'dealertype', 'id_usuario', 'id_cashier', 'officetype', 'poc', 'typeaz', 'typeDO', 'Dpayment', 'DeliveryT', 'id_cliente', 'agcode', 'credit', 'erase', 'id_policy', 'recivedcashConfirmation'], 'integer'],
            [['amountpoc', 'feecompany', 'feedealer', 'feeforaz', 'feeoffice', 'total', 'valponchon'], 'number'],
            [['comment', 'policynumber', 'nameclient', 'nameentrega', 'namevendedor', 'recibo', 'horat'], 'string'],
            [['fecha'], 'safe'],
            [['Dpayment', 'DeliveryT', 'id_cliente', 'horat', 'agcode', 'erase'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'agency' => 'Agency',
            'amountpoc' => 'Amountpoc',
            'comment' => 'Comment',
            'policynumber' => 'Policynumber',
            'company' => 'Company',
            'companytype' => 'Companytype',
            'dealership' => 'Dealership',
            'dealertype' => 'Dealertype',
            'fecha' => 'Fecha',
            'feecompany' => 'Feecompany',
            'feedealer' => 'Feedealer',
            'feeforaz' => 'Feeforaz',
            'feeoffice' => 'Feeoffice',
            'id_usuario' => 'Id Usuario',
            'id_cashier' => 'Id Cashier',
            'nameclient' => 'Nameclient',
            'nameentrega' => 'Nameentrega',
            'namevendedor' => 'Namevendedor',
            'officetype' => 'Officetype',
            'poc' => 'Poc',
            'typeaz' => 'Typeaz',
            'typeDO' => 'Type Do',
            'total' => 'Total',
            'valponchon' => 'Valponchon',
            'recibo' => 'Recibo',
            'Dpayment' => 'Dpayment',
            'DeliveryT' => 'Delivery T',
            'id_cliente' => 'Id Cliente',
            'horat' => 'Horat',
            'agcode' => 'Agcode',
            'credit' => 'Credit',
            'erase' => 'Erase',
            'id_policy' => 'Id Policy',
            'recivedcashConfirmation' => 'Recivedcash Confirmation',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPolicies() {
        return $this->hasOne(Policies::className(), ['Id' => 'id_policy']);
    }


}
