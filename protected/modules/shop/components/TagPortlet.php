<?php
class TagPortlet extends CPortlet {
	public $title='Tags';
	public $maxTags=20;
	protected function renderContent()
	{
		$tags=ThePhanLoai::model()->findTagWeights($this->maxTags);
	
		foreach($tags as $tag=>$weight)
		{
			$link=CHtml::link(CHtml::encode($tag), array('post/index','tag'=>$tag));
			echo CHtml::tag('span', array(
					'class'=>'tag',
					'style'=>"font-size:{$weight->soLuong}pt",
			), $link)."\n";
		}
	}
}