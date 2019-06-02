<?php
/* @var $this \yii\web\View */
/* @var $content string */
use jx\admin_fm\assets\AppAsset;
use yii\helpers\Html;
$asset =AppAsset::register($this);
$AssetUrl = $asset->baseUrl;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
	<meta charset="<?= Yii::$app->charset ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?= Html::csrfMetaTags() ?>
	<title><?= Html::encode($this->title) ?></title>
	<?php $this->head() ?>
</head>
<body class="skin-custom sidebar-mini">
<?php $this->beginBody() ?>
<div class="wrapper">
	<?= $this->render('parts/header',['AssetUrl'=>$AssetUrl]) ?>

	<?= $this->render('parts/left') ?>

	<?= $this->render('parts/content', ['content' => $content]) ?>

	<?= $this->render('parts/footer') ?>

	<?= $this->render('parts/sidebar') ?>

	<?= $this->render('parts/modal') ?>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
