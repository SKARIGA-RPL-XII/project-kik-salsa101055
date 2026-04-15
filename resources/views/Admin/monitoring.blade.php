<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoring - Upvity</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background: #F4F5F7; min-height: 100vh; }

        /* SIDEBAR */
        .sidebar { width: 220px; min-height: 100vh; background: #fff; position: fixed; top: 0; left: 0; border-right: 1px solid #EBEBEB; z-index: 100; padding: 24px 0; }
        .sidebar-logo { padding: 0 20px 24px; border-bottom: 1px solid #EBEBEB; display: flex; align-items: center; }
        .sidebar-logo img { height: 40px; width: auto; object-fit: contain; }
        .sidebar-section-label { font-size: 11px; font-weight: 600; color: #9CA3AF; letter-spacing: 0.08em; text-transform: uppercase; padding: 20px 20px 8px; }
        .sidebar-item { display: flex; align-items: center; gap: 10px; padding: 10px 20px; color: #6B7280; font-size: 14px; font-weight: 500; text-decoration: none; border-radius: 8px; margin: 2px 10px; transition: all 0.15s; }
        .sidebar-item:hover { background: #F3F0FF; color: #7C3AED; }
        .sidebar-item.active { background: #7C3AED; color: #fff; }
        .sidebar-item.active i { color: #fff; }
        .sidebar-item i { font-size: 16px; }

        /* TOPBAR */
        .topbar { margin-left: 220px; background: #fff; border-bottom: 1px solid #EBEBEB; padding: 14px 28px; display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: 99; }
        .search-box { background: #F4F5F7; border: none; border-radius: 10px; padding: 8px 16px 8px 38px; font-size: 14px; color: #374151; width: 260px; outline: none; }
        .search-wrap { position: relative; }
        .search-wrap i { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #9CA3AF; font-size: 14px; }
        .user-trigger { display: flex; align-items: center; gap: 10px; cursor: pointer; position: relative; user-select: none; }
        .user-trigger .name { font-size: 14px; font-weight: 600; color: #1F2937; text-align: right; }
        .user-trigger .email-text { font-size: 12px; color: #9CA3AF; text-align: right; }
        .avatar { width: 38px; height: 38px; border-radius: 50%; background: #E5E7EB; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 14px; color: #6B7280; overflow: hidden; }
        .avatar img { width: 100%; height: 100%; object-fit: cover; }
        .chevron { color: #9CA3AF; font-size: 14px; transition: transform 0.2s; }
        .user-trigger.open .chevron { transform: rotate(180deg); }
        .profile-dropdown { position: absolute; top: calc(100% + 12px); right: 0; width: 280px; background: #fff; border-radius: 16px; box-shadow: 0 8px 32px rgba(0,0,0,0.12); border: 1px solid #F0F0F0; z-index: 999; display: none; overflow: hidden; }
        .profile-dropdown.show { display: block; animation: fadeDown 0.15s ease; }
        @keyframes fadeDown { from { opacity:0; transform:translateY(-8px); } to { opacity:1; transform:translateY(0); } }
        .dropdown-user-info { padding: 20px; display: flex; align-items: center; gap: 14px; border-bottom: 1px solid #F0F0F0; }
        .dropdown-avatar { width: 52px; height: 52px; border-radius: 50%; background: #E5E7EB; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 18px; color: #6B7280; overflow: hidden; flex-shrink: 0; }
        .dropdown-avatar img { width: 100%; height: 100%; object-fit: cover; }
        .dropdown-user-name { font-size: 15px; font-weight: 700; color: #1F2937; }
        .dropdown-user-role { font-size: 12px; color: #7C3AED; font-weight: 600; margin: 2px 0; }
        .dropdown-user-email { font-size: 12px; color: #9CA3AF; display: flex; align-items: center; gap: 4px; }
        .dropdown-menu-item { display: flex; align-items: center; gap: 10px; padding: 13px 20px; font-size: 14px; font-weight: 500; color: #374151; text-decoration: none; transition: background 0.1s; }
        .dropdown-menu-item:hover { background: #F9FAFB; color: #374151; }
        .dropdown-menu-item i { font-size: 16px; color: #6B7280; }
        .dropdown-menu-item.logout { color: #DC2626; border-top: 1px solid #F0F0F0; }
        .dropdown-menu-item.logout i { color: #DC2626; }
        .dropdown-menu-item.logout:hover { background: #FEF2F2; }

        /* MAIN */
        .main-content { margin-left: 220px; padding: 28px; }
        .page-title { font-size: 22px; font-weight: 700; color: #1F2937; }
        .page-subtitle { font-size: 14px; color: #9CA3AF; margin-top: 2px; }

        /* STAT CARDS */
        .stat-card { background: #fff; border-radius: 16px; border: 1px solid #F0F0F0; padding: 20px; }
        .stat-icon { width: 44px; height: 44px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 20px; margin-bottom: 12px; }
        .stat-value { font-size: 28px; font-weight: 700; color: #1F2937; line-height: 1; }
        .stat-label { font-size: 13px; color: #9CA3AF; margin-top: 4px; }
        .stat-change { font-size: 12px; font-weight: 600; margin-top: 8px; }
        .stat-up { color: #059669; }
        .stat-down { color: #DC2626; }

        /* CARD SECTION */
        .card-section { background: #fff; border-radius: 16px; border: 1px solid #F0F0F0; overflow: hidden; }
        .card-section-header { padding: 18px 24px; border-bottom: 1px solid #F0F0F0; display: flex; align-items: center; justify-content: space-between; }
        .card-section-header .title { font-size: 15px; font-weight: 700; color: #1F2937; }
        .card-body-pad { padding: 20px 24px; }

        /* TABLE */
        .table { margin: 0; }
        .table thead th { font-size: 11px; font-weight: 600; color: #9CA3AF; text-transform: uppercase; letter-spacing: 0.06em; background: #FAFAFA; border-bottom: 1px solid #F0F0F0; padding: 12px 16px; white-space: nowrap; }
        .table tbody td { padding: 13px 16px; font-size: 13px; color: #374151; vertical-align: middle; border-color: #F5F5F5; }
        .table tbody tr:hover { background: #FAFAFA; }

        /* USER AVATAR */
        .user-avatar { width: 34px; height: 34px; border-radius: 50%; background: #F3F0FF; color: #7C3AED; display: inline-flex; align-items: center; justify-content: center; font-size: 13px; font-weight: 700; overflow: hidden; flex-shrink: 0; }
        .user-avatar img { width: 100%; height: 100%; object-fit: cover; }
        .user-name { font-weight: 600; font-size: 13px; color: #1F2937; }
        .user-email { font-size: 12px; color: #9CA3AF; }

        /* PROGRESS */
        .progress { height: 6px; border-radius: 10px; background: #F0F0F0; }
        .progress-exp { background: linear-gradient(90deg, #7C3AED, #A78BFA); }
        .progress-hp { background: linear-gradient(90deg, #EF4444, #F97316); }
        .progress-task { background: linear-gradient(90deg, #059669, #34D399); }
        .progress-label { font-size: 11px; color: #9CA3AF; margin-bottom: 3px; display: flex; justify-content: space-between; }

        /* LEVEL BADGE */
        .level-badge { background: #F3F0FF; color: #7C3AED; font-size: 11px; font-weight: 600; padding: 3px 10px; border-radius: 20px; }

        /* STATUS */
        .status-active { background: #ECFDF5; color: #059669; font-size: 11px; font-weight: 600; padding: 3px 10px; border-radius: 20px; }
        .status-inactive { background: #F9FAFB; color: #9CA3AF; font-size: 11px; font-weight: 600; padding: 3px 10px; border-radius: 20px; }

        /* RANK */
        .rank-1 { color: #F59E0B; font-weight: 700; font-size: 15px; }
        .rank-2 { color: #9CA3AF; font-weight: 700; font-size: 15px; }
        .rank-3 { color: #B45309; font-weight: 700; font-size: 15px; }
        .rank-other { color: #D1D5DB; font-weight: 600; font-size: 14px; }

        /* COIN */
        .coin-val { font-size: 13px; font-weight: 700; color: #F59E0B; }

        /* CHART CONTAINER */
        .chart-container { position: relative; height: 220px; }

        /* SEARCH */
        .search-filter { background: #F4F5F7; border: none; border-radius: 10px; padding: 8px 14px 8px 36px; font-size: 13px; color: #374151; width: 200px; outline: none; }
        .search-filter-wrap { position: relative; }
        .search-filter-wrap i { position: absolute; left: 11px; top: 50%; transform: translateY(-50%); color: #9CA3AF; font-size: 13px; }

        /* OVERDUE BADGE */
        .overdue-badge { background: #FEF2F2; color: #EF4444; font-size: 11px; font-weight: 600; padding: 3px 8px; border-radius: 20px; }
        .done-badge { background: #ECFDF5; color: #059669; font-size: 11px; font-weight: 600; padding: 3px 8px; border-radius: 20px; }
        .pending-badge { background: #FFF7ED; color: #D97706; font-size: 11px; font-weight: 600; padding: 3px 8px; border-radius: 20px; }
    </style>
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <div class="sidebar-logo">
        <img src="{{ asset('images/Logo Upvity.png') }}" alt="Upvity">
    </div>
    <div class="sidebar-section-label">Beranda</div>
    <a href="{{ route('admin.dashboard') }}" class="sidebar-item">
        <i class="bi bi-grid-1x2-fill"></i> Dashboard
    </a>
    <div class="sidebar-section-label">Management</div>
    <a href="{{ route('admin.users') }}" class="sidebar-item">
        <i class="bi bi-people"></i> Kelola User
    </a>
    <a href="{{ route('admin.tasks') }}" class="sidebar-item">
        <i class="bi bi-clipboard-check"></i> Kelola Tugas
    </a>
    <a href="{{ route('admin.review') }}" class="sidebar-item">
        <i class="bi bi-eye"></i> Review Tugas
    </a>
    <div class="sidebar-section-label">Analytics</div>
    <a href="{{ route('admin.monitoring') }}" class="sidebar-item active">
        <i class="bi bi-graph-up"></i> Monitoring
    </a>
    <a href="#" class="sidebar-item">
        <i class="bi bi-file-earmark-bar-graph"></i> Laporan
    </a>
</div>

<!-- TOPBAR -->
<div class="topbar">
    <div class="search-wrap">
        <i class="bi bi-search"></i>
        <input type="text" class="search-box" placeholder="Telusuri sesuatu...">
    </div>
    <div class="user-trigger" id="userTrigger">
        <div>
            <div class="name">{{ auth()->user()->name }}</div>
            <div class="email-text">{{ auth()->user()->email }}</div>
        </div>
        <div class="avatar">
            @if(auth()->user()->photo_profile)
                <img src="{{ asset('images/' . auth()->user()->photo_profile) }}" alt="foto">
            @else
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            @endif
        </div>
        <i class="bi bi-chevron-down chevron"></i>
        <div class="profile-dropdown" id="profileDropdown">
            <div class="dropdown-user-info">
                <div class="dropdown-avatar">
                    @if(auth()->user()->photo_profile)
                        <img src="{{ asset('images/' . auth()->user()->photo_profile) }}" alt="foto">
                    @else
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    @endif
                </div>
                <div>
                    <div class="dropdown-user-name">{{ auth()->user()->name }}</div>
                    <div class="dropdown-user-role">Admin</div>
                    <div class="dropdown-user-email"><i class="bi bi-envelope"></i> {{ auth()->user()->email }}</div>
                </div>
            </div>
            <a href="{{ route('admin.profile') }}" class="dropdown-menu-item">
                <i class="bi bi-person"></i> Profil Saya
            </a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="dropdown-menu-item logout w-100 border-0 bg-transparent text-start">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </form>
        </div>
    </div>
</div>

<!-- MAIN CONTENT -->
<div class="main-content">
    <div class="mb-4">
        <div class="page-title">Monitoring</div>
        <div class="page-subtitle">Pantau aktivitas dan performa user secara real-time</div>
    </div>

    <!-- STAT CARDS -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon" style="background:#F3F0FF;">
                    <i class="bi bi-people-fill" style="color:#7C3AED;"></i>
                </div>
                <div class="stat-value">{{ $totalUsers }}</div>
                <div class="stat-label">Total User</div>
                <div class="stat-change stat-up"><i class="bi bi-arrow-up"></i> {{ $activeUsers }} aktif</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon" style="background:#ECFDF5;">
                    <i class="bi bi-clipboard-check-fill" style="color:#059669;"></i>
                </div>
                <div class="stat-value">{{ $doneTasks }}</div>
                <div class="stat-label">Tugas Selesai</div>
                <div class="stat-change stat-up"><i class="bi bi-check-circle"></i> approved</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon" style="background:#FFF7ED;">
                    <i class="bi bi-hourglass-split" style="color:#D97706;"></i>
                </div>
                <div class="stat-value">{{ $pendingTasks }}</div>
                <div class="stat-label">Pending Review</div>
                <div class="stat-change" style="color:#D97706;"><i class="bi bi-clock"></i> menunggu</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon" style="background:#FEF2F2;">
                    <i class="bi bi-exclamation-triangle-fill" style="color:#EF4444;"></i>
                </div>
                <div class="stat-value">{{ $overdueTasks }}</div>
                <div class="stat-label">Tugas Overdue</div>
                <div class="stat-change stat-down"><i class="bi bi-arrow-down"></i> lewat deadline</div>
            </div>
        </div>
    </div>

    <!-- CHART ROW -->
    <div class="row g-3 mb-4">
        <!-- Chart Status Tugas -->
        <div class="col-md-5">
            <div class="card-section h-100">
                <div class="card-section-header">
                    <span class="title">Status Tugas</span>
                </div>
                <div class="card-body-pad">
                    <div class="chart-container">
                        <canvas id="chartStatus"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chart User Aktif vs Tidak -->
        <div class="col-md-4">
            <div class="card-section h-100">
                <div class="card-section-header">
                    <span class="title">Status User</span>
                </div>
                <div class="card-body-pad">
                    <div class="chart-container">
                        <canvas id="chartUser"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top EXP -->
        <div class="col-md-3">
            <div class="card-section h-100">
                <div class="card-section-header">
                    <span class="title">🏆 Top EXP</span>
                </div>
                <div style="padding: 12px 16px;">
                    @forelse($topUsers as $index => $u)
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <div style="width:24px;text-align:center;">
                            @if($index == 0)
                                <span class="rank-1">🥇</span>
                            @elseif($index == 1)
                                <span class="rank-2">🥈</span>
                            @elseif($index == 2)
                                <span class="rank-3">🥉</span>
                            @else
                                <span class="rank-other">{{ $index + 1 }}</span>
                            @endif
                        </div>
                        <div class="user-avatar" style="width:28px;height:28px;font-size:11px;">
                            @if($u->photo_profile)
                                <img src="{{ asset('images/' . $u->photo_profile) }}" alt="">
                            @else
                                {{ strtoupper(substr($u->name, 0, 1)) }}
                            @endif
                        </div>
                        <div style="flex:1;min-width:0;">
                            <div style="font-size:12px;font-weight:600;color:#1F2937;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $u->name }}</div>
                            <div style="font-size:11px;color:#7C3AED;font-weight:600;">{{ $u->exp ?? 0 }} EXP</div>
                        </div>
                    </div>
                    @empty
                    <div style="text-align:center;color:#9CA3AF;font-size:13px;padding:20px;">Belum ada data</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- TABEL MONITORING USER -->
    <div class="card-section">
        <div class="card-section-header">
            <span class="title">Detail Performa User</span>
            <div class="search-filter-wrap">
                <i class="bi bi-search"></i>
                <input type="text" class="search-filter" id="searchInput" placeholder="Cari user...">
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-borderless" id="monitorTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Level</th>
                        <th>EXP</th>
                        <th>HP</th>
                        <th>Coin</th>
                        <th>Selesai</th>
                        <th>Pending</th>
                        <th>Overdue</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($userStats as $index => $u)
                    <tr>
                        <td style="color:#9CA3AF;font-weight:600;">{{ $index + 1 }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="user-avatar">
                                    @if($u->photo_profile)
                                        <img src="{{ asset('images/' . $u->photo_profile) }}" alt="">
                                    @else
                                        {{ strtoupper(substr($u->name, 0, 1)) }}
                                    @endif
                                </div>
                                <div>
                                    <div class="user-name">{{ $u->name }}</div>
                                    <div class="user-email">{{ $u->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td><span class="level-badge">Lv {{ $u->id_level ?? 1 }}</span></td>
                        <td>
                            <div style="min-width:90px;">
                                <div class="progress-label"><span>{{ $u->exp ?? 0 }} EXP</span><span>100</span></div>
                                <div class="progress">
                                    <div class="progress-bar progress-exp" style="width:{{ min((($u->exp ?? 0)/100)*100, 100) }}%"></div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div style="min-width:80px;">
                                <div class="progress-label"><span>{{ $u->hp ?? 50 }}/50</span></div>
                                <div class="progress">
                                    <div class="progress-bar progress-hp" style="width:{{ (($u->hp ?? 50)/50)*100 }}%"></div>
                                </div>
                            </div>
                        </td>
                        <td><span class="coin-val"><i class="bi bi-coin"></i> {{ number_format($u->coin ?? 0) }}</span></td>
                        <td><span class="done-badge">{{ $u->done_count ?? 0 }}</span></td>
                        <td><span class="pending-badge">{{ $u->pending_count ?? 0 }}</span></td>
                        <td><span class="overdue-badge">{{ $u->overdue_count ?? 0 }}</span></td>
                        <td>
                            <span class="status-{{ $u->status }}">
                                {{ $u->status === 'active' ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" class="text-center text-muted py-5">
                            <i class="bi bi-people" style="font-size:32px;opacity:0.3;display:block;margin-bottom:8px;"></i>
                            Belum ada data user
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div style="padding:14px 24px;border-top:1px solid #F0F0F0;font-size:13px;color:#9CA3AF;">
            Menampilkan {{ $userStats->count() }} user
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Topbar dropdown
    const trigger = document.getElementById('userTrigger');
    const dropdown = document.getElementById('profileDropdown');
    trigger.addEventListener('click', function(e) {
        e.stopPropagation();
        trigger.classList.toggle('open');
        dropdown.classList.toggle('show');
    });
    document.addEventListener('click', function() {
        trigger.classList.remove('open');
        dropdown.classList.remove('show');
    });
    dropdown.addEventListener('click', function(e) { e.stopPropagation(); });

    // Search
    document.getElementById('searchInput').addEventListener('input', function() {
        const q = this.value.toLowerCase();
        document.querySelectorAll('#monitorTable tbody tr').forEach(function(row) {
            row.style.display = row.innerText.toLowerCase().includes(q) ? '' : 'none';
        });
    });

    // Chart Status Tugas
    const ctxStatus = document.getElementById('chartStatus').getContext('2d');
    new Chart(ctxStatus, {
        type: 'bar',
        data: {
            labels: ['Not Started', 'In Progress', 'In Review', 'Done'],
            datasets: [{
                label: 'Jumlah Tugas',
                data: [
                    {{ $taskStats['not_started'] }},
                    {{ $taskStats['in_progress'] }},
                    {{ $taskStats['in_review'] }},
                    {{ $taskStats['done'] }}
                ],
                backgroundColor: ['#E5E7EB', '#BFDBFE', '#FDE68A', '#A7F3D0'],
                borderColor: ['#9CA3AF', '#2563EB', '#D97706', '#059669'],
                borderWidth: 1.5,
                borderRadius: 8,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, ticks: { stepSize: 1 }, grid: { color: '#F5F5F5' } },
                x: { grid: { display: false } }
            }
        }
    });

    // Chart User Aktif
    const ctxUser = document.getElementById('chartUser').getContext('2d');
    new Chart(ctxUser, {
        type: 'doughnut',
        data: {
            labels: ['Aktif', 'Nonaktif'],
            datasets: [{
                data: [{{ $activeUsers }}, {{ $inactiveUsers }}],
                backgroundColor: ['#7C3AED', '#E5E7EB'],
                borderWidth: 0,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { font: { size: 12 }, padding: 16 }
                }
            },
            cutout: '65%'
        }
    });
</script>
</body>
</html>