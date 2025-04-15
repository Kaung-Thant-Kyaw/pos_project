<?php

namespace App\Http\Controllers\Admins;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\PaymentHistory;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\User;

class AdminController extends Controller
{
    public function home()
    {
        $totalIncome = number_format(PaymentHistory::sum('total_amt'));

        $order = Order::where('status', 1)->count('status');

        $user_count = User::where('role', 'user')->count('id');

        $contact_messages = Contact::count('id');

        return view('admins.home.list', compact('totalIncome', 'order', 'user_count', 'contact_messages'));
    }
}
