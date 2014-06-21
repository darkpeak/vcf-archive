@extends('layout')

@section('content')
<div class="container">
<h1>{{ $event->Name }}</h1>
    <h2>Event</h2>
    <p>Start: {{ date('j F Y', strtotime($event->Start)) }}</p>
    <p>Finish: {{ date('j F Y', strtotime($event->End)) }}</p>
    {{ Form::open(array('url' => '/results/event/' . $event->EventID, 'class' => 'form-inline', 'role' => 'form')) }}
    {{ Form::label('round', 'Select round', array('class' => 'control-label')) }}
    {{ Form::select('round', $roundsForEvent, $round->RoundNumber, array('class' => 'form-control')) }}
    {{ Form::submit('Go', array('class' => 'btn btn-default')) }}

    {{ Form::close() }}
    <h2>Round {{ $round->RoundNumber }}</h2>
    <p>Start: {{ date('j F Y', strtotime($round->Start)) }}</p>
    <p>Finish: {{ date('j F Y', strtotime($round->End)) }}</p>
    <div class="table-responsive">

    <table class="table table-striped table-hover table-condensed">
    <thead>
        <th></th>
        <th>Rider</th>
        <th>kg</th>
        <th>Div</th>
        <th>Time</th>
        <th>km/h</th>
        <th>watt</th>
        <th>bpm</th>
        <th>rpm</th>
        <th>Trainer</th>
        <th>Behind</th>
    </thead>
    <tbody>
    <?php $pos = 1; $prevTime = 0; $equal = 0; $winTime = 0; ?>
@foreach($results as $result)
    <tr>
        <?php
            if($pos == 1) $winTime = $result->TotalTime;
            if($result->TotalTime == $prevTime ) {
                --$pos;
                ++$equal;
            } else {
                $pos += $equal;
                $equal = 0;
            }
            $prevTime = $result->TotalTime
        ?>
        <td>{{ $pos++ }}{{ $equal > 0 ? '=' : '' }}</td>
        <td>{{ $result->Ridername }}</td>
        <td>{{ sprintf('%.0f', $result->Weight) }}</td>
        <td>{{ $result->DivisionName }}</td>
        <td>{{ gmdate("H:i:", $result->TotalTime); }}{{ sprintf('%04.1f', fmod($result->TotalTime , 60.0)) }}</td>
        <td>{{ sprintf('%.1f', $result->AvSpeed) }}</td>
        <td>{{ sprintf('%.0f', $result->AvPower) }}</td>
        <td>{{ $result->AvHR }}</td>
        <td>{{ $result->AvCadence }}</td>
        <td class="{{ strtolower($result->Trainer) }}">{{ $result->Trainer }}</td>
        <td>{{ gmdate("H:i:", $result->TotalTime - $winTime); }}{{ sprintf('%04.1f', fmod($result->TotalTime - $winTime, 60.0)) }}</td>
    </tr>
@endforeach
    </tbody>
</table>
        </div>
    </div>
@stop