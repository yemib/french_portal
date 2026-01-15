<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Hostel extends Model
{
    protected  $fillable = [
        "title",
        "rooms",
        "room_capacity"
    ];

    public function hostel_allocations()
    {
        return $this->hasMany(HostelAllocation::class);
    }

    public function getCapacityAttribute()
    {
        return $this->rooms * $this->room_capacity;
    }

    public function getSpacesRemainingAttribute()
    {
        $current_session = Session::orderBy("start", "desc")->first();
        $spaces_taken = $this->hostel_allocations->where("session_id", $current_session->id)->count();

        /*foreach ( as $hostel_allocation)
        {

        }*/

        return $this->capacity - $spaces_taken;
    }
}
