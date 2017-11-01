<?php

class Gallery extends Eloquent{

    /**
     * Database Model
     * 	-	id INT UNSIGNED / AUTO_INCREMENT PRIMARY KEY
     *  -	file_name VARCHAR(255) / UNIQUE
     *  -   file_size DOUBLE
     *  - 	created_at TIMESTAMP
     *  - 	updated_at TIMESTAMP
     */

    /**
     * validation rules for entities
     *
     */
    public static $rules = ['images_name' => 'image|max:3000'];

    /**
     * validation error messages
     */
    public static $messages = ['images.image' => 'Dozvoljeni formati slike su: .jpeg, .png, .bmp i .gif',
                                'images.max' => 'Maksimalna veličina slike je 3MB',
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'gallery';

}