<?php

namespace Tests\Unit;

use App\Models\Reservation;
use App\Models\User;
use PHPUnit\Framework\TestCase;

class ReservationTest extends TestCase
{
    /** @test */
    public function reservation_can_cancelled_by_an_admin_return_true()
    {
        // arrange
        $user = new User();
        $reservation = new Reservation();

        // act
        $user->setIsAdmin(true);
        $result = $reservation->cancelledBy($user);

        // assert
        $this->assertTrue($result);
    }

    /** @test */
    public function reservation_can_be_cancelled_by_same_user_return_true()
    {
        $user = new User();
        $reservation = new Reservation();

        $user->setName('amirul');
        $reservation->setMadeBy($user);
        $result = $reservation->cancelledBy($user);

        $this->assertTrue($result);
    }

    /** @test */
    public function reservation_can_be_cancelled_by_another_user_return_false()
    {
        $amirul = new User();
        $amirul->setName('amirul');
        $ihsan = new User();
        $ihsan->setName('ihsan');
        $reservation = new Reservation();

        $reservation->setMadeBy($amirul);
        $result = $reservation->cancelledBy($ihsan);

        $this->assertFalse($result);
    }
}
