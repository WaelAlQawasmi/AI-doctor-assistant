<?php

namespace App\Http\Controllers;

use App\Models\payments;
use App\Models\pointManagement;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    public function grantingTrialPeriod( Request $request){
        $trialPoint = pointManagement::create(['user_id'=>$request->id,
                                         'points'=>20,
                                         'point_type'=>'trial'
                                                        ]);
        payments::create([
            'user_id'=>$request->id,
            'pay_type'=>'free',
            'cost'=>0,
            'number_of_points'=>20,
            'points_id'=>$trialPoint->id,
        ]);
        return response('',200);
    }
    public function addPointsToUser( Request $request){
        $paidPoint = pointManagement::create(['user_id'=>$request->id,
                                         'points'=>$request->points,
                                         'point_type'=>'paid'
                                                        ]);
        payments::create([
            'user_id'=>$request->id,
            'pay_type'=>'cash',
            'cost'=>$request->cost,
            'number_of_points'=>$request->points,
            'points_id'=>$paidPoint->id,
        ]);
        return response('',200);
    }
}
