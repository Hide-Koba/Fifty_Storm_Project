<div class="recipes form">
<?php echo $this->Form->create('Recipe'); ?>
	<fieldset>
		<legend><?php echo __('レシピの編集'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('Recipe.name',array('label'=>'料理名を入力して下さい'));
		$categories = array(
		'主食','主菜','副菜 和え物', '副菜 煮物', '副菜 サラダ', '副菜 その他(焼き物など)', '汁'
		);
		echo $this->Form->input('Recipe.category',array('label'=>'種別を選んでください','options'=>$categories));
		echo $this->Form->input('Recipe.advise',array('label'=>'作り方のコツやお勧め一言をお願いします'));
		$seasons = array(
		'春', '夏', '秋','冬', '一年を通じて' 
		);
		echo $this->Form->input('Recipe.season',array('label'=>'料理の季節を選んでください','options'=>$seasons));
		echo $this->Form->input('Recipe.cal',array('label'=>'カロリーを入力して下さい'));
		echo $this->Form->input('Recipe.fat',array('label'=>'脂質を入力して下さい'));
		echo $this->Form->input('Recipe.protain',array('label'=>'タンパク質を入力して下さい'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('更新')); ?>
</div>
<div class="actions">
	<h3><?php echo __('メニュー'); ?></h3>
	<ul>

		<li><?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Recipe.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('Recipe.id')))); ?></li>
		<li><?php echo $this->Html->link(__('リストに戻る'), array('action' => 'index')); ?></li>
	</ul>
</div>
