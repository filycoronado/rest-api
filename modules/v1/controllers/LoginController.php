<?php
namespace app\modules\v1\controllers;
use yii\web\Response;
use app\models\Status;
use yii\rest\Controller;
use app\models\User;
use Yii;
// Created By @hoaaah * Copyright (c) 2020 belajararief.com
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Authorization, X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER['REQUEST_METHOD'];
if ($method == "OPTIONS") {
    die();
}

class LoginController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */

    public function behaviors()

	{

        $behaviors = parent::behaviors();

        

        $behaviors['contentNegotiator'] = [

	            'class' => 'yii\filters\ContentNegotiator',

	            'formats' => [

	                'application/json' => Response::FORMAT_JSON,

	            ]

        ];

        

        return $behaviors;

	}	
    public function actionIndex()
    {
        return [
            'status' => Status::STATUS_OK,
            'message' => "Test Controller",
            'data' => ''
        ];
    }

    public function actionSignup()
    {
        $model = new User();
        $params = Yii::$app->request->post("data");
       
        if(!$params) {
            Yii::$app->response->statusCode = Status::STATUS_BAD_REQUEST;
            return [
                'status' => Status::STATUS_BAD_REQUEST,
                'message' => "Need username, password, and email.",
                'data' => ''
            ];
        }


        $model->username = $params['username'];
        $model->email = $params['email'];

        $model->setPassword($params['password']);
        $model->generateAuthKey();
        $model->status = User::STATUS_ACTIVE;

        if ($model->save()) {
            Yii::$app->response->statusCode = Status::STATUS_CREATED;
            $response['isSuccess'] = 201;
            $response['message'] = 'You are now a member!';
            $response['user'] = \app\models\User::findByUsername($model->username);
            return [
                'status' => Status::STATUS_CREATED,
                'message' => 'You are now a member',
                'data' => User::findByUsername($model->username),
            ];
        } else {
            Yii::$app->response->statusCode = Status::STATUS_BAD_REQUEST;
            $model->getErrors();
            $response['hasErrors'] = $model->hasErrors();
            $response['errors'] = $model->getErrors();
            return [
                'status' => Status::STATUS_BAD_REQUEST,
                'message' => 'Error saving data!',
                'data' => [
                    'hasErrors' => $model->hasErrors(),
                    'getErrors' => $model->getErrors(),
                ]
            ];
        }
    }

    public function actionLogin()
    {
        $params = Yii::$app->request->post();
        if(empty($params['username']) || empty($params['password'])) return [
            'status' => Status::STATUS_BAD_REQUEST,
            'message' => "Need username and password.",
            'data' => ''
        ];

        $user = User::findByUsername($params['username']);

        if ($user->validatePassword($params['password'])) {
    
            Yii::$app->response->statusCode = Status::STATUS_OK;
            $user->generateAuthKey();
            $user->save();
            return [
                'status' =>  Status::STATUS_OK,
                'message' => 'Login Succeed',
                'data' => [
                    'id' => $user->username,
                    'token' => $user->auth_key,
                    'email' => $user['email'],
                ]
            ];
        } else {
            Yii::$app->response->statusCode = Status::STATUS_UNAUTHORIZED;
            return [
                'status' => Status::STATUS_UNAUTHORIZED,
                'message' => 'Username and Password not found. Check Again!',
                'data' => ''
            ];
        }
    }

}
