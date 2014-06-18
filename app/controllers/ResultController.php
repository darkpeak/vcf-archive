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
        $roundNo = e(Route::input('round'));
        if($roundNo == null)  $roundNo = 1;
        $round = Round::where('EventID', '=', $id)->where('RoundNumber', '=', $roundNo)->firstOrFail();
        $event = CyclingEvent::find($id);
//
//        $sql = "select results.*, duration + timepenalty as TotalTime,divisions.DivisionID,divisions.DivisionName, teams.Name as TeamName,teams.Colour,concat(lower(countries.code), '.png') as flagname,profiledata.country as country " .
//        "from results " .
//        "left join eventrider on results.ridername = eventrider.ridername and results.eventid = eventrider.eventid " .
//        "left join divisions on eventrider.divisionid = divisions.divisionid " .
//        "left join teamrider on results.ridername=teamrider.ridername and results.eventid=teamrider.eventid " .
//        "left join teams on teamrider.teamid=teams.teamid " .
//        "left join profiledata on profiledata.fullname = results.ridername " .
//        "left join countries on countries.name = profiledata.country " .
//        "where roundid = ?roundid and results.trainer like ?trainer order by Duration + TimePenalty";

//        $results = Result::where('EventID', '=', $id)->where('RoundID', '=', $round->RoundID)->orderBy('Duration')->get();
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

        return View::make('results', array('results' => $results, 'event' => $event));
    }

}