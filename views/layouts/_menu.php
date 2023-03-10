<?php

use app\common\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

NavBar::begin([
	'brandLabel' => Yii::$app->name,
	'brandUrl'   => Yii::$app->homeUrl,
	'options'    => ['class' => 'navbar-expand-md navbar-dark bg-dark fixed-top']
]);
echo Nav::widget([
	'options' => ['class' => 'navbar-nav'],
	'items'   => [
		['label' => 'Home', 'url' => ['/site/index']],
		['label' => 'Setting', 'url' => ['/setting/index']],
		['label' => 'Due', 'url' => ['/due/index']],
		Yii::$app->user->isGuest
			? ['label' => 'Login', 'url' => ['/site/login']]
			: '<li class="nav-item">'
			  . Html::beginForm(['/site/logout'])
			  . Html::submitButton(
				'Logout (' . Yii::$app->user->identity->username . ')',
				['class' => 'nav-link btn btn-link logout']
			)
			  . Html::endForm()
			  . '</li>'
	]
]);
NavBar::end();