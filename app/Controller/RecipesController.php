<?php
App::uses('AppController', 'Controller','String');
/**
 * Recipes Controller
 *
 * @property Recipe $Recipe
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class RecipesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session', 'Flash');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Recipe->recursive = 0;
		$this->set('recipes', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */

 public function checkext($name){
	 $arr = explode('.', $name);
	 $ext = array_pop($arr);
	 return $ext;
 }
	public function view($id = null) {
		//$sd = "C:\\xampp\htdocs\\fifty_recipe\app\webroot\img\\";
		$sd = "../../app/webroot/img/";

		$this->set('path',$sd);

		if ($this->request->data){
			if ($this->request->data['Recipe']['type']==="file_upload"){
				//イメージファイルかどうかを確認
				//if(file_exists($this->request->data['Recipe']['file_name']['tmp_name']) && exif_imagetype($this->request->data['Recipe']['file_name']['tmp_name'])){
				if(file_exists($this->request->data['Recipe']['file_name']['tmp_name'])){
					//ファイル名をUUIDへ変換
					$ext = $this->checkext($this->request->data['Recipe']['file_name']['name']);
					$filename = CakeText::uuid().".".$ext;
					$uploadfile = $sd . basename($filename);

					//ファイルの移動と保存
					if (move_uploaded_file($this->data['Recipe']['file_name']['tmp_name'], $uploadfile)){
						//write to DB
						$this->Recipe->id = $this->request->data['Recipe']['id'];
						$this->Recipe->saveField('main_pict',$filename);
					}else{
					}
				}
			}
		}
		if (!$this->Recipe->exists($id)) {
			throw new NotFoundException(__('Invalid recipe'));
		}
		$options = array('conditions' => array('Recipe.' . $this->Recipe->primaryKey => $id));
		$this->set('recipe', $this->Recipe->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->loadModel('Ingredient');
		$this->loadModel('Step');
		if ($this->request->is('post')) {
			//debug($this->request->data);
			//check and trim blank column at Ingredient and Step
			$cnt=0;
			foreach ($this->request->data['Ingredient'] as $var){
				if ($var['name']===""){
					unset($this->request->data['Ingredient'][$cnt]);
				}
				$cnt++;
			}
			$cnt=0;
			foreach($this->request->data['Step'] as $var){
				if ($var['comment']===""){
					unset($this->request->data['Step'][$cnt]);
				}
				$cnt++;
			}

			$this->Recipe->create();
			if ($this->Recipe->saveAll($this->request->data)) {
				$this->Flash->success(__('The recipe has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The recipe could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Recipe->exists($id)) {
			throw new NotFoundException(__('Invalid recipe'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Recipe->save($this->request->data)) {
				$this->Flash->success(__('The recipe has been saved.'));
				return $this->redirect(array('action' => 'view',$id));
			} else {
				$this->Flash->error(__('The recipe could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Recipe.' . $this->Recipe->primaryKey => $id));
			$this->request->data = $this->Recipe->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Recipe->id = $id;
		if (!$this->Recipe->exists()) {
			throw new NotFoundException(__('Invalid recipe'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Recipe->delete()) {
			$this->Flash->success(__('The recipe has been deleted.'));
		} else {
			$this->Flash->error(__('The recipe could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	//Pick three
	public function pickthree(){
		$this->layout = 'recipe_view';
		if ($this->request->data){
			$number_adult = $this->request->data['Recipe']['number_adult'];
			$number_child = $this->request->data['Recipe']['number_child'];

			//Get Recipe
			$recipe = $this->Recipe->pickrecipe(3);
			//$recipe = $this->Recipe->multiplier($recipe,$number_adult,$number_child);
			$this->set('recipe',$recipe);
			$this->set('n_ad',$number_adult);
			$this->set('n_ch',$number_child);

			//
			$comment = 'よし、大人'.$number_adult.'人と、こども'.$number_child.'人の料理やな。ちょっとまっとりゃーよ。ちゃーっとしらべてくるで。';
			$late_comment="こんなんでどうかね？";
			$this->set('late_comment',$late_comment);
		}
		$options = array();
		for ($i=1;$i<11;$i++){
			$options[$i]=$i;
		}
		$this->set('options',$options);


		//Set Comment
		if (!isset($comment)){
			$comment = 'なにしとりゃーす？';
		}
		//$this->Recipe->
		$this->set('comment',$comment);

	}
}
