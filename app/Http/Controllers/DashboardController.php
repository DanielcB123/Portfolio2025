<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Show the main TaskFlow board.
     */
    public function index(Request $request): Response
    {
        return Inertia::render('Dashboard', [
            // 'teams' => [],
            // 'tasks' => [],
        ]);
    }
}
