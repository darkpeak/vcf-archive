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
        $roundNo = e(Input::get('round'));
        $id = e(Route::input('id'));
        if(strlen($roundNo) == 0) {
            $roundNo = e(Route::input('round'));
            if($roundNo == null)  $roundNo = 1;
        }
        $round = Round::where('EventID', '=', $id)->where('RoundNumber', '=', $roundNo)->firstOrFail();
        $roundsForEvent = Round::where('EventID', '=', $id)->orderBy('RoundNumber')->get();
        $roundsForEventSelect = array();
        foreach($roundsForEvent as $r) {
            $coursename = $r->course !== null ? $r->course->Name : '[deleted course]';
            $roundsForEventSelect[$r->RoundNumber] = $r->RoundNumber . ': ' . $coursename;
        }
        $event = CyclingEvent::find($id);

        $results = DB::table('results')
            ->select(DB::raw('results.*, duration + timepenalty as TotalTime,divisions.DivisionID,divisions.DivisionName, teams.Name as TeamName,teams.Colour,concat(lower(countries.code), ".png")'))
            ->leftJoin('eventrider', function($join) {
                    $join->on('results.ridername', '=', 'eventrider.ridername')
                    ->on('results.eventid', '=', 'eventrider.eventid');
                })
            ->leftJoin('divisions', 'eventrider.divisionid', '=', 'divisions.divisionid')
            ->leftJoin('teamrider', function($join) {
                $join->on('results.ridername', '=', 'teamrider.ridername')
                    ->on('results.eventid','=','teamrider.eventid');
            })
            ->leftJoin('teams', 'teamrider.teamid', '=', 'teams.teamid')
            ->leftJoin('profiledata', 'profiledata.fullname', '=', 'results.ridername')
            ->leftJoin('countries', 'countries.name', '=', 'profiledata.country')
            ->where('roundid', '=', $round->RoundID)
            ->orderByRaw('Duration + TimePenalty, AvSpeed desc')
            ->get();

        return View::make('results', array('results' => $results, 'event' => $event, 'round' => $round, 'roundsForEvent' => $roundsForEventSelect));
    }

}