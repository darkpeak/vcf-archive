<?php
class CyclingEvent extends Eloquent {

    protected $table = 'events';
    protected $primaryKey = 'EventID';
    public $timestamps = false;

    public function eventType()
    {
        return $this->hasOne('EventType', 'EventTypeID', 'EventTypeID');
    }
}