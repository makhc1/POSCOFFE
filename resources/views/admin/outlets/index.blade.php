@extends('layouts.admin')

@section('title', 'Kelola Outlet Cabang - Admin Kopi Gacoan')

@section('content')
<div class="space-y-6">
    
    <div>
        <h1 class="font-display font-black text-2xl text-white">Daftar Cabang Outlet Kopi Gacoan</h1>
        <p class="text-xs text-gray-400 mt-1">Kelola jam operasional, status buka/tutup, dan fasilitas cabang.</p>
    </div>

    <div class="bg-[#121216] border border-white/10 rounded-3xl p-6 shadow-xl space-y-4">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-gray-300">
                <thead class="bg-white/5 uppercase text-[10px] font-bold text-gray-400 tracking-wider">
                    <tr>
                        <th class="p-3.5 rounded-l-xl">Nama Cabang</th>
                        <th class="p-3.5">Kota</th>
                        <th class="p-3.5">Alamat Lengkap</th>
                        <th class="p-3.5">Jam Operasional</th>
                        <th class="p-3.5">Fasilitas</th>
                        <th class="p-3.5 rounded-r-xl">Status & Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @foreach($outlets as $o)
                        <tr class="hover:bg-white/5 transition-colors">
                            <td class="p-3.5">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $o->image_url }}" alt="{{ $o->name }}" class="w-12 h-12 rounded-xl object-cover shrink-0">
                                    <div>
                                        <span class="font-bold text-white block">{{ $o->name }}</span>
                                        <span class="text-[10px] text-gray-500">{{ $o->phone }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="p-3.5 font-bold text-[#FF9900]">
                                {{ $o->city }}
                            </td>
                            <td class="p-3.5 text-gray-400 max-w-xs truncate">
                                {{ $o->address }}
                            </td>
                            <td class="p-3.5">
                                <span class="font-bold text-white">{{ $o->operating_hours }}</span>
                                @if($o->is_24_hours)
                                    <span class="block text-[10px] text-[#FF2E63] font-bold uppercase">Buka 24 Jam Nonstop</span>
                                @endif
                            </td>
                            <td class="p-3.5">
                                <div class="flex gap-1 text-gray-400 text-sm">
                                    @if($o->has_wifi) <i class="ph ph-wifi text-[#FF9900]" title="WiFi"></i> @endif
                                    @if($o->has_colokan) <i class="ph ph-plug text-[#FF2E63]" title="Colokan"></i> @endif
                                    @if($o->has_drive_thru) <i class="ph ph-car text-cyan-400" title="Drive Thru"></i> @endif
                                    @if($o->has_outdoor) <i class="ph ph-umbrella text-yellow-400" title="Outdoor"></i> @endif
                                    @if($o->has_musholla) <i class="ph ph-mosque text-emerald-400" title="Musholla"></i> @endif
                                </div>
                            </td>
                            <td class="p-3.5">
                                <form action="{{ route('admin.outlets.toggle-status', $o) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" onchange="this.form.submit()" class="bg-[#09090C] border border-white/10 rounded-lg px-2.5 py-1 text-xs font-bold {{ $o->status === 'Buka' ? 'text-emerald-400' : 'text-red-400' }} focus:outline-none">
                                        <option value="Buka" {{ $o->status === 'Buka' ? 'selected' : '' }}>🟢 Buka</option>
                                        <option value="Ramai" {{ $o->status === 'Ramai' ? 'selected' : '' }}>🟡 Ramai</option>
                                        <option value="Tutup" {{ $o->status === 'Tutup' ? 'selected' : '' }}>🔴 Tutup</option>
                                    </select>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="pt-4">
            {{ $outlets->links() }}
        </div>
    </div>

</div>
@endsection
