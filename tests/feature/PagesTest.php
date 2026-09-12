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
        $result->assertSee('A simple starting point for a point-of-sale system');
    }

    public function testAboutPageLoads(): void
    {
        $result = $this->get('/about');

        $result->assertStatus(200);
        $result->assertSee('How this beginner project works');
    }

    public function testCustomerPageShowsStaticRecords(): void
    {
        $result = $this->get('/customers');

        $result->assertStatus(200);
        $result->assertSee('Ana Santos');
        $result->assertSee('Ella Garcia');
    }

    public function testUserPageShowsStaticRecords(): void
    {
        $result = $this->get('/users');

        $result->assertStatus(200);
        $result->assertSee('admin01');
        $result->assertSee('manager01');
    }
}
