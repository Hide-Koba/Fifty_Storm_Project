<div class="recipes form">
<?php echo $this->Form->create('Recipe'); ?>
	<fieldset>
		<legend><?php echo __('レシピの編集'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name',array('label'=>'レシピ名'));
		$categories = array(
		'主食','主菜','副菜 和え物', '副菜 煮物', '副菜 サラダ', '副菜 その他(焼き物など)', '汁'
		);
		echo $this->Form->input('category',array('label'=>'カテゴリー','options'=>$categories));
		echo $this->Form->input('advise',array('label'=>'アドバイス'));
		$seasons = array(
		'春', '夏', '秋','冬', '一年を通じて' 
		);
		echo $this->Form->input('season',array('label'=>'季節','options'=>$seasons));
		echo $this->Form->input('cal',array('label'=>'カロリー'));
		echo $this->Form->input('fat',array('label'=>'脂質'));
		echo $this->Form->input('protain',array('label'=>'タンパク質'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('送信')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('レシピリストに戻る'), array('action' => 'index')); ?></li>
	</ul>
</div>
