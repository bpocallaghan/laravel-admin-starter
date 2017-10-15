<?php

namespace App\Events;

use App\Models\UserInvite;
use App\User;
use Carbon\Carbon;
use App\Models\Role;
use Illuminate\Queue\SerializesModels;
use App\Notifications\UserRegistered as NotifyUserRegistered;

class UserRegistered
{
    use SerializesModels;

    /**
     * Create a new event instance.
     * @param User $user
     * @param null $token
     */
    public function __construct(User $user, $token = null)
    {
        $roles = [Role::$WEBSITE];

        // if token - add admin role and mark as claimed
        $userInvite = UserInvite::whereToken($token)->whereNull('claimed_at')->first();
        if ($userInvite) {
            $roles[] = Role::$ADMIN;
            // set invite claimed
            $user->update(['gender' => 'male']);
            $userInvite->update(['claimed_at' => Carbon::now()]);
        }

        // attach the roles to the user
        $user->syncRoles($roles);

        // notify / send email to user to confirm account
        $user->notify(new NotifyUserRegistered());

        log_activity('User Registered', $user->fullname . ' registered as a new user.', $user);
    }
}
