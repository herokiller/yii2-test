<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Apple;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Apples';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="apple-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Apple', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <p>
        <?= Html::beginForm(['generate'], 'post') ?>
        <?= Html::input('submit', '', 'Generate some apples', ['class' => 'btn btn-success']) ?>
        <?= Html::endForm() ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'color',
            [
                'label' => 'Status',
                'attribute'=>'status',
                'value' => function ($data) {

                    $statuses = [
                        Apple::STATUS_TREE => 'On the tree',
                        Apple::STATUS_GROUND => 'On the ground',
                        Apple::STATUS_SPOILED => 'Spoiled'
                    ];

                    return $statuses[$data->getStatus()];
                },
            ],
            [
                'label' => 'size',
                'attribute' => 'size',
                'value' => function($data) {
                    return $data->size/100.0;
                }
            ],
            [
                'label' => 'Created At',
                'attribute'=>'created_at',
                'value' => function ($data) {
                    return date('Y-m-d H:s', $data->created_at);
                },
            ],

            [
                'label' => 'Fell At',
                'attribute'=>'fell_at',
                'value' => function ($data) {
                    return date('Y-m-d H:s', $data->fell_at);
                },
            ],

            [
                'label' => 'Eat',
                'format' => 'raw',
                'value' => function ($data) {
                    return Html::beginForm(['/apple/eat', 'id' => $data->id], 'post') .
                           Html::input('number', 'percent', 0) .
                           Html::input('submit', '', 'Eat') .
                           Html::endForm();
                },
            ],

            [
                'label' => 'Drop',
                'format' => 'raw',
                'value' => function ($data) {
                    return Html::beginForm(['/apple/fall', 'id' => $data->id], 'post') .
                           Html::input('submit', '', 'Fall') .
                           Html::endForm();
                },
            ],


            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
