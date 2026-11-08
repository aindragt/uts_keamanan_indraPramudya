<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class MahasiswaController extends Controller
{
    private function rules($id = null): array
    {
        return [
            'nim'     => ['required','string','max:20', Rule::unique('mahasiswas','nim')->ignore($id)],
            'nama'    => 'required|string|max:100',
            'email'   => 'required|email|max:100',
            'jurusan' => 'required|string|max:100',
            'no_hp'   => 'required|string|max:20',
            'alamat'  => 'required|string|max:255',
        ];
    }

    public function index()
    {
        $mahasiswas = Mahasiswa::latest()->paginate(10);
        return view('mahasiswa.index', compact('mahasiswas'));
    }

    public function create()
    {
        return view('mahasiswa.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->rules());
        $data = array_map('strip_tags', $data);               // sanitasi input
        $data['alamat'] = Crypt::encryptString($data['alamat']); // enkripsi
        Mahasiswa::create($data);

        return redirect()->route('mahasiswa.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        $mahasiswa->alamat = Crypt::decryptString($mahasiswa->alamat); // dekripsi untuk form
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $data = $request->validate($this->rules($mahasiswa->id));
        $data = array_map('strip_tags', $data);
        $data['alamat'] = Crypt::encryptString($data['alamat']);
        $mahasiswa->update($data);

        return redirect()->route('mahasiswa.index')->with('success', 'Data berhasil diubah');
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        Gate::authorize('delete-mahasiswa'); // hanya admin
        $mahasiswa->delete();

        return redirect()->route('mahasiswa.index')->with('success', 'Data berhasil dihapus');
    }
}