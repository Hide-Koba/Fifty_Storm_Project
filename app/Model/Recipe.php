<?php
App::uses('AppModel', 'Model');
/**
 * Recipe Model
 *
 */
class Recipe extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'recipe';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'name' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => '名前を入力して下さい',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'category' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'season' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'cal' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'カロリーを数字で入力して下さい',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'fat' => array(
			'decimal' => array(
				'rule' => array('decimal'),
				'message' => '脂質を数字で入力して下さい',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'protain' => array(
			'decimal' => array(
				'rule' => array('decimal'),
				'message' => 'タンパク質を数字で入力して下さい',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	 public $hasMany = array('Ingredient','Step');

	 public function define_season($date=null){
	 	if ($date==null){
	 		return false;
	 	}
		$season = 4;
		switch($date){
			default:
				return 4;
			case 1:
				$season=3;
				break;
			case 2:
				$season=3;
				break;
			case 3:
				$season=0;
				break;
			case 4:
				$season=0;
				break;
			case 5:
				$season=0;
				break;
			case 6:
				$season=1;
				break;
			case 7:
				$season=1;
				break;
			case 8:
				$season=1;
				break;
			case 9:
				$season=2;
				break;
			case 10:
				$season=2;
				break;
			case 11:
				$season=2;
				break;
			case 12:
				$season=3;
				break;
		}

		return $season;
	 }

	 public function get_previous_season($season=0){
	 	$season--;
	 	if ($season==-1){
			$season=3;//Winter
		}
	 	return $season;
	 }

	 public function get_next_season($season=0){
	 	$season++;
	 	if ($season==4){
			$season=0;//Winter
		}
	 	return $season;
	 }

	 public function gen_rnd($max=1){
	 	//$rnd_seed = (rand(0,$max)+rand(0,$max)+rand(0,$max)+rand(0,$max)+rand(0,$max))/5.0;
		$rnd_seed = rand(0,($max-1));
	 	return $rnd_seed;
	 }
	 public function get_subseason($date){
	 	//サブシーズンをreturnする。基本的には前の季節もしくは次の季節が入る。季節の中央であれば、同じ季節の品物が入る
		switch($date){
			default:
				return 4;
			case 1:
				$season=3;
				break;
			case 2:
				$season=0;
				break;
			case 3:
				$season=3;
				break;
			case 4:
				$season=0;
				break;
			case 5:
				$season=1;
				break;
			case 6:
				$season=0;
				break;
			case 7:
				$season=1;
				break;
			case 8:
				$season=2;
				break;
			case 9:
				$season=1;
				break;
			case 10:
				$season=2;
				break;
			case 11:
				$season=3;
				break;
			case 12:
				$season=2;
				break;
		}
	 	return $season;
	 }
	 public function set_rnd_season(){
	 	$rnd_seed = $this->gen_rnd(2);
		switch ($rnd_seed) {
			case 0:
				$season=0;
				break;
			case 1:
				$season=1;
				break;
			case 2:
				$season=2;
				break;
			default:
				$season=0;
				break;
		}
		return $season;
	 }

	 public function find_recipe($season=4){
	 	$recipe['main'] = $this->find('all',array('conditions'=>array('season'=>$season,'category'=>0)));

		$recipe['dish'] = $this->find('all',array('conditions'=>array('season'=>$season,'category'=>1)));

		$recipe['sub'] = $this->find('all',
			array(
				'conditions'=>array(
					array('season'=>$season)),
					array('OR'=>array('category'=>2)),
					array('OR'=>array('category'=>3)),
					array('OR'=>array('category'=>4)),
					array('OR'=>array('category'=>5)),
			)
		);

		$recipe['soup'] = $this->find('all',array('conditions'=>array('season'=>$season,'category'=>6)));
		//debug($recipe['soup']);

		//Count
		$recipe['cnt']['main_cnt'] = count($recipe['main']);
		$recipe['cnt']['dish_cnt'] = count($recipe['dish']);
		$recipe['cnt']['sub_cnt'] = count($recipe['sub']);
		$recipe['cnt']['soup_cnt'] = count($recipe['soup']);
		return $recipe;
	 }

	 public function find_joint_recipe($season=4){
		 //joint all recipe
	 	$recipe['main'] = $this->find('all',array('conditions'=>array('season'=>array($season,4),'category'=>0)));

		$recipe['dish'] = $this->find('all',array('conditions'=>array('season'=>array($season,4),'category'=>1)));

		$recipe['sub'] = $this->find('all',
			array(
				'conditions'=>array(
					array('season'=>array($season,4))),
					array('OR'=>array('category'=>2)),
					array('OR'=>array('category'=>3)),
					array('OR'=>array('category'=>4)),
					array('OR'=>array('category'=>5)),
			)
		);

		$recipe['soup'] = $this->find('all',array('conditions'=>array('season'=>array($season,4),'category'=>6)));
		//debug($recipe['soup']);

		//もし、絶対数が少なかったら、今度は全季節でもう一回やりなおし

		if (count($recipe['main'])<10){
			$recipe['main'] = $this->find('all',array('conditions'=>array('category'=>0)));
		}
		if (count($recipe['dish'])<10){
			$recipe['dish'] = $this->find('all',array('conditions'=>array('category'=>1)));
		}
		if (count($recipe['sub'])<10){
			$recipe['sub'] = $recipe['sub'] = $this->find('all',
				array(
					'conditions'=>array(
						array('OR'=>array('category'=>2)),
						array('OR'=>array('category'=>3)),
						array('OR'=>array('category'=>4)),
						array('OR'=>array('category'=>5)),
					)
				)
			);
		}
		if (count($recipe['soup'])<10){
			$recipe['soup'] = $this->find('all',array('conditions'=>array('category'=>6)));
		}

		//Count
		$recipe['cnt']['main_cnt'] = count($recipe['main']);
		$recipe['cnt']['dish_cnt'] = count($recipe['dish']);
		$recipe['cnt']['sub_cnt'] = count($recipe['sub']);
		$recipe['cnt']['soup_cnt'] = count($recipe['soup']);
		return $recipe;
	 }
	 public function gen_photourl(){
		 $url_rand = rand(1,3);//ここ、ベタ打ちなので注意
		 //仮環境URL
		 $url = 'http://localhost/fifty_recipe/img/fifty_'.$url_rand.'.png';
		 //本番環境URL
		 //$url = 'http://50storm.net/recipe_system/img/fifty_'.$url_rand.'.png';
		 return $url;
	 }
	 public function gen_goroku(){
		 $aisatsu = "";
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

		$word_rand = rand(0,(count($words)-1));

		 return $words[$word_rand];
	 }
	 public function pickrecipe($day_count=1){
	 	//Init Vars

	 	$recipe = array();

		$today = date('n');
		//echo $today;

		//Define months
		//Compare with today date and season
		//Spring3,4,5
		//Summer6,7,8
		//Autom9,10,11
		//Winter 12,1,2
		$season = $this->define_season($today);
		$sub_season = $this->get_subseason($today);

		$this_season_recipe = $this->find_recipe($season);
		//debug($this_season_recipe);

		//Get subseason Recipe
		$sub_season_recipe = $this->find_recipe($sub_season);

		//Get General Recipe
		$general_recipe = $this->find_recipe(4);


		//Make 3 loops
		//Lunch, Dinner
		for ($i=0;$i<$day_count;$i++){
			//主
			//decide season
			$cook_season = $this->set_rnd_season(2);
			//decide recipe
			switch ($cook_season) {
				case 0://current
					$recipe_no['main'] = $this_season_recipe['main'][$this->gen_rnd($this_season_recipe['cnt']['main_cnt'])];
					break;
				case 1://previous
					$recipe_no['main'] = $sub_season_recipe['main'][$this->gen_rnd($sub_season_recipe['cnt']['main_cnt'])];
				break;
				case 2://all year
					$recipe_no['main'] = $general_recipe['main'][$this->gen_rnd($general_recipe['cnt']['main_cnt'])];
				break;
			}
			//主菜
			//decide season
			$cook_season = $this->set_rnd_season(2);
			//decide recipe
			switch ($cook_season) {
				case 0://current
					$recipe_no['dish'] = $this_season_recipe['dish'][$this->gen_rnd($this_season_recipe['cnt']['dish_cnt'])];
					break;
				case 1://previous
					$recipe_no['dish'] = $sub_season_recipe['dish'][$this->gen_rnd($sub_season_recipe['cnt']['dish_cnt'])];
				break;
				case 2://all year
					$recipe_no['dish'] = $general_recipe['dish'][$this->gen_rnd($general_recipe['cnt']['dish_cnt'])];
				break;
			}

			//副
			//decide season
			$cook_season = $this->set_rnd_season(2);
			//decide recipe
			switch ($cook_season) {
				case 0://current
					$recipe_no['sub'] = $this_season_recipe['sub'][$this->gen_rnd($this_season_recipe['cnt']['sub_cnt'])];
					break;
				case 1://previous
					$recipe_no['sub'] = $sub_season_recipe['sub'][$this->gen_rnd($sub_season_recipe['cnt']['sub_cnt'])];
				break;
				case 2://all year
					$recipe_no['sub'] = $general_recipe['sub'][$this->gen_rnd($general_recipe['cnt']['sub_cnt'])];
				break;
			}
			//汁
			//decide season
			$cook_season = $this->set_rnd_season(2);
			//decide recipe
			if (($this_season_recipe['cnt']['soup_cnt']==0)||($sub_season_recipe['cnt']['soup_cnt']==0)){
				$cook_season=2;
			}
			switch ($cook_season) {
				case 0://current
					$recipe_no['soup'] = $this_season_recipe['soup'][$this->gen_rnd($this_season_recipe['cnt']['soup_cnt'])];
					break;
				case 1://previous
					$recipe_no['soup'] = $sub_season_recipe['soup'][$this->gen_rnd($sub_season_recipe['cnt']['soup_cnt'])];
				break;
				case 2://all year
					$recipe_no['soup'] = $general_recipe['soup'][$this->gen_rnd($general_recipe['cnt']['soup_cnt'])];
				break;
			}
			//Set Lunch
			//debug($recipe_no['main']);
			$recipe[$i][0][0]=$recipe_no['main'];
			$recipe[$i][0][1]=$recipe_no['dish'];
			$recipe[$i][0][2]=$recipe_no['sub'];
			$recipe[$i][0][3]=$recipe_no['soup'];

			//Dinner
			//主
			//decide season
			$cook_season = $this->set_rnd_season(3);
			//decide recipe
			switch ($cook_season) {
				case 0://current
					$recipe_no['main'] = $this_season_recipe['main'][$this->gen_rnd($this_season_recipe['cnt']['main_cnt'])];
					break;
				case 1://previous
					$recipe_no['main'] = $sub_season_recipe['main'][$this->gen_rnd($sub_season_recipe['cnt']['main_cnt'])];
				break;
				case 2://all year
					$recipe_no['main'] = $general_recipe['main'][$this->gen_rnd($general_recipe['cnt']['main_cnt'])];
				break;
			}
			//主菜
			//decide season
			$cook_season = $this->set_rnd_season(3);
			//decide recipe
			switch ($cook_season) {
				case 0://current
					$recipe_no['dish'] = $this_season_recipe['dish'][$this->gen_rnd($this_season_recipe['cnt']['dish_cnt'])];
					break;
				case 1://previous
					$recipe_no['dish'] = $sub_season_recipe['dish'][$this->gen_rnd($sub_season_recipe['cnt']['dish_cnt'])];
				break;
				case 2://all year
					$recipe_no['dish'] = $general_recipe['dish'][$this->gen_rnd($general_recipe['cnt']['dish_cnt'])];
				break;
			}

			//副
			//decide season
			$cook_season = $this->set_rnd_season(3);
			//decide recipe
			switch ($cook_season) {
				case 0://current
					$recipe_no['sub'] = $this_season_recipe['sub'][$this->gen_rnd($this_season_recipe['cnt']['sub_cnt'])];
					break;
				case 1://previous
					$recipe_no['sub'] = $sub_season_recipe['sub'][$this->gen_rnd($sub_season_recipe['cnt']['sub_cnt'])];
				break;
				case 2://all year
					$recipe_no['sub'] = $general_recipe['sub'][$this->gen_rnd($general_recipe['cnt']['sub_cnt'])];
				break;
			}
			//汁
			//decide season
			$cook_season = $this->set_rnd_season(3);
			//decide recipe
			switch ($cook_season) {
				case 0://current
					$recipe_no['soup'] = $this_season_recipe['soup'][$this->gen_rnd($this_season_recipe['cnt']['soup_cnt'])];
					break;
				case 1://previous
					$recipe_no['soup'] = $sub_season_recipe['soup'][$this->gen_rnd($sub_season_recipe['cnt']['soup_cnt'])];
				break;
				case 2://all year
					$recipe_no['soup'] = $general_recipe['soup'][$this->gen_rnd($general_recipe['cnt']['soup_cnt'])];
				break;
			}

			//Set Dinner
			$recipe[$i][1][0]=$recipe_no['main'];
			$recipe[$i][1][1]=$recipe_no['dish'];
			$recipe[$i][1][2]=$recipe_no['sub'];
			$recipe[$i][1][3]=$recipe_no['soup'];
		}
		//debug($recipe);
		//return Recipe
		return $recipe;
	 }

	 public function pickrecipe2($day_count=1){
		 //check args
		 //echo $day_count;

		 //check this month
		 $thismonth = date('n');
 		//echo "Month".$thismonth;
		//echo "<br>";
		$thisseason = $this->define_season($thismonth);//0:spring(3-5), 1:summer(6-8), 2:autom(9-11), 3:winter(12-2)
		//$otherseason = $this->define_season(12);
		//echo "Season No".$thisseason;
		//echo "<br>";

		//get General Recipe
		$general_recipe = $this->find_recipe(4);
		$seasonal_recipe = $this->find_recipe($thisseason);
		$joint_recipe = $this->find_joint_recipe($thisseason);
		/*
		echo "No. joint main recipe:".count($joint_recipe['main'])."<br>";
		echo "No. joint dish recipe:".count($joint_recipe['dish'])."<br>";
		echo "No. joint sub recipe:".count($joint_recipe['sub'])."<br>";
		echo "No. joint soup recipe:".count($joint_recipe['soup'])."<br>";
echo "<br>";
		echo "No. main recipe general:".count($general_recipe['main'])."<br>";
		echo "No. dish recipe general:".count($general_recipe['dish'])."<br>";
		echo "No. sub recipe general:".count($general_recipe['sub'])."<br>";
		echo "No. soup recipe general:".count($general_recipe['soup'])."<br>";
echo "<br>";
		echo "No. main recipe seasonal:".count($seasonal_recipe['main'])."<br>";
		echo "No. dish recipe seasonal:".count($seasonal_recipe['dish'])."<br>";
		echo "No. sub recipe seasonal:".count($seasonal_recipe['sub'])."<br>";
		echo "No. soup recipe seasonal:".count($seasonal_recipe['soup'])."<br>";

		echo "<br>";
		echo "<pre>";
		//var_dump($general_recipe);
		echo "</pre>";
		echo "No. recipe seasonal:".count($seasonal_recipe);
		echo "<br>";*/

		for ($i=0;$i<$day_count;$i++){
			//昼
			//主食
			$recipe[$i][0][0] = $joint_recipe['main'][$this->gen_rnd($joint_recipe['cnt']['main_cnt'])];
			//主菜
			$recipe[$i][0][1] = $joint_recipe['dish'][$this->gen_rnd($joint_recipe['cnt']['dish_cnt'])];
			//副菜
			$recipe[$i][0][2] = $joint_recipe['sub'][$this->gen_rnd($joint_recipe['cnt']['sub_cnt'])];
			//汁
			$recipe[$i][0][3] = $joint_recipe['soup'][$this->gen_rnd($joint_recipe['cnt']['soup_cnt'])];

			//夜
			//主食
			$recipe[$i][1][0] = $joint_recipe['main'][$this->gen_rnd($joint_recipe['cnt']['main_cnt'])];
			//主菜
			$recipe[$i][1][1] = $joint_recipe['dish'][$this->gen_rnd($joint_recipe['cnt']['dish_cnt'])];
			//副菜
			$recipe[$i][1][2] = $joint_recipe['sub'][$this->gen_rnd($joint_recipe['cnt']['sub_cnt'])];
			//汁
			$recipe[$i][1][3] = $joint_recipe['soup'][$this->gen_rnd($joint_recipe['cnt']['soup_cnt'])];
		}




		 return $recipe;
	 }


}
