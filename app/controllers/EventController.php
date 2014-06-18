<?php

class EventController extends BaseController {

    /*
    |--------------------------------------------------------------------------
    | Default Home Controller
    |--------------------------------------------------------------------------
    |
    | You may wish to use controllers instead of, or in addition to, Closure
    | based routes. That's great! Here is an example controller method to
    | get you started. To route to this controller, just add the route:
    |
    |	Route::get('/', 'HomeController@showWelcome');
    |
    */

    public function index()
    {
//        $events = CyclingEvent::all()->orderBy('End', 'asc');
        $events = CyclingEvent::where('Visible', '<>', 0)->orderBy('Start')->get();

        return View::make('events')->with('events', $events);
    }

}