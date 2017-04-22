<?php

namespace frontend\modules\properties\controllers;

use common\models\Object;
use common\models\ObjectsProperties;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

/**
 * Default controller for the `properties` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Object::find(),
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                    'name' => SORT_ASC,
                ]
            ],
        ]);

        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionView($id)
    {
        $model = Object::findOne($id);
        $dataProvider = new ActiveDataProvider(['query' => ObjectsProperties::find()->where(['object_id' => $model->id])]);

        return $this->render('object', [
            'model' => $model,
            'dataProvider' => $dataProvider,
        ]);
    }
}
