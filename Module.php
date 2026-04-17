<?php

namespace humhub\modules\followall;

use yii\helpers\Url;

class Module extends \humhub\components\Module
{
    public $resourcesPath = 'resources';

    public function getConfigUrl()
    {
        return Url::to(['/follow-all/admin']);
    }
}
