<?php

use yeesoft\Yee;
use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var yeesoft\models\AuthItemGroup $model
 */
$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yee::t('back', 'Users'), 'url' => ['/user']];
$this->params['breadcrumbs'][] = ['label' => Yee::t('back', 'Permission groups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="permission-groups-view">

    <h3 class="lte-hide-title"><?= Html::encode($this->title) ?></h3>

    <div class="panel panel-default">
        <div class="panel-body">

            <p>
                <?= Html::a('Edit', ['update', 'id' => $model->code], ['class' => 'btn btn-sm btn-primary']) ?>

                <?=
                Html::a('Delete', ['delete', 'id' => $model->code],
                    [
                        'class' => 'btn btn-sm btn-default',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this user?',
                            'method' => 'post',
                        ],
                    ])
                ?>

                <?= Html::a('Add New', ['create'], ['class' => 'btn btn-sm btn-primary pull-right']) ?>
            </p>

            <?=
            DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'name',
                    'code',
                    'created_at:datetime',
                    'updated_at:datetime',
                ],
            ])
            ?>

        </div>
    </div>

</div>












