<?php
/**
 *
 *   Copyright © 2010-2012 by xhost.ch GmbH
 *
 *   All rights reserved.
 *
 **/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<!--
 -
 -   Copyright © 2010-2012 by xhost.ch GmbH
 -
 -   All rights reserved.
 -
 -->
<head>
	<meta content="initial-scale=1.0, width=device-width, user-scalable=yes" name="viewport">
	<meta content="yes" name="apple-mobile-web-app-capable">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	<link rev="made" href="mailto:multicraft@xhost.ch">
	<meta name="description" content="Multicraft: The Minecraft server control panel">
	<meta name="keywords" content="Multicraft, Minecraft, server, management, control panel, hosting">
	<meta name="author" content="xhost.ch GmbH">

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Theme::css('screen.css') ?>" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Theme::css('print.css') ?>" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Theme::css('ie.css') ?>" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Theme::css('main.css') ?>" />
	<link rel="stylesheet" type="text/css" href="<?php echo Theme::css('form.css') ?>" />

	<link href="//ready2frag.com/css/style.css" media="all" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="//use.typekit.net/ned2mke.js"></script>
    <script type="text/javascript">try{Typekit.load();}catch(e){}</script>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
	<div id="page-wrap">
        <div class="linkbar">
            <div class="container">
                <div class="pull-left">
                    <a href="{{ link.twitter }}" class="fa fa-twitter"></a>
                    <a href="{{ link.facebook }}" class="fa fa-facebook"></a>
                    <a href="{{ link.email }}" class="fa fa-envelope"></a>
                </div>
                <div class="pull-right">
                    <a href="{{ link.panel }}" class="nav-item">Panel Login</a>
                    <a href="{{ link.wmhcs.home }}" class="nav-item">Client Area</a>
                </div>
            </div>
        </div>
        <div class="navigation">
            <nav class="navbar navbar-default" role="navigation">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#page-navigation">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="fa fa-bars"></span>
                        </button>
                        <a class="navbar-brand" href="{{ link.pages.home }}">Ready2Frag</a>
                    </div>
                    <div id="page-navigation" class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-right">
                             <li class="dropdown">
                                 <a href="#" class="dropdown-toggle" data-toggle="dropdown">About Us</a>
                                 <ul class="dropdown-menu">
                                     <li><a href="{{ link.pages.about.dc }}">Datacenter &amp; Network</a></li>
                                     <li><a href="{{ link.pages.about.features }}">Features</a></li>
                                     <li><a href="{{ link.pages.about.contact }}">Contact Us</a></li>
                                 </ul>
                             </li>
                             <li>
                                 <a href="{{ link.pages.game_servers }}">Gaming</a>
                             </li>
                             <li>
                                 <a href="{{ link.pages.dedicated_servers }}">Dedicated</a>
                             </li>
                             <li>
                                 <a href="{{ link.pages.vps }}">VPS</a>
                             </li>
                         </ul>
                     </div>
                </div>
            </nav>
        </div>
		<div class="sub-navigation">
			<div class="container">
				<nav class="navbar navbar-inverse navbar-sub">
					<?php
					$items = array();

					$simple = (Yii::app()->theme && in_array(Yii::app()->theme->name, array('simple', 'mobile', 'platform')));
					if (!$simple)
						$items[] = array('label'=>Yii::t('mc', 'Home'), 'url'=>array('/site/page', 'view'=>'home'));
					if (@Yii::app()->params['installer'] !== 'show')
					{
						$items[] = array(
							'label'=>Yii::t('mc', 'Servers'),
							'url'=>array('/server/index', 'my'=>($simple && !Yii::app()->user->isSuperuser() ? 1 : 0)),
						);
						$items[] = array(
							'label'=>Yii::t('mc', 'Users'),
							'url'=>array('/user/index'),
							'visible'=>(Yii::app()->user->isSuperuser()
								|| !(Yii::app()->user->isGuest || (Yii::app()->params['hide_userlist'] === true) || $simple)),
						);
						$items[] = array(
							'label'=>Yii::t('mc', 'Profile'),
							'url'=>array('/user/view', 'id'=>Yii::app()->user->id),
							'visible'=>(!Yii::app()->user->isSuperuser() && !Yii::app()->user->isGuest
								&& ((Yii::app()->params['hide_userlist'] === true) || $simple)),
						);
						$items[] = array(
							'label'=>Yii::t('mc', 'Settings'),
							'url'=>array('/daemon/index'),
							'visible'=>Yii::app()->user->isSuperuser(),
						);
						$items[] = array(
							'label'=>Yii::t('mc', 'Support'),
							'url'=>array('/site/report'),
							'visible'=>!empty(Yii::app()->params['admin_email']),
						);
					}
					if (Yii::app()->user->isGuest)
					{
						$items[] = array(
							'label'=>Yii::t('mc', 'Login'),
							'url'=>array('/site/login'),
							'itemOptions'=>$simple ? array('style'=>'float: right') : array(),
						);
					}
					else
					{
						$items[] = array(
							'label'=>Yii::t('mc', 'Logout ({name})', array('{name}'=>Yii::app()->user->name)),
							'url'=>array('/site/logout'),
							'itemOptions'=>$simple ? array('style'=>'float: right') : array(),
						);
					}
					$items[] = array(
						'label'=>Yii::t('mc', 'About'),
						'url'=>array('/site/page', 'view'=>'about'),
						'visible'=>$simple,
						'itemOptions'=>array('style'=>'float: right'),
					);
					
					
					$this->widget('zii.widgets.CMenu', array(
						'items'=>$items,
						'htmlOptions' => array('class' => 'nav navbar-nav')
					)); ?>
				</nav>
			</div>
		</div><!-- mainmenu -->

		<div class="container">
			<div class="content">
				
                <div class="row shaded-bar">
                    <h1>Multicraft</h1>
                </div>
				<?php
					if (!$simple)
					{
						array_pop($this->breadcrumbs);
						$this->widget('zii.widgets.CBreadcrumbs', array(
							'homeLink'=>'',
							'links'=>$this->breadcrumbs,
							'tagName' => 'ol',
							'htmlOptions' => array('class' => 'breadcrumb'),
							'separator' => '',
							'activeLinkTemplate' => '<li><a href="{url}">{label}</a></li>',
							'inactiveLinkTemplate' => '<li class="active">{label}</li>',
						));
					}
				?>

				<?php echo $content; ?>
			</div>
		</div>
	</div>
    <footer>
        <div class="container">
            <div class="content">
                <div class="row">
                    <div class="col-sm-3">
                        <h2>About Us</h2>
                        <ul>
                            <li><a href="{{ link.pages.about.dc }}">Datacenter &amp; Network</a></li>
                            <li><a href="{{ link.pages.about.features }}">Features</a></li>
                            <li><a href="{{ link.pages.about.contact }}">Contact Us</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-3">
                        <h2>Services</h2>
                        <ul>
                            <li><a href="{{ link.pages.game_servers }}">Game Servers</a></li>
                            <li><a href="{{ link.pages.dedicated_servers }}">Dedicated Servers</a></li>
                            <li><a href="{{ link.pages.vps }}">Virtual Private Servers</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-3">
                        <h2>Clients</h2>
                        <ul>
                            <li><a href="{{ link.wmhcs.home }}">Billing Area</a></li>
                            <li><a href="{{ link.panel }}">Game Server Panel</a></li>
                            <li><a href="{{ link.panel }}">VPS Panel</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-3">
                        <h2>&nbsp;</h2>
                        <ul>
                            <li><a href="{{ link.pages.terms_of_service }}">Terms of Service</a></li>
                            <li><a href="{{ link.pages.privacy_policy }}">Privacy Policy</a></li>
                            <li><a href="{{ link.pages.about.contact }}">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
                <div class="row lastrow">
                    <div class="pull-left">
                        <a href="{{ link.pages.home }}" class="logo"></a>
                    </div>
                    <div class="pull-right">
                        <a href="{{ link.pages.home }}">Copyright 2014</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <script src="//ready2frag.com/js/fit.js"></script>
    <script src="//ready2frag.com/js/ready2frag.js"></script>
</body>
</html>
