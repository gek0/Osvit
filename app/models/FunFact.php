<?php

class FunFact extends Eloquent{

    /**
     * Database Model
     * 	-	id INT UNSIGNED / AUTO_INCREMENT PRIMARY KEY
     *  -   info_title VARCHAR(50)
     *  -   info_number INT UNSIGNED
     *  - 	created_at TIMESTAMP
     *  - 	updated_at TIMESTAMP
     */

    /**
     * validation rules for entities
     *
     */
    public static $rules = ['info_title_1' => 'between:0,50',
                            'info_number_1' => 'integer',
                            'info_title_2' => 'between:0,50',
                            'info_number_2' => 'integer',
                            'info_title_3' => 'between:0,50',
                            'info_number_3' => 'integer',
                            'info_title_4' => 'between:0,50',
                            'info_number_4' => 'integer'
    ];

    /**
     * validation error messages
     */
    public static $messages = ['info_title_1.between' => 'Naslov 1 mora biti kraći od 50 znakova',
                                'info_number_1.integer' => 'Broj 1 mora biti ciijeli broj',
                                'info_title_2.between' => 'Naslov 2 mora biti kraći od 50 znakova',
                                'info_number_2.integer' => 'Broj 2 mora biti ciijeli broja',
                                'info_title_3.between' => 'Naslov 3 mora biti kraći od 50 znakova',
                                'info_number_3.integer' => 'Broj 3 mora biti ciijeli broj',
                                'info_title_4.between' => 'Naslov 4 mora biti kraći od 50 znakova',
                                'info_number_4.integer' => 'Broj 4 mora biti ciijeli broj'
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'info_numbers';

}