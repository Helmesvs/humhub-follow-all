<?php

namespace humhub\modules\followall;

use humhub\modules\user\models\User;
use Yii;

class Events
{
    public static function onAfterUserCreate($event)
    {
        $newUser = $event->sender;

        $module = Yii::$app->getModule('follow-all');
        $withNotifications = $module ? (bool)$module->settings->get('sendNotifications', false) : false;

        foreach (User::find()->active()->andWhere(['!=', 'id', $newUser->id])->all() as $existingUser) {
            $existingUser->follow($newUser, $withNotifications);
            $newUser->follow($existingUser, $withNotifications);
        }
    }

    public static function onCronDailyRun($event)
    {
        $controller = $event->sender;
        $controller->stdout("Ensuring all users follow each other... ");

        $module = Yii::$app->getModule('follow-all');
        if ($module === null) {
            return;
        }

        $withNotifications = (bool)$module->settings->get('sendNotifications', false);

        if (!(bool)$module->settings->get('followAllUsers', false)) {
            return;
        }

        $users = User::find()->active()->all();
        foreach ($users as $targetUser) {
            foreach ($users as $followerUser) {
                if ($targetUser->id === $followerUser->id) {
                    continue;
                }

                $targetUser->follow($followerUser, $withNotifications);
            }
        }

        $controller->stdout('done.' . PHP_EOL, \yii\helpers\Console::FG_GREEN);
    }
}
