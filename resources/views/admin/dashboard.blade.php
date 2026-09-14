@extends('layouts.admin')

@section('title', 'Admin Dashboard - Bagelan Coffee')

@section('content')
<div class="space-y-16 max-w-7xl mx-auto opacity-0 translate-y-16" style="animation: fadeUp 1s cubic-bezier(0.32, 0.72, 0, 1) forwards;">
    
    <!-- Top Greeting -->
    <div class="flex flex-col sm:flex-row justify-between sm:items-end gap-8 mb-8">
        <div>
            <div class="inline-flex items-center gap-3 mb-4">
                <span class="w-8 h-[1px] bg-[#2D2420]/30"></span>
                <span class="text-[10px] font-semibold uppercase tracking-[0.3em] text-[#2D2420]/60">Ikhtisar Operasional</span>
            </div>
            <h1 class="font-editorial text-4xl sm:text-5xl text-[#2D2420] leading-tight">Performa <br>Mahakarya.</h1>
        </div>
        <a href="{{ route('admin.products.create') }}" class="group relative rounded-full pl-6 pr-2 py-2 bg-[#2D2420] hover:bg-[#4E342E] text-[#FDFBF7] text-[11px] font-semibold uppercase tracking-widest inline-flex items-center gap-4 transition-all duration-700 ease-[cubic-bezier(0.32,0.72,0,1)] shadow-[0_10px_30px_rgba(45,36,32,0.2)] active:scale-[0.98]">
            <span>Tambah Menu</span>
            <div class="w-8 h-8 rounded-full bg-[#FDFBF7]/10 flex items-center justify-center group-hover:scale-105 awwwards-transition">
                <i class="ph ph-plus text-sm"></i>
            </div>
        </a>
    </div>

    <!-- The Asymmetrical Bento Grid -->
    <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
        
        <!-- Large Hero Metric (Omset) -->
        <div class="col-span-1 md:col-span-8 bg-[#FAF7F2] border border-[#2D2420]/10 rounded-[2rem] p-1 shadow-[inset_0_1px_1px_rgba(255,255,255,0.8)]">
            <div class="bg-[#FDFBF7] rounded-[calc(2rem-0.25rem)] border border-[#2D2420]/5 p-8 sm:p-12 h-full flex flex-col justify-between relative overflow-hidden group">
                <div class="absolute -right-12 -top-12 w-64 h-64 bg-gradient-to-bl from-[#8D6E63]/10 to-transparent rounded-full blur-3xl group-hover:scale-110 awwwards-transition duration-[2000ms]"></div>
                
                <div class="flex justify-between items-start relative z-10 mb-12">
                    <div>
                        <span class="text-[11px] font-semibold uppercase tracking-[0.2em] text-[#2D2420]/50 block mb-2">Total Pendapatan</span>
                        <div class="w-12 h-1 bg-[#2D2420]"></div>
                    </div>
                    <div class="w-10 h-10 rounded-full border border-[#2D2420]/10 flex items-center justify-center text-[#2D2420]">
                        <i class="ph ph-wallet text-lg"></i>
                    </div>
                </div>
                <div class="relative z-10">
                    <span class="font-editorial text-5xl sm:text-6xl text-[#2D2420] block leading-none">
                        Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                    </span>
                    <span class="text-sm text-[#2D2420]/50 mt-4 block font-light">Akumulasi dari seluruh transaksi berhasil bulan ini.</span>
                </div>
            </div>
        </div>

        <!-- Stacked Metrics -->
        <div class="col-span-1 md:col-span-4 flex flex-col gap-6">
            <!-- Pesanan Masuk -->
            <div class="flex-1 bg-[#FAF7F2] border border-[#2D2420]/10 rounded-[2rem] p-1 shadow-[inset_0_1px_1px_rgba(255,255,255,0.8)]">
                <div class="bg-[#FDFBF7] rounded-[calc(2rem-0.25rem)] border border-[#2D2420]/5 p-6 sm:p-8 h-full flex flex-col justify-center relative overflow-hidden group">
                    <div class="absolute inset-0 bg-[#2D2420]/[0.02] translate-y-full group-hover:translate-y-0 awwwards-transition"></div>
                    <div class="flex items-center gap-4 relative z-10 mb-4">
                        <div class="w-8 h-8 rounded-full border border-[#2D2420]/10 flex items-center justify-center text-[#2D2420]">
                            <i class="ph ph-receipt text-sm"></i>
                        </div>
                        <span class="text-[10px] font-semibold uppercase tracking-[0.2em] text-[#2D2420]/50">Pesanan</span>
                    </div>
                    <span class="font-editorial text-4xl text-[#2D2420] block relative z-10">{{ number_format($totalOrders) }}</span>
                </div>
            </div>

            <!-- Cabang Outlet -->
            <div class="flex-1 bg-[#FAF7F2] border border-[#2D2420]/10 rounded-[2rem] p-1 shadow-[inset_0_1px_1px_rgba(255,255,255,0.8)]">
                <div class="bg-[#FDFBF7] rounded-[calc(2rem-0.25rem)] border border-[#2D2420]/5 p-6 sm:p-8 h-full flex flex-col justify-center relative overflow-hidden group">
                    <div class="absolute inset-0 bg-[#2D2420]/[0.02] translate-y-full group-hover:translate-y-0 awwwards-transition"></div>
                    <div class="flex items-center gap-4 relative z-10 mb-4">
                        <div class="w-8 h-8 rounded-full border border-[#2D2420]/10 flex items-center justify-center text-[#2D2420]">
                            <i class="ph ph-storefront text-sm"></i>
                        </div>
                        <span class="text-[10px] font-semibold uppercase tracking-[0.2em] text-[#2D2420]/50">Cabang</span>
                    </div>
                    <span class="font-editorial text-4xl text-[#2D2420] block relative z-10">{{ number_format($totalOutlets) }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Analytics Chart: Editorial Double-Bezel -->
    <div class="bg-[#FAF7F2] border border-[#2D2420]/10 rounded-[2.5rem] p-1.5 shadow-[0_20px_40px_rgba(45,36,32,0.05)] relative overflow-hidden group">
        <div class="bg-[#FDFBF7] shadow-[inset_0_1px_2px_rgba(255,255,255,1)] rounded-[calc(2.5rem-0.375rem)] border border-[#2D2420]/5 p-8 sm:p-12 relative z-10">
            
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6 mb-12">
                <div>
                    <h3 class="font-editorial text-3xl text-[#2D2420]">Grafik Transaksi.</h3>
                    <p class="text-xs text-[#2D2420]/50 mt-2 font-light">Pergerakan volume penjualan harian selama minggu ini.</p>
                </div>
                <!-- Button in Button pattern -->
                <button class="group/btn relative rounded-full pl-5 pr-1.5 py-1.5 bg-[#FDFBF7] hover:bg-[#FAF7F2] text-[10px] font-bold text-[#2D2420] uppercase tracking-widest transition-all duration-700 ease-[cubic-bezier(0.32,0.72,0,1)] active:scale-[0.98] border border-[#2D2420]/10 flex items-center gap-4 shadow-sm">
                    <span>Laporan Lanjut</span>
                    <div class="w-8 h-8 rounded-full bg-[#2D2420]/5 flex items-center justify-center transition-transform duration-700 ease-[cubic-bezier(0.32,0.72,0,1)] group-hover/btn:scale-105">
                        <i class="ph ph-arrow-down-right text-[12px]"></i>
                    </div>
                </button>
            </div>
            
            <div class="h-[350px] w-full relative">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Recent Inquiries -->
    <div class="bg-[#FAF7F2] border border-[#2D2420]/10 rounded-[2.5rem] p-1.5 shadow-[0_20px_40px_rgba(45,36,32,0.05)] relative overflow-hidden">
        <div class="bg-[#FDFBF7] shadow-[inset_0_1px_2px_rgba(255,255,255,1)] rounded-[calc(2.5rem-0.375rem)] border border-[#2D2420]/5 p-8 sm:p-12 relative z-10">
            
            <div class="mb-10">
                <h3 class="font-editorial text-3xl text-[#2D2420]">Aktivitas Terkini.</h3>
                <p class="text-xs text-[#2D2420]/50 mt-2 font-light">Pengajuan kemitraan franchise dan lamaran kerja terbaru yang masuk.</p>
            </div>
            
            <div class="overflow-x-auto hide-scrollbar">
                <table class="w-full text-left text-sm text-[#2D2420]">
                    <thead class="uppercase text-[10px] font-semibold text-[#2D2420]/40 tracking-widest border-b border-[#2D2420]/10">
                        <tr>
                            <th class="pb-6 font-semibold">Tipe</th>
                            <th class="pb-6 font-semibold">Nama Kandidat / Mitra</th>
                            <th class="pb-6 font-semibold">Kontak Utama</th>
                            <th class="pb-6 font-semibold">Wilayah</th>
                            <th class="pb-6 font-semibold text-right">Waktu</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#2D2420]/5">
                        @forelse($recentInquiries as $inq)
                            <tr class="group hover:bg-[#2D2420]/[0.02] awwwards-transition">
                                <td class="py-6 pr-4">
                                    <span class="px-3 py-1.5 rounded-full text-[9px] font-bold uppercase tracking-wider {{ $inq->type === 'franchise' ? 'bg-[#8D6E63]/10 text-[#4E342E]' : 'bg-[#2D2420]/10 text-[#2D2420]' }}">
                                        {{ $inq->type }}
                                    </span>
                                </td>
                                <td class="py-6 pr-4 font-semibold text-[#2D2420]">{{ $inq->full_name }}</td>
                                <td class="py-6 pr-4 text-[#2D2420]/70 text-xs">{{ $inq->phone }}</td>
                                <td class="py-6 pr-4 text-[#2D2420]/70 text-xs">{{ $inq->city }}</td>
                                <td class="py-6 text-right text-[#2D2420]/40 text-xs">{{ $inq->created_at->diffForHumans() }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-12 text-center text-[#2D2420]/40 text-sm font-light">Rekam jejak aktivitas belum tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
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

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('revenueChart').getContext('2d');
        
        // Creamy gradient
        const gradient = ctx.createLinearGradient(0, 0, 0, 350);
        gradient.addColorStop(0, 'rgba(45, 36, 32, 0.08)');   // #2D2420
        gradient.addColorStop(1, 'rgba(45, 36, 32, 0.0)');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
                datasets: [{
                    label: 'Omset',
                    data: [1200000, 1900000, 1500000, 2200000, 2800000, 3500000, 3100000],
                    borderColor: '#2D2420',
                    borderWidth: 2,
                    backgroundColor: gradient,
                    fill: true,
                    tension: 0.4, // Fluid cubic bezier curve equivalent
                    pointBackgroundColor: '#FDFBF7',
                    pointBorderColor: '#2D2420',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    pointHoverBackgroundColor: '#4E342E',
                    pointHoverBorderColor: '#FDFBF7'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                animation: {
                    duration: 2000,
                    easing: 'easeOutQuart'
                },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: 'rgba(253, 251, 247, 0.95)',
                        titleColor: '#2D2420',
                        bodyColor: '#2D2420',
                        borderColor: 'rgba(45, 36, 32, 0.1)',
                        borderWidth: 1,
                        padding: 16,
                        displayColors: false,
                        titleFont: { family: "'Plus Jakarta Sans', sans-serif", size: 10, weight: 'bold' },
                        bodyFont: { family: "'Playfair Display', serif", size: 14 },
                        callbacks: {
                            label: function(context) {
                                return 'Rp ' + new Intl.NumberFormat('id-ID').format(context.parsed.y);
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: { display: false, drawBorder: false },
                        ticks: {
                            color: 'rgba(45, 36, 32, 0.4)',
                            font: { family: "'Plus Jakarta Sans', sans-serif", size: 10, weight: '600' }
                        }
                    },
                    y: {
                        grid: {
                            color: 'rgba(45, 36, 32, 0.05)',
                            drawBorder: false,
                            borderDash: [4, 4]
                        },
                        ticks: {
                            color: 'rgba(45, 36, 32, 0.4)',
                            font: { family: "'Plus Jakarta Sans', sans-serif", size: 10, weight: '600' },
                            callback: function(value) {
                                return 'Rp ' + (value / 1000000) + 'M';
                            },
                            maxTicksLimit: 5
                        },
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
@endpush
