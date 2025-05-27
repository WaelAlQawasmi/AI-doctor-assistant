<?php
namespace App\Services;

use App\Models\payments;

class PaymentsService
{
    public function setPayment ($userId,$cost,$points,$paidPointId,$payTyp='cash'){
        
         payments::create([
            'user_id' => $userId,
            'pay_type' => $payTyp,
            'cost' => $cost,
            'number_of_points' => $points,
            'points_id' => $paidPointId,
        ]);
    }
}