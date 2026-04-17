<?php

use humhub\libs\Html;
use humhub\widgets\ActiveForm;

?>

<div class="panel panel-default">

    <div class="panel-heading"><?= Yii::t('FollowAllModule.base', '<strong>Follow All</strong>'); ?></div>

    <div class="panel-body">
        <p>
            <?= Yii::t('FollowAllModule.setting', 'When this module is enabled, new users will automatically follow all existing active users.'); ?>
        </p>
        <br>

        <?php $form = ActiveForm::begin(); ?>

        <div class="form-group">
            <?= $form->field($model, 'sendNotifications')->checkbox(); ?>

            <div class="help-block" style="margin-left: 12px">
                <?= Yii::t('FollowAllModule.setting', 'If the option below is enabled, a daily routine ensures that all users follow each other, ignoring manual unfollow actions.'); ?>
            </div>
            <?= $form->field($model, 'followAllUsers')->checkbox(); ?>
        </div>

        <div class="form-group">
            <?= Html::saveButton() ?>
            <?= Html::a(Yii::t('base', 'Back'), '/admin/module', ['class' => 'btn btn-default pull-right']); ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>