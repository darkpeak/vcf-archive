@extends('layout')

@section('content')
<div class="container">
<h1>{{ $event->Name }}</h1>
<p>Start: {{ date('j F Y', strtotime($event->Start)) }}</p>
<p>Finish: {{ date('j F Y', strtotime($event->End)) }}</p>
<table class="table table-striped table-hover table-condensed">
    <thead>
        <th></th>
        <th>Rider</th>
        <th>Speed</th>
        <th>Power</th>
        <th>Cadence</th>
        <th>HR</th>
        <th>Total Time</th>
        <th>Handicap</th>
        <th>Penalty</th>
    </thead>
    <tbody>
    <?php $pos = 1; $prevTime = 0; $equal = 0; ?>
@foreach($results as $result)
    <tr {{ $result->TimePenalty > 0 ? 'class=\'danger\'' : '' }}>
        <?php
            if($result->TotalTime == $prevTime ) {
                --$pos;
                ++$equal;
            } else {
                $pos += $equal;
                $equal = 0;
            }
            $prevTime = $result->TotalTime;
        ?>
        <td>{{ $pos++ }}{{ $equal > 0 ? '=' : '' }}</td>
        <td>{{ $result->Ridername }}</td>
        <td>{{ sprintf('%.1f', $result->AvSpeed) }}</td>
        <td>{{ sprintf('%.0f', $result->AvPower) }}</td>
        <td>{{ $result->AvCadence }}</td>
        <td>{{ $result->AvHR }}</td>
        <td>{{ gmdate("H:i:", $result->TotalTime); }}{{ sprintf('%04.1f', fmod($result->TotalTime , 60.0)) }}</td>
        <td>{{ $result->HandicapDuration }}</td>
        <td>{{ $result->TimePenalty }}</td>
    </tr>
@endforeach
    </tbody>
</table>
    </div>
@stop