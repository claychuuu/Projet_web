<?php
	class ArchivesController extends AppController {
		var $name = 'Archives';

		public function index() {
			$this->layout = 'default2';
			$data = $this->Archive->find('all', array(
				'order'=>array('created'=>'desc')
			));
			$this->set('archive', $data);
		}

		function resultSearch($search = null) {

			if ($this->request->is('ajax')) {
				$this->layout = 'ajax';

				$data = $this->request->params['pass'][0];
				$query = $this->Archive->find('all', array('conditions'=>array('Archive.query LIKE'=>'%'.$data.'%')));

				$i = 0;
				foreach ($query as $q) {
					echo '<a href="/Projet_web/sitecollaboratif/archives#'.$query[$i]['Archive']['id'].'">' . $query[$i]['Archive']['query'] . '</a><br/>';
					$i++;
				}
				die();
			} else {
				$this->redirect($this->referer());
			}
	    }

		public function question($msg) {
			$this->autoRender = false;

			if (empty($this->request->params['pass'][0]))
				die();

			if ($this->request->is('ajax')) {
				$data['Archives']['query'] = $this->request->params['pass'][0];
				$this->Archive->save($data['Archives']);
				die();
			}
		}

		public function reponse($qst, $msg) {
			$this->autoRender = false;

			if ($this->request->is('ajax')) {

				$query = $this->Archive->find('first', array(
					'conditions' => array('query'=>$qst)
					)
				);

				if ($query == null) {
					echo __("Aucune question ne correspond à votre demande");
					die();
				}

				$this->Archive->id = $query['Archive']['id'];
				$this->Archive->saveField('answer', $msg);

				echo __("Réponse enregistrée !");
			}
		}

		public function question_test($id_question, $current_user) {}

		public function reponse_test($id_answer, $current_user) {
			$this->autoRender = false;

			if ($this->request->is('ajax')) {
				if ($id_answer == null || $current_user == null) {
					echo "error";
					die();
				}
				echo "ok";
				die();
			}
		}
	}
