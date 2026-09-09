@extends('layouts.admin')

@section('title', 'Admin Dashboard - Kopi Gacoan')

@section('content')
<div class="space-y-8">
    
    <!-- Top Greeting -->
    <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-4">
        <div>
            <h1 class="font-display font-black text-2xl sm:text-3xl text-white">Ringkasan Penjualan & Operasional 📊</h1>
            <p class="text-xs text-gray-400 mt-1">Pantau pesanan barista live, omset penjualan, dan inventori menu.</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="inline-flex items-center gap-2 bg-[#FF2E63] hover:bg-[#e01e53] text-white text-xs font-black px-5 py-3 rounded-xl shadow-lg shadow-[#FF2E63]/30 transition-all">
            <i class="ph ph-plus"></i>
            <span>Tambah Menu Baru</span>
        </a>
    </div>

    <!-- 4 Metric Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        
        <div class="bg-[#121216] border border-white/10 rounded-3xl p-6 shadow-xl space-y-2">
            <div class="flex justify-between items-center text-gray-400 text-xs font-bold uppercase">
                <span>Total Omset Penjualan</span>
                <i class="ph ph-rupiah-sign text-emerald-400 text-base"></i>
            </div>
            <span class="font-display font-black text-2xl text-emerald-400 block">
                Rp {{ number_format($totalRevenue, 0, ',', '.') }}
            </span>
            <span class="text-[10px] text-gray-500">Dari seluruh transaksi sukses</span>
        </div>

        <div class="bg-[#121216] border border-white/10 rounded-3xl p-6 shadow-xl space-y-2">
            <div class="flex justify-between items-center text-gray-400 text-xs font-bold uppercase">
                <span>Total Pesanan Masuk</span>
                <i class="ph ph-receipt text-[#FF2E63] text-base"></i>
            </div>
            <span class="font-display font-black text-2xl text-white block">
                {{ number_format($totalOrders) }} Order
            </span>
            <span class="text-[10px] text-gray-500">Dine-in, Takeaway & Delivery</span>
        </div>

        <div class="bg-[#121216] border border-white/10 rounded-3xl p-6 shadow-xl space-y-2">
            <div class="flex justify-between items-center text-gray-400 text-xs font-bold uppercase">
                <span>Total Menu Aktif</span>
                <i class="ph ph-mug-hot text-[#FF9900] text-base"></i>
            </div>
            <span class="font-display font-black text-2xl text-white block">
                {{ number_format($totalProducts) }} Menu
            </span>
            <span class="text-[10px] text-gray-500">Kopi, Dimsum, & Es Setan</span>
        </div>

        <div class="bg-[#121216] border border-white/10 rounded-3xl p-6 shadow-xl space-y-2">
            <div class="flex justify-between items-center text-gray-400 text-xs font-bold uppercase">
                <span>Cabang Outlet Aktif</span>
                <i class="ph ph-store text-cyan-400 text-base"></i>
            </div>
            <span class="font-display font-black text-2xl text-white block">
                {{ number_format($totalOutlets) }} Lokasi
            </span>
            <span class="text-[10px] text-gray-500">Jakarta, Bandung, Jogja, Bali, dll</span>
        </div>

    </div>

    <!-- Analytics Chart: Ethereal Glass Double-Bezel -->
    <div class="bg-white/5 ring-1 ring-white/10 p-2 rounded-[2rem] shadow-2xl relative overflow-hidden group">
        <!-- Radial Gradient Backdrop inside shell -->
        <div class="absolute inset-0 bg-gradient-to-tr from-[#FF2E63]/10 via-transparent to-[#FF9900]/10 opacity-50 transition-opacity duration-700 ease-[cubic-bezier(0.32,0.72,0,1)] group-hover:opacity-100 pointer-events-none"></div>
        
        <div class="bg-[#050505] shadow-[inset_0_1px_1px_rgba(255,255,255,0.15)] rounded-[calc(2rem-0.5rem)] p-6 sm:p-8 relative z-10">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
                <div>
                    <div class="inline-flex items-center gap-2 mb-2">
                        <span class="rounded-full px-3 py-1 text-[10px] uppercase tracking-[0.2em] font-medium bg-white/10 text-white/70">Analytics</span>
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                    </div>
                    <h3 class="font-display font-black text-xl text-white">Trend Penjualan Harian</h3>
                </div>
                <!-- Button in Button pattern -->
                <button class="group/btn relative rounded-full px-6 py-2.5 bg-white/5 hover:bg-white/10 text-xs font-bold text-white transition-all duration-700 ease-[cubic-bezier(0.32,0.72,0,1)] active:scale-[0.98] border border-white/10 flex items-center gap-4">
                    <span>Unduh Laporan</span>
                    <div class="w-6 h-6 rounded-full bg-white/10 flex items-center justify-center transition-transform duration-700 ease-[cubic-bezier(0.32,0.72,0,1)] group-hover/btn:scale-110 group-hover/btn:translate-x-0.5">
                        <i class="ph ph-download-simple text-[10px]"></i>
                    </div>
                </button>
            </div>
            
            <div class="h-[300px] w-full relative">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Recent Partnership / Career Inquiries -->
    <div class="bg-[#121216] border border-white/10 rounded-3xl p-6 shadow-xl space-y-4">
        <h3 class="font-display font-bold text-lg text-white">Pengajuan Kemitraan Franchise & Lamaran Barista Terbaru</h3>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-gray-300">
                <thead class="bg-white/5 uppercase text-[10px] font-bold text-gray-400 tracking-wider">
                    <tr>
                        <th class="p-3.5 rounded-l-xl">Tipe</th>
                        <th class="p-3.5">Nama</th>
                        <th class="p-3.5">Kontak WhatsApp / Email</th>
                        <th class="p-3.5">Kota</th>
                        <th class="p-3.5">Posisi / Lokasi</th>
                        <th class="p-3.5 rounded-r-xl">Waktu Masuk</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($recentInquiries as $inq)
                        <tr class="hover:bg-white/5 transition-colors">
                            <td class="p-3.5">
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold uppercase {{ $inq->type === 'franchise' ? 'bg-[#FF9900]/20 text-[#FF9900]' : 'bg-[#FF2E63]/20 text-[#FF2E63]' }}">
                                    {{ $inq->type }}
                                </span>
                            </td>
                            <td class="p-3.5 font-bold text-white">{{ $inq->full_name }}</td>
                            <td class="p-3.5">{{ $inq->phone }} • {{ $inq->email }}</td>
                            <td class="p-3.5">{{ $inq->city }}</td>
                            <td class="p-3.5">{{ $inq->location_plan_or_position }}</td>
                            <td class="p-3.5 text-gray-500">{{ $inq->created_at->diffForHumans() }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-8 text-center text-gray-500">Belum ada pengajuan masuk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('revenueChart').getContext('2d');
        
        // Create an ethereal gradient for the chart area
        const gradient = ctx.createLinearGradient(0, 0, 0, 300);
        gradient.addColorStop(0, 'rgba(255, 46, 99, 0.4)');   // #FF2E63 with opacity
        gradient.addColorStop(1, 'rgba(255, 153, 0, 0.0)');   // #FF9900 faded out

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
                datasets: [{
                    label: 'Omset',
                    data: [1200000, 1900000, 1500000, 2200000, 2800000, 3500000, 3100000],
                    borderColor: '#FF2E63',
                    borderWidth: 2,
                    backgroundColor: gradient,
                    fill: true,
                    tension: 0.4, // Smooth cubic-bezier curve equivalent
                    pointBackgroundColor: '#050505',
                    pointBorderColor: '#FF2E63',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    pointHoverBackgroundColor: '#FF9900',
                    pointHoverBorderColor: '#fff'
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
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(5, 5, 5, 0.8)',
                        titleColor: '#fff',
                        bodyColor: '#e5e7eb',
                        borderColor: 'rgba(255,255,255,0.1)',
                        borderWidth: 1,
                        padding: 12,
                        displayColors: false,
                        callbacks: {
                            label: function(context) {
                                return 'Rp ' + new Intl.NumberFormat('id-ID').format(context.parsed.y);
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            color: '#9ca3af',
                            font: {
                                family: 'ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif',
                                size: 10
                            }
                        }
                    },
                    y: {
                        grid: {
                            color: 'rgba(255, 255, 255, 0.05)',
                            drawBorder: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            color: '#9ca3af',
                            font: {
                                size: 10
                            },
                            callback: function(value) {
                                return 'Rp ' + (value / 1000000) + 'M';
                            }
                        },
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
@endpush
