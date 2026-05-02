<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KearifanLokal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KearifanLokalController extends Controller
{
    public function index()
    {
        $data = KearifanLokal::latest()->get();
        return view('admin.kearifan_lokal.index', compact('data'));
    }

    public function create()
    {
        return view('admin.kearifan_lokal.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_penyakit' => 'nullable|string|max:255',
            'penanganan_kearifan_lokal' => 'required|string|max:5000',
            'nama_obat' => 'required|string|max:255',
            'deskripsi_obat' => 'required|string|max:5000',
            'gambar_obat' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link_pembelian' => 'nullable|url|max:500',
        ]);

        if ($request->hasFile('gambar_obat')) {
            $path = $request->file('gambar_obat')->store('public/obat');
            $validated['gambar_obat'] = str_replace('public/', 'storage/', $path);
        }

        KearifanLokal::create($validated);

        return redirect()->route('admin.kearifan-lokal.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit(KearifanLokal $kearifanLokal)
    {
        return view('admin.kearifan_lokal.edit', compact('kearifanLokal'));
    }

    public function update(Request $request, KearifanLokal $kearifanLokal)
    {
        $validated = $request->validate([
            'nama_penyakit' => 'nullable|string|max:255',
            'penanganan_kearifan_lokal' => 'required|string|max:5000',
            'nama_obat' => 'required|string|max:255',
            'deskripsi_obat' => 'required|string|max:5000',
            'gambar_obat' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link_pembelian' => 'nullable|url|max:500',
        ]);

        if ($request->hasFile('gambar_obat')) {
            // Delete old image if exists
            if ($kearifanLokal->gambar_obat) {
                $oldPath = str_replace('storage/', 'public/', $kearifanLokal->gambar_obat);
                Storage::delete($oldPath);
            }
            
            $path = $request->file('gambar_obat')->store('public/obat');
            $validated['gambar_obat'] = str_replace('public/', 'storage/', $path);
        }

        $kearifanLokal->update($validated);

        return redirect()->route('admin.kearifan-lokal.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(KearifanLokal $kearifanLokal)
    {
        if ($kearifanLokal->gambar_obat) {
            $oldPath = str_replace('storage/', 'public/', $kearifanLokal->gambar_obat);
            Storage::delete($oldPath);
        }
        
        $kearifanLokal->delete();

        return redirect()->route('admin.kearifan-lokal.index')->with('success', 'Data berhasil dihapus.');
    }
}
