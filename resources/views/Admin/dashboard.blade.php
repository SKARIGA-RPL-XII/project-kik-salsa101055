<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Upvity</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        * {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background: #F4F5F7;
            min-height: 100vh;
        }

        .sidebar {
            width: 220px;
            min-height: 100vh;
            background: #fff;
            position: fixed;
            top: 0;
            left: 0;
            border-right: 1px solid #EBEBEB;
            z-index: 100;
            padding: 24px 0;
        }

        .sidebar-logo {
            padding: 0 20px 24px;
            border-bottom: 1px solid #EBEBEB;
            display: flex;
            align-items: center;
        }

        .sidebar-logo img {
            height: 40px;
            width: auto;
            object-fit: contain;
        }

        .sidebar-section-label {
            font-size: 11px;
            font-weight: 600;
            color: #9CA3AF;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 20px 20px 8px;
        }

        .sidebar-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 20px;
            color: #6B7280;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            border-radius: 8px;
            margin: 2px 10px;
            transition: all 0.15s;
        }

        .sidebar-item:hover {
            background: #F3F0FF;
            color: #7C3AED;
        }

        .sidebar-item.active {
            background: #7C3AED;
            color: #fff;
        }

        .sidebar-item.active i {
            color: #fff;
        }

        .sidebar-item i {
            font-size: 16px;
        }

        .topbar {
            margin-left: 220px;
            background: #fff;
            border-bottom: 1px solid #EBEBEB;
            padding: 14px 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 99;
        }

        .search-box {
            background: #F4F5F7;
            border: none;
            border-radius: 10px;
            padding: 8px 16px 8px 38px;
            font-size: 14px;
            color: #374151;
            width: 260px;
            outline: none;
        }

        .search-wrap {
            position: relative;
        }

        .search-wrap i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #9CA3AF;
            font-size: 14px;
        }

        .user-trigger {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            position: relative;
            user-select: none;
        }

        .user-trigger .name {
            font-size: 14px;
            font-weight: 600;
            color: #1F2937;
            text-align: right;
        }

        .user-trigger .email-text {
            font-size: 12px;
            color: #9CA3AF;
            text-align: right;
        }

        .avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: #E5E7EB;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 14px;
            color: #6B7280;
            overflow: hidden;
        }

        .avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .chevron {
            color: #9CA3AF;
            font-size: 14px;
            transition: transform 0.2s;
        }

        .user-trigger.open .chevron {
            transform: rotate(180deg);
        }

        .profile-dropdown {
            position: absolute;
            top: calc(100% + 12px);
            right: 0;
            width: 280px;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.12);
            border: 1px solid #F0F0F0;
            z-index: 999;
            display: none;
            overflow: hidden;
        }

        .profile-dropdown.show {
            display: block;
            animation: fadeDown 0.15s ease;
        }

        @keyframes fadeDown {
            from {
                opacity: 0;
                transform: translateY(-8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .dropdown-user-info {
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 14px;
            border-bottom: 1px solid #F0F0F0;
        }

        .dropdown-avatar {
            width: 52px;
            height: 52px;
            border-radius: 50%;
            background: #E5E7EB;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 18px;
            color: #6B7280;
            overflow: hidden;
            flex-shrink: 0;
        }

        .dropdown-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .dropdown-user-name {
            font-size: 15px;
            font-weight: 700;
            color: #1F2937;
        }

        .dropdown-user-role {
            font-size: 12px;
            color: #7C3AED;
            font-weight: 600;
            margin: 2px 0;
        }

        .dropdown-user-email {
            font-size: 12px;
            color: #9CA3AF;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .dropdown-menu-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 13px 20px;
            font-size: 14px;
            font-weight: 500;
            color: #374151;
            text-decoration: none;
            transition: background 0.1s;
        }

        .dropdown-menu-item:hover {
            background: #F9FAFB;
            color: #374151;
        }

        .dropdown-menu-item i {
            font-size: 16px;
            color: #6B7280;
        }

        .dropdown-menu-item.logout {
            color: #DC2626;
            border-top: 1px solid #F0F0F0;
        }

        .dropdown-menu-item.logout i {
            color: #DC2626;
        }

        .dropdown-menu-item.logout:hover {
            background: #FEF2F2;
        }

        .main-content {
            margin-left: 220px;
            padding: 28px;
        }

        .stat-card {
            background: #fff;
            border-radius: 16px;
            padding: 22px 24px;
            border: 1px solid #F0F0F0;
            transition: box-shadow 0.2s;
        }

        .stat-card:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        }

        .stat-label {
            font-size: 13px;
            color: #9CA3AF;
            font-weight: 500;
            margin-bottom: 6px;
        }

        .stat-value {
            font-size: 28px;
            font-weight: 700;
            color: #1F2937;
            margin-bottom: 6px;
        }

        .stat-badge {
            font-size: 12px;
            font-weight: 600;
            color: #10B981;
            display: flex;
            align-items: center;
            gap: 3px;
        }

        .stat-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .icon-blue {
            background: #EFF6FF;
            color: #3B82F6;
        }

        .icon-purple {
            background: #F3F0FF;
            color: #7C3AED;
        }

        .icon-orange {
            background: #FFF7ED;
            color: #F97316;
        }

        .icon-green {
            background: #ECFDF5;
            color: #10B981;
        }

        .card-section {
            background: #fff;
            border-radius: 16px;
            border: 1px solid #F0F0F0;
            overflow: hidden;
        }

        .card-section-header {
            padding: 18px 24px;
            border-bottom: 1px solid #F0F0F0;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card-section-header .title {
            font-size: 15px;
            font-weight: 700;
            color: #1F2937;
        }

        .table {
            margin: 0;
        }

        .table thead th {
            font-size: 12px;
            font-weight: 600;
            color: #9CA3AF;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            background: #FAFAFA;
            border-bottom: 1px solid #F0F0F0;
            padding: 12px 24px;
        }

        .table tbody td {
            padding: 14px 24px;
            font-size: 14px;
            color: #374151;
            vertical-align: middle;
            border-color: #F5F5F5;
        }

        .table tbody tr:hover {
            background: #FAFAFA;
        }

        .badge-status {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-active {
            background: #ECFDF5;
            color: #059669;
        }

        .badge-inactive {
            background: #FEF2F2;
            color: #DC2626;
        }

        .badge-done {
            background: #ECFDF5;
            color: #059669;
        }

        .badge-in_progress {
            background: #EFF6FF;
            color: #2563EB;
        }

        .badge-not_started {
            background: #F9FAFB;
            color: #6B7280;
        }

        .badge-in_review {
            background: #FFF7ED;
            color: #D97706;
        }

        .avatar-sm {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #F3F0FF;
            color: #7C3AED;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 700;
            margin-right: 8px;
        }

        .page-title {
            font-size: 22px;
            font-weight: 700;
            color: #1F2937;
        }

        .page-subtitle {
            font-size: 14px;
            color: #9CA3AF;
            margin-top: 2px;
        }

        .btn-view-all {
            font-size: 13px;
            color: #7C3AED;
            font-weight: 600;
            text-decoration: none;
        }

        .btn-view-all:hover {
            color: #5B21B6;
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="sidebar-logo">
            <img src="{{ asset('images/Logo Upvity.png') }}" alt="Upvity">
        </div>

        <div class="sidebar-section-label">Beranda</div>
        <a href="{{ route('admin.dashboard') }}" class="sidebar-item active">
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
        <a href="{{ route('admin.monitoring') }}" class="sidebar-item">
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

            <!-- DROPDOWN -->
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
                        <div class="dropdown-user-email">
                            <i class="bi bi-envelope"></i> {{ auth()->user()->email }}
                        </div>
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
            <div class="page-title">Dashboard</div>
            <div class="page-subtitle">Selamat datang kembali, {{ auth()->user()->name }}!</div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <div class="stat-card d-flex justify-content-between align-items-start">
                    <div>
                        <div class="stat-label">Total User</div>
                        <div class="stat-value">{{ $totalUsers }}</div>
                        <div class="stat-badge"><i class="bi bi-arrow-up-short"></i> Active users</div>
                    </div>
                    <div class="stat-icon icon-blue"><i class="bi bi-people-fill"></i></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card d-flex justify-content-between align-items-start">
                    <div>
                        <div class="stat-label">Total Tugas</div>
                        <div class="stat-value">{{ $totalTasks }}</div>
                        <div class="stat-badge"><i class="bi bi-arrow-up-short"></i> Semua tugas</div>
                    </div>
                    <div class="stat-icon icon-purple"><i class="bi bi-box-seam"></i></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card d-flex justify-content-between align-items-start">
                    <div>
                        <div class="stat-label">Pending Review</div>
                        <div class="stat-value">{{ $pendingTasks }}</div>
                        <div class="stat-badge" style="color:#F97316;"><i class="bi bi-clock"></i> Menunggu review</div>
                    </div>
                    <div class="stat-icon icon-orange"><i class="bi bi-graph-up-arrow"></i></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card d-flex justify-content-between align-items-start">
                    <div>
                        <div class="stat-label">Tugas Selesai</div>
                        <div class="stat-value">{{ $doneTasks }}</div>
                        <div class="stat-badge"><i class="bi bi-check-circle"></i> Completed</div>
                    </div>
                    <div class="stat-icon icon-green"><i class="bi bi-list-check"></i></div>
                </div>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-md-6">
                <div class="card-section">
                    <div class="card-section-header">
                        <span class="title">User Terbaru</span>
                        <a href="{{ route('admin.users') }}" class="btn-view-all">Lihat semua →</a>
                    </div>
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Level</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentUsers as $user)
                                <tr style="cursor:pointer;" onclick="window.location='{{ route('admin.users') }}'">
                                    <td>
                                        <span class="avatar-sm">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                        <span>{{ $user->name }}</span>
                                    </td>
                                    <td><span style="font-size:13px;color:#6B7280;">Lv. {{ $user->id_level }}</span></td>
                                    <td>
                                        <span class="badge-status badge-{{ $user->status }}">
                                            {{ $user->status === 'active' ? 'Aktif' : 'Nonaktif' }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-4">Belum ada user</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card-section">
                    <div class="card-section-header">
                        <span class="title">Tugas Terbaru</span>
                        <a href="{{ route('admin.tasks') }}" class="btn-view-all">Lihat semua →</a>
                    </div>
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Deadline</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentTasks as $task)
                                <tr>
                                    <td style="max-width:160px;">
                                        <div
                                            style="font-weight:600;font-size:13px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                                            {{ $task->title }}
                                        </div>
                                        <div style="font-size:12px;color:#9CA3AF;">+{{ $task->reward }} EXP</div>
                                    </td>
                                    <td style="font-size:13px;color:#6B7280;">
                                        {{ \Carbon\Carbon::parse($task->deadline)->format('d M Y') }}
                                    </td>
                                    <td>
                                        <span class="badge-status badge-{{ $task->status }}">
                                            {{ str_replace('_', ' ', ucfirst($task->status)) }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-4">Belum ada tugas</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const trigger = document.getElementById('userTrigger');
        const dropdown = document.getElementById('profileDropdown');

        trigger.addEventListener('click', function (e) {
            e.stopPropagation();
            trigger.classList.toggle('open');
            dropdown.classList.toggle('show');
        });
        document.addEventListener('click', function () {
            trigger.classList.remove('open');
            dropdown.classList.remove('show');
        });
        dropdown.addEventListener('click', function (e) { e.stopPropagation(); });
    </script>
</body>

</html>