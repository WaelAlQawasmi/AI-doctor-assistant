<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\PaymentsService;
use App\Services\PointsService;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{

       public function __construct(private PointsService $pointService, private PaymentsService $paymentService)
    {
        $this->pointService = $pointService;
        $this->paymentService =$paymentService;
    }
    /**
     * this action to granting Trial Period for the user to has access to
     * AI system
     */
    public function grantingTrialPeriod(Request $request)
    {
        
        $trialPoint =$this->pointService->chargePoints( $request->id,10, 'trial');  // trial period is added with +10 points.
        $this->paymentService->setPayment( $request->id, 0, 10 ,$trialPoint,'free');
        $trialPoint =$this->pointService->chargePoints( $request->id,10, 'trial-advanced');  // trial period is added with +10 points.
        $this->paymentService->setPayment( $request->id, 0, 10 ,$trialPoint,'free');
       
        return response('', 201);
    }
    /**
     * action to add point to user manualy 
     */
    public function addPointsToUser(Request $request)
    {
        $pointsType=  $request->cost>0? "paid - $request->pointsType": "trial  - $request->pointsType";
        $paidPointId =$this->pointService->chargePoints($request->id, $request->points,$pointsType);
        $this->paymentService->setPayment( $request->id, $request->cost, $request->points,$paidPointId);
        return response('', 201);
        
    }
}
