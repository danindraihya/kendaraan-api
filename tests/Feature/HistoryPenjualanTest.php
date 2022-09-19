<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\User;

class HistoryPenjualanTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testLaporanPenjualanPerKendaraanWithAuth()
    {
        $user = User::where('username', 'test')->first();
        $token = JWTAuth::fromUser($user);
        $this->withHeader('Authorization', "Bearer {$token}");

        $testData = [
            'merek' => 'Hyundai'
        ];

        $response = $this->post('api/kendaraan/getLaporanPenjualanPerKendaraan', $testData);

        $response->assertStatus(200);
    }

    public function testLaporanPenjualanPerKendaraanWithoutAuth()
    {
        $response = $this->post('api/kendaraan/getLaporanPenjualanPerKendaraan');

        $response->assertStatus(403);
    }

    public function testLaporanPenjualanPerKendaraanWithoutParam()
    {

        $user = User::where('username', 'test')->first();
        $token = JWTAuth::fromUser($user);
        $this->withHeader('Authorization', "Bearer {$token}");

        $response = $this->post('api/kendaraan/getLaporanPenjualanPerKendaraan');

        $response->assertStatus(400);
    }
}
