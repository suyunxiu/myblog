<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use common\models\Adminuser;

/**
 * Signup form
 */
class ResetPwdForm extends Model
{
    public $password;
    public $password_repeat;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => '两次输入的密码不一致'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'password' => '新密码',
            'password_repeat' => '重输密码',
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function resetPassword($id)
    {
        if (!$this->validate()) {
            return null;
        }
        
        $adminUser = Adminuser::findOne($id);
        $adminUser->setPassword($this->password);
        $adminUser->removePasswordResetToken();
        return $adminUser->save() ? true : false;

    }

}
