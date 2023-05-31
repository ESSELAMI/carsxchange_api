<?php

namespace App\Policies;

use App\Models\Bid;
use App\Models\Car;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BidPolicy
{
  

    /**
     * Determine whether the user can create models.
     */
    
    public function create(User $user,Car $car): bool
    {
        return $user->id !== $car->user_id;

    }

    
}
