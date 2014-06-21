<?php
class Round extends Eloquent {

    public $timestamps = false;
    protected $primaryKey = 'RoundID';

    public function course()
    {
        return $this->hasOne('Course', 'CourseID', 'CourseID');
    }

}