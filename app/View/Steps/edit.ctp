<div class="steps form">
<?php echo $this->Form->create('Step'); ?>
	<fieldset>
		<legend><?php echo __('工程を編集'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('recipe_id');
		echo $this->Form->input('step_count',array('label'=>'工数'));
		echo $this->Form->input('comment',array('label'=>'工程'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('編集を完了')); ?>
</div>
<div class="actions">
	<ul>
	</ul>
</div>
