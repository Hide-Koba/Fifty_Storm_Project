<style>
	.base{
		/*width:640px;*/
		/*width:500px;*/
		width:85%;
		border:#000000 1px;
	}
	#head{
		border:#ff0000 1px;
	}
	#recipe_input{
		border:#ffff00 1px;
	}
	#lunch{
		border:#00ff00 1px;
	}
	#dinner{
		border:#0000ff 1px;
	}
</style>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
$("#parent-iframe", window.parent.document).height(document.body.scrollHeight);
});
</script>
<?php
if (isset($n_ad)){
	$n_ad = (int)$n_ad;
	//debug($n_ad);
}

function show_weightcategory($size,$weight_category,$n_ad,$n_ch){
	$i_size=$size;
	$size = ($i_size*$n_ad)+($i_size*($n_ch*0.8));
	$sentence="";
	switch($weight_category){
		case 0:
		$sentence= $size." g";
		break;
		case 1:
			$sentence= $size." cc";
		break;
		case 2:
			$sentence= "手量りで".$size."つかみほど";
		break;
		default:
		break;
		}
		return $sentence;
}

function gogoku(){
	$words = array(
		"最近はみんな一週間分まとめ買いだけど、野菜は三日間しかもたんでね",
"五日間の買い物計画でも良いけど、とりあえず三日間だね",
"朝は玉子、昼は肉、夜は魚って覚えときゃぁよ",
"ちゃんとご飯は食べなかんよ",
"お腹周りが気になって来たら三口食べたらお茶を飲みな",
"口の中でお粥を作りな",
"野菜を食べなよ",
"かぼちゃは冬至を過ぎると味が落ちるからね",
"弁当の日を作っとるか",
"食事は口に入るまでは文化、口の中に入ったら科学",
"どじょうはうなぎと同じ栄養価だからね",
"べろメーターを大切に",
"おしょう油とみりんを同量のものを作っておきなよ。それを急ぎの時に使うとお助けマンになるよ",
"健康の素は食事だよ"
	);

	$rnd = rand(0,count($words));
	return $words[$rnd];
}
?>

<div id="head" class="base">
	<!-- Photo section -->
	<?php
		$max=3;
		$rnd_seed = (rand(0,$max)+rand(0,$max)+rand(0,$max)+rand(0,$max)+rand(0,$max))/5.0;
		switch($rnd_seed){
			case 0:
				$igarashi_photo="fifty_1.png";
			break;
			case 1:
				$igarashi_photo="fifty_2.png";
			break;
			case 2:
				$igarashi_photo="fifty_3.png";
			break;
			default:
				$igarashi_photo="fifty_1.png";
			break;
		}
		echo $this->Html->image($igarashi_photo);
	?>
</div>
<div id="comment" class="base">
	<!-- Comment section -->
<?php echo $comment ?><br />
	<?php echo gogoku(); ?>
	<!-- Comment section END -->
</div>
<div id="recipe_input" class="base">
	<!-- Recipe Input Section -->
	<?php echo $this->Form->create('Recipe'); ?>
	<?php echo $this->Form->input('number_adult',array('options'=>$options,'label'=>'あんたんとこ何人？')); ?>
	<?php echo $this->Form->submit('レシピを教えて！');?>
	<?php echo $this->Form->end(); ?>
	<!-- Recipe Input Section END-->
