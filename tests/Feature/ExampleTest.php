<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_homepage_returns_a_successful_response(): void
    {
        $this->get('/')
            ->assertStatus(200);
    }

    public function test_projects_page_returns_a_successful_response(): void
    {
        $this->get('/projects')
            ->assertStatus(200);
    }

    public function test_bids_page_returns_a_successful_response(): void
    {
        $this->get('/bids')
            ->assertStatus(200);
    }
}