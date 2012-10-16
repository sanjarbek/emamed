<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'mrtscan_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'mrtscan_name',array('class'=>'span5','maxlength'=>45)); ?>

	<?php echo $form->textFieldRow($model,'mrtscan_description',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'mrtscan_price',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'mrtscan_enable',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'created_at',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'updated_at',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'created_user',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'updated_user',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
		    'buttonType'=>'submit'
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
