@extends('layouts.admin')

@section('title', 'Manajemen Outlet - Bagelan Coffee')

@section('content')
<div class="space-y-8 max-w-7xl mx-auto opacity-0 translate-y-16" style="animation: fadeUp 1s cubic-bezier(0.32, 0.72, 0, 1) forwards;">
    
    <div class="flex flex-col sm:flex-row justify-between sm:items-end gap-6 mb-4">
        <div>
            <div class="inline-flex items-center gap-3 mb-4">
                <span class="w-8 h-[1px] bg-[#2D2420]/30"></span>
                <span class="text-[10px] font-semibold uppercase tracking-[0.3em] text-[#2D2420]/60">Distribusi Wilayah</span>
            </div>
            <h1 class="font-editorial text-4xl text-[#2D2420] leading-tight">Arsitektur Outlet.</h1>
        </div>
    </div>

    <!-- Editorial Double-Bezel Table Container -->
    <div class="bg-[#FAF7F2] border border-[#2D2420]/10 rounded-[2.5rem] p-1.5 shadow-[0_20px_40px_rgba(45,36,32,0.05)] relative overflow-hidden">
        <div class="bg-[#FDFBF7] shadow-[inset_0_1px_2px_rgba(255,255,255,1)] rounded-[calc(2.5rem-0.375rem)] border border-[#2D2420]/5 p-6 sm:p-10 relative z-10">
            
            <div class="overflow-x-auto hide-scrollbar">
                <table class="w-full text-left text-sm text-[#2D2420]">
                    <thead class="uppercase text-[9px] font-bold text-[#2D2420]/40 tracking-widest border-b border-[#2D2420]/10">
                        <tr>
                            <th class="pb-6">Identitas Outlet</th>
                            <th class="pb-6">Lokasi Geografis</th>
                            <th class="pb-6">Operasional</th>
                            <th class="pb-6">Fasilitas Ekstra</th>
                            <th class="pb-6 text-right">Status Kendali</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#2D2420]/5">
                        @forelse($outlets as $o)
                            <tr class="group hover:bg-[#2D2420]/[0.02] awwwards-transition">
                                <td class="py-6 pr-4">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 rounded-xl overflow-hidden bg-[#2D2420]/5 shrink-0 border border-[#2D2420]/5">
                                            <img src="{{ asset($o->image_url) }}" alt="{{ $o->name }}" class="w-full h-full object-cover mix-blend-multiply opacity-90 group-hover:scale-110 awwwards-transition duration-700">
                                        </div>
                                        <div>
                                            <span class="font-editorial font-bold text-base text-[#2D2420] block">{{ $o->name }}</span>
                                            <span class="text-[10px] text-[#2D2420]/50 font-semibold tracking-widest uppercase mt-0.5">{{ $o->phone }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-6 pr-4">
                                    <span class="font-bold text-[#8D6E63] block">{{ $o->city }}</span>
                                    <span class="text-[10px] text-[#2D2420]/60 max-w-[200px] block truncate mt-0.5">{{ $o->address }}</span>
                                </td>
                                <td class="py-6 pr-4">
                                    <span class="font-bold text-[#2D2420] text-sm block">{{ $o->operating_hours }}</span>
                                    @if($o->is_24_hours)
                                        <span class="block text-[9px] font-bold text-[#4E342E] uppercase tracking-widest mt-1 bg-[#8D6E63]/10 px-2 py-0.5 rounded w-max border border-[#8D6E63]/20">24 Jam Nonstop</span>
                                    @endif
                                </td>
                                <td class="py-6 pr-4">
                                    <div class="flex gap-1 text-[#2D2420]/50 text-sm">
                                        @if($o->has_wifi) <i class="ph ph-wifi text-[#2D2420]" title="WiFi"></i> @endif
                                        @if($o->has_colokan) <i class="ph ph-plug text-[#2D2420]" title="Colokan"></i> @endif
                                        @if($o->has_drive_thru) <i class="ph ph-car text-[#2D2420]" title="Drive Thru"></i> @endif
                                        @if($o->has_outdoor) <i class="ph ph-umbrella text-[#2D2420]" title="Outdoor"></i> @endif
                                        @if($o->has_musholla) <i class="ph ph-mosque text-[#2D2420]" title="Musholla"></i> @endif
                                    </div>
                                </td>
                                <td class="py-6 text-right relative">
                                    <form action="{{ route('admin.outlets.toggle-status', $o) }}" method="POST" class="relative group/form inline-block">
                                        @csrf
                                        @method('PATCH')
                                        <i class="ph ph-caret-down absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-[#2D2420]/40 group-focus-within/form:text-[#2D2420] awwwards-transition"></i>
                                        <select name="status" onchange="this.form.submit()" class="appearance-none bg-[#FAF7F2] border border-[#2D2420]/10 hover:border-[#2D2420]/30 rounded-xl pl-4 pr-8 py-2 text-[11px] font-bold uppercase tracking-widest text-[#2D2420] focus:outline-none cursor-pointer awwwards-transition shadow-sm">
                                            <option value="Buka" {{ $o->status === 'Buka' ? 'selected' : '' }}>🟢 Terbuka</option>
                                            <option value="Ramai" {{ $o->status === 'Ramai' ? 'selected' : '' }}>🟡 Padat</option>
                                            <option value="Tutup" {{ $o->status === 'Tutup' ? 'selected' : '' }}>🔴 Ditutup</option>
                                        </select>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-12 text-center text-[#2D2420]/40 font-light text-sm">Belum ada outlet cabang terdaftar.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="pt-8">
                {{ $outlets->links() }}
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(2rem); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection
