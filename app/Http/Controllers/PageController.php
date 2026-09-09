<?php

namespace App\Http\Controllers;

use App\Models\PartnershipInquiry;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display About Us / Brand Story.
     */
    public function about(): View
    {
        return view('about');
    }

    /**
     * Display Franchise / Partnership page.
     */
    public function kemitraan(): View
    {
        return view('kemitraan');
    }

    /**
     * Store franchise partnership inquiry.
     */
    public function submitKemitraan(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'phone' => 'required|string|max:25',
            'city' => 'required|string|max:50',
            'location_plan_or_position' => 'nullable|string|max:150',
            'budget_or_experience' => 'nullable|string|max:100',
            'message' => 'nullable|string|max:500',
        ]);

        PartnershipInquiry::create([
            'type' => 'franchise',
            'full_name' => $validated['full_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'city' => $validated['city'],
            'location_plan_or_position' => $validated['location_plan_or_position'] ?? 'Ruko / Standalone',
            'budget_or_experience' => $validated['budget_or_experience'] ?? 'Rp 150jt - 300jt',
            'message' => $validated['message'] ?? '',
            'status' => 'baru',
        ]);

        return back()->with('success', 'Terima kasih atas minat kemitraan Anda! Tim Business Development Kopi Gacoan akan segera menghubungi Anda via WhatsApp & Email.');
    }

    /**
     * Display Career page.
     */
    public function karir(): View
    {
        return view('karir');
    }

    /**
     * Store job application.
     */
    public function submitKarir(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'phone' => 'required|string|max:25',
            'city' => 'required|string|max:50',
            'position' => 'required|string|max:100',
            'experience' => 'nullable|string|max:100',
            'message' => 'nullable|string|max:500',
        ]);

        PartnershipInquiry::create([
            'type' => 'career',
            'full_name' => $validated['full_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'city' => $validated['city'],
            'location_plan_or_position' => $validated['position'],
            'budget_or_experience' => $validated['experience'] ?? 'Fresh Graduate / < 1 Tahun',
            'message' => $validated['message'] ?? '',
            'status' => 'baru',
        ]);

        return back()->with('success', 'Lamaran Anda berhasil dikirim! Kami akan mereview profil Anda untuk panggilan interview Barista Squad.');
    }
}
