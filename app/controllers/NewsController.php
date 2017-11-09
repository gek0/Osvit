<?php

class NewsController extends BaseController
{

    /**
     * CSRF validation on requests
     */
    public function __construct()
    {
        $this->beforeFilter('crfs', ['on' => ['post', 'put', 'patch', 'delete']]);
    }

    protected $news_paginate = 9;
    protected $sort_data = ['added_desc' => 'Najnovije vijesti',
                            'added_asc' => 'Najstarije vijesti',
                            'visits_desc' => 'S najviše pregleda',
                            'visits_asc' => 'S najmanje pregleda'
    ];

    /**
     * show admin news
     * @return mixed
     */
    public function showNews()
    {
        $news_data = News::orderBy('id', 'DESC')->paginate($this->news_paginate);

        return View::make('admin.news.index')->with(['page_title' => 'Administracija',
                                                        'news_data' => $news_data
        ]);
    }

}