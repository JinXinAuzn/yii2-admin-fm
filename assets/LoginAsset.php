<?php

namespace jx\admin_fm\assets;


use yii\web\AssetBundle;

/**
 * @author Au zn <690550322@qq.com>
 * @since Full version
 */
class LoginAsset extends AssetBundle
{
	public $sourcePath = '@jx/admin_fm/web';
	public $css = [
		'css/login/login.css',
	];
	public $js=[
	];
	public $depends = [
		'yii\web\YiiAsset',
	];
}