</div>
<div id="recipe_area" class="base">
	<?php
		$days = count($recipe);
		for ($i=0;$i<$days;$i++){

			?>
			<hr />
			<div id="lunch">
				<?= date('Y年m月d日', strtotime($i.' day', time()));?>
				<h1>お昼ごはん</h1>
				<div>
					<h2>主食:<?php echo($recipe[$i][0][0]['Recipe']['name']); ?></h2>
					<div>
						<?php
						if ($recipe[$i][0][0]['Recipe']['main_pict']===""){
						}else{
							?><img src="http://50storm.net/recipe_system/img/<?php echo($recipe[$i][0][0]['Recipe']['main_pict']); ?>" height="190px" />
							<?php
						}
						 ?>
					</div>
					<div>手順
						<ol>
							<?php foreach($recipe[$i][0][0]['Step'] as $step ){
								?>
								<li><?= $step['comment']?></li>
								<?php
							}
							?>
						</ol>
					</div>
					<div>材料
						<ul>
						<?php foreach($recipe[$i][0][0]['Ingredient'] as $ingredient){
							?>
							<li><?= $ingredient['name']." ".show_weightcategory($ingredient['weight'],$ingredient['weight_category'],$n_ad,$n_ch)?></li>
							<?php
						}
						?>
						</ul>
					</div>
				</div>
				<div>
					<h2>主菜:<?php echo($recipe[$i][0][1]['Recipe']['name']); ?></h2>
					<div>
						<?php
						if ($recipe[$i][0][1]['Recipe']['main_pict']===""){
						}else{
							?><img src="http://50storm.net/recipe_system/img/<?php echo($recipe[$i][0][1]['Recipe']['main_pict']); ?>" height="190px" />
							<?php
						}
						 ?>
					</div>
					<div>手順
						<ol>
							<?php foreach($recipe[$i][0][1]['Step'] as $step ){
								?>
								<li><?= $step['comment']?></li>
								<?php
							}
							?>
						</ol>
					</div>
					<div>材料
						<ul>
						<?php foreach($recipe[$i][0][1]['Ingredient'] as $ingredient){
							?>
							<li><?= $ingredient['name']." ".show_weightcategory($ingredient['weight'],$ingredient['weight_category'],$n_ad,$n_ch)?></li>
							<?php
						}
						?>
						</ul>
					</div>
				</div>
				<div>
					<h2>副菜:<?php echo($recipe[$i][0][2]['Recipe']['name']); ?></h2>
					<div>
						<?php
						if ($recipe[$i][0][2]['Recipe']['main_pict']===""){
						}else{
							?><img src="http://50storm.net/recipe_system/img/<?php echo($recipe[$i][0][2]['Recipe']['main_pict']); ?>" height="190px" />
							<?php
						}
						 ?>
					</div>
					<div>手順
						<ol>
							<?php foreach($recipe[$i][0][2]['Step'] as $step ){
								?>
								<li><?= $step['comment']?></li>
								<?php
							}
							?>
						</ol>
					</div>
					<div>材料
						<ul>
						<?php foreach($recipe[$i][0][2]['Ingredient'] as $ingredient){
							?>
							<li><?= $ingredient['name']." ".show_weightcategory($ingredient['weight'],$ingredient['weight_category'],$n_ad,$n_ch)?></li>
							<?php
						}
						?>
						</ul>
					</div>
				</div>
				<div>
					<h2>汁:<?php echo($recipe[$i][0][3]['Recipe']['name']); ?></h2>
					<div>
						<?php
						if ($recipe[$i][0][3]['Recipe']['main_pict']===""){
						}else{
							?><img src="http://50storm.net/recipe_system/img/<?php echo($recipe[$i][0][3]['Recipe']['main_pict']); ?>" height="190px" />
							<?php
						}
						 ?>
					</div>
					<div>手順
						<ol>
							<?php foreach($recipe[$i][0][3]['Step'] as $step ){
								?>
								<li><?= $step['comment']?></li>
								<?php
							}
							?>
						</ol>
					</div>
					<div>材料
						<ul>
						<?php foreach($recipe[$i][0][3]['Ingredient'] as $ingredient){
							?>
							<li><?= $ingredient['name']." ".show_weightcategory($ingredient['weight'],$ingredient['weight_category'],$n_ad,$n_ch)?></li>
							<?php
						}
						?>
						</ul>
					</div>
				</div>
			</div>

			<hr />

			<div id="dinner">
			<?= date('Y年m月d日', strtotime($i.' day', time()));?>
			<h1>夜ごはん</h1>
			<div>
				<h2>主食:<?php echo($recipe[$i][1][0]['Recipe']['name']); ?></h2>
				<div>
					<?php
					if ($recipe[$i][1][0]['Recipe']['main_pict']===""){
					}else{
						?><img src="http://50storm.net/recipe_system/img/<?php echo($recipe[$i][1][0]['Recipe']['main_pict']); ?>" height="190px" />
						<?php
					}
					 ?>
				</div>
				<div>手順
					<ol>
						<?php foreach($recipe[$i][1][0]['Step'] as $step ){
							?>
							<li><?= $step['comment']?></li>
							<?php
						}
						?>
					</ol>
				</div>
				<div>材料
					<ul>
					<?php foreach($recipe[$i][1][0]['Ingredient'] as $ingredient){
						?>
						<li><?= $ingredient['name']." ".show_weightcategory($ingredient['weight'],$ingredient['weight_category'],$n_ad,$n_ch)?></li>
						<?php
					}
					?>
					</ul>
				</div>
			</div>
			<div>
				<h2>主菜:<?php echo($recipe[$i][1][1]['Recipe']['name']); ?></h2>
				<div>
					<?php
					if ($recipe[$i][1][1]['Recipe']['main_pict']===""){
					}else{
						?><img src="http://50storm.net/recipe_system/img/<?php echo($recipe[$i][1][1]['Recipe']['main_pict']); ?>" height="190px" />
						<?php
					}
					 ?>
				</div>
				<div>手順
					<ol>
						<?php foreach($recipe[$i][1][1]['Step'] as $step ){
							?>
							<li><?= $step['comment']?></li>
							<?php
						}
						?>
					</ol>
				</div>
				<div>材料
					<ul>
					<?php foreach($recipe[$i][1][1]['Ingredient'] as $ingredient){
						?>
						<li><?= $ingredient['name']." ".show_weightcategory($ingredient['weight'],$ingredient['weight_category'],$n_ad,$n_ch)?></li>
						<?php
					}
					?>
					</ul>
				</div>
			</div>
			<div>
				<h2>副菜:<?php echo($recipe[$i][1][2]['Recipe']['name']); ?></h2>
				<div>
					<?php
					if ($recipe[$i][1][2]['Recipe']['main_pict']===""){
					}else{
						?><img src="http://50storm.net/recipe_system/img/<?php echo($recipe[$i][1][2]['Recipe']['main_pict']); ?>" height="190px" />
						<?php
					}
					 ?>
				</div>
				<div>手順
					<ol>
						<?php foreach($recipe[$i][1][2]['Step'] as $step ){
							?>
							<li><?= $step['comment']?></li>
							<?php
						}
						?>
					</ol>
				</div>
				<div>材料
					<ul>
					<?php foreach($recipe[$i][1][2]['Ingredient'] as $ingredient){
						?>
						<li><?= $ingredient['name']." ".show_weightcategory($ingredient['weight'],$ingredient['weight_category'],$n_ad,$n_ch)?></li>
						<?php
					}
					?>
					</ul>
				</div>
			</div>
			<div>
				<h2>汁:<?php echo($recipe[$i][1][3]['Recipe']['name']); ?></h2>
				<div>
					<?php
					if ($recipe[$i][1][3]['Recipe']['main_pict']===""){
					}else{
						?><img src="http://50storm.net/recipe_system/img/<?php echo($recipe[$i][1][3]['Recipe']['main_pict']); ?>" height="190px" />
						<?php
					}
					 ?>
				</div>
				<div>手順
					<ol>
						<?php foreach($recipe[$i][1][3]['Step'] as $step ){
							?>
							<li><?= $step['comment']?></li>
							<?php
						}
						?>
					</ol>
				</div>
				<div>材料
					<ul>
					<?php foreach($recipe[$i][1][3]['Ingredient'] as $ingredient){
						?>
						<li><?= $ingredient['name']." ".show_weightcategory($ingredient['weight'],$ingredient['weight_category'],$n_ad,$n_ch)?></li>
						<?php
					}
					?>
					</ul>
				</div>
			</div>
			</div>
			<?php
		}
	?>
</div>
	<div id="late_comment" class="base">
		<?php if (isset($late_comment)){
			echo $late_comment;
		} ?>
	</div>
