<?php
$this->breadcrumbs=array(
	'Doctors'=>array('admin'),
	$model->doctor_id,
);

//$this->menu=array(
//	array('label'=>'List Doctor','url'=>array('index')),
//	array('label'=>'Create Doctor','url'=>array('create')),
//	array('label'=>'Update Doctor','url'=>array('update','id'=>$model->doctor_id)),
//	array('label'=>'Delete Doctor','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->doctor_id),'confirm'=>'Are you sure you want to delete this item?')),
//	array('label'=>'Manage Doctor','url'=>array('admin')),
//);
?>

<!--<h1>View Doctor #--><?php //echo $model->doctor_id; ?><!--</h1>-->

<?php $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title'=>Yii::t('title', 'View doctor'),
    'headerIcon'=>'icon-eye-open',
    'headerButtonActionsLabel'=>Yii::t('title', 'Actions'),
    'headerActions'=>array(
        array('label'=>'Create Doctor','url'=>array('create'), 'icon'=>'icon-plus'),
        array('label'=>'Update Doctor','url'=>array('update','id'=>$model->doctor_id), 'icon'=>'icon-pencil'),
        array('label'=>'Delete Doctor','url'=>'#', 'icon'=>'icon-remove', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->doctor_id),'confirm'=>'Are you sure you want to delete this item?')),
        array('label'=>'Manage Doctor','url'=>array('admin'), 'icon'=>'icon-th-list'),
    ),
)); ?>


<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'doctor_id',
		'doctor_fullname',
		'doctor_phone',
        array(
            'name'=>'doctor_hospital',
            'value'=>CHtml::encode($model->doctorHospital->hospital_name),
        ),
        array(
            'name'=>'doctor_enable',
            'value'=>CHtml::encode($model->getStatusText()),
        ),
		'created_at',
		'updated_at',
//		'created_user',
//		'updated_user',
	),
)); ?>

<?php $this->endWidget(); ?>
