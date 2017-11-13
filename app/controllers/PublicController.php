<?php

class PublicController extends BaseController {

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
     * show homepage
     * @return mixed
     */
    public function showHome()
    {
        $cover_data = Cover::first();
        $feature_data = Feature::orderBy('id', 'ASC')->get();
        $video_gallery_data = VideoGallery::first();
        $image_gallery_data = Gallery::orderBy('id', 'DESC')->limit(9)->get(); // enough to fill 3 rows
        $fun_facts_data = FunFact::orderBy('id', 'ASC')->get();
        $locations_data = Location::orderBy('id', 'DESC')->get();
        $news_data = News::orderBy('id', 'DESC')->first();

        $about_us_data = [];
        if($about_us_data = AboutUs::first()){
            $about_us_data['about_body'] = $about_us_data->about_body;
            $about_us_data['about_title'] = $about_us_data->about_title;
        }
        else{
            $about_us_data['about_body'] = null;
            $about_us_data['about_title'] = null;
        }

        return View::make('public.index')->with(['page_title' => 'Dobrodošli',
                                                'cover_data' => $cover_data,
                                                'feature_data' => $feature_data,
                                                'video_gallery_data' => $video_gallery_data,
                                                'image_gallery_data' => $image_gallery_data,
                                                'fun_facts_data' => $fun_facts_data,
                                                'locations_data' => $locations_data,
                                                'about_us_data' => $about_us_data,
                                                'news_data' => $news_data
        ]);
    }

    /**
     * show image gallery
     * @return mixed
     */
    public function showImageGallery()
    {
        $image_gallery_data = Gallery::orderBy('id', 'DESC')->get();

        return View::make('public.image-gallery')->with(['page_title' => 'Galerija slika',
                                                        'image_gallery_data' => $image_gallery_data
        ]);
    }

