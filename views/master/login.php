<?php

use jx\admin_fm\assets\LoginAsset;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = '登录';
$asset = LoginAsset::register($this);
$AssetUrl = $asset->baseUrl;
?>
<!DOCTYPE html>
<?php $this->beginPage() ?>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?>_后台管理系统</title>
    <?php $this->head() ?>
</head>
<body class='hold-transition skin-custom'>
<?php $this->beginBody() ?>
<div class="home">
    <div class="loginwrap">
        <div class="whitebg">
            <img class="topbg" src="<?= $AssetUrl ?>/images/login/bottbor.png" alt="">
            <?php
            $form = ActiveForm::begin([
                'id' => 'login-form',
                'fieldConfig' => [
                    'options' => ['tag' => 'li'],
                    'template' => '<span></span><div class="input">{input}</div>',
                ],
            ]);
            ?>
                <div class="putwrap">
                    <?=Html::img($AssetUrl.'/images/login/user.png')?>
                    <?=Html::input('string',Html::getInputName($model,'username'),'',['placeholder'=>'账号'])?>
                </div>
                <div class="putwrap">
                    <?=Html::img($AssetUrl.'/images/login/pass.png')?>
                    <?=Html::input('password',Html::getInputName($model,'password'),'',['placeholder'=>'密码'])?>
                </div>
                <div class="codewrap">
                    <?=Html::input('string',Html::getInputName($model,'verifyCode'),'',['placeholder'=>'请输入验证码'])?>
                    <?=Html::img('/admin/master/captcha')?>
                </div>
            <div class="button">
                <?= Html::submitButton('登录', ['name' => 'login-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
        <div class="redbg">
            <img class="bglogo" src="<?= $AssetUrl ?>/images/login/logobig.png" alt="">
            <h2><?=Yii::t('rbac-admin','login_Backend_name')?></h2>
            <div class="gang"></div>
            <h4>
                Maihuo Backstage
            </h4>
            <h4>
                management system
            </h4>
        </div>
        <div class="copyright">
            &copy;四川泛梦科技版权所有
        </div>
    </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
