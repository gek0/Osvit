<?php

class Feature extends Eloquent{

    /**
     * Database Model
     * 	-	id INT UNSIGNED / AUTO_INCREMENT PRIMARY KEY
     *  -   feature_title VARCHAR(25)
     *  -   feature_body VARCHAR(100)
     *  -	feature_link VARCHAR(25)
     *  -   feature_icon VARCHAR(50) NULL
     *  - 	created_at TIMESTAMP
     *  - 	updated_at TIMESTAMP
     */

    /**
     * validation rules for entities
     *
     */
    public static $rules = ['feature_title_1' => 'between:0,25',
                            'feature_body_1' => 'between:0,100',
                            'feature_link_1' => 'between:0,25',
                            'feature_icon_1' => 'between:0,25',
                            'feature_title_2' => 'between:0,25',
                            'feature_body_2' => 'between:0,100',
                            'feature_link_2' => 'between:0,25',
                            'feature_icon_2' => 'between:0,25',
                            'feature_title_3' => 'between:0,25',
                            'feature_body_3' => 'between:0,200',
                            'feature_link_3' => 'between:0,25',
                            'feature_icon_3' => 'between:0,25'
    ];

    /**
     * validation error messages
     */
    public static $messages = ['feature_title_1.between' => 'Naslov 1 mora biti kraći od 25 znakova',
                                'feature_body_1.between' => 'Tekst 1 mora biti kraći od 100 znakova',
                                'feature_link_1.between' => 'Link 1 mora biti kraći od 25 znakova',
                                'feature_icon_1.between' => 'Ikona 1 mora biti kraća od 50 znakova',
                                'feature_title_2.between' => 'Naslov 2 mora biti kraći od 25 znakova',
                                'feature_body_2.between' => 'Tekst 2 mora biti kraći od 100 znakova',
                                'feature_link_2.between' => 'Link 2 mora biti kraći od 25 znakova',
                                'feature_icon_2.between' => 'Ikona 2 mora biti kraća od 50 znakova',
                                'feature_title_3.between' => 'Naslov 3 mora biti kraći od 25 znakova',
                                'feature_body_3.between' => 'Tekst 3 mora biti kraći od 100 znakova',
                                'feature_link_3.between' => 'Link 3 mora biti kraći od 25 znakova',
                                'feature_icon_3.between' => 'Ikona 3 mora biti kraća od 50 znakova'
    ];

    /**
     * model attributes
     */
    public static $feature_links = ['about-us' => 'O nama',
                                    'locations' => 'Lokacije/dvorane',
                                    'gallery' => 'Galerija slika',
                                    'news' => 'Obavijesti',
                                    'fun-facts' => 'Zanimljivosti'
    ];

    public static $feature_icons = ['fa fa-home fa-gig' => '<i class="fa">&#xf015;</i>',
                                    'fa fa-map-marker fa-gig' => '<i class="fa">&#xf041;</i>',
                                    'fa fa-map-signs fa-gig' => '<i class="fa">&#xf277;</i>',
                                    'fa fa-camera fa-gig' => '<i class="fa">&#xf030;</i>',
                                    'fa fa-calendar fa-gig' => '<i class="fa">&#xf073;</i>',
                                    'fa fa-info fa-gig' => '<i class="fa">&#xf129;</i>',
                                    'fa fa-child fa-gig' => '<i class="fa">&#xf1ae;</i>',
                                    'fa fa-users fa-gig' => '<i class="fag">&#xf0c0;</i>',
                                    'fa fa-user-plus fa-gig' => '<i class="fa">&#xf234;</i>',
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
    protected $table = 'features';

}