<x-filament-panels::page>
    @if (session('status'))
        <x-filament::section>
            <p class="pm-flash">
                {{ session('status') }}
            </p>
        </x-filament::section>
    @endif

    <x-filament::section heading="Filter Pencarian" description="Cari mahasiswa berdasarkan nama/NRP, departemen, dan status aktif.">
        <form method="GET" action="{{ url()->current() }}" class="pm-filter-grid">
            <div>
                <label for="search" class="pm-label">
                    Keyword
                </label>
                <x-filament::input.wrapper>
                    <x-filament::input
                        id="search"
                        name="search"
                        type="text"
                        value="{{ $search }}"
                        placeholder="Nama atau NRP..."
                    />
                </x-filament::input.wrapper>
            </div>

            <div>
                <label for="departemen" class="pm-label">
                    Departemen
                </label>
                <x-filament::input.wrapper>
                    <x-filament::input.select id="departemen" name="departemen">
                        <option value="">Semua Departemen</option>
                        @foreach ($departemens as $departemenOption)
                            <option value="{{ $departemenOption }}" @selected($departemen === $departemenOption)>
                                {{ $departemenOption }}
                            </option>
                        @endforeach
                    </x-filament::input.select>
                </x-filament::input.wrapper>
            </div>

            <div>
                <label for="status" class="pm-label">
                    Status
                </label>
                <x-filament::input.wrapper>
                    <x-filament::input.select id="status" name="status">
                        <option value="">Semua Status</option>
                        <option value="aktif" @selected($status === 'aktif')>Aktif</option>
                        <option value="nonaktif" @selected($status === 'nonaktif')>Nonaktif</option>
                    </x-filament::input.select>
                </x-filament::input.wrapper>
            </div>

            <div class="pm-actions">
                <x-filament::button type="submit">
                    Cari
                </x-filament::button>

                <x-filament::button tag="a" href="{{ url()->current() }}" color="gray">
                    Reset
                </x-filament::button>
            </div>
        </form>
    </x-filament::section>

    <x-filament::section
        heading="Data Mahasiswa"
        description="Pagination mempertahankan seluruh parameter filter aktif melalui withQueryString()."
    >
        <div class="pm-table-wrap">
            <table class="pm-table">
                <thead>
                    <tr>
                        <th>NRP</th>
                        <th>Nama</th>
                        <th>Departemen</th>
                        <th>Angkatan</th>
                        <th>Status</th>
                        @can('hapus-data')
                            <th class="pm-right">Aksi</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @forelse ($mahasiswas as $mahasiswa)
                        <tr>
                            <td class="pm-mono">{{ $mahasiswa->nrp }}</td>
                            <td>{{ $mahasiswa->nama }}</td>
                            <td>{{ $mahasiswa->departemen }}</td>
                            <td>{{ $mahasiswa->angkatan }}</td>
                            <td>
                                <x-filament::badge :color="$mahasiswa->is_active ? 'success' : 'gray'">
                                    {{ $mahasiswa->is_active ? 'Aktif' : 'Nonaktif' }}
                                </x-filament::badge>
                            </td>
                            @can('hapus-data')
                                <td class="pm-right">
                                    <form method="POST" action="{{ route('admin.mahasiswa.destroy', $mahasiswa) }}"
                                          onsubmit="return confirm('Yakin ingin menghapus data mahasiswa ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <x-filament::button type="submit" color="danger" size="xs">
                                            Hapus
                                        </x-filament::button>
                                    </form>
                                </td>
                            @endcan
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="pm-empty">
                                Tidak ada data mahasiswa yang cocok dengan filter.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pm-pagination">
            {{ $mahasiswas->links('vendor.pagination.admin') }}
        </div>
    </x-filament::section>
</x-filament-panels::page>
