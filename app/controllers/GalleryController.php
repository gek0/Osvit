<?php

class GalleryController extends BaseController
{

    /**
     * CSRF validation on requests
     */
    public function __construct()
    {
        $this->beforeFilter('crfs', ['on' => ['post', 'put', 'patch', 'delete']]);
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
            return Redirect::back()->withErrors('Nevažeći CSRF token');
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
                $video = new VideoGallery;
            }
            else{
                $video = $check_data;
            }

            $video->video_url = $form_data['video_url'];
            $video->save();
        }

        return Redirect::to(route('admin-video-gallery'))->with(['success' => 'Video za prezentaciju uspješno izmjenjen']);
    }

    /**
     * delete url from video gallery
     * @return mixed
     */
    public function deleteVideoGalleryUrl()
    {
        $video_gallery = VideoGallery::first();
        $video_gallery->delete();

        return Redirect::to(route('admin-video-gallery'))->with(['success' => 'Video je uspješno obrisan']);
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
            return Redirect::back()->withErrors('Nevažeći CSRF token');
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
                return Redirect::to(route('admin-image-gallery'))->with(['success' => 'Slike uspješno dodane']);
            }
            else{
                return Redirect::to(route('admin-image-gallery'))->withErrors('Nijedna slika nije odabrana');
            }
        }
        else{
            return Redirect::to(route('admin-image-gallery'))->withErrors($error_list);
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
            return Redirect::to(route('admin-image-gallery'))->withErrors('Odabrana slika ne postoji');
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
                    return Redirect::to(route('admin-image-gallery'))->withErrors('Slika nije mogla biti obrisana');
                }

                //redirect on finish
                return Redirect::to(route('admin-image-gallery'))->with(['success' => 'Slika je uspješno obrisana']);
            }
            else{
                return Redirect::to(route('admin-image-gallery'))->withErrors('odabrana slika ne postoji');
            }
        }
    }
}