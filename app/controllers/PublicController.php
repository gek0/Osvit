<?php

class PublicController extends BaseController {

    /**
     * CSRF validation on requests
     */
    public function __construct()
    {
        $this->beforeFilter('crfs', ['on' => ['post', 'put', 'patch', 'delete']]);
    }

    /**
     * show homepage
     * @return mixed
     */
    public function showHome()
    {
        return "HOME";
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
            $messages = ['full_name.required' => 'Zaboravili ste unjeti ime i prezime / Full name is mandatory',
                'full_name.between' => 'Ime i prezime ne mogu biti dulji od 100 znakova i kraæi od 2 / Full name length max. 100 chars and min. 2 chars',
                'email.required' => 'E-mail adresa je obavezno polje / E-mail is mandatory',
                'email.email' => 'Unjeta e-mail adresa nije važeæa / E-mail is invalid',
                'subject.required' => 'Zaboravili ste unjeti naslov poruke / Subjectis mandatory',
                'subject.between' => 'Naslov poruke ne može biti dulji od 100 znakova i kraæi od 2 / Subject length max. 100 chars and min. 2 chars',
                'message_body.required' => 'Poruka je obavezno polje / Message is mandatory',
                'message_body.min' => 'Poruka je prekratka, minimalno 10 znakova / Message too short, min. 10 chars',
                'g-recaptcha-response.required' => 'Captcha je obavezna / Captcha is mandatory',
                'g-recaptcha-response.captcha' => 'Captcha nije važeæa / Captcha response is invalid'
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
                    'errors' => 'Nevažeæi CSRF token!'
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
                            'errors' => 'E-mail nije mogao biti poslan - E-mail was not sent.'
                        ]);
                    }
                }
            }
        }
        else{
            return Response::json(['status' => 'error',
                'errors' => 'Podaci nisu poslani Ajax-om! - Data not sent with Ajax!'
            ]);
        }
    }
}
