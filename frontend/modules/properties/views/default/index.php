<?php
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;

?>

<div class="properties-default-index">

    <h1>Objects</h1>

    <?= /** @var ActiveDataProvider $dataProvider */
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'created_at:datetime',
            [
                'attribute' => 'type_id',
                'format' => 'raw',
                'value' => function ($data) {
                    /** @var Object $data */
                    return $data->type->name;
                },
            ],

            [
                'attribute' => 'name',
                'format' => 'raw',
                'value' => function ($data) {
                    return Html::a($data->name, '/properties/view?id=' . $data->id);
                },
            ],
            [
                'attribute' => 'numberOfProperties',
                'value' => function ($data) {
                    /** @var Object $data */
                    return count($data->getObjectsProperties()->all());
                },
                'format' => 'html',
            ],
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
            ],
        ],

    ]) ?>

</div>
