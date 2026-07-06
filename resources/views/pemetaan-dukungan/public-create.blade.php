@extends('layouts.guest')

@section('content')
<!-- Google Fonts: Plus Jakarta Sans & Material Symbols -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&display=swap" rel="stylesheet">

<style>
    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
    }
    
    .glass-card {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.4);
    }
    
    .dark .glass-card {
        background: rgba(15, 23, 42, 0.65);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.06);
    }
    
    .logo-container {
        position: relative;
        display: inline-block;
    }
    
    .logo-container::before {
        content: '';
        position: absolute;
        inset: -12px;
        border-radius: 9999px;
        background: radial-gradient(circle, var(--color-brand) 0%, transparent 70%);
        opacity: 0.15;
        z-index: -1;
        animation: pulse-glow 3s infinite ease-in-out;
    }
    
    @keyframes pulse-glow {
        0%, 100% { transform: scale(1); opacity: 0.15; }
        50% { transform: scale(1.2); opacity: 0.3; }
    }
    
    .input-wrapper {
        position: relative;
    }
    
    .input-icon {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #9CA3AF;
        pointer-events: none;
        transition: color 0.2s, transform 0.2s;
    }
    
    .input-field {
        padding-left: 44px !important;
        transition: all 0.25s ease;
        border-radius: 12px;
    }
    
    .input-field:focus {
        border-color: var(--color-brand) !important;
        box-shadow: 0 0 0 4px var(--color-brand-soft) !important;
        background-color: #fff !important;
    }
    
    .dark .input-field:focus {
        background-color: rgba(3, 7, 18, 0.4) !important;
    }
    
    .btn-submit {
        background: linear-gradient(135deg, var(--color-brand) 0%, var(--color-brand-dark) 100%);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border-radius: 12px;
    }
    
    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px -5px var(--color-brand-soft);
        opacity: 0.95;
    }
    
    .btn-submit:active {
        transform: translateY(0);
    }
    
    /* Custom Checkmark Animation */
    .success-checkmark {
        width: 80px;
        height: 80px;
        margin: 0 auto;
    }
    
    .success-checkmark .check-icon {
        width: 80px;
        height: 80px;
        position: relative;
        border-radius: 50%;
        box-sizing: content-box;
        border: 4px solid var(--color-brand);
    }
    
    .success-checkmark .check-icon::before {
        top: 3px;
        left: -2px;
        width: 30px;
        transform-origin: 100% 50%;
        border-radius: 100px 0 0 100px;
    }
    
    .success-checkmark .check-icon::after {
        top: 0;
        left: 30px;
        width: 60px;
        transform-origin: 0 50%;
        border-radius: 0 100px 100px 0;
    }
    
    .success-checkmark .check-icon .icon-line {
        height: 5px;
        background-color: var(--color-brand);
        display: block;
        border-radius: 2px;
        position: absolute;
        z-index: 10;
    }
    
    .success-checkmark .check-icon .icon-line.line-tip {
        top: 46px;
        left: 14px;
        width: 25px;
        transform: rotate(45deg);
        animation: icon-line-tip 0.75s;
    }
    
    .success-checkmark .check-icon .icon-line.line-long {
        top: 38px;
        right: 8px;
        width: 47px;
        transform: rotate(-45deg);
        animation: icon-line-long 0.75s;
    }
    
    @keyframes icon-line-tip {
        0% { width: 0; left: 1px; top: 19px; }
        54% { width: 0; left: 1px; top: 19px; }
        70% { width: 50px; left: -8px; top: 37px; }
        84% { width: 17px; left: 21px; top: 48px; }
        100% { width: 25px; left: 14px; top: 46px; }
    }
    
    @keyframes icon-line-long {
        0% { width: 0; right: 46px; top: 54px; }
        65% { width: 0; right: 46px; top: 54px; }
        84% { width: 55px; right: 0px; top: 35px; }
        100% { width: 47px; right: 8px; top: 38px; }
    }
</style>

