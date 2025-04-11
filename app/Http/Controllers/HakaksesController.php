<?php

namespace App\Http\Controllers;

use App\Models\hakakses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class HakaksesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $search = $request->get('search');
        if ($search) {
            $data['hakakses'] = hakakses::where('role', 'admin')
                ->where(function($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('id', 'like', "%{$search}%");
                })
                ->get();
        } else {
            $data['hakakses'] = hakakses::where('role', 'admin')->get();
        }
        return view('layouts.hakakses.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('layouts.hakakses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'role' => 'required'
        ]);

        $hakakses = new hakakses();
        $hakakses->name = $request->name;
        $hakakses->email = $request->email;
        $hakakses->password = bcrypt($request->password);
        $hakakses->role = $request->role;
        $hakakses->save();

        return redirect()->route('hakakses.index')
            ->with('message', 'User berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(hakakses $hakakses)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $hakakses = hakakses::find($id);
        return view('layouts.hakakses.edit', compact('hakakses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $hakakses = hakakses::find($id);
        $hakakses->role = $request->role;
        $hakakses->save();
        return redirect()->route('hakakses.index')->with('message', 'Role berhasil diupdate!');
    }

    public function sendOtp($id)
    {
        $hakakses = hakakses::find($id);
        $otp = mt_rand(100000, 999999);

        // Store OTP in cache for 5 minutes
        Cache::put('otp_' . $id, $otp, now()->addMinutes(5));

        // Send OTP via email
        Mail::send('emails.otp', ['otp' => $otp], function($message) use ($hakakses) {
            $message->to($hakakses->email)
                    ->subject('OTP untuk Melihat Password');
        });

        return redirect()->back()->with('otp_sent', true);
    }

    public function verifyOtp(Request $request, $id)
    {
        $hakakses = hakakses::find($id);
        $storedOtp = Cache::get('otp_' . $id);

        if (!$storedOtp || $request->otp != $storedOtp) {
            return redirect()->back()->with('error', 'OTP tidak valid atau sudah kadaluarsa');
        }

        // Clear the OTP from cache
        Cache::forget('otp_' . $id);

        // Generate new random password
        $newPassword = Str::random(12); // 12 karakter random

        // Save new password
        $hakakses->password = Hash::make($newPassword);
        $hakakses->save();

        // Force logout from all sessions
        DB::table('sessions')->where('user_id', $hakakses->id)->delete();

        // Send new password via email
        Mail::send('emails.password-reset', [
            'user' => $hakakses,
            'password' => $newPassword
        ], function($message) use ($hakakses) {
            $message->to($hakakses->email)
                    ->subject('Reset Password Berhasil');
        });

        return redirect()->back()->with('success', 'Password telah direset dan dikirim ke email ' . $hakakses->email . '. User akan diminta login ulang.');
    }

    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'new_password' => 'required|min:8|confirmed',
        ]);

        $hakakses = hakakses::find($id);
        $hakakses->password = Hash::make($request->new_password);
        $hakakses->save();

        // Force logout from all sessions
        DB::table('sessions')->where('user_id', $hakakses->id)->delete();

        return redirect()->back()->with('success', 'Password berhasil diupdate! User akan diminta login ulang.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $hakakses = hakakses::find($id);
        if ($hakakses) {
            $hakakses->delete();
            return redirect()->route('hakakses.index')
                ->with('message', 'User berhasil dihapus!');
        }

        return redirect()->route('hakakses.index')
            ->with('error', 'User tidak ditemukan!');
    }
}
