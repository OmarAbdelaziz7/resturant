<?php

namespace App\Http\Controllers;

use App\Models\StoreSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    /**
     * Show the settings page
     */
    public function index()
    {
        $user = Auth::user();
        $storeSettings = StoreSetting::getSettings();

        return view('admin.settings', [
            'user' => $user,
            'storeSettings' => $storeSettings,
        ]);
    }

    /**
     * Update settings
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'theme' => 'required|in:light,dark',
            'store_name' => 'required|string|max:255',
            'store_location' => 'required|string|max:255',
            'store_phone' => 'required|string|max:20',
            'store_email' => 'required|email|max:255',
            'store_description' => 'nullable|string|max:1000',
        ]);

        // Update user settings (name and theme)
        $user = Auth::user();
        $user->update([
            'name' => $request->name,
            'theme' => $request->theme,
        ]);

        // Update store settings
        $storeSettings = StoreSetting::getSettings();
        $storeSettings->update([
            'store_name' => $request->store_name,
            'store_location' => $request->store_location,
            'store_phone' => $request->store_phone,
            'store_email' => $request->store_email,
            'store_description' => $request->store_description,
        ]);

        return redirect()->route('admin.settings')
            ->with('success', 'Settings updated successfully!');
    }
}
