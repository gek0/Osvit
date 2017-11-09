<?php

class LocationController extends BaseController
{

    /**
     * CSRF validation on requests
     */
    public function __construct()
    {
        $this->beforeFilter('crfs', ['on' => ['post', 'put', 'patch', 'delete']]);
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
}