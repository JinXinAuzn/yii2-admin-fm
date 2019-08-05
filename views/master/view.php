<?php
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model jx\admin_fm\models\Master */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('rbac-admin', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="list-table list-table ibox panel-dep-edit">
	<?=
	DetailView::widget([
		'model' => $model,
		'options'=> ['class' => "text-center kv-grid-table table table-bordered table-striped kv-table-wrap"],
		'attributes' => [
			'username',
			'real_name',
			[
				'attribute' => 'created_at',
				'format' => ['date', 'php:Y-m-d'],
			],
			[
				'attribute' => 'status',
				'value' => function ($model) {
					return $model->status == 0 ? Yii::t('rbac-admin', 'Inactive') : Yii::t('rbac-admin', 'Active');
				},
			]
		],
	])
	?>

</div>
