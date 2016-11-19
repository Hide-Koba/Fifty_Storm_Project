<div class="steps form">
<?php echo $this->Form->create('Step'); ?>
	<fieldset>
	<?php
		echo $this->Form->input('recipe_id',array('type'=>'hidden','value'=>$backward_id));
		echo $this->Form->input('comment',array('label'=>'工程'));
		echo $this->Form->input('add_option',array('label'=>'どの後ろに追加するかを選択して下さい','type'=>'select','options'=>$add_options));
	?>
	</fieldset>
<?php echo $this->Form->end(__('工程を追加')); ?>
</div>
<div class="actions">
	<ul>
	</ul>
</div>