    /**
     * generate javascript code for google map
     * @return mixed
     */
    public function generateMap($id = null){
        if($id == null){
            return '';
        }
        else{
            $location = Location::where('id', '=', $id)->first();
            if(!$location){
                return '';
            }
            else{
                Header("content-type: application/x-javascript");

                $js_map = 'jQuery(document).ready(function(){
                                var image = "'.asset('css/assets/images/map-marker.png').'";
                                var map'.$location->id.' = $("#map'.$location->id.'");

                                if(map'.$location->id.'.length > 0) {
                                    map = new GMaps({
                                        el: "#map'.$location->id.'", lat: '.$location->map_lat.', lng: '.$location->map_lng.', zoom: 15, linksControl: true, zoomControl: true,
                                        panControl: true, scrollwheel: true, streetViewControl: true
                                    });

                                    map.addMarker({lat: '.$location->map_lat.', lng: '.$location->map_lng.', title: "'.$location->map_title.'", icon: image});
                                    var styles = '.$location->map_style.';
                                    map.setOptions({styles: styles});
                                }
                            });';

                return $js_map;
            }
        }
    }

    /**
     * send email from contact form over Ajax request
     * @return mixed
     */
    public function sendMail()
    {
        if (Request::ajax()) {
            //define validator rules and messages
            $rules = ['full_name' => 'required|between:2,100',
                        'email' => 'required|email',
                        'subject' => 'required|between:2,100',
                        'message_body' => 'required|min:10',
                        'g-recaptcha-response' => 'required|captcha'
            ];
            $messages = ['full_name.required' => 'Zaboravili ste unjeti ime i prezime',
                        'full_name.between' => 'Ime i prezime ne mogu biti dulji od 100 znakova i kraći od 2',
                        'email.required' => 'E-mail adresa je obavezno polje',
                        'email.email' => 'Unjeta e-mail adresa nije važeća',
                        'subject.required' => 'Zaboravili ste unjeti naslov poruke',
                        'subject.between' => 'Naslov poruke ne može biti dulji od 100 znakova i kraći od 2',
                        'message_body.required' => 'Poruka je obavezno polje',
                        'message_body.min' => 'Poruka je prekratka, minimalno 10 znakova',
                        'g-recaptcha-response.required' => 'Captcha je obavezna',
                        'g-recaptcha-response.captcha' => 'Captcha nije važeća'
            ];

            //get form data
            $input_data = Input::get('formData');
            $token = Input::get('_token');
            $user_data = ['full_name' => e($input_data['full_name']),
                        'email' => e($input_data['email']),
                        'subject' => e($input_data['subject']),
                        'message_body' => e($input_data['message_body']),
                        'g-recaptcha-response' => e($input_data['g-recaptcha-response'])
            ];

            //validate user data
            $validator = Validator::make($user_data, $rules, $messages);

            //check if csrf token is valid
            if(Session::token() != $token){
                return Response::json(['status' => 'error',
                                        'errors' => 'Nevažeći CSRF token!'
                ]);
            }
            else {
                //check validation results and save user if ok
                if($validator->fails()){
                    return Response::json(['status' => 'error',
                                            'errors' => $validator->getMessageBag()->toArray()
                    ]);
                }
                else{
                    //send email
                    try{
                        Mail::send('email', $user_data, function($message) use ($user_data){
                            $message->from($user_data['email'], $user_data['full_name']);
                            $message->to(getenv('OWNER_CONTACT_EMAIL'))->subject(getenv('WEB_EMAIL_SUBJECT').' - '.$user_data['subject']);
                        });
                        return Response::json(['status' => 'success']);
                    }
                    catch(Exception $e){
                        return Response::json(['status' => 'error',
                                                'errors' => 'E-mail nije mogao biti poslan, pokušajte ponovo'
                        ]);
                    }
                }
            }
        }
        else{
            return Response::json(['status' => 'error',
                                    'errors' => 'Podaci nisu ispravno poslani'
            ]);
        }
    }

    /**
     * show cached rss feed
     * @return mixed
     */
    public function getRss()
    {
        //generate feed and cache for 60 min
        $feed = Feed::make();
        $feed->setCache(60, getenv('RSS_CACHE_KEY'));

        //check if there is cached version
        if(!$feed->isCached()) {
            //grab news data from database
            $news_data = News::orderBy('id', 'DESC')->take(5)->get();
            //check if there are news
            if ($news_data == true) {
                //set feed parameters
                $feed->title = getenv('WEB_NAME').' :: RSS';
                $feed->description = 'Najnovije vijesti na '.getenv('WEB_NAME').'';
                $feed->logo = URL::to('css/assets/images/logo_main_small.png');
                $feed->link = URL::to('rss');
                $feed->setDateFormat('datetime');
                $feed->pubdate = $news_data[0]->created_at;
                $feed->lang = getenv('APP_LOCALE');
                $feed->setShortening(true);
                $feed->setTextLimit(500);
                foreach ($news_data as $news) {
                    $feed->add($news->news_title, 'admin', URL::to(route('news-show', $news->slug)), $news->created_at, (new BBCParser)->unparse($news->news_body), '');
                }
            }
            else{
                return Redirect::to(route('news'))->withErrors('Trenutno nema vijesti. RSS je isključen.');
            }
        }

        return $feed->render('atom');
    }

    /**
     * shoow all tags
     * @return mixed
     */
    public function showTagsList()
    {
        $tags_data = Tag::all();

        return View::make('public.tags-list')->with(['page_title' => 'Lista tagova',
                                                'tags_data' => $tags_data
        ]);
    }

    /**
     * show news
     * @return mixed
     */
    public function showNews()
    {
        //default form sort value
        $news_text_sort = null;
        $sort_category = null;
        $sort_data = $this->sort_data;
        $news_data = News::orderBy('id', 'DESC')->paginate($this->news_paginate);

        return View::make('public.news')->with(['page_title' => 'Obavijesti',
                                                'news_text_sort' => $news_text_sort,
                                                'sort_data' => $sort_data,
                                                'sort_category' => $sort_category,
                                                'news_data' => $news_data
        ]);
    }

    /**
     * view individual news
     * @param $slug
     * @return mixed
     */
    public function showIndividualNews($slug = null)
    {
        if ($slug !== null){
            $news_data = News::findBySlug(e($slug));

            //check if news exists
            if($news_data){

                //increment number of visits
                if((!Session::get('read_news') || !in_array($news_data->id, Session::get('read_news')))){
                    Session::push('read_news', $news_data->id);
                    $news_data->increment('num_visited');
                }

                //find previous and next person after current
                $previous_news = $news_data->previousNews();
                $next_news = $news_data->nextNews();

                //check if there are news before/after or not
                if($previous_news){
                    $previous_news = ['slug' => $previous_news->slug, 'news_title' => $previous_news->news_title];
                }
                else{
                    $previous_news = false;
                }

                if($next_news){
                    $next_news = ['slug' => $next_news->slug, 'news_title' => $next_news->news_title];
                }
                else{
                    $next_news = false;
                }

                return View::make('public.show-news')->with(['page_title' => $news_data->news_title,
                                                                    'news_data' => $news_data,
                                                                    'previous_news' => $previous_news,
                                                                    'next_news' => $next_news
                ]);
            }
            else{
                App::abort(404, 'Članak nije pronađen.');
            }
        }
        else{
            App::abort(404, 'Članak nije pronađen.');
        }
    }

    /**
     * sort news by selected category
     * @return mixed
     */
    public function showFilteredSortedNews()
    {
        //get form data and set default sort options
        $news_text_sort = e(Input::get('news_text_sort'));
        $sort_category = e(Input::get('sort_option'));
        $sort_data = $this->sort_data;

        //check sort category selected in form and get data
        switch($sort_category){
            case 'added_desc':
                if($news_text_sort == '') {
                    $news_data = News::orderBy('id', 'DESC')->paginate($this->news_paginate);
                }
                else{
                    $news_data = News::where('news_title', 'LIKE', '%'.$news_text_sort.'%')->orderBy('id', 'DESC')->paginate($this->news_paginate);
                }
                break;

            case 'added_asc':
                if($news_text_sort == '') {
                    $news_data = News::orderBy('id', 'ASC')->paginate($this->news_paginate);
                }
                else{
                    $news_data = News::where('news_title', 'LIKE', '%'.$news_text_sort.'%')->orderBy('id', 'ASC')->paginate($this->news_paginate);
                }
                break;

            case 'visits_desc':
                if($news_text_sort == '') {
                    $news_data = News::orderBy('num_visited', 'DESC')->paginate($this->news_paginate);
                }
                else{
                    $news_data = News::where('news_title', 'LIKE', '%'.$news_text_sort.'%')->orderBy('num_visited', 'DESC')->paginate($this->news_paginate);
                }
                break;

            case 'visits_asc':
                if($news_text_sort == '') {
                    $news_data = News::orderBy('num_visited', 'ASC')->paginate($this->news_paginate);
                }
                else{
                    $news_data = News::where('news_title', 'LIKE', '%'.$news_text_sort.'%')->orderBy('num_visited', 'ASC')->paginate($this->news_paginate);
                }
                break;

            default:
                if($news_text_sort == '') {
                    $news_data = News::orderBy('id', 'DESC')->paginate($this->news_paginate);
                }
                else{
                    $news_data = News::where('news_title', 'LIKE', '%'.$news_text_sort.'%')->orderBy('id', 'DESC')->paginate($this->news_paginate);
                }
        }

        return View::make('public.news')->with(['page_title' => 'Obavijesti',
                                                    'news_data' => $news_data,
                                                    'sort_data' => $sort_data,
                                                    'sort_category' => $sort_category,
                                                    'news_text_sort' => $news_text_sort
        ]);
    }
}
