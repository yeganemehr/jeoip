<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomePageTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();
    }

    public function test_home_renders_in_persian_by_default(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('JeoIP', false);
        $response->assertSee('lang="fa"', false);
        $response->assertSee('dir="rtl"', false);
        $response->assertSee('سوالات متداول', false);
    }

    public function test_english_locale_renders_ltr(): void
    {
        $response = $this->get('/en');

        $response->assertStatus(200);
        $response->assertSee('lang="en"', false);
        $response->assertSee('dir="ltr"', false);
        $response->assertSee('Your IP Information:', false);
    }

    public function test_fa_locale_route(): void
    {
        $response = $this->get('/fa');

        $response->assertStatus(200);
        $response->assertSee('dir="rtl"', false);
    }

    public function test_unknown_locale_segment_is_not_matched(): void
    {
        $this->get('/de')->assertNotFound();
    }
}
