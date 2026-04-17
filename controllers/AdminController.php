<?php

namespace humhub\modules\followall\controllers;

use humhub\modules\followall\models\ConfigureForm;
use Yii;

class AdminController extends \humhub\modules\admin\components\Controller
{
    public function actionIndex()
    {
        $model = new ConfigureForm();
        $model->loadSettings();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->view->saved();
        }

        return $this->render('index', ['model' => $model]);
    }
}
