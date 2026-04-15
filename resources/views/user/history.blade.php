<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Tugas - Upvity</title>
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
            justify-content: flex-end;
            position: sticky;
            top: 0;
            z-index: 99;
            gap: 12px;
        }

        .topbar-coin {
            display: flex;
            align-items: center;
            gap: 6px;
            background: #FFF8E7;
            border: 1px solid #FDE68A;
            border-radius: 20px;
            padding: 5px 14px;
            font-weight: 700;
            font-size: 13px;
            color: #92400E;
        }

        .topbar-coin i {
            color: #F59E0B;
            font-size: 16px;
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

        .user-trigger .role-text {
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

        .page-title {
            font-size: 22px;
            font-weight: 700;
            color: #1F2937;
            margin-bottom: 4px;
        }

        .page-subtitle {
            font-size: 14px;
            color: #9CA3AF;
            margin-bottom: 24px;
        }

        /* HISTORY CARD */
        .history-card {
            background: #fff;
            border-radius: 16px;
            border: 1px solid #F0F0F0;
            overflow: hidden;
        }

        .card-header-bar {
            padding: 18px 24px;
            border-bottom: 1px solid #F0F0F0;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card-header-bar .title {
            font-size: 15px;
            font-weight: 700;
            color: #1F2937;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .card-header-bar .title i {
            color: #7C3AED;
        }

        .table {
            margin: 0;
        }

        .table thead th {
            font-size: 11px;
            font-weight: 600;
            color: #9CA3AF;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            background: #FAFAFA;
            border-bottom: 1px solid #F0F0F0;
            padding: 12px 16px;
            white-space: nowrap;
        }

        .table tbody td {
            padding: 14px 16px;
            font-size: 13px;
            color: #374151;
            vertical-align: middle;
            border-color: #F5F5F5;
        }

        .table tbody tr:hover {
            background: #FAFAFA;
        }

        .status-pill {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .pill-approved {
            background: #ECFDF5;
            color: #059669;
        }

        .pill-rejected {
            background: #FEF2F2;
            color: #DC2626;
        }

        .pill-pending {
            background: #FFF7ED;
            color: #D97706;
        }

        .reward-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-weight: 700;
            color: #7C3AED;
            font-size: 13px;
        }

        .task-title-cell {
            font-weight: 600;
            color: #1F2937;
            margin-bottom: 2px;
            font-size: 13px;
        }

        .task-deadline-cell {
            font-size: 11px;
            color: #9CA3AF;
        }

        .file-link {
            font-size: 12px;
            color: #2563EB;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .file-link:hover {
            color: #1D4ED8;
        }

        .no-file {
            font-size: 12px;
            color: #D1D5DB;
        }

        .keterangan-cell {
            font-size: 12px;
            color: #6B7280;
            max-width: 180px;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #9CA3AF;
        }

        .empty-state i {
            font-size: 40px;
            margin-bottom: 12px;
            display: block;
            opacity: 0.4;
        }

        .empty-state p {
            font-size: 14px;
        }

        .pagination-info {
            padding: 14px 24px;
            border-top: 1px solid #F0F0F0;
            font-size: 13px;
            color: #9CA3AF;
        }

        /* FILTER */
        .filter-pills {
            display: flex;
            gap: 8px;
        }

        .filter-pill {
            padding: 5px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            border: 1.5px solid #E5E7EB;
            background: #fff;
            color: #6B7280;
            transition: all 0.15s;
        }

        .filter-pill.active {
            background: #7C3AED;
            color: #fff;
            border-color: #7C3AED;
        }

        .filter-pill:hover {
            border-color: #7C3AED;
            color: #7C3AED;
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
        <a href="{{ route('user.dashboard') }}" class="sidebar-item">
            <i class="bi bi-grid-1x2-fill"></i> Dashboard
        </a>
        <a href="{{ route('user.history') }}" class="sidebar-item active">
            <i class="bi bi-clock-history"></i> Riwayat
        </a>
    </div>

    <!-- TOPBAR -->
    <div class="topbar">
        <div class="topbar-coin">
            <i class="bi bi-coin"></i> {{ number_format(auth()->user()->coin ?? 0) }}
        </div>
        <div class="user-trigger" id="userTrigger">
            <div>
                <div class="name">{{ auth()->user()->name }}</div>
                <div class="role-text">{{ auth()->user()->level ? auth()->user()->level->level_name : 'User' }}</div>
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
                        <div class="dropdown-user-role">
                            {{ auth()->user()->role ? auth()->user()->role->role_name : 'User' }}</div>
                        <div class="dropdown-user-email"><i class="bi bi-envelope"></i> {{ auth()->user()->email }}
                        </div>
                    </div>
                </div>
                <a href="{{ route('user.profile') }}" class="dropdown-menu-item">
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
        <div class="page-title">Riwayat Tugas</div>
        <div class="page-subtitle">Semua laporan tugas yang sudah kamu submit</div>

        <div class="history-card">
            <div class="card-header-bar">
                <div class="title"><i class="bi bi-clock-history"></i> Laporan Saya</div>
                <div class="filter-pills">
                    <button class="filter-pill active" onclick="filterHistory('all', this)">Semua</button>
                    <button class="filter-pill" onclick="filterHistory('pending', this)">Pending</button>
                    <button class="filter-pill" onclick="filterHistory('approved', this)">Approved</button>
                    <button class="filter-pill" onclick="filterHistory('rejected', this)">Ditolak</button>
                </div>
            </div>

            @if($reports->count() > 0)
                <div class="table-responsive">
                    <table class="table table-borderless" id="historyTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tugas</th>
                                <th>Tanggal Submit</th>
                                <th>Status</th>
                                <th>EXP Didapat</th>
                                <th>File</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reports as $i => $report)
                                <tr data-status="{{ $report->status }}">
                                    <td style="color:#D1D5DB;font-weight:600;font-size:13px;">{{ $i + 1 }}</td>
                                    <td>
                                        <div class="task-title-cell">{{ $report->task ? $report->task->title : '-' }}</div>
                                        @if($report->task)
                                            <div class="task-deadline-cell">
                                                <i class="bi bi-calendar3"></i>
                                                Deadline: {{ \Carbon\Carbon::parse($report->task->deadline)->format('d M Y') }}
                                            </div>
                                        @endif
                                    </td>
                                    <td style="font-size:13px;white-space:nowrap;">
                                        {{ $report->created_at->format('d M Y') }}<br>
                                        <span
                                            style="font-size:11px;color:#9CA3AF;">{{ $report->created_at->format('H:i') }}</span>
                                    </td>
                                    <td>
                                        @if($report->status === 'approved')
                                            <span class="status-pill pill-approved"><i
                                                    class="bi bi-check-circle-fill"></i>Approved</span>
                                        @elseif($report->status === 'rejected')
                                            <span class="status-pill pill-rejected"><i
                                                    class="bi bi-x-circle-fill"></i>Ditolak</span>
                                        @else
                                            <span class="status-pill pill-pending"><i
                                                    class="bi bi-hourglass-split"></i>Pending</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($report->status === 'approved')
                                            <span class="reward-badge">
                                                <i class="bi bi-star-fill" style="color:#F59E0B;font-size:11px;"></i>
                                                +{{ $report->task ? $report->task->reward : 0 }} EXP
                                            </span>
                                        @else
                                            <span style="color:#D1D5DB;font-size:13px;">—</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($report->report_file)
                                            <a href="{{ asset('images/reports/' . $report->report_file) }}" target="_blank"
                                                class="file-link">
                                                <i class="bi bi-paperclip"></i> Lihat File
                                            </a>
                                        @else
                                            <span class="no-file">—</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="keterangan-cell" title="{{ $report->report_text }}">
                                            {{ Str::limit($report->report_text, 60) }}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="pagination-info" id="historyCount">
                    Menampilkan {{ $reports->count() }} laporan
                </div>
            @else
                <div class="empty-state">
                    <i class="bi bi-clipboard-x"></i>
                    <p>Belum ada riwayat laporan tugas</p>
                </div>
            @endif
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Dropdown
        const trigger = document.getElementById('userTrigger');
        const dropdown = document.getElementById('profileDropdown');
        trigger.addEventListener('click', e => { e.stopPropagation(); trigger.classList.toggle('open'); dropdown.classList.toggle('show'); });
        document.addEventListener('click', () => { trigger.classList.remove('open'); dropdown.classList.remove('show'); });
        dropdown.addEventListener('click', e => e.stopPropagation());

        // Filter
        function filterHistory(status, btn) {
            document.querySelectorAll('.filter-pill').forEach(p => p.classList.remove('active'));
            btn.classList.add('active');
            let count = 0;
            document.querySelectorAll('#historyTable tbody tr').forEach(row => {
                const show = status === 'all' || row.dataset.status === status;
                row.style.display = show ? '' : 'none';
                if (show) count++;
            });
            document.getElementById('historyCount').textContent = 'Menampilkan ' + count + ' laporan';
        }
    </script>
</body>

</html>