<?php

namespace App\Http\Controllers;
use App\Models\Token;
use App\Models\Payment;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
public function generateToken(Request $request)
{
    
    $tokenValue = Str::random(20);
    
    Token::create(['value' => $tokenValue]);
    
    return view('admin.token_generated', ['token' => $tokenValue]);
}

public function subscribe()
{
    $usersWithPayments = DB::table('users')
        ->join('payments', 'users.id', '=', 'payments.user_id')
        ->select('users.name', 'payments.amount', 'payments.token','payments.created_at')
        ->distinct()
        ->get();

    return view('admin.subscriber', ['usersWithPayments' => $usersWithPayments]);
}






}
