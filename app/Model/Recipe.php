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
	 	$rnd_seed = (rand(0,$max)+rand(0,$max)+rand(0,$max)+rand(0,$max)+rand(0,$max))/5.0;
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
}
