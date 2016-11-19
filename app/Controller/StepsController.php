<?php
App::uses('AppController', 'Controller');
/**
 * Steps Controller
 *
 * @property Step $Step
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class StepsController extends AppController {

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
		$this->Step->recursive = 0;
		$this->set('steps', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Step->exists($id)) {
			throw new NotFoundException(__('Invalid step'));
		}
		$options = array('conditions' => array('Step.' . $this->Step->primaryKey => $id));
		$this->set('step', $this->Step->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($id=null) {
		if ($this->request->is('post')) {
			$forward_id = $this->request->data['Step']['recipe_id'];
			//Normal add&update
			if ($this->request->data['Step']['add_option']==0){
					//check counter and add steps
					$counter = $this->Step->find('count',array('conditions'=>array('recipe_id'=>$this->request->data['Step']['recipe_id'])));
					$counter++;
					$this->request->data['Step']['step_count'] = $counter;
					$this->Step->create();
				if ($this->Step->save($this->request->data)) {
					$this->Flash->success(__('The qitem has been saved.'));
					return $this->redirect(array('controller'=>'Recipes','action' => 'view',$forward_id));
				} else {
					$this->Flash->error(__('The qitem could not be saved. Please, try again.'));
				}
			}else{
				$add_option = $this->request->data['Step']['add_option'];
				//Inturrupt Update
				$updater = $this->Step->intrrupt_update_prepare($this->request->data['Step'],$add_option);
				//Delete current holding records
				$cnt=0;
				foreach ($updater as $update){
					if (!isset($update['Step']['id'])){continue;}
					$del_id[$cnt] = $update['Step']['id']; 
					$cnt++;
				}
				$this->Step->deleteAll(array('id'=>$del_id),false); //Don't forget false
				
				//Unset all IDs to update as "NEW"
				$cnt=0;
				foreach ($updater as $update){
					unset($updater[$cnt]['Step']['id']);
					$cnt++;
				}
				
				//update all
				$this->Step->create();
				if ($this->Step->saveAll($updater)) {
					$this->Flash->success(__('The qitem has been saved.'));
					return $this->redirect(array('controller'=>'Recipes','action' => 'view',$forward_id));
				} 
			}
			
		}
		$recipes = $this->Step->Recipe->find('list');
		$this->set(compact('recipes'));
		$this->set('backward_id',$id);
		$this->set('add_options',$this->Step->set_add_options($id));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Step->exists($id)) {
			throw new NotFoundException(__('Invalid step'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Step->save($this->request->data)) {
				$this->Flash->success(__('The step has been saved.'));
				return $this->redirect(array('controller'=>'Recipes','action' => 'view',$this->request->data['Step']['recipe_id']));
			} else {
				$this->Flash->error(__('The step could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Step.' . $this->Step->primaryKey => $id));
			$this->request->data = $this->Step->find('first', $options);
		}
		$recipes = $this->Step->Recipe->find('list');
		$this->set(compact('recipes'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Step->id = $id;
		
		//check backward_id
		$delete_object = $this->Step->find('first',array('conditions'=>array('Step.id'=>$id)));
		$backward_id = $delete_object['Step']['recipe_id'];
		if (!$this->Step->exists()) {
			throw new NotFoundException(__('Invalid step'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Step->delete()) {
			$this->Flash->success(__('The step has been deleted.'));
		} else {
			$this->Flash->error(__('The step could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('controller'=>'Recipes','action' => 'view',$backward_id));
	}
}
