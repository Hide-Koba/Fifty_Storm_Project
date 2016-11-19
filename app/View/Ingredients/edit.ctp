<div class="ingredients form">
<?php echo $this->Form->create('Ingredient'); ?>
	<fieldset>
		<legend><?php echo __('材料の編集'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('recipe_id',array('type'=>'hidden','value'=>$this->request->data['Ingredient']['recipe_id']));
		echo $this->Form->input('name',array('label'=>'名前'));
		echo $this->Form->input('weight',array('label'=>'重さ'));
		$weight_category_selecter = array(
		'g', 'cc', '手量り'
		);
		echo $this->Form->input('weight_category',array('label'=>'重さの単位','options'=>$weight_category_selecter));
	?>
	</fieldset>
<?php echo $this->Form->end(__('保存')); ?>
</div>
<div class="actions">
	<ul>
	</ul>
</div>
