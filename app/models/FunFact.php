<?php

class FunFact extends Eloquent{

    /**
     * Database Model
     * 	-	id INT UNSIGNED / AUTO_INCREMENT PRIMARY KEY
     *  -   info_title VARCHAR(50)
     *  -   info_number INT UNSIGNED
     *  -   info_icon VARCHAR(50)
     *  - 	created_at TIMESTAMP
     *  - 	updated_at TIMESTAMP
     */

    /**
     * validation rules for entities
     *
     */
    public static $rules = ['info_title_1' => 'between:0,50',
                            'info_number_1' => 'integer',
                            'info_icon_1' => 'between:0,50',
                            'info_title_2' => 'between:0,50',
                            'info_number_2' => 'integer',
                            'info_icon_2' => 'between:0,50',
                            'info_title_3' => 'between:0,50',
                            'info_number_3' => 'integer',
                            'info_icon_3' => 'between:0,50',
                            'info_title_4' => 'between:0,50',
                            'info_number_4' => 'integer',
                            'info_icon_4' => 'between:0,50'
    ];

    /**
     * validation error messages
     */
    public static $messages = ['info_title_1.between' => 'Naslov 1 mora biti kraći od 50 znakova',
                                'info_number_1.integer' => 'Broj 1 mora biti ciijeli broj',
                                'info_icon_1.between' => 'Ikona 1 mora biti kraći od 50 znakova',
                                'info_title_2.between' => 'Naslov 2 mora biti kraći od 50 znakova',
                                'info_number_2.integer' => 'Broj 2 mora biti ciijeli broja',
                                'info_icon_2.between' => 'Ikona 2 mora biti kraći od 50 znakova',
                                'info_title_3.between' => 'Naslov 3 mora biti kraći od 50 znakova',
                                'info_number_3.integer' => 'Broj 3 mora biti ciijeli broj',
                                'info_icon_3.between' => 'Ikona 3 mora biti kraći od 50 znakova',
                                'info_title_4.between' => 'Naslov 4 mora biti kraći od 50 znakova',
                                'info_number_4.integer' => 'Broj 4 mora biti ciijeli broj',
                                'info_icon_4.between' => 'Ikona 4 mora biti kraći od 50 znakova'
    ];

    /**
     * model attributes
     */

    public static $info_icons = ['fa fa-home fa-gig' => '<i class="fa">&#xf015;</i>',
                                    'fa fa-map-marker fa-gig' => '<i class="fa">&#xf041;</i>',
                                    'fa fa-map-signs fa-gig' => '<i class="fa">&#xf277;</i>',
                                    'fa fa-camera fa-gig' => '<i class="fa">&#xf030;</i>',
                                    'fa fa-calendar fa-gig' => '<i class="fa">&#xf073;</i>',
                                    'fa fa-info fa-gig' => '<i class="fa">&#xf129;</i>',
                                    'fa fa-child fa-gig' => '<i class="fa">&#xf1ae;</i>',
                                    'fa fa-users fa-gig' => '<i class="fag">&#xf0c0;</i>',
                                    'fa fa-user-plus fa-gig' => '<i class="fa">&#xf234;</i>',
                                    'fa fa-user fa-gig' => '<i class="fa">&#xf007;</i>',
                                    'fa fa-trophy fa-gig' => '<i class="fa">&#xf091;</i>',
                                    'fa fa-heart fa-gig' => '<i class="fa">&#xf004;</i>',
                                    'fa fa-rocket fa-gig' => '<i class="fa">&#xf135;</i>',
                                    'fa fa-bar-chart fa-gig' => '<i class="fa">&#xf080;</i>',
                                    'fa fa-line-chart fa-gig' => '<i class="fa">&#xf201;</i>',
                                    'fa fa-search fa-gig' => '<i class="fa">&#xf002;</i>',
                                    'fa fa-star fa-gig' => '<i class="fa">&#xf005;</i>',
                                    'fa fa-pencil fa-gig' => '<i class="fa">&#xf040;</i>',
                                    'fa fa-newspaper-o fa-gig' => '<i class="fa">&#xf1ea;</i>'
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'info_numbers';

}