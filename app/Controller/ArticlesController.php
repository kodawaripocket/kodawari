<?php
class ArticlesController extends AppController {
	public $uses    = array('Article', 'Categories', 'Sub_categories', 'Genre', 'User', 'Bad_user', 'Good_user');
	public $helpers = array('Html', 'Form');

	//認証用コンポーネント　ログインしたユーザーの情報を得るのに必要です。
	public $components = array('Auth','Search.Prg');
	//public $class = $this;

	public $paginate = array(
		'page'  => 1,
		'limit' => 5,
		'order' => array('' => 'dsc')
	);

	public function index() {
		$this->Session->write('login_user_id', '0312015091');
		$this->set('articles', $this->paginate());
	}

	public function result() {
	    // 検索条件設定
	    $this->Prg->commonProcess();
	    if (isset($this->passedArgs['search_word'])) {
	        //条件を生成
	        $conditions = $this->Article->parseCriteria($this->passedArgs);

	        $this->paginate = array(
	            'conditions' => $conditions,
	            'limit' => 20,
	            'order' => array(
	            'id' => 'desc'
	            )
	        );
	        $this->set('articles', $this->paginate('Article'));
			$this->render('index');
	    }
		$this->render('index');
	}
	public function form() {
		$this->Session->write('login_user_id', '0312015091');
		$this->set('category_id', $this->Categories->find('list',
				array('fields' => array('category_id', 'name'))));
		$this->set('sub_category_id', $this->Sub_categories->find('list',
				array('fields' => array('sub_category_id', 'name'))));
		$this->set('genre_id', $this->Genre->find('list',
				array('fields' => array('genre_id', 'name'))));
	}
	public function check() {
		if ($this->request->is('post')) {
			$this->request->data["Article"]["content"];
			$this->Article->save($this->data);
		}
	}

	public function view($article_id = null) {
		$user_id = $this->Auth->user('user_id');
		$this->set('user_id', $user_id);
		$this->Article->article_id = $article_id;

		//article_idで取得
		$conditions = array("article_id"                               => $article_id);
		$article    = $this->Article->find('first', array('conditions' => $conditions));

		//user_idで取得
		$evaluator = array("user_id"                                    => $user_id, "article_id"                                    => $article_id);
		$good      = $this->Good_user->find('first', array('conditions' => $evaluator));
		$bad       = $this->Bad_user->find('first', array('conditions'  => $evaluator));

		$this->set('article', $article);
		$this->set('good', $good);
		$this->set('bad', $bad);
		$this->set('category', $this->Categories->find('list',
				array('fields' => array('category_id', 'name'))));
		$this->set('sub_category', $this->Sub_categories->find('list',
				array('fields' => array('sub_category_id', 'name'))));
		$this->set('genre', $this->Genre->find('list',
				array('fields' => array('genre_id', 'name'))));
		$this->disableCache();
	}

	//いいねわるいねの更新
	function update($article_id, $judge, $add) {
		$conditions = array("article_id"                               => $article_id);
		$article    = $this->Article->find('first', array('conditions' => $conditions));
		$user_id    = $this->Auth->user('user_id');
		if ($judge == 1) {
			if ($add == 1) {
				$good_date   = array('article_id' => $article_id, 'user_id' => $user_id);
				$good_fields = array('article_id', 'user_id');
				$this->Good_user->save($good_date, false, $good_fields);
				$this->Article->updateAll(
					array('good_sum'   => $article['Article']['good_sum']+1),
					array('article_id' => $article_id));
			} else {
				$deletefields = array("user_id" => $user_id);
				$deletedate   = $this->Good_user->deleteAll($deletefields);
				$this->Article->updateAll(
					array('good_sum'   => $article['Article']['good_sum']-1),
					array('article_id' => $article_id));
			}
		} else {
			if ($add == 1) {
				$bad_date   = array('article_id' => $article_id, 'user_id' => $user_id);
				$bad_fields = array('article_id', 'user_id');
				$this->Bad_user->save($bad_date, false, $bad_fields);

				$this->Article->updateAll(
					array('bad_sum'    => $article['Article']['bad_sum']+1),
					array('article_id' => $article_id));
			} else {
				$deletefields = array("user_id" => $user_id);
				$deletedate   = $this->Bad_user->deleteAll($deletefields);
				$this->Article->updateAll(
					array('bad_sum'    => $article['Article']['bad_sum']-1),
					array('article_id' => $article_id));
			}
		}
		//$this->redirect(array('action' =>'view',$article_id));
		$this->redirect($this->request->referer());
	}
}
