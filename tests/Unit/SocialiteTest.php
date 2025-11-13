<?php

namespace Saeedvir\SocialiteSlim\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Saeedvir\SocialiteSlim\Socialite;

class SocialiteTest extends TestCase
{
    /** @test */
    public function it_can_create_instance()
    {
        $socialite = new Socialite();
        $this->assertInstanceOf(Socialite::class, $socialite);
    }
}