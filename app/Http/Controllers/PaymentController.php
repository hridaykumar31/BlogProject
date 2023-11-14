<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Token;
use App\Models\Payment;
class PaymentController extends Controller
{
    
    public function payment()
    {

        $id1 = auth()->user()->id;

        $payment = Payment::where('user_id', $id1)->first();

       
        if($payment)
        {
           
        $notify = ['message' => 'Subscription Successfully', 'alert-type' => 'success'];
        return redirect('/premium')->with('$notify');
        }
        else
        {
            
            $notify = ['message' => 'Subscription not Successfully', 'alert-type' => 'success'];
            return redirect('/user/recharge')->with('$notify');
        }
    }

    
}