<div class="w-full max-w-xl mx-auto my-12 px-4 relative z-10">
    <!-- Header Branding -->
    <div class="text-center mb-8">
        <div class="logo-container mb-4">
            <img src="{{ asset(config('party.assets.logo')) }}" alt="Logo" class="h-14 w-auto object-contain transition-transform duration-500 hover:rotate-[360deg] cursor-pointer">
        </div>
        <h1 class="text-2xl font-extrabold tracking-wide uppercase text-gray-900 dark:text-white sm:text-3xl">
            {{ config('party.name') }}
        </h1>
        <div class="mt-2 flex items-center justify-center gap-1.5">
            <span class="h-1.5 w-1.5 rounded-full brand-bg"></span>
            <p class="text-xs font-semibold tracking-widest text-gray-500 dark:text-gray-400 uppercase">
                {{ config('party.tagline') }}
            </p>
            <span class="h-1.5 w-1.5 rounded-full brand-bg"></span>
        </div>
    </div>

    @if(session('success_registered'))
    <!-- Success Card -->
    <div class="glass-card rounded-3xl p-8 sm:p-10 text-center shadow-2xl transition-all duration-300 transform scale-100 hover:scale-[1.01]">
        <div class="success-checkmark mb-6">
            <div class="check-icon">
                <span class="icon-line line-tip"></span>
                <span class="icon-line line-long"></span>
            </div>
        </div>
        <h2 class="text-2xl font-extrabold text-gray-900 dark:text-white">Dukungan Terkirim!</h2>
        <p class="text-sm text-gray-600 dark:text-gray-300 mt-3 leading-relaxed">
            Terima kasih <strong>{{ session('registered_name') }}</strong>. Data kependudukan Anda berhasil diverifikasi secara real-time dan terdaftar di database sistem pemenangan.
        </p>
        <div class="mt-8">
            <a href="{{ route('pemetaan-dukungan.public-create') }}" 
               class="inline-flex items-center gap-2 px-6 py-3 text-xs font-bold text-white btn-submit uppercase tracking-wider shadow-lg brand-shadow">
                <span class="material-symbols-outlined text-sm">arrow_back</span>
                Kirim Dukungan Lainnya
            </a>
        </div>
    </div>
    @else
    <!-- Registration Form Card -->
    <div class="glass-card rounded-3xl shadow-2xl overflow-hidden border transition-all duration-300">
        <div class="px-6 py-5 border-b dark:border-gray-700/50 border-gray-100 bg-gray-50/50 dark:bg-gray-800/30 flex items-center gap-3">
            <div class="p-2 rounded-xl brand-bg text-white shadow-md">
                <span class="material-symbols-outlined text-lg block font-variation-filled">how_to_reg</span>
            </div>
            <div>
                <h2 class="text-sm font-extrabold text-gray-800 dark:text-gray-100 uppercase tracking-wider">Registrasi Dukungan Mandiri</h2>
                <p class="text-[10px] text-gray-400 dark:text-gray-500 font-medium">Harap isi formulir dengan data asli KTP Anda secara benar.</p>
            </div>
        </div>

        @if ($errors->any())
        <div class="p-4 mx-6 mt-4 text-xs text-red-800 rounded-xl bg-red-50 dark:bg-red-950/20 dark:text-red-400 border dark:border-red-900/30 border-red-200">
            <div class="flex items-center gap-2 mb-1.5 font-bold">
                <span class="material-symbols-outlined text-sm">error</span>
                <span>Terdapat kesalahan pengisian data:</span>
            </div>
            <ul class="list-disc pl-5 space-y-1 font-medium">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('pemetaan-dukungan.public-store') }}" enctype="multipart/form-data" class="p-6 space-y-5">
            @csrf

            <!-- Nama Lengkap -->
            <div>
                <label class="block text-[10px] font-bold uppercase tracking-wider dark:text-gray-400 text-gray-600 mb-1.5">Nama Lengkap <span class="text-red-500">*</span></label>
                <div class="input-wrapper">
                    <span class="material-symbols-outlined input-icon text-sm">person</span>
                    <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Contoh: Ahmad Fauzi" 
                           class="input-field w-full text-xs bg-gray-50 dark:bg-gray-900 border border-gray-300 dark:border-gray-700 p-3 dark:text-white text-gray-900 focus:outline-none" required>
                </div>
            </div>

            <!-- NIK -->
            <div>
                <label class="block text-[10px] font-bold uppercase tracking-wider dark:text-gray-400 text-gray-600 mb-1.5">NIK (Nomor Induk Kependudukan) <span class="text-red-500">*</span></label>
                <div class="input-wrapper">
                    <span class="material-symbols-outlined input-icon text-sm">badge</span>
                    <input type="text" name="nik" value="{{ old('nik') }}" placeholder="16 digit angka KTP" pattern="[0-9]{16}" maxlength="16"
                           class="input-field w-full text-xs bg-gray-50 dark:bg-gray-900 border border-gray-300 dark:border-gray-700 p-3 dark:text-white text-gray-900 focus:outline-none" required>
                </div>
                <span class="block text-[9px] text-gray-450 dark:text-gray-500 mt-1.5">Satu NIK hanya diperbolehkan memberikan dukungan kepada satu partai politik.</span>
            </div>

            <!-- No HP & KTP -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-wider dark:text-gray-400 text-gray-600 mb-1.5">No. HP / WhatsApp <span class="text-red-500">*</span></label>
                    <div class="input-wrapper">
                        <span class="material-symbols-outlined input-icon text-sm">call</span>
                        <input type="text" name="no_hp" value="{{ old('no_hp') }}" placeholder="Contoh: 08123456789" 
                               class="input-field w-full text-xs bg-gray-50 dark:bg-gray-900 border border-gray-300 dark:border-gray-700 p-3 dark:text-white text-gray-900 focus:outline-none" required>
                    </div>
                </div>
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-wider dark:text-gray-400 text-gray-600 mb-1.5">Foto KTP <span class="text-[9px] text-gray-400 font-normal">(opsional)</span></label>
                    <div class="relative bg-gray-50 dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded-xl p-2 flex items-center justify-between">
                        <input type="file" name="ktp" accept="image/*,application/pdf" class="w-full text-xs text-gray-500 dark:text-gray-400 file:mr-2 file:py-1 file:px-2.5 file:rounded-lg file:border-0 file:text-[10px] file:font-bold file:brand-bg file:text-white hover:file:opacity-90 file:cursor-pointer">
                    </div>
                    <span class="block text-[9px] text-gray-450 dark:text-gray-500 mt-1">Format: JPG, PNG, PDF. Maks 5MB.</span>
                </div>
            </div>

            <!-- Alamat -->
            <div>
                <label class="block text-[10px] font-bold uppercase tracking-wider dark:text-gray-400 text-gray-600 mb-1.5">Alamat Domisili <span class="text-red-500">*</span></label>
                <div class="input-wrapper">
                    <span class="material-symbols-outlined input-icon text-sm" style="top: 24px;">home</span>
                    <textarea name="alamat" rows="2" placeholder="Tuliskan alamat lengkap beserta RT/RW..." 
                              class="input-field w-full text-xs bg-gray-50 dark:bg-gray-900 border border-gray-300 dark:border-gray-700 p-3 dark:text-white text-gray-900 focus:outline-none" required>{{ old('alamat') }}</textarea>
                </div>
            </div>

            <!-- Wilayah -->
            <div class="border-t border-dashed dark:border-gray-700 border-gray-200 pt-4 space-y-3.5">
                <div class="flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-xs dark:text-gray-500 text-gray-400">location_on</span>
                    <p class="text-[10px] font-extrabold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Penentuan Wilayah TPS</p>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-wider dark:text-gray-400 text-gray-600 mb-1.5">Kecamatan <span class="text-red-500">*</span></label>
                        <select name="kecamatan_id" id="select-kecamatan" onchange="loadDesa(this.value)" class="w-full text-xs bg-gray-50 dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded-lg p-2.5 dark:text-white text-gray-900 brand-focus" required>
                            <option value="">— Pilih —</option>
                            @foreach($kecamatans as $kec)
                            <option value="{{ $kec->id }}" {{ old('kecamatan_id') == $kec->id ? 'selected' : '' }}>{{ $kec->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-wider dark:text-gray-400 text-gray-600 mb-1.5">Desa <span class="text-red-500">*</span></label>
                        <select name="desa_id" id="select-desa" onchange="loadTps(this.value)" class="w-full text-xs bg-gray-50 dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded-lg p-2.5 dark:text-white text-gray-900 brand-focus" required>
                            <option value="">— Pilih —</option>
                            @foreach($desas as $ds)
                            <option value="{{ $ds->id }}" {{ old('desa_id') == $ds->id ? 'selected' : '' }}>{{ $ds->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-wider dark:text-gray-400 text-gray-600 mb-1.5">TPS <span class="text-[9px] text-gray-400 font-normal">(opsional)</span></label>
                        <select name="tps_id" id="select-tps" class="w-full text-xs bg-gray-50 dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded-lg p-2.5 dark:text-white text-gray-900 brand-focus">
                            <option value="">— Pilih —</option>
                            @foreach($tpsList as $tp)
                            <option value="{{ $tp->id }}" {{ old('tps_id') == $tp->id ? 'selected' : '' }}>{{ $tp->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- Catatan -->
            <div>
                <label class="block text-[10px] font-bold uppercase tracking-wider dark:text-gray-400 text-gray-600 mb-1.5">Catatan Tambahan <span class="text-[9px] text-gray-400 font-normal">(opsional)</span></label>
                <div class="input-wrapper">
                    <span class="material-symbols-outlined input-icon text-sm" style="top: 24px;">chat</span>
                    <textarea name="catatan" rows="2" placeholder="Tulis catatan jika ada info pendukung tambahan..." 
                              class="input-field w-full text-xs bg-gray-50 dark:bg-gray-900 border border-gray-300 dark:border-gray-700 p-3 dark:text-white text-gray-900 focus:outline-none">{{ old('catatan') }}</textarea>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="pt-2">
                <button type="submit" class="w-full py-3.5 text-xs font-bold text-white btn-submit uppercase tracking-widest shadow-xl brand-shadow">
                    Kirim Dukungan Saya →
                </button>
            </div>
        </form>
    </div>
    @endif
</div>

{{-- Dynamic cascading selects script --}}
<script>
    const allDesas = @json($desas->map(fn($d) => ['id'=>$d->id,'nama'=>$d->nama,'kecamatan_id'=>$d->kecamatan_id]));
    const allTps   = @json($tpsList->map(fn($t) => ['id'=>$t->id,'nama'=>$t->nama,'desa_id'=>$t->desa_id]));

    function loadDesa(kecId) {
        const desas = allDesas.filter(d => d.kecamatan_id == kecId);
        const sel = document.getElementById('select-desa');
        if (sel) {
            sel.innerHTML = '<option value="">— Pilih Desa —</option>';
            desas.forEach(d => sel.innerHTML += `<option value="${d.id}">${d.nama}</option>`);
            loadTps('');
        }
    }

    // Dynamic cascading selects
    function loadTps(desaId) {
        const tps = allTps.filter(t => t.desa_id == desaId);
        const sel = document.getElementById('select-tps');
        if (sel) {
            sel.innerHTML = '<option value="">— Pilih TPS —</option>';
            tps.forEach(t => sel.innerHTML += `<option value="${t.id}">${t.nama}</option>`);
        }
    }

    // Restore on validation fail
    document.addEventListener('DOMContentLoaded', () => {
        const selectedKec = "{{ old('kecamatan_id') }}";
        const selectedDesa = "{{ old('desa_id') }}";
        const selectedTps = "{{ old('tps_id') }}";

        if (selectedKec) {
            loadDesa(selectedKec);
            const desaSel = document.getElementById('select-desa');
            if (desaSel) desaSel.value = selectedDesa;
        }
        if (selectedDesa) {
            loadTps(selectedDesa);
            const tpsSel = document.getElementById('select-tps');
            if (tpsSel) tpsSel.value = selectedTps;
        }
        
        // Add dynamic focus color transitions for icon colors
        const fields = document.querySelectorAll('.input-field');
        fields.forEach(field => {
            field.addEventListener('focus', () => {
                const icon = field.parentElement.querySelector('.input-icon');
                if (icon) {
                    icon.style.color = 'var(--color-brand)';
                    icon.style.transform = 'translateY(-50%) scale(1.1)';
                }
            });
            field.addEventListener('blur', () => {
                const icon = field.parentElement.querySelector('.input-icon');
                if (icon) {
                    icon.style.color = '#9CA3AF';
                    icon.style.transform = 'translateY(-50%) scale(1)';
                }
            });
        });
    });
</script>
@endsection
