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

        return View::make('admin.home')->with(['page_title' => 'Administracija',
            'cover_data' => $cover_data,
            'feature_data' => $feature_data,
            'feature_links' => $feature_links,
            'feature_icons' => $feature_icons,
            'fun_facts_data' => $fun_facts_data
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

        return Redirect::to('admin/naslovnica')->with(['success' => 'Naslovnica je uspješno izmjenjena']);
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

        return Redirect::to('admin/naslovnica')->with(['success' => 'Sekcija ukratko je uspješno izmjenjena']);
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

            return Redirect::to('admin/naslovnica')->with(['success' => 'Slika naslovnice je uspješno obrisana']);
        }
        catch(Exception $e){
            return Redirect::to('admin/naslovnica')->withErrors('Slika naslovnice nije mogla biti obrisana');
        }
    }

    /**
     * show admin locations
     * @return mixed
     */
    public function showLocations()
    {
        $locations_data = Location::orderBy('id', 'DESC')->get();

        return View::make('admin.locations')->with(['page_title' => 'Administracija',
            'locations_data' => $locations_data
        ]);
    }

    /**
     * show admin location edit
     * @return mixed
     */
    public function showUpdateLocation($id = null)
    {
        if($id == null){
            return Redirect::to('admin/dvorane')->withErrors('Dvorana ne postoji');
        }
        else{
            $location = Location::where('id', '=', $id)->first();
            if(!$location){
                return Redirect::to('admin/dvorane')->withErrors('Dvorana ne postoji');
            }
            else{
                if(isset($location->map_style) && !empty($location->map_style)){
                    $custom_style = true;
                }
                else{
                    $custom_style = false;
                    $location->map_style = null;
                }

                return View::make('admin.locations-edit')->with(['page_title' => 'Administracija',
                                                                'location' => $location,
                                                                'custom_style' => $custom_style
                ]);
            }
        }
    }

    /**
     * update location
     * @return mixed
     */
    public function updateLocation()
    {
        $form_data = ['map_title' => e(Input::get('map_title')), 'contact_info' => e(Input::get('contact_info')),
                    'map_lat' => e(Input::get('map_lat')), 'map_lng' => e(Input::get('map_lng')),
                    'time_schedule' => Input::get('time_schedule'), 'map_style' => Input::get('map_style')];
        $token = Input::get('_token');
        $location_id = e(Input::get('id'));

        //check if csrf token is valid
        if(Session::token() != $token){
            return Redirect::back()->withErrors('Nevažeći CSRF token!');
        }

        $validator = Validator::make($form_data, Location::$rules, Location::$messages);
        //check validation results and category if ok
        if($validator->fails()){
            return Redirect::back()->withErrors($validator->getMessageBag()->toArray())->withInput();
        }
        else{
            $location = Location::where('id', '=', $location_id)->first();

            # check for custom map styling
            if(isset($form_data['map_style']) && !empty($form_data['map_style'])){
                $map_style = $form_data['map_style'];
            }
            else{
                $map_style = '[{"featureType":"all","elementType":"labels","stylers":[{"visibility":"on"}]},{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]},{"featureType":"administrative.locality","elementType":"labels.text.fill","stylers":[{"color":"#c4c4c4"}]},{"featureType":"administrative.neighborhood","elementType":"labels.text.fill","stylers":[{"color":"#707070"}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21},{"visibility":"on"}]},{"featureType":"poi.business","elementType":"geometry","stylers":[{"visibility":"on"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#be2026"},{"lightness":"0"},{"visibility":"on"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"visibility":"off"}]},{"featureType":"road.highway","elementType":"labels.text.fill","stylers":[{"visibility":"off"}]},{"featureType":"road.highway","elementType":"labels.text.stroke","stylers":[{"visibility":"off"},{"hue":"#ff000a"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#575757"}]},{"featureType":"road.arterial","elementType":"labels.text.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"road.arterial","elementType":"labels.text.stroke","stylers":[{"color":"#2c2c2c"}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"road.local","elementType":"labels.text.fill","stylers":[{"color":"#999999"}]},{"featureType":"road.local","elementType":"labels.text.stroke","stylers":[{"saturation":"-52"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":17}]}]';
            }

            $location->map_title = $form_data['map_title'];
            $location->contact_info = $form_data['contact_info'];
            $location->map_lat = $form_data['map_lat'];
            $location->map_lng = $form_data['map_lng'];
            $location->time_schedule = $form_data['time_schedule'];
            $location->map_style = $map_style;
            $location->save();
        }

        return Redirect::back()->with(['success' => 'Dvorana je uspješno izmjenjena']);
    }

    /**
     * add new location
     * @return mixed
     */
    public function addLocation()
    {
        $form_data = ['map_title' => e(Input::get('map_title')), 'contact_info' => e(Input::get('contact_info')),
                        'map_lat' => e(Input::get('map_lat')), 'map_lng' => e(Input::get('map_lng')),
                        'time_schedule' => Input::get('time_schedule'), 'map_style' => Input::get('map_style')];
        $token = Input::get('_token');

        //check if csrf token is valid
        if(Session::token() != $token){
            return Redirect::back()->withErrors('Nevažeći CSRF token!');
        }

        $validator = Validator::make($form_data, Location::$rules, Location::$messages);
        //check validation results and category if ok
        if($validator->fails()){
            return Redirect::back()->withErrors($validator->getMessageBag()->toArray())->withInput();
        }
        else{
            # check for custom map styling
            if(isset($form_data['map_style']) && !empty($form_data['map_style'])){
                $map_style = $form_data['map_style'];
            }
            else{
                $map_style = '[{"featureType":"all","elementType":"labels","stylers":[{"visibility":"on"}]},{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]},{"featureType":"administrative.locality","elementType":"labels.text.fill","stylers":[{"color":"#c4c4c4"}]},{"featureType":"administrative.neighborhood","elementType":"labels.text.fill","stylers":[{"color":"#707070"}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21},{"visibility":"on"}]},{"featureType":"poi.business","elementType":"geometry","stylers":[{"visibility":"on"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#be2026"},{"lightness":"0"},{"visibility":"on"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"visibility":"off"}]},{"featureType":"road.highway","elementType":"labels.text.fill","stylers":[{"visibility":"off"}]},{"featureType":"road.highway","elementType":"labels.text.stroke","stylers":[{"visibility":"off"},{"hue":"#ff000a"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#575757"}]},{"featureType":"road.arterial","elementType":"labels.text.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"road.arterial","elementType":"labels.text.stroke","stylers":[{"color":"#2c2c2c"}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"road.local","elementType":"labels.text.fill","stylers":[{"color":"#999999"}]},{"featureType":"road.local","elementType":"labels.text.stroke","stylers":[{"saturation":"-52"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":17}]}]';
            }

            $location = new Location;
            $location->map_title = $form_data['map_title'];
            $location->contact_info = $form_data['contact_info'];
            $location->map_lat = $form_data['map_lat'];
            $location->map_lng = $form_data['map_lng'];
            $location->time_schedule = $form_data['time_schedule'];
            $location->map_style = $map_style;
            $location->save();
        }

        return Redirect::to('admin/dvorane')->with(['success' => 'Dvorana je uspješno dodana']);
    }

    /**
     * delete location
     * @return mixed
     */
    public function deleteLocation($id = null)
    {
        if($id == null){
            return Redirect::to('admin/dvorane')->withErrors('Dvorana ne postoji');
        }
        else{
            $location = Location::where('id', '=', $id)->first();
            if(!$location){
                return Redirect::to('admin/dvorane')->withErrors('Dvorana ne postoji');
            }
            else{
                $location->delete();
                return Redirect::to('admin/dvorane')->with(['success' => 'Dvorana je uspješno obrisana']);
            }
        }
    }

    /**
     * show admin video gallery
     * @return mixed
     */
    public function showVideoGallery()
    {
        $video_gallery_data = VideoGallery::first();

        return View::make('admin.video-gallery')->with(['page_title' => 'Administracija',
            'video_gallery_data' => $video_gallery_data
        ]);
    }

    /**
     * add url to video gallery
     * @return mixed
     */
    public function updateVideoGallery()
    {
        $form_data = ['video_url' => e(Input::get('video_url'))];
        $token = Input::get('_token');

        //check if csrf token is valid
        if(Session::token() != $token){
            return Redirect::back()->withErrors('Nevažeći CSRF token!');
        }

        $validator = Validator::make($form_data, VideoGallery::$rules, VideoGallery::$messages);
        //check validation results and category if ok
        if($validator->fails()){
            return Redirect::back()->withErrors($validator->getMessageBag()->toArray())->withInput();
        }
        else{
            //only one record in database
            $check_data = VideoGallery::first();
            if($check_data == null){
                $video = new VideoGallery();
            }
            else{
                $video = $check_data;
            }
            $video->video_url = $form_data['video_url'];
            $video->save();
        }

        return Redirect::to('admin/video-galerija')->with(['success' => 'Video za prezentaciju uspješno izmjenjen']);
    }

    /**
     * delete url from video gallery
     * @return mixed
     */
    public function deleteVideoGalleryUrl()
    {
        $video_gallery = VideoGallery::first();
        $video_gallery->delete();

        return Redirect::to('admin/video-galerija')->with(['success' => 'Video je uspješno obrisan.']);
    }

    /**
     * show admin gallery
     * @return mixed
     */
    public function showImageGallery()
    {
        $image_gallery_data = Gallery::orderBy('id', 'DESC')->get();

        return View::make('admin.image-gallery')->with(['page_title' => 'Administracija',
            'image_gallery_data' => $image_gallery_data
        ]);
    }

    /**
     * add images to image gallery
     * @return mixed
     */
    public function updateImageGallery()
    {
        $gallery_images = Input::file('image_gallery_images');
        $token = Input::get('_token');

        //check if csrf token is valid
        if(Session::token() != $token){
            return Redirect::back()->withErrors('Nevažeći CSRF token!');
        }

        //validate
        $error_list = null;
        if($gallery_images == true){
            foreach($gallery_images as $img){
                $validator_images = Validator::make(['images' => $img], Gallery::$rules, Gallery::$messages);
                if($validator_images->fails()){
                    $error_list = $validator_images->messages()->merge();
                }
            }
        }

        //check for errors
        if($error_list == null){
            //add new images
            if($gallery_images == true && $gallery_images[0] != null){
                //check for image directory
                $path = public_path().'/'.getenv('IMAGE_GALLERY_UPLOAD_DIR').'/';
                $short_path = getenv('IMAGE_GALLERY_UPLOAD_DIR');
                if(!File::exists($path)){
                    File::makeDirectory($path, 0777);
                }

                foreach($gallery_images as $img){
                    $file_name = getenv('WEB_NAME_URL_SAFE').'_galerija_'.Str::random(5);
                    $file_extension = $img->getClientOriginalExtension();
                    $full_name = $file_name.'.'.$file_extension;
                    $file_size = $img->getSize();

                    $file_uploaded = $img->move($path, $full_name);
                    $image_resize = Image::make($path.$full_name)->widen(800, function ($constraint) {
                        $constraint->upsize();
                    })->save();
                    if($file_uploaded){
                        $image = new Gallery;
                        $image->file_name = $full_name;
                        $image->file_size = $file_size;
                        $image->save();
                    }
                }


                //redirect on finish
                return Redirect::to('admin/galerija')->with(['success' => 'Slike uspješno dodane']);
            }
            else{
                return Redirect::to('admin/galerija')->withErrors('Nijedna slika nije odabrana');
            }
        }
        else{
            return Redirect::to('admin/galerija')->withErrors($error_list);
        }
    }

    /**
     * delete image from image gallery
     * @param null $id
     * @return mixed
     */
    public function deleteImageGalleryImage($id = null)
    {
        if($id == null){
            return Redirect::to('admin/galerija')->withErrors('Odabrana slika ne postoji');
        }
        else{
            // find image in database
            $image = Gallery::findOrFail($id);

            if($image){
                try{
                    File::delete(public_path().'/'.getenv('IMAGE_GALLERY_UPLOAD_DIR').'/'.$image->file_name);
                    $image->delete();
                }
                catch(Exception $e){
                    return Redirect::to('admin/galerija')->withErrors('Slika nije mogla biti obrisana');
                }

                //redirect on finish
                return Redirect::to('admin/galerija')->with(['success' => 'Slika je uspješno obrisana']);
            }
            else{
                return Redirect::to('admin/galerija')->withErrors('odabrana slika ne postoji');
            }
        }
    }

    /**
     * show admin users
     * @return mixed
     */
    public function showUsers()
    {
        $users_data = User::orderBy('id', 'ASC')->get();

        return View::make('admin.users')->with(['page_title' => 'Administracija',
            'users_data' => $users_data
        ]);
    }

    /**
     * show admin user edit
     * @return mixed
     */
    public function showUpdateUser($id = null)
    {
        if($id == null){
            return Redirect::to('admin/korisnici')->withErrors('Korisnik ne postoji');
        }
        else{
            $user = User::where('id', '=', $id)->first();
            if(!$user){
                return Redirect::to('admin/korisnici')->withErrors('Korisnik ne postoji');
            }
            else{
                return View::make('admin.users-edit')->with(['page_title' => 'Administracija',
                    'user' => $user
                ]);
            }
        }
    }

    /**
     * update user
     * @return mixed
     */
    public function updateUser()
    {
        $form_data = ['username' => e(Input::get('username')), 'password' => Input::get('password'), 'password_again' => Input::get('password_again'), 'email' => e(Input::get('email'))];
        $token = Input::get('_token');
        $user_id = e(Input::get('id'));

        //check if csrf token is valid
        if(Session::token() != $token){
            return Redirect::back()->withErrors('Nevažeći CSRF token!');
        }

        $validator = Validator::make($form_data, User::$rulesLessStrict, User::$messages);
        //check validation results and category if ok
        if($validator->fails()){
            return Redirect::back()->withErrors($validator->getMessageBag()->toArray())->withInput();
        }
        else{
            $user = User::where('id', '=', $user_id)->first();
            $user->username = $form_data['username'];
            if(!empty($form_data['password']) && !empty($form_data['password'])){
                $user->password = Hash::make($form_data['password']);
            }
            $user->email = $form_data['email'];
            $user->save();
        }

        return Redirect::to('admin/korisnici')->with(['success' => 'Korisnik je uspješno izmjenjen']);
    }

    /**
     * add user
     * @return mixed
     */
    public function addUser()
    {
        $form_data = ['username' => e(Input::get('username')), 'password' => Input::get('password'), 'password_again' => Input::get('password_again'), 'email' => e(Input::get('email'))];
        $token = Input::get('_token');

        //check if csrf token is valid
        if(Session::token() != $token){
            return Redirect::back()->withErrors('Nevažeći CSRF token!');
        }

        $validator = Validator::make($form_data, User::$rules, User::$messages);
        //check validation results and category if ok
        if($validator->fails()){
            return Redirect::back()->withErrors($validator->getMessageBag()->toArray())->withInput();
        }
        else{
            $user = new User;
            $user->username = $form_data['username'];
            $user->password = Hash::make($form_data['password']);
            $user->email = $form_data['email'];
            $user->save();
        }

        return Redirect::to('admin/korisnici')->with(['success' => 'Korisnik je uspješno dodan']);
    }

    /**
     * delete user
     * @return mixed
     */
    public function deleteUser($id = null)
    {
        if($id == null){
            return Redirect::to('admin/korisnici')->withErrors('Korisnik ne postoji');
        }
        else{
            $user = User::where('id', '=', $id)->first();
            if(!$user){
                return Redirect::to('admin/korisnici')->withErrors('Korisnik ne postoji');
            }
            else{
                $user->delete();
                return Redirect::to('admin/korisnici')->with(['success' => 'Korisnik je uspješno obrisan']);
            }
        }
    }
}