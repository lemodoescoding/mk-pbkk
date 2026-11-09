<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home(Request $request)
    {
        return view('pages.home', [
            'title' => 'Beranda',
            'user' => $request->query('user'),   // Challenge 2
        ]);
    }

    public function profil()
    {
        return view('pages.profil', [
            'title' => 'Profil Mahasiswa',
            'profil' => [
                'Nama' => 'Ahmad Satrio Arrohman',
                'NRP' => '5025241061',
                'Departemen' => 'Teknik Informatika',
                'Angkatan' => '2026',
            ],
        ]);
    }

    public function ide(Request $request)
    {
        return view('pages.ide', [
            'title' => 'Ide Riset Agentic AI',
            // 'dark'  => $request->query('mode') === 'dark',   // Challenge 1
        ]);
    }

    public function kirimIde(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:100',
            'ide' => 'required|string|min:10',
        ]);

        return redirect()->route('ide', $request->only('mode'))
            ->with('status', 'Terima kasih '.$data['nama'].', ide kamu sudah tercatat!');
    }
}
