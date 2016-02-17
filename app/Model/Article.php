<?php
class Article extends AppModel{
	public $validate = array(
    'title' => array(
        array('rule' => 'notEmpty', 'message' => 'タイトルを入力してください')
    ),
    'content' => array(
        array('rule' => 'notEmpty', 'message' => '記事内容を入力してください')
    )
);

public $actsAs = array('Search.Searchable');

// 検索対象のフィルタ設定
public $filterArgs = array(
    array('name' => 'search_word', 'type' => 'query', 'method' => 'multiWordSearch')
);

public function multiWordSearch($data = array()) {
    $keyword = mb_convert_kana($data['search_word'], "s", "UTF-8");
    $keywords = explode(' ', $keyword);

    if (count($keywords) < 2) {
        $conditions = array(
            'OR' => array(
                //検索対象のフィールド名、適宜変更や追加削除を行って下さい。
                $this->alias.'.title LIKE' => '%' . $keyword . '%',
                $this->alias.'.content LIKE' => '%' . $keyword . '%',
                //$this->alias.'.category_id LIKE' => '%' . $keyword . '%'
            )
        );
    }else{
    $conditions['AND'] = array();
        foreach ($keywords as $count => $keyword) {
            $condition = array(
                'OR' => array(
                    //検索対象のフィールド名、適宜変更や追加削除を行って下さい。
                    $this->alias.'.title LIKE' => '%' . $keyword . '%',
                    $this->alias.'.content LIKE' => '%' . $keyword . '%',
                    //$this->alias.'.category_id LIKE' => '%' . $keyword . '%'
                )
            );
            array_push($conditions['AND'], $condition);
        }
    }
    return $conditions;
}

}
