<?php
$this->breadcrumbs=array(
	'Mrtscans'=>array('admin'),
	$model->mrtscan_id=>array('view','id'=>$model->mrtscan_id),
	'Update',
);

//$this->menu=array(
//	array('label'=>'List Mrtscan','url'=>array('index')),
//	array('label'=>'Create Mrtscan','url'=>array('create')),
//	array('label'=>'View Mrtscan','url'=>array('view','id'=>$model->mrtscan_id)),
//	array('label'=>'Manage Mrtscan','url'=>array('admin')),
//);
?>

<!--<h1>Update Mrtscan --><?php //echo $model->mrtscan_id; ?><!--</h1>-->

<?php $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title'=>Yii::t('title', 'Update MRT scan'),
    'headerIcon'=>'icon-pencil',
    'headerButtonActionsLabel' => Yii::t('title', 'Actions'),
    'headerActions'=>array(
        array('label'=>Yii::t('menu', 'Create Mrtscan'),'url'=>array('create'), 'icon'=>'icon-plus'),
        array('label'=>Yii::t('menu', 'View Mrtscan'),'url'=>array('view','id'=>$model->mrtscan_id), 'icon'=>'icon-eye-open'),
        array('label'=>Yii::t('menu', 'Manage Mrtscan'),'url'=>array('admin'), 'icon'=>'icon-th-list'),
    ),
)); ?>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>

<?php $this->endWidget(); ?>