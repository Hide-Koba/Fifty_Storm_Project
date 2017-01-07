<div class="recipes view">
<h2><?php echo __('レシピ'); ?></h2>
<style>
#recipe_details_container{
	width:100%;
	fload:left;
}
#recipe_details{
	width:59%;
	float:left;
}
#recipe_pict{
	width:39%;
	float:left;
	margin:5px;
	/*padding:5px;*/
	text-align: center;
}
/** Scaffold View **/
#dl_recipe {
	line-height: 2em;
	margin: 0em 0em;
	width: 100%;
}
</style>
<div id="recipe_details_container">
<div id="recipe_details">
	<dl id="dl_recipe">
		<dt><?php echo __('レシピ名'); ?></dt>
		<dd>
			<?php echo h($recipe['Recipe']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('カテゴリー'); ?></dt>
		<dd>
			<?php
			switch($recipe['Recipe']['category']){
				case 0:
					echo "主食";
					break;
				case 1:
					echo "主菜";
					break;
				case 2:
					echo "副菜 和え物";
					break;
				case 3:
					echo "副菜 煮物";
					break;
				case 4:
					echo "副菜 サラダ";
					break;
				case 5:
					echo "副菜 その他(焼き物など)";
					break;
				case 6:
					echo "汁";
					break;
				default:
					break;
			} ?>
			&nbsp;
		</dd>
		<dt><?php echo __('アドバイス'); ?></dt>
		<dd>
			<?php echo h($recipe['Recipe']['advise']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('季節'); ?></dt>
		<dd>
			<?php
				switch($recipe['Recipe']['season']){
				case 0:
					echo "春";
					break;
				case 1:
					echo "夏";
					break;
				case 2:
					echo "秋";
					break;
				case 3:
					echo "冬";
					break;
				case 4:
					echo "一年を通じて";
				default:
					break;
			}
			 ?>
			&nbsp;
		</dd>
		<dt><?php echo __('カロリー'); ?></dt>
		<dd>
			<?php echo h($recipe['Recipe']['cal']); ?> カロリー
			&nbsp;
		</dd>
		<dt><?php echo __('脂質'); ?></dt>
		<dd>
			<?php echo h($recipe['Recipe']['fat']); ?> g
			&nbsp;
		</dd>
		<dt><?php echo __('タンパク質'); ?></dt>
		<dd>
			<?php echo h($recipe['Recipe']['protain']); ?> g
			&nbsp;
		</dd>
	</dl>
</div>

	<div id="recipe_pict">
		<div style="height:190px;width:350px;text-align:center;">
		<?php
			//画像があるかどうかを実体で検知
			$filename=$path.$recipe['Recipe']['main_pict'];
			$file_exsistency = file_exists($filename);

			if ($recipe['Recipe']['main_pict']&&$file_exsistency){
				//画像あり
				echo $this->Html->image($recipe['Recipe']['main_pict'],array('height'=>'190px'));
			}else{
				//画像なし
			 echo $this->Html->image('no_image.png');
			}
		?>
		</div>
		<?php
		//debug($recipe);
			echo $this->Form->create('Recipe',array('type'=>'file'));
			echo $this->Form->input('id',array('type'=>'hidden','value'=>$recipe['Recipe']['id']));
			echo $this->Form->input('type',array('type'=>'hidden','value'=>'file_upload'));
			echo $this->Form->input('file_name',array('type'=>'file','label'=>'画像をアップロードする'));
			if ($recipe['Recipe']['main_pict']){
				echo $this->Form->end(__('画像を更新'));
			}else{
				echo $this->Form->end(__('画像を登録'));
			}

		 ?>
	</div>

	</div>
	<div style="clear:both;" /></div>
	<div class="related">
	<h3><?php echo __('素材リスト'); ?></h3>
	<?php if (!empty($recipe['Ingredient'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('名前'); ?></th>
		<th><?php echo __('重さ'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($recipe['Ingredient'] as $ingredient): ?>
		<tr>
			<td><?php echo $ingredient['name']; ?></td>
			<td><?php echo $ingredient['weight']; ?> <?php
				switch($ingredient['weight_category']){
					case 0: echo "g";break;
					case 1: echo "cc";break;
					case 2:echo "手量り"; break;
				} ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('編集'), array('controller' => 'ingredients', 'action' => 'edit', $ingredient['id'])); ?>
				<?php echo $this->Form->postLink(__('削除'), array('controller' => 'ingredients', 'action' => 'delete', $ingredient['id']), array('confirm' => __('Are you sure you want to delete # %s?', $ingredient['id']))); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('材料を追加'), array('controller' => 'ingredients', 'action' => 'add',$recipe['Recipe']['id'])); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('手順一覧');?></h3>
	<?php if (!empty($recipe['Step'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('手順'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($recipe['Step'] as $step): ?>
		<tr>
			<td><?php echo $step['comment']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('手順を編集'), array('controller' => 'steps', 'action' => 'edit', $step['id'])); ?>
				<?php echo $this->Form->postLink(__('手順を削除'), array('controller' => 'steps', 'action' => 'delete', $step['id']), array('confirm' => __('Are you sure you want to delete # %s?', $step['id']))); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('手順を追加'), array('controller' => 'steps', 'action' => 'add',$recipe['Recipe']['id'])); ?> </li>
		</ul>
	</div>
</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('レシピを編集する'), array('action' => 'edit', $recipe['Recipe']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('レシピを削除する'), array('action' => 'delete', $recipe['Recipe']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $recipe['Recipe']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('一覧へ戻る'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('新しいレシピを登録する'), array('action' => 'add')); ?> </li>
	</ul>
</div>
