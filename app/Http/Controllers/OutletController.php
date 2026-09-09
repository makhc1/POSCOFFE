<?php

namespace App\Http\Controllers;

use App\Models\Outlet;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class OutletController extends Controller
{
    /**
     * Display outlets directory and map finder.
     */
    public function index(Request $request): View
    {
        $city = $request->query('city');
        $search = $request->query('q');
        $facility = $request->query('facility'); // 24h, drivethru, wifi

        $query = Outlet::query();

        if ($city && $city !== 'all') {
            $query->where('city', $city);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('address', 'like', "%{$search}%")
                    ->orWhere('city', 'like', "%{$search}%");
            });
        }

        if ($facility === '24h') {
            $query->where('is_24_hours', true);
        } elseif ($facility === 'drivethru') {
            $query->where('has_drive_thru', true);
        }

        $outlets = $query->orderBy('city', 'asc')->orderBy('name', 'asc')->get();
        $cities = Outlet::select('city')->distinct()->pluck('city');

        return view('outlets.index', compact('outlets', 'cities', 'city', 'search', 'facility'));
    }
}
