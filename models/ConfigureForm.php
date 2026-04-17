<?php

namespace humhub\modules\followall\models;

use Yii;

class ConfigureForm extends \yii\base\Model
{
    public $followAllUsers;
    public $sendNotifications;

    public function rules()
    {
        return [
            ['followAllUsers', 'boolean'],
            ['sendNotifications', 'boolean'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'followAllUsers' => Yii::t('FollowAllModule.setting', 'Keep everyone following everyone (daily sync)'),
            'sendNotifications' => Yii::t('FollowAllModule.setting', 'Send notifications when following users'),
        ];
    }

    public function loadSettings()
    {
        $module = Yii::$app->getModule('follow-all');
        $this->followAllUsers = (bool)$module->settings->get('followAllUsers', false);
        $this->sendNotifications = (bool)$module->settings->get('sendNotifications', false);
    }

    public function save()
    {
        $module = Yii::$app->getModule('follow-all');
        $module->settings->set('followAllUsers', (bool)$this->followAllUsers);
        $module->settings->set('sendNotifications', (bool)$this->sendNotifications);
        return true;
    }
}
