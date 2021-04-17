<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    public $madeBy;

    public function setMadeBy(User $user)
    {
        $this->madeBy = $user->name;
    }

    public function cancelledBy(User $user): bool
    {
        if ($user->isAdmin) {
            return true;
        }

        if ($this->madeBy == $user->name) {
            return true;
        }

        return false;
    }
}
