<?php

/* @var $this \yii\web\View */

if (Yii::$app->request->isAjax) {
    $this->context->layout = '//blank';
    echo $this->renderAjax('_index');
} else {
    $this->params['selectedNav'] = 'nav-setting-user';

    //uncomment below if choose sidebarPlugin is accordion 
    //$this->params['selectedNavAccordion'] = 'setting';
}