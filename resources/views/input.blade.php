{{-- File: resources/views/input.blade.php --}}
<x-app-layout>
    
    <div class="row g-5"> {{-- g-5 memberi jarak (gutter) antar kolom --}}
        
        {{-- Kolom 1: Form Input (Lebar 5 dari 12 di layar besar) --}}
        <div class="col-lg-5">
            <x-table.form />
        </div>

        {{-- Kolom 2: Tabel Data (Lebar 7 dari 12 di layar besar) --}}
        <div class="col-lg-7">
            <x-table.table />
        </div>

    </div>

</x-app-layout>