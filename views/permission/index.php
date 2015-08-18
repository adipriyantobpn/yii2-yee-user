<?php

use webvimark\extensions\GridPageSize\GridPageSize;
use yeesoft\grid\GridView;
use yeesoft\models\AuthItemGroup;
use yeesoft\models\Permission;
use yeesoft\Yee;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

/**
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var yeesoft\user\models\search\PermissionSearch $searchModel
 * @var yii\web\View $this
 */
$this->title = Yee::t('back', 'Permissions');
$this->params['breadcrumbs'][] = ['label' => Yee::t('back', 'Users'), 'url' => ['/user']];
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="permission-index">

    <div class="row">
        <div class="col-sm-12">
            <h3 class="lte-hide-title page-title"><?= Html::encode($this->title) ?></h3>
            <?= Html::a('Add New', ['create'], ['class' => 'btn btn-sm btn-primary']) ?>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-body">

            <div class="row">
                <div class="col-sm-12 text-right">
                    <?= GridPageSize::widget(['pjaxId' => 'permission-grid-pjax']) ?>
                </div>
            </div>

            <?php
            Pjax::begin([
                'id' => 'permission-grid-pjax',
            ])
            ?>

            <?=
            GridView::widget([
                'id' => 'permission-grid',
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'bulkActionOptions' => [
                    'gridId' => 'permission-grid',
                    'actions' => [Url::to(['bulk-delete']) => 'Delete']
                ],
                'columns' => [
                    ['class' => 'yii\grid\CheckboxColumn', 'options' => ['style' => 'width:10px']],
                    [
                        'attribute' => 'description',
                        'class' => 'yeesoft\grid\columns\TitleActionColumn',
                        'title' => function ($model) {
                            if ($model->name == Yii::$app->getModule('yee')->commonPermissionName) {
                                return Html::a(
                                    $model->description,
                                    ['view', 'id' => $model->name],
                                    ['data-pjax' => 0, 'class' => 'label label-primary']
                                );
                            } else {
                                return Html::a($model->description,
                                    ['view', 'id' => $model->name],
                                    ['data-pjax' => 0]);
                            }
                        },
                    ],
                    'name',
                    [
                        'attribute' => 'group_code',
                        'filter' => ArrayHelper::map(AuthItemGroup::find()->asArray()->all(),
                            'code', 'name'),
                        'value' => function (Permission $model) {
                            return $model->group_code ? $model->group->name : '';
                        },
                        'filterInputOptions' => [],
                    ],
                ],
            ]);
            ?>

            <?php Pjax::end() ?>
        </div>
    </div>
</div>





