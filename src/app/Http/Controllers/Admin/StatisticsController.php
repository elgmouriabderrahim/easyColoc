<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Colocation;
use App\Models\Category;
use App\Models\Expense;

class StatisticsController extends Controller
{
    public function index()
    {
        $userCount = User::count();
        $colocationCount = Colocation::count();
        $categoriesCount = Category::count();
        $expensesCount = Expense::count();
        $trustedUsersCount = User::where('reputation_score', '>', 0)->count();
        $untrustedUsersCount =  User::where('reputation_score', '<=', 0)->count();
        $neutralUsersCount = User::where('reputation_score', 0)->count();

        return view('admin.statistics.index', compact('userCount', 'colocationCount', 'categoriesCount', 'expensesCount', 'trustedUsersCount', 'untrustedUsersCount', 'neutralUsersCount'));
    }
}
