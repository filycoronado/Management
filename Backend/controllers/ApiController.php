<?php

namespace app\controllers;

use app\models\Agents;
use app\models\Customers;
use app\models\Services;
use app\models\PolicyType;
use app\models\Companies;
use app\models\Dealers;
use app\models\Policies;
use app\models\Payments;
use yii;
use yii\app;
use yii\filters\AccessControl;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\ContentNegotiator;
use yii\rest\Controller;
use yii\web\Response;
use yii\base\Model;

class ApiController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::className(),
            'only' => ['Home'],
        ];
        $behaviors['contentNegotiator'] = [
            'class' => ContentNegotiator::className(),
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
            ],
        ];
        $behaviors['access'] = [
            'class' => AccessControl::className(),
            'only' => ['dashboard'],
            'rules' => [
                [
                    'actions' => ['dashboard'],
                    'allow' => true,
                    'roles' => ['@'],
                ],
            ],
        ];
        return $behaviors;
    }

    public function beforeAction($action) {

        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionGet_users() {
        return Usuarios::find()->where("active=1")->all();
    }

    public function actionSave_client() {
        $session = Yii::$app->session;
        $user_in_session = $session->get('user_login');
        $request = Yii::$app->request;
        $client = $request->post('client');
        $policy = $request->post('policy');
        $dealer = $request->post('dealer');
        $payment = $request->post('payment');

        $dob = date("Y-m-d", strtotime($client['birth_date']));
        //save Customer
        $customer = new Customers();
        $customer->nombre = $client['name'];
        $customer->address = $client['address'];
        $customer->dob = $dob;
        $customer->zipcode = $client['zipcode'];
        $customer->tel = $client['phone'];
        $customer->city = $client['city'];
        $customer->id_usuario = $user_in_session['id'];
        $customer->status = 1;
        $customer->languajePrefernce = $client['languaje'];
        $customer->agencia = $user_in_session['agencia'];
        $customer->fechaalta = date("Y-m-d");

        if ($customer->save(false)) {
            //policy information
            $policyE = new Policies();
            $policyE->id_cliente = $customer->id;
            $policyE->company_id = $policy['company'];
            $policyE->location = $policy['location'];
            $policyE->policy_type = $policy['type'];
            $policyE->policynumber = $policy['policy_number'];
            $policyE->status_policy = 10;
            $policyE->fech_mod_status = date("Y-m-d");
            $policyE->adc_number = $policy['adc_number'];
            $policyE->date_alta = date("Y-m-d");
            $policyE->id_user = $user_in_session['id'];

            if ($dealer['is_dealer'] == 1) {
                $policyE->dealer_id = $dealer['dealer'];
            }

            if ($policyE->save(false)) {
                $payments = new Payments();
                $payments->id_policy = $policyE->Id;
                $payments->agency = $user_in_session['agencia'];
                $payments->feecompany = $payment['ins_total'];
                $payments->feeforaz = $payment['adc_total'];
                $payments->feeoffice = $payment['office_total'];
                $payments->companytype = $payment['type_ins'];

                $payments->typeaz = $payment['type_adc'];
                $payments->fecha = date("Y-m-d");
                $payments->horat = date("H:i:s a");
                $payments->policynumber = $policy['policy_number'];
                $payments->company = $policy['company'];
                $payments->id_usuario = $user_in_session['id'];
                if ($dealer['is_dealer'] == 1) {
                    $payments->nameentrega = $dealer['delivery'];
                    $payments->namevendedor = $dealer['seller'];
                    $payments->DeliveryT = $dealer['typeDelivery'];
                    $payments->dealership = $dealer['dealer'];
                    $payments->typeDO = 1;
                    $payments->feedealer = $payment['dealer_total'];
                } else {
                    $payments->feedealer = 0;
                }
                $payments->typeDO = 2;
                $payments->Dpayment = $payment['status_transaction'];
                $payments->id_cashier = $payment['cashier'];
                $payments->total = $payments->feeforaz + $payments->feecompany + $payments->feeoffice + $payments->feedealer;
                $payments->nameclient = $customer->nombre;
                if ($payments->save(false)) {
                    return $response = [
                        "status" => "success",
                        "message" => "Completado",
                    ];
                }
            }
        }
    }

    public function actionSave_policy() {
        $session = Yii::$app->session;
        $user_in_session = $session->get('user_login');
        $request = Yii::$app->request;
        $id = $request->post('id');
        $policy = $request->post('policy');
        $dealer = $request->post('dealer');
        $payment = $request->post('payment');
        $customer = Customers::findOne($id);

        //policy information
        $policyE = new Policies();
        $policyE->id_cliente = $customer->id;
        $policyE->company_id = $policy['company'];
        $policyE->location = $policy['location'];
        $policyE->policy_type = $policy['type'];
        $policyE->policynumber = $policy['policy_number'];
        $policyE->status_policy = 10;
        $policyE->fech_mod_status = date("Y-m-d");
        $policyE->adc_number = $policy['adc_number'];
        $policyE->date_alta = date("Y-m-d");
        $policyE->id_user = $user_in_session['id'];

        if ($dealer['is_dealer'] == 1) {
            $policyE->dealer_id = $dealer['dealer'];
        }

        if ($policyE->save(false)) {
            $payments = new Payments();
            $payments->id_policy = $policyE->Id;
            $payments->agency = $user_in_session['agencia'];
            $payments->feecompany = $payment['ins_total'];
            $payments->feeforaz = $payment['adc_total'];
            $payments->feeoffice = $payment['office_total'];
            $payments->companytype = $payment['type_ins'];

            $payments->typeaz = $payment['type_adc'];
            $payments->fecha = date("Y-m-d");
            $payments->horat = date("H:i:s a");
            $payments->policynumber = $policy['policy_number'];
            $payments->company = $policy['company'];
            $payments->id_usuario = $user_in_session['id'];
            if ($dealer['is_dealer'] == 1) {
                $payments->nameentrega = $dealer['delivery'];
                $payments->namevendedor = $dealer['seller'];
                $payments->DeliveryT = $dealer['typeDelivery'];
                $payments->dealership = $dealer['dealer'];
                $payments->typeDO = 1;
                $payments->feedealer = $payment['dealer_total'];
            } else {
                $payments->feedealer = 0;
            }
            $payments->typeDO = 2;
            $payments->Dpayment = $payment['status_transaction'];
            $payments->id_cashier = $payment['cashier'];
            $payments->total = $payments->feeforaz + $payments->feecompany + $payments->feeoffice + $payments->feedealer;
            $payments->nameclient = $customer->nombre;
            if ($payments->save(false)) {
                return $response = [
                    "status" => "success",
                    "message" => "Completado",
                ];
            }
        }
    }

    public function actionUpdate_transaction() {
        $request = Yii::$app->request;
        $model = new Payments();
        $model->load(Yii::$app->getRequest()->getBodyParams(), 'ticket');
        $id = $request->post('id');


        if (($payment = Payments::findOne($id)) !== null) {
            $payment->agency = $model->agency;
            $payment->nameclient = $model->nameclient;
            $payment->fecha = date("Y-m-d", strtotime($model->fecha));
            $payment->feecompany = $model->feecompany;
            $payment->feeforaz = $model->feeforaz;
            $payment->feeoffice = $model->feeoffice;
            $payment->feedealer = $model->feedealer;
            $payment->company = $model->company;
            $payment->id_usuario = $model->id_usuario;
            $payment->id_cashier = $model->id_cashier;
            if ($payment->update(false)) {
                return $response = [
                    "status" => "success",
                    "message" => "Completado",
                ];
            } else {
                return $response = [
                    "status" => "error",
                    "message" => "Error",
                ];
            }
        } else {
            return $payment;
        }
    }

    public function actionTransaction_user() {
        $session = Yii::$app->session;
        $user_in_session = $session->get('user_login');
        $today = date("Y-m-d");
        return Payments::find()->where("id_usuario=" . $user_in_session['id'])->andWhere("erase!=1")->andWhere("fecha='" . $today . "'")->all();
    }

    public function actionUpdate_customer() {
        $request = Yii::$app->request;
        $id = $request->post('id');
        $model = new Customers();
        $model->load(Yii::$app->getRequest()->getBodyParams(), 'client');
        if (($customer = Customers::findOne($id)) !== null) {
            $dob = date("Y-m-d", strtotime($model->dob));
            $customer->nombre = $model->nombre;
            $customer->address = $model->address;
            $customer->languajePrefernce = $model->languajePrefernce;
            $customer->city = $model->city;
            $customer->zipcode = $model->zipcode;
            $customer->dob = $dob;
            $customer->mail = $model->mail;
            $customer->addemail = $model->addemail;
            $customer->tel = $model->tel;
            $customer->addphone = $model->addphone;
            $customer->homephone = $model->homephone;
            $customer->workphone = $model->workphone;

            if ($customer->update(false)) {
                return $response = [
                    "status" => "success",
                    "message" => "Completado",
                ];
            } else {
                return $response = [
                    "status" => "error",
                    "message" => "Error",
                ];
            }
        }
    }

    public function actionGet_customer_actives() {
        $request = Yii::$app->request;
        $name = $request->post('name');
        $phone = $request->post('phone');
        return Customers::find()
                        ->where(['like', 'nombre', '%' . $name . '%', false])
                        ->andWhere(['like', 'tel', '%' . $phone . '%', false])
                        ->all();
        /* return Services::find()
          ->where("active=1")
          ->andWhere("finish_date >='" . $today . "'")
          ->with('customer')
          ->asArray()
          ->all(); */
    }

    public function actionGet_customer_cancelled() {
        $today = date("Y-m-d");
        return Services::find()
                        ->where("active=1")
                        ->andWhere("finish_date < '" . $today . "'")
                        ->with('customer')
                        ->asArray()
                        ->all();
    }

    public function actionLogin_user() {
        $session = Yii::$app->session;
        $request = Yii::$app->request;
        $session->open();
        $session->destroy();
        $user = $request->post('user');
        $pass = $user['password'];
        $response = [];
        $userFind = Agents::find()
                ->where("user='" . $user['username'] . "'")
                ->andWhere("pass='" . $pass . "'")
                ->andWhere("agencia=" . $user['agency'])
                ->andWhere("deleted=0")
                ->one();

        if ($userFind != null) {
            $session->set('user_login', $userFind);
            $response = [
                "status" => true,
                "info" => $userFind,
            ];
        } else {
            $response = [
                "status" => false,
                "info" => "Fail Login",
            ];
        }
        return $response;
    }

    public function actionMake_payment() {
        $session = Yii::$app->session;
        $user_in_session = $session->get('user_login');
        $request = Yii::$app->request;
        $id_policy = $request->post('id_policy');
        $id_cliente = $request->post('id_cliente');
        $payment = $request->post('payment');
        $endrose = $request->post('endorse');

        $policy = Policies::findOne($id_policy);
        $customer = Customers::findOne($id_cliente);

        $payments = new Payments();
        $payments->id_policy = $policy->Id;
        $payments->agency = $user_in_session['agencia'];
        $payments->feecompany = $payment['ins_total'];
        $payments->feeforaz = $payment['adc_total'];
        $payments->feeoffice = $payment['office_total'];
        $payments->companytype = $payment['type_ins'];

        $payments->typeaz = $payment['type_adc'];
        $payments->fecha = date("Y-m-d");
        $payments->horat = date("H:i:s a");
        $payments->policynumber = $policy->policynumber;
        $payments->company = $policy->company_id;
        $payments->id_usuario = $user_in_session['id'];

        $payments->nameentrega = "";
        $payments->namevendedor = "";
        $payments->DeliveryT = 0;
        $payments->dealership = 0;
        $payments->feedealer = 0;
        if ($endrose['is_endrose'] == "2") {
            $payments->typeDO = 4;
            $payments->comment = $endrose['concept'];
        } else {
            $payments->typeDO = 2;
            $payments->comment = "";
        }
        $payments->Dpayment = $payment['status_transaction'];
        $payments->id_cashier = $payment['cashier'];
        $payments->total = $payments->feeforaz + $payments->feecompany + $payments->feeoffice + $payments->feedealer;
        $payments->nameclient = $customer->nombre;
        if ($payments->save(false)) {
            return $response = [
                "status" => "success",
                "message" => "Completado",
            ];
        } else {
            return $response = [
                "status" => "error",
                "message" => "error",
            ];
        }
    }

    public function actionGet_customers() {
        return $customer = Customers::find()->where("active=1")->all();
    }

    public function actionRemove_session() {
        $session = Yii::$app->session;
        $session->destroy();
    }

    public function actionGet_customer_by_id() {
        $request = Yii::$app->request;
        $id = $request->post('id');
        return Customers::find()->where("id=" . $id)->with('services')->asArray()->all();
    }

    public function actionGet_service_by_id() {
        $request = Yii::$app->request;
        $id = $request->post('id');
        return Services::findOne($id);
    }

    public function calculate_dates($period) {
        $today = date("Y-m-d");
        if ($period == 1) {
            return date("Y-m-d", strtotime($today . "+ 1 days"));
        } else if ($period == 2) {
            return date("Y-m-d", strtotime($today . "+ 1 week"));
        } else if ($period == 3) {
            return date("Y-m-d", strtotime($today . "+ 1 month"));
        }
    }

    function generarCodigo() {
        $key = '';
        $pattern = 'ESPERANZAGYM012356789';
        $max = strlen($pattern) - 1;
        for ($i = 0; $i < 5; $i++)
            $key .= $pattern{mt_rand(0, $max)};
        return $key;
    }

    function actionGet_types() {
        return PolicyType::find()->all();
    }

    function actionGet_companies() {
        return Companies::find()->where("agency=101")->andWhere("active=1")->all();
    }

    function actionGet_dealers() {
        return Dealers::find()->where("agency=101")->andWhere("habilitado=1")->all();
    }

    function actionGet_cashiers() {
        return Agents::find()->where("isCashier=1")->andWhere("isloggedClock=1")->all();
    }

    function actionGet_agents() {
        return Agents::find()->where("habilitado=1")->andWhere("nivel=1 or nivel=2 or nivel=5")->all();
    }

    function actionGet_ticket_by_id() {
        $request = Yii::$app->request;
        $id = $request->post('id');
        return Payments::findOne($id);
    }

    function actionGet_customer_id() {
        $request = Yii::$app->request;
        $id = $request->post('id');
        return Customers::findOne($id);
    }

    function actionGet_policies_id() {
        $request = Yii::$app->request;
        $id = $request->post('id');
        return Policies::find()->where("id_cliente=" . $id)->all();
    }

    function actionGet_payment_history() {
        $request = Yii::$app->request;
        $id = $request->post('id');
        return Payments::find()->where("id_policy=" . $id)->andWhere("erase!=1")->all();
    }

    function actionGet_policy_by_id() {
        $request = Yii::$app->request;
        $id = $request->post('id');
        return Policies::findOne($id);
    }

}
