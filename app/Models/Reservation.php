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
        return $user->isAdmin || $this->madeBy === $user->name;
    }
}
