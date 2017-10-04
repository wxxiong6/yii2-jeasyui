<?php

use yii\helpers\Html;
use sheillendra\jeasyui\assets\YiiEasyUILoginAsset;

/* @var $this \yii\web\View */
/* @var $content string */

YiiEasyUILoginAsset::register($this);
?>
<?php $this->beginPage() ?>
<?php $this->render('@app/views/layouts/_init_login') ?>
<!DOCTYPE html>
<html lang="<?php echo Yii::$app->language ?>">
    <head>
        <meta charset="<?php echo Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php echo Html::csrfMetaTags() ?>
        <title><?php echo Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
        <div id="error"></div>
        <?php $this->beginBody() ?>
        <?php echo $content ?>
        <?php $this->endBody() ?>
    </body>
</html>
<?php
$this->registerJs(<<<EOD
        yii.easyuiLogin.dialogTitle = '{$this->params['loginDialogTitle']}';
        yii.easyuiLogin.dialogWidth = {$this->params['loginDialogWidth']};
        yii.easyuiLogin.dialogHeight = {$this->params['loginDialogHeight']};
        yii.easyuiLogin.textboxWidth = {$this->params['textboxWidth']};
        yii.easyuiLogin.usernameSelector = '{$this->params['usernameSelector']}';
        yii.easyuiLogin.url = '{$this->params['loginUrl']}';
        yii.easyuiLogin.signupurl = '{$this->params['signupUrl']}';
        yii.easyuiLogin.forgoturl = '{$this->params['forgotUrl']}';
        yii.easyuiLogin.init();
EOD
);

$this->endPage();
