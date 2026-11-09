<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DemoLoginController extends Controller
{
    public function __invoke(Request $request, string $role): RedirectResponse
    {
        abort_unless(app()->environment('local', 'testing'), 404);

        $email = match ($role) {
            'admin' => 'admin@demo.test',
            'staf' => 'staf@demo.test',
            'mahasiswa' => 'mahasiswa@demo.test',
            default => abort(404),
        };

        $user = User::query()->where('email', $email)->firstOrFail();

        Auth::login($user);
        $request->session()->regenerate();

        if ($user->hasAnyRole(['Admin', 'Staf'])) {
            return redirect('/admin');
        }

        return redirect('/beranda');
    }
}
