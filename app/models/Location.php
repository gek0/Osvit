<?php

class Location extends Eloquent{

    /**
     * Database Model
     * 	-	id INT UNSIGNED / AUTO_INCREMENT PRIMARY KEY
     *  -	map_title VARCHAR(255)
     *  -   contact_info VARCHAR(255)
     *  -   time_schedule TEXT
     *  -   map_style TEXT
     *  -   map_lat FLOAT(10,6) UNSIGNED
     *  -   map_lng FLOAT(10,6) UNSIGNED
     *  - 	created_at TIMESTAMP
     *  - 	updated_at TIMESTAMP
     */

    /**
     * validation rules for entities
     *
     */
    public static $rules = ['map_title' => 'required|string|between:2,255',
                            'contact_info' => 'required|alpha_spaces_dash|between:2,255',
    ];

    /**
     * validation error messages
     */
    public static $messages = ['map_title.required' => 'Ime lokacije je obavezno polje' ,
                                'map_title.alpha_spaces_dash' => 'Ime lokacije može sadržavati samo slova, brojeve, - i razmak',
                                'map_title.between' => 'Ime lokacije mora biti dulje od 2 znaka i kraće od 255',
                                'contact_info' => 'Kontakt informacija je obavezno polje',
                                'contact_infe.alpha_spaces_dash' => 'Kontakt informacija može sadržavati samo slova, brojeve, - i razmak',
                                'contact_inf.between' => 'Kontakt informacija mora biti dulja od 2 znaka i kraća od 255',
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'locations';

}