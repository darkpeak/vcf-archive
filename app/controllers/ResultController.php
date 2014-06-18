<?php

class ResultController extends BaseController {

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
        $id = e(Route::input('id'));
        $roundid = e(Route::input('roundid'));
        if($roundid == null)  $roundid = 1;
        $event = CyclingEvent::find($id);
        $results = Result::where('EventID', '=', $id)->orderBy('Duration')->get();

        return View::make('results', array('results' => $results, 'event' => $event));
    }

}