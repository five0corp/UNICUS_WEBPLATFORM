<?php

use App\Models\User;
use App\Models\ProductBidding;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('bid', function ($user) {
    // return true;
    return ['id' => $user->id, 'name' => $user->username];
});

Broadcast::channel('bidenter.{product}', function ($user,ProductBidding $product) {

    // if($user->id == $product->user_id || $user->id == $product->user_id )
    // {
    //     return false;
    // }
    return true;
});