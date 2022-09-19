<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\User;

class KendaraanTest extends TestCase
{

    public function testLihatStokAllKendaraanWithoutAuth()
    {
        $response = $this->post('api/kendaraan/lihatStokAllKendaraan');

        $response->assertStatus(403);
    }

    public function testLihatStokAllKendaraanWithAuth()
    {   
        $user = User::where('username', 'test')->first();
        $token = JWTAuth::fromUser($user);
        $this->withHeader('Authorization', "Bearer {$token}");
        $response = $this->post('api/kendaraan/lihatStokAllKendaraan');

        $response->assertStatus(200);
    }

    public function testLihatStokByMerekWithoutAuth()
    {   
        $response = $this->post('api/kendaraan/lihatStokKendaraanByMerek');

        $response->assertStatus(403);
    }

    public function testLihatStokByMerekWithAuthAndParam()
    {   
        $user = User::where('username', 'test')->first();
        $token = JWTAuth::fromUser($user);
        $this->withHeader('Authorization', "Bearer {$token}");

        $testData = [
            'merek' => 'Ducati'
        ];

        $response = $this->post('api/kendaraan/lihatStokKendaraanByMerek', $testData);

        $response->assertStatus(200);
    }

    public function testLihatStokByMerekWithoutParam()
    {   
        $user = User::where('username', 'test')->first();
        $token = JWTAuth::fromUser($user);
        $this->withHeader('Authorization', "Bearer {$token}");


        $response = $this->post('api/kendaraan/lihatStokKendaraanByMerek');

        $response->assertStatus(400);
    }

    public function testJualKendaraanWithoutAuth()
    {   


        $response = $this->post('api/kendaraan/jualKendaraan');

        $response->assertStatus(403);
    }

    public function testJualKendaraanDataNotFound()
    {   
        $user = User::where('username', 'test')->first();
        $token = JWTAuth::fromUser($user);
        $this->withHeader('Authorization', "Bearer {$token}");

        $testData = [
            'merek' => 'Ducati',
            'qty' => '1'
        ];

        $response = $this->post('api/kendaraan/jualKendaraan', $testData);

        $response->assertStatus(400);
    }

    public function testJualKendaraanQtyMoreThanStok()
    {   
        $user = User::where('username', 'test')->first();
        $token = JWTAuth::fromUser($user);
        $this->withHeader('Authorization', "Bearer {$token}");

        $testData = [
            'merek' => 'Hyundai',
            'qty' => 100
        ];

        $response = $this->post('api/kendaraan/jualKendaraan', $testData);

        $response->assertStatus(400);
    }

    public function testJualKendaraanNormal()
    {   
        $user = User::where('username', 'test')->first();
        $token = JWTAuth::fromUser($user);
        $this->withHeader('Authorization', "Bearer {$token}");

        $testData = [
            'merek' => 'Ducati',
            'qty' => 1,
            'total_pembayaran' => 50000
        ];

        $response = $this->post('api/kendaraan/jualKendaraan', $testData);

        $response->assertStatus(200);
    }
    
}
