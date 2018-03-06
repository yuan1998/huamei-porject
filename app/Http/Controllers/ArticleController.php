<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class ArticleController extends ApiController
{


	/**
	 * The Method is New Article Model
	 */
	public function __construct(\App\Articles $model)
	{
		$this->model = $model;
	}

    /**
     * The Method is where change article
     * @return [type] [description]
     */
    public function changeArticle()
    {
		$data = request()->toArray();

    	$article = $this->findArticleValidator($data['id']);

    	$r = $article ? $article->fill($data)->save() : false;

    	return $this->resultReturn($r);

    }
}
