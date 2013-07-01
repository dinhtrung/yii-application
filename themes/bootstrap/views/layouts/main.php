<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />


	<title><?php echo CHtml::encode(strip_tags($this->pageTitle)); ?></title>
	<?php Yii::app()->bootstrap->register(); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" />
</head>

<body>

<?php if (isset($this->mainMenu)) $this->widget('bootstrap.widgets.TbNavbar',array(
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbNav',
            'items'=>$this->mainMenu,
        ),
    ),
)); ?>

<div class="container" id="page">

	<?php if(isset($this->breadcrumbs)):?>
		<?php echo TbHtml::breadcrumbs($this->breadcrumbs); ?>
	<?php endif?>
	
	<?php $this->widget('bootstrap.widgets.TbAlert'); ?>
	
	<?php echo $content; ?>

</div><!-- page -->

<div id="footer" class="container">
	Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
	All Rights Reserved.<br/>
	<?php echo Yii::powered(); ?>
</div><!-- footer -->


</body>
</html>
