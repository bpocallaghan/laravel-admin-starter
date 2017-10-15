<?php

namespace App\Models\Traits;

use App\Models\BankCard;
use App\Models\Role;

trait UserHelper
{
    /**
     * Get the user fullname (firstname + lastname)
     *
     * @return string
     */
    public function getFullnameAttribute()
    {
        return $this->attributes['firstname'] . ' ' . $this->attributes['lastname'];
    }

    /**
     * Get the last 7 digits of the cellphone number
     * @return string
     */
    public function getCellphone7Attribute()
    {
        return substr($this->cellphone, -7);
    }

    /**
     * Is User Disabled
     * @return int
     */
    public function getIsDisabledAttribute()
    {
        return $this->attributes['disabled_at'] == null ? 0 : 1;
    }

    /**
     * Get the disabled at status badge
     * @return string
     */
    public function getIsDisabledBadgeAttribute()
    {
        return $this->is_disabled ? '<span class="badge bg-red">disabled</span>' : '<span class="badge bg-green">active</span>';
    }

    /**
     * Set the unique confirmation_token
     *
     * @param [string] $confirmation_token
     */
    public function setConfirmationTokenAttribute($value)
    {
        // if null - dont generate and set null in table
        if (is_null($value)) {
            $this->attributes['confirmation_token'] = null;
        }
        else {
            $this->attributes['confirmation_token'] = $this->getUniqueConfirmationToken();
        }
    }

    private function getUniqueConfirmationToken()
    {
        $token = token($this->email);
        if (self::where('confirmation_token', $token)->first()) {
            return $this->getUniqueConfirmationToken();
        }

        return $token;
    }
}