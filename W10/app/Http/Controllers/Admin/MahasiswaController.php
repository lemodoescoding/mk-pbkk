<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\HasMiddleware;

class MahasiswaController extends Controller implements HasMiddleware
{
    /**
     * @return array<int, string>
     */
    public static function middleware(): array
    {
        return ['permission:hapus-data'];
    }

    public function destroy(Mahasiswa $mahasiswa): RedirectResponse
    {
        $this->authorize('delete', $mahasiswa);

        $mahasiswa->delete();

        return back()->with('status', 'Data mahasiswa berhasil dihapus.');
    }
}
