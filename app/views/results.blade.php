@extends('layout')

@section('content')
<h1>{{ $event->Name }}</h1>
<table>
    <thead><th>Rider</th><th>Time</th></thead>
    <tbody>
@foreach($results as $result)
    <tr><td>{{ $result->Ridername }}<td><td>{{ gmdate("H:i:", $result->Duration); }}{{ sprintf('%05.2f', fmod($result->Duration , 60.0)) }}</td></tr>
@endforeach
    </tbody>
</table>
@stop