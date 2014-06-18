@extends('layout')

@section('content')
<div class="container">
    <table class="table">

        <?php $year = null ?>
            @foreach($events as $event)
                <?php
                $nextYear = date('Y', strtotime($event->Start));
                if($nextYear <> $year) {
                    if($year != null)
                        echo '</tbody></table>';
                    echo '<h2>' . $nextYear . '</h2>';
                    ?>
                    <table class="table">
                        <thead>
                        <tr><th>Event</th><th>Type</th><th>Start</th><th>End</th></tr>
                        </thead>
                        <tbody>

                    <?php
                }
                $year = $nextYear;
                ?>

                <tr><td><a href="/results/event/{{ $event->EventID }}">{{ $event->Name }}</a></td><td>{{ $event->eventType->Name }}</td><td>{{ date('j F Y', strtotime($event->Start)) }}</td><td>{{ date('j F Y', strtotime($event->End)) }}</td></tr>
            @endforeach
        </tbody>
    </table>
</div>
@stop