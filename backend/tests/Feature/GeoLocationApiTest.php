<?php

namespace Tests\Feature;

use App\Entities\GeoPosition;
use App\Entities\Page;
use App\Entities\Session;
use App\Entities\System;
use App\Entities\User;
use App\Entities\Visit;
use App\Entities\Visitor;
use App\Entities\Website;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GeoLocationApiTest extends TestCase
{
    use RefreshDatabase;

    private const GEOLOCATION_RESPONSE_STRUCTURE = [
        'data' => [
            'all_visitors_count' => [
                '*' => self::TABLE_RESPONSE_STRUCTURE
            ],
            // 'newest_visitors_count'
        ],
        'meta' => []
    ];

    private const TABLE_RESPONSE_STRUCTURE = [
        'parameter',
        'parameter_value',
        'total',
        'percentage'
    ];

    private const URL = 'api/v1/geo-location-items';

    private $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
        factory(Website::class)->create();
        factory(Visitor::class, 3)->create();
        factory(Page::class)->create();
        factory(GeoPosition::class, 3)->create();
        factory(System::class, 3)->create();
        factory(Session::class, 3)->create();
        factory(Visit::class, 6)->create();
    }

    public function testGeoLocation()
    {
        $data = [
            'filter' => [
                'start_date' => (string) Carbon::create(2019)->timestamp,
                'end_date' => (string) Carbon::now()->timestamp
            ]
        ];

        $this->actingAs($this->user)
            ->json('GET', self::URL, $data)
            ->assertStatus(200)
            ->assertJsonStructure(self::GEOLOCATION_RESPONSE_STRUCTURE);
    }
}
