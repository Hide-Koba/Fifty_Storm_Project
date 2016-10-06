<?php echo $this->Html->script( 'jquery-1.9.1', array( 'inline' => true ) ); ?>
<script>
$(function() {

$('#add-option-button').click(function(event){
	//console.log("test");
    var optionCount = ($('#poll-options > div').size()/3);
    
    var inputHtml = '<div class="input text"><label for="Ingredient' + optionCount + 'Name">材料 ' + (optionCount+1)
        + '</label><input id="Ingredient' + optionCount + 'Name" type="text" name="data[Ingredient][' + optionCount + '][name]" />'+
        '</div><div class="input text"><label for="Ingredient' + optionCount + 'weight">数量 ' + (optionCount+1)
        + '</label><input id="Ingredient' + optionCount + 'weight" type="text" name="data[Ingredient][' + optionCount + '][weight]" />'+
        '</div><div class="input select"><label for="Ingredient' + optionCount + 'weight_category">単位 ' + (optionCount+1)
        + '</label><select id="Ingredient' + optionCount + 'weight_category" name="data[Ingredient][' + optionCount + '][weight_category]"><option value="0">g</option><option value="1">cc</option><option value="2">手量り</option></select>'
        +'</div>';
    event.preventDefault();
    $('#poll-options').append(inputHtml);
});
$('#add-step-button').click(function(event){
	//console.log("test");
    var optionCount = $('#step-options > div').size();
    var inputHtml = '<input id="Step' + optionCount + 'Name" type="hidden" value='+optionCount+' name="data[Step][' + optionCount + '][step_count]" />'+
        '</div><div class="input text"><label for="Step' + optionCount + 'comment">工程 ' + (optionCount+1)
        + '</label><input id="Step' + optionCount + 'comment" type="text" name="data[Step][' + optionCount + '][comment]" />'+
        '</div>';
    event.preventDefault();
    $('#step-options').append(inputHtml);
});
});
</script>
<div class="recipes form">
<?php echo $this->Form->create('Recipe'); ?>
	<fieldset>
		<legend><?php echo __('五十嵐プロジェクト・レシピ・入力フォーム'); ?></legend>
	<?php
		echo $this->Form->input('Recipe.name',array('label'=>'料理名を入力して下さい'));
		$categories = array(
		'主食','主菜','副菜 和え物', '副菜 煮物', '副菜 サラダ', '副菜 その他(焼き物など)', '汁'
		);
		echo $this->Form->input('Recipe.category',array('label'=>'種別を選んでください','options'=>$categories));
		?>
		
		<div id="poll-options">
<?php 
//if (isset($this->data['Ingredient'])) {
    $i = 0;
    //foreach ($this->data['Ingredient'] as $opt) {
        //echo $form->hidden("Ingredient.$i.id");
        echo $this->Form->input("Ingredient.$i.name", array('label' => "材料 " . ($i + 1)));
		echo $this->Form->input("Ingredient.$i.weight", array('label' => "数量 " . ($i+1)));
		$weight_category_selecter = array(
		'g', 'cc', '手量り'
		);
		echo $this->Form->input("Ingredient.$i.weight_category", array('label' => "単位 " . ($i+1), 'options'=>$weight_category_selecter));
        $i++;
    //}
//}
?>
</div>
<input type="button" value="材料追加" id="add-option-button">
		<div id="step-options">
			<?php 
//if (isset($this->data['Ingredient'])) {
    $i = 0;
    //foreach ($this->data['Ingredient'] as $opt) {
        echo $this->Form->hidden("Ingredient.$i.step_count",array('value'=>$i+1));
        echo $this->Form->input("Step.$i.comment", array('label' => "手順 " . ($i + 1)));
        $i++;
    //}
//}
?>
		</div>
		<input type="button" value="手順追加" id="add-step-button">
		<?php
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
<?php echo $this->Form->end(__('送信')); ?>
</div>
<div class="actions">
	<h3><?php echo __('メニュー'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('レシピリストに戻る'), array('action' => 'index')); ?></li>
	</ul>
</div>
