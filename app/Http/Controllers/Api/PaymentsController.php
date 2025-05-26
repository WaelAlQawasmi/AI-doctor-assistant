<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\payments;
use App\Services\PointsService;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{

       public function __construct(private PointsService $pointService)
    {
        $this->pointService = $pointService;
    }
    /**
     * this action to granting Trial Period for the user to has access to
     * AI system
     */
    public function grantingTrialPeriod(Request $request)
    {
        
        $trialPoint =$this->pointService->chargePoints( $request->id,10, 'trial');  // trial period is added with +10 points.
        self::paymentRegister( $request->id, 10,$trialPoint, 'free' ,0);  
       
        $trialPoint =$this->pointService->chargePoints( $request->id,10, 'trial-advanced');  // trial period is added with +10 points.
        self::paymentRegister( $request->id, 10,$trialPoint, 'free' ,0);  
        return response('', 201);
    }
    /**
     * action to add point to user manualy 
     */
    public function addPointsToUser(Request $request)
    {
        $pointsType=  $request->cost>0? "paid - $request->pointsType": "trial  - $request->pointsType";
        $paidPointId =$this->pointService->chargePoints($request->id, $request->points,$pointsType);
        payments::create([
            'user_id' => $request->id,
            'pay_type' => 'cash',
            'cost' => $request->cost,
            'number_of_points' => $request->points,
            'points_id' => $paidPointId,
        ]);
        return response('', 201);
    }
/**
 * this function to log payment
 */
    public static function  paymentRegister ($userId, $points, $points_id, $pay_type, $cost){
       
        payments::create([
            'user_id' => $userId,
            'pay_type' => $pay_type,
            'cost' =>$cost,
            'number_of_points' => $points,
            'points_id' => $points_id,
        ]);
    }
}
