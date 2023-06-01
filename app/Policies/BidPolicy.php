<?php

namespace App\Policies;

use App\Models\Bid;
use App\Models\Car;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;

class BidPolicy
{
  

    /**
     * Determine whether the user can create models.
     */

    public function create(User $user,Car $car): Response
    {
        
    
       
        return $car->user_id != $user->id
                ? Response::allow()
                : Response::deny('You cannot bid on your own car.');

    }

    
}
