<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Cashier\Billable;

class Team extends Model
{
    use HasFactory;
    use Billable;

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot(TeamUser::class);
    }
}
