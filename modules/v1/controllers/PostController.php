<?php

namespace app\modules\v1\controllers;

use app\helpers\BehaviorsFromParamsHelper;
use yii\rest\ActiveController;

/*
 *
 * @author Heru Arief Wijaya
 * 2020 @  belajararief.com
 */

class PostController extends ActiveController
{
    public $modelClass = 'app\models\Post';

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
}
