<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

final class PagesTest extends CIUnitTestCase
{
    use FeatureTestTrait;

    public function testHomePageLoads(): void
    {
        $result = $this->get('/');

        $result->assertStatus(200);
        $result->assertSee('Tasks for Today');
    }

    public function testAboutPageLoads(): void
    {
        $result = $this->get('/about');

        $result->assertStatus(200);
        $result->assertSee('A focused view of daily work.');
    }

    public function testTaskPageShowsAllDatabaseRecords(): void
    {
        $result = $this->get('/tasks');

        $result->assertStatus(200);
        $result->assertSee('Finish the dashboard views');
        $result->assertSee('Deploy and verify the live website');
    }

    public function testProfilePageShowsTheDemoUser(): void
    {
        $result = $this->get('/profile');

        $result->assertStatus(200);
        $result->assertSee('Angelo Kacey N. Pineda');
        $result->assertSee('angelowww11');
    }
}
