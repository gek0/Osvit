<?php

class AdminController extends BaseController
{

    /**
     * CSRF validation on requests
     */
    public function __construct()
    {
        $this->beforeFilter('crfs', ['on' => ['post', 'put', 'patch', 'delete']]);
    }


    /**
     * show admin page home
     * @return mixed
     */
    public function showPageHome()
    {
        $cover_data = Cover::first();
        $feature_data = Feature::orderBy('id', 'ASC')->get();
        $feature_links = Feature::$feature_links;
        $feature_icons = Feature::$feature_icons;
        $fun_facts_data = FunFact::orderBy('id', 'ASC')->get();
        $fun_facts_icons = FunFact::$info_icons;

        $about_us_data = [];
        if($about_us_data = AboutUs::first()){
            $about_us_data['about_body'] = $about_us_data->about_body;
            $about_us_data['about_title'] = $about_us_data->about_title;
        }
        else{
            $about_us_data['about_body'] = null;
            $about_us_data['about_title'] = null;
        }

        return View::make('admin.home')->with(['page_title' => 'Administracija',
                                                'cover_data' => $cover_data,
                                                'feature_data' => $feature_data,
                                                'feature_links' => $feature_links,
                                                'feature_icons' => $feature_icons,
                                                'fun_facts_data' => $fun_facts_data,
                                                'fun_facts_icons' => $fun_facts_icons,
                                                'about_us_data' => $about_us_data
        ]);
    }

    /**
     * update cover
     * @return mixed
     */
    public function updateCover()
    {
        $form_data = ['cover_title' => e(Input::get('cover_title')), 'cover_subtitle' => e(Input::get('cover_subtitle')),
                      'image_file_name' => Input::file('cover_image')];
        $token = Input::get('_token');

        //check if csrf token is valid
        if(Session::token() != $token){
            return Redirect::back()->withErrors('Nevažeći CSRF token!');
        }

        $validator = Validator::make($form_data, Cover::$rules, Cover::$messages);
        //check validation results and category if ok
        if($validator->fails()){
            return Redirect::back()->withErrors($validator->getMessageBag()->toArray())->withInput();
        }
        else{
            // only one record in database
            $check_data = Cover::first();
            if($check_data == null){
                $cover = new Cover;
            }
            else{
                $cover = $check_data;
            }

            $cover->cover_title = $form_data['cover_title'];
            $cover->cover_subtitle = $form_data['cover_subtitle'];

            //check if there is image
            if($form_data['image_file_name'] == true){
                //check for image directory
                $path = public_path().'/'.getenv('COVER_UPLOAD_DIR').'/';
                //delete existing image
                File::deleteDirectory($path);

                if(!File::exists($path)){
                    //recreate directory
                    File::makeDirectory($path, 0777);
                }

                $file_name = getenv('WEB_NAME_URL_SAFE').'_cover';
                $file_extension = $form_data['image_file_name']->getClientOriginalExtension();
                $full_name = $file_name.'.'.$file_extension;
                $file_size = $form_data['image_file_name']->getSize();

                $form_data['image_file_name']->move($path, $full_name);

                $cover->cover_file_name = $full_name;
                $cover->cover_file_size = $file_size;
            }

            $cover->save();
        }

        return Redirect::to(route('admin-page-home'))->with(['success' => 'Naslovnica je uspješno izmjenjena']);
    }

    /**
     * delete cover image
     * @return mixed
     */
    public function deleteCoverImage()
    {
        $cover = Cover::first();

        $path = public_path().'/cover_uploads/';

        try {
            // delete from hard disk
            if (File::exists($path)) {
                //delete existing image
                File::deleteDirectory($path);
            }

            // update database
            $cover->cover_file_name = 'https://via.placeholder.com/1920x1080?text='.getenv('WEB_NAME');
            $cover->cover_file_size = 0;
            $cover->save();

            return Redirect::to(route('admin-page-home'))->with(['success' => 'Slika naslovnice je uspješno obrisana']);
        }
        catch(Exception $e){
            return Redirect::to(route('admin-page-home'))->withErrors('Slika naslovnice nije mogla biti obrisana');
        }
    }

    /**
     * update features
     * @return mixed
     */
    public function updateFeatures()
    {
        $form_data = Input::all();

         //check if csrf token is valid
        if(Session::token() != $form_data['_token']){
            return Redirect::back()->withErrors('Nevažeći CSRF token!');
        }

        $validator = Validator::make($form_data, Feature::$rules, Feature::$messages);
        //check validation results and category if ok
        if($validator->fails()){
            return Redirect::back()->withErrors($validator->getMessageBag()->toArray())->withInput();
        }
        else {
            // there will be only 3 records by design
            $feature_1 = Feature::find(1);
            $feature_2 = Feature::find(2);
            $feature_3 = Feature::find(3);

            $feature_1->feature_title = $form_data['feature_title_1'];
            $feature_1->feature_body = $form_data['feature_body_1'];
            $feature_1->feature_link = $form_data['feature_link_1'];
            $feature_1->feature_icon = $form_data['feature_icon_1'];
            $feature_1->save();

            $feature_2->feature_title = $form_data['feature_title_2'];
            $feature_2->feature_body = $form_data['feature_body_2'];
            $feature_2->feature_link = $form_data['feature_link_2'];
            $feature_2->feature_icon = $form_data['feature_icon_2'];
            $feature_2->save();

            $feature_3->feature_title = $form_data['feature_title_3'];
            $feature_3->feature_body = $form_data['feature_body_3'];
            $feature_3->feature_link = $form_data['feature_link_3'];
            $feature_3->feature_icon = $form_data['feature_icon_3'];
            $feature_3->save();
        }

        return Redirect::to(route('admin-page-home'))->with(['success' => 'Sekcija "Ukratko" je uspješno izmjenjena']);
    }

    /**
     * update about us section
     * @return mixed
     */
    public function updateAboutUs()
    {
        $form_data = Input::all();

        //check if csrf token is valid
        if(Session::token() != $form_data['_token']){
            return Redirect::back()->withErrors('Nevažeći CSRF token!');
        }

        $validator = Validator::make($form_data, AboutUs::$rules, AboutUs::$messages);
        //check validation results and category if ok
        if($validator->fails()){
            return Redirect::back()->withErrors($validator->getMessageBag()->toArray())->withInput();
        }
        else {
            //only one record in database
            $check_data = AboutUs::first();
            if($check_data == null){
                $about_us = new AboutUs;
            }
            else{
                $about_us = $check_data;
            }

            $about_us->about_title = $form_data['about_title'];
            $about_us->about_body = $form_data['about_body'];
            $about_us->save();
        }

        return Redirect::to(route('admin-page-home'))->with(['success' => 'Sekcija "O nama" je uspješno izmjenjena']);
    }

    /**
     * update fun facts
     * @return mixed
     */
    public function updateFunFacts()
    {
        $form_data = Input::all();

        //check if csrf token is valid
        if(Session::token() != $form_data['_token']){
            return Redirect::back()->withErrors('Nevažeći CSRF token!');
        }

        $validator = Validator::make($form_data, FunFact::$rules, FunFact::$messages);
        //check validation results and category if ok
        if($validator->fails()){
            return Redirect::back()->withErrors($validator->getMessageBag()->toArray())->withInput();
        }
        else {
            // there will be only 4 records by design
            $fun_fact_1 = FunFact::find(1);
            $fun_fact_2 = FunFact::find(2);
            $fun_fact_3 = FunFact::find(3);
            $fun_fact_4 = FunFact::find(4);

            $fun_fact_1->info_title = $form_data['info_title_1'];
            $fun_fact_1->info_number = $form_data['info_number_1'];
            $fun_fact_1->info_icon = $form_data['info_icon_1'];
            $fun_fact_1->save();

            $fun_fact_2->info_title = $form_data['info_title_2'];
            $fun_fact_2->info_number = $form_data['info_number_2'];
            $fun_fact_2->info_icon = $form_data['info_icon_2'];
            $fun_fact_2->save();

            $fun_fact_3->info_title = $form_data['info_title_3'];
            $fun_fact_3->info_number = $form_data['info_number_3'];
            $fun_fact_3->info_icon = $form_data['info_icon_3'];
            $fun_fact_3->save();

            $fun_fact_4->info_title = $form_data['info_title_4'];
            $fun_fact_4->info_number = $form_data['info_number_4'];
            $fun_fact_4->info_icon = $form_data['info_icon_4'];
            $fun_fact_4->save();
        }

        return Redirect::to(route('admin-page-home'))->with(['success' => 'Sekcija "Info brojevi" je uspješno izmjenjena']);
    }
}