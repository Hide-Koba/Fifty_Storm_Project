<div class="recipes form">
<?php echo $this->Form->create('Recipe'); ?>
	<fieldset>
		<legend><?php echo __('Edit Recipe'); ?></legend>
	<?php
		echo $this->Form->input('id');
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

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Recipe.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('Recipe.id')))); ?></li>
		<li><?php echo $this->Html->link(__('List Recipes'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Ingredients'), array('controller' => 'ingredients', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ingredient'), array('controller' => 'ingredients', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Steps'), array('controller' => 'steps', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Step'), array('controller' => 'steps', 'action' => 'add')); ?> </li>
	</ul>
</div>
