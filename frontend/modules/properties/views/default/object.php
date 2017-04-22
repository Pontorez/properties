<?php
use yii\data\ActiveDataProvider;
use yii\grid\GridView;

/** @var \common\models\Object $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = [
    'label' => 'Objects',
    'url' => ['/properties/index'],
];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="properties-default-index">

    <h2><?= $model->name ?></h2>

    <h3>Object id: <?= $model->id ?>, created at <?= $model->created_at ?></h3>

    <?php

    /** @var ActiveDataProvider $dataProvider */
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'label' => 'Атрибут',
                'value' => function ($data) {
                    return $data->property->name;
                },

            ],
            [
                'label' => 'Значение',
                'value' => function ($data) {
//                    return $data->value_text ? $data->value_text : $data->value_int;
                    return $data->getValue($data->property->name);
                },

            ],
        ]
    ]);

    ?>
</div>
