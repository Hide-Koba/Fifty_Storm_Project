<div class="recipes form">
<?php echo $this->Form->create('Recipe'); ?>
	<fieldset>
		<legend><?php echo __('Add Recipe'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('category');
		echo $this->Form->input('advise');
		echo $this->Form->input('season');
		echo $this->Form->input('cal');
		echo $this->Form->input('fat');
		echo $this->Form->input('protain');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Recipes'), array('action' => 'index')); ?></li>
	</ul>
</div>
