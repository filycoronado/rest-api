<?php

namespace app\modules\v1\controllers;
use yii\web\Response;
use app\helpers\BehaviorsFromParamsHelper;
use yii\rest\ActiveController;
use app\models\Car;
use yii\filters\auth\HttpBearerAuth;
/*
 *
 * @author Heru Arief Wijaya
 * 2020 @  belajararief.com
 */
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Authorization, X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER['REQUEST_METHOD'];
if ($method == "OPTIONS") {
    die();
}
class CarController extends ActiveController
{
    public $modelClass = 'app\models\Car';
    

    public function beforeAction($action)
    {
      $this->enableCsrfValidation = false;
      return parent::beforeAction($action);
    }

    
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors = BehaviorsFromParamsHelper::behaviors($behaviors);
        return $behaviors;
    }

  
  
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return [
            'status' => 200,
            'message' => "You may customize this page by editing the following file:" . __FILE__,
            'data' => ''
        ];
    }

    public function actionGetall()
    {
      
        $list= Car::findAll("enabled==1");
        return [
            'status' => 200,
            'message' => "Cars Available ",
            'data' => $list
        ];
    }
}
