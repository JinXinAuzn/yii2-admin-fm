<?php
namespace jx\admin_fm\models\form;

use Yii;
use jx\admin_fm\models\Master;
use yii\base\Model;

/**
 * Signup form
 * @author Au zn <690550322@qq.com>
 * @since Full version
 */
class Signup extends Model
{
    public $username;
    public $real_name;
    public $password;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => 'jx\admin_fm\models\Master', 'message' => '此登陆账号已被使用'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['real_name', 'filter', 'filter' => 'trim'],
            ['real_name', 'required'],
            ['real_name', 'unique', 'targetClass' => 'jx\admin_fm\models\Master', 'message' => '此用户名已被使用'],
            ['real_name', 'string', 'min' => 2, 'max' => 255],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }
	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => Yii::t('rbac-admin', 'ID'),
			'username' => "登录账号",
			'real_name' => "用户名",
			'password' => "密码",

		];
	}
    /**
     * Signs master up.
     *
     * @return Master|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new Master();
            $user->username = $this->username;
            $user->real_name = $this->real_name;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            if ($user->save()) {
                return $user;
            }
        }

        return null;
    }
}
