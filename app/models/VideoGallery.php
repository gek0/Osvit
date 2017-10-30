<?php

class VideoGallery extends Eloquent{

    /**
     * Video Gallery Database Model
     * 	-	id INT UNSIGNED / AUTO_INCREMENT PRIMARY KEY
     *  -	video_url VARCHAR(255)
     *  - 	created_at TIMESTAMP
     *  - 	updated_at TIMESTAMP
     */

    /**
     * validation rules for entities
     *
     */
    public static $rules = ['video_url' => 'required|max:255|url'];

    /**
     * validation error messages
     */
    public static $messages = ['video_url.required' => 'Video URL je obavezan',
        'video_url.max' => 'Maksimalna duljina URL-a je 255 znakova',
        'video_url.url' => 'Unjeti URL nije važeći',
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'video_gallery';


}