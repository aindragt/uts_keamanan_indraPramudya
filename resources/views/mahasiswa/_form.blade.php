@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@foreach(['nim' => 'NIM', 'nama' => 'Nama', 'email' => 'Email', 'jurusan' => 'Jurusan', 'no_hp' => 'No HP'] as $field => $label)
<div class="mb-3">
    <label class="form-label">{{ $label }}</label>
    <input type="text" name="{{ $field }}"
           class="form-control @error($field) is-invalid @enderror"
           value="{{ old($field, $mahasiswa->$field ?? '') }}">
    @error($field)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
@endforeach

<div class="mb-3">
    <label class="form-label">Alamat</label>
    <textarea name="alamat" rows="3"
              class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat', $mahasiswa->alamat ?? '') }}</textarea>
    @error('alamat')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<button type="submit" class="btn btn-success">Simpan</button>
<a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">Batal</a>