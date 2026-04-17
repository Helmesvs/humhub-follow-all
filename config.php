<?php

use humhub\commands\CronController;
use humhub\modules\user\models\User;

return [
    'id' => 'follow-all',
    'class' => 'humhub\\modules\\followall\\Module',
    'namespace' => 'humhub\\modules\\followall',
    'events' => [
        [User::className(), User::EVENT_AFTER_INSERT, ['humhub\\modules\\followall\\Events', 'onAfterUserCreate']],
        ['class' => CronController::class, 'event' => CronController::EVENT_ON_DAILY_RUN, 'callback' => ['humhub\\modules\\followall\\Events', 'onCronDailyRun']],
    ]
];
