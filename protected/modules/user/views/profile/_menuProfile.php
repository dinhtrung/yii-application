<?php $this->menu = array(
	'profile'	=>	array(
			'label'	=>	Yii::t('user', 'Profile'),
			'url'	=>	array('/user/profile'),
	),
	'edit'	=>	array(
			'label'	=>	Yii::t('user', 'Edit Your Profile'),
			'url'	=>	array('/user/profile/edit'),
	),
	'changepassword'	=>	array(
			'label'	=>	Yii::t('user', 'Change Password'),
			'url'	=>	array('/user/profile/changepassword'),
	),
	'logout'	=>	array(
			'label'	=>	Yii::t('user', 'Logout'),
			'url'	=>	array('/user/logout'),
	),
);
