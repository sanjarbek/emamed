<?php
$this->breadcrumbs=array(
	'Mrtscans'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Mrtscan','url'=>array('index')),
	array('label'=>'Create Mrtscan','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('mrtscan-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Mrtscans</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'mrtscan-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'mrtscan_id',
		'mrtscan_name',
		'mrtscan_description',
		'mrtscan_price',
		'mrtscan_enable',
		'created_at',
		/*
		'updated_at',
		'created_user',
		'updated_user',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
