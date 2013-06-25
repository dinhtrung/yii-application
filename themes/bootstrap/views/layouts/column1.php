<?php $this->beginContent('//layouts/main'); ?>
<div class="container">
	<div id="content">
		<?php if (! empty($this->menu)) echo TbHtml::buttonGroup($this->menu); ?>
		<?php echo $content; ?>
	</div><!-- content -->
</div>
<?php $this->endContent(); ?>