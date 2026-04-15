<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Tugas - Upvity</title>
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

        /* SIDEBAR */
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

        /* TOPBAR */
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

        /* MAIN */
        .main-content {
            margin-left: 220px;
            padding: 28px;
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

        /* CARD */
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

        .task-count {
            font-size: 13px;
            color: #9CA3AF;
            font-weight: 500;
            margin-left: 8px;
        }

        /* SEARCH */
        .search-filter {
            background: #F4F5F7;
            border: none;
            border-radius: 10px;
            padding: 8px 14px 8px 36px;
            font-size: 13px;
            color: #374151;
            width: 220px;
            outline: none;
        }

        .search-filter-wrap {
            position: relative;
        }

        .search-filter-wrap i {
            position: absolute;
            left: 11px;
            top: 50%;
            transform: translateY(-50%);
            color: #9CA3AF;
            font-size: 13px;
        }

        /* TABLE */
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

        /* TASK INFO */
        .task-title {
            font-weight: 600;
            font-size: 13px;
            color: #1F2937;
            margin-bottom: 2px;
        }

        .task-desc {
            font-size: 12px;
            color: #9CA3AF;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 180px;
        }

        /* USER CHIP */
        .user-chip {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #F3F0FF;
            color: #7C3AED;
            font-size: 12px;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 20px;
        }

        /* DEADLINE */
        .deadline-badge {
            font-size: 12px;
            font-weight: 500;
            color: #374151;
            background: #F3F4F6;
            padding: 4px 10px;
            border-radius: 8px;
            white-space: nowrap;
        }

        /* STATUS BADGE */
        .status-pending {
            background: #FFF7ED;
            color: #D97706;
            font-size: 11px;
            font-weight: 600;
            padding: 4px 12px;
            border-radius: 20px;
        }

        .status-approved {
            background: #ECFDF5;
            color: #059669;
            font-size: 11px;
            font-weight: 600;
            padding: 4px 12px;
            border-radius: 20px;
        }

        .status-rejected {
            background: #FEF2F2;
            color: #DC2626;
            font-size: 11px;
            font-weight: 600;
            padding: 4px 12px;
            border-radius: 20px;
        }

        /* ACTION BUTTONS */
        .btn-review {
            width: 30px;
            height: 30px;
            border-radius: 8px;
            background: #EFF6FF;
            color: #2563EB;
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            cursor: pointer;
            transition: background 0.15s;
        }

        .btn-review:hover {
            background: #DBEAFE;
        }

        .btn-reject {
            width: 30px;
            height: 30px;
            border-radius: 8px;
            background: #FEF2F2;
            color: #EF4444;
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            cursor: pointer;
            transition: background 0.15s;
        }

        .btn-reject:hover {
            background: #FEE2E2;
        }

        /* PAGINATION */
        .pagination-info {
            font-size: 13px;
            color: #9CA3AF;
            padding: 14px 24px;
            border-top: 1px solid #F0F0F0;
        }

        /* MODAL */
        .modal-header {
            border-bottom: 1px solid #F0F0F0;
            padding: 20px 24px;
        }

        .modal-title {
            font-size: 16px;
            font-weight: 700;
            color: #1F2937;
        }

        .modal-body {
            padding: 24px;
        }

        .modal-footer {
            border-top: 1px solid #F0F0F0;
            padding: 16px 24px;
        }

        .modal-content {
            border-radius: 16px;
            border: none;
        }

        /* DETAIL ITEM */
        .detail-label {
            font-size: 11px;
            font-weight: 600;
            color: #9CA3AF;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            margin-bottom: 4px;
        }

        .detail-value {
            font-size: 14px;
            color: #1F2937;
            font-weight: 500;
        }

        .detail-box {
            background: #F9FAFB;
            border-radius: 10px;
            padding: 12px 14px;
            font-size: 13px;
            color: #374151;
            border: 1px solid #F0F0F0;
        }

        /* FILE PREVIEW */
        .file-preview {
            background: #F9FAFB;
            border: 1px dashed #E5E7EB;
            border-radius: 10px;
            padding: 16px;
            text-align: center;
        }

        .file-preview img {
            max-width: 100%;
            max-height: 200px;
            border-radius: 8px;
            object-fit: contain;
        }

        .file-preview a {
            color: #7C3AED;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .file-preview a:hover {
            text-decoration: underline;
        }

        /* REWARD INFO */
        .reward-info {
            background: #F3F0FF;
            border-radius: 10px;
            padding: 12px 16px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .reward-info .exp {
            font-size: 18px;
            font-weight: 700;
            color: #7C3AED;
        }

        .reward-info .label {
            font-size: 12px;
            color: #9CA3AF;
        }

        /* BTN APPROVE */
        .btn-approve {
            background: #7C3AED;
            color: #fff;
            border: none;
            padding: 10px 24px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.15s;
        }

        .btn-approve:hover {
            background: #6D28D9;
        }

        .btn-reject-action {
            background: #FEF2F2;
            color: #DC2626;
            border: 1px solid #FECACA;
            padding: 10px 24px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.15s;
        }

        .btn-reject-action:hover {
            background: #FEE2E2;
        }

        .btn-back {
            background: #F3F4F6;
            color: #6B7280;
            border: none;
            padding: 10px 24px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
        }

        .btn-back:hover {
            background: #E5E7EB;
            color: #6B7280;
        }

        /* ALERT */
        .alert-success-custom {
            background: #ECFDF5;
            border: 1px solid #A7F3D0;
            color: #065F46;
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
        }

        .alert-error-custom {
            background: #FEF2F2;
            border: 1px solid #FECACA;
            color: #991B1B;
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 14px;
            margin-bottom: 20px;
        }

        /* EMPTY STATE */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
        }

        .empty-state i {
            font-size: 48px;
            color: #E5E7EB;
            display: block;
            margin-bottom: 12px;
        }

        .empty-state p {
            color: #9CA3AF;
            font-size: 14px;
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
        <a href="{{ route('admin.review') }}" class="sidebar-item active">
            <i class="bi bi-eye"></i> Review Tugas
        </a>
        <div class="sidebar-section-label">Analytics</div>
        <a href="#" class="sidebar-item">
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
                        <div class="dropdown-user-email"><i class="bi bi-envelope"></i> {{ auth()->user()->email }}
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
            <div class="page-title">Review Tugas</div>
            <div class="page-subtitle">Approval tugas yang dikirim oleh user</div>
        </div>

        @if(session('success'))
            <div class="alert-success-custom">
                <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert-error-custom">
                <i class="bi bi-exclamation-circle-fill"></i> {{ session('error') }}
            </div>
        @endif

        <div class="card-section">
            <div class="card-section-header">
                <div class="d-flex align-items-center">
                    <span class="title">All Tasks</span>
                    <span class="task-count">({{ $reports->count() }} laporan)</span>
                </div>
                <div class="search-filter-wrap">
                    <i class="bi bi-search"></i>
                    <input type="text" class="search-filter" id="searchInput" placeholder="Cari tugas...">
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-borderless" id="reviewTable">
                    <thead>
                        <tr>
                            <th>Tugas</th>
                            <th>Deadline</th>
                            <th>Status</th>
                            <th>Assigned To</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reports as $report)
                            <tr>
                                <!-- TUGAS -->
                                <td>
                                    <div class="task-title">{{ $report->task->title ?? '-' }}</div>
                                    <div class="task-desc">{{ $report->task->description ?? '-' }}</div>
                                </td>

                                <!-- DEADLINE -->
                                <td>
                                    <span class="deadline-badge">
                                        <i class="bi bi-calendar3 me-1"></i>
                                        {{ $report->task ? \Carbon\Carbon::parse($report->task->deadline)->format('d M Y') : '-' }}
                                    </span>
                                </td>

                                <!-- STATUS -->
                                <td>
                                    <span class="status-{{ $report->status }}">
                                        {{ ucfirst($report->status) }}
                                    </span>
                                </td>

                                <!-- ASSIGNED TO -->
                                <td>
                                    @if($report->user)
                                        <span class="user-chip">
                                            <i class="bi bi-person"></i> {{ $report->user->name }}
                                        </span>
                                    @else
                                        <span style="color:#D1D5DB;font-size:12px;">-</span>
                                    @endif
                                </td>

                                <!-- AKSI -->
                                <td>
                                    <div class="d-flex gap-1">
                                        <!-- Tombol Review/Detail -->
                                        <button class="btn-review btn-detail" data-report-id="{{ $report->id_report }}"
                                            data-task-title="{{ $report->task->title ?? '-' }}"
                                            data-task-desc="{{ $report->task->description ?? '-' }}"
                                            data-task-reward="{{ $report->task->reward ?? 0 }}"
                                            data-report-text="{{ $report->report_text }}"
                                            data-report-file="{{ $report->report_file }}"
                                            data-report-status="{{ $report->status }}"
                                            data-user-name="{{ $report->user->name ?? '-' }}"
                                            data-user-id="{{ $report->id_user }}" data-bs-toggle="modal"
                                            data-bs-target="#modalReview" title="Lihat Detail">
                                            <i class="bi bi-eye"></i>
                                        </button>

                                        @if($report->status === 'pending')
                                            <!-- Tombol Reject langsung -->
                                            <form action="{{ route('admin.review.reject', $report->id_report) }}" method="POST"
                                                class="form-reject">
                                                @csrf @method('PUT')
                                                <button type="submit" class="btn-reject" title="Tolak">
                                                    <i class="bi bi-x-lg"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                    <div class="empty-state">
                                        <i class="bi bi-clipboard-x"></i>
                                        <p>Belum ada laporan tugas yang masuk</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="pagination-info">
                Menampilkan {{ $reports->count() }} laporan
            </div>
        </div>
    </div>

    <!-- ===== MODAL REVIEW DETAIL ===== -->
    <div class="modal fade" id="modalReview" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-eye me-2" style="color:#7C3AED;"></i>Detail Review Tugas
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <!-- Info Tugas -->
                        <div class="col-md-8">
                            <div class="detail-label">Judul Tugas</div>
                            <div class="detail-value mb-3" id="modalTaskTitle">-</div>

                            <div class="detail-label">Deskripsi Tugas</div>
                            <div class="detail-box mb-3" id="modalTaskDesc">-</div>

                            <div class="detail-label">Laporan dari User</div>
                            <div class="detail-box" id="modalReportText">-</div>
                        </div>

                        <!-- Reward & User -->
                        <div class="col-md-4">
                            <div class="detail-label mb-2">Reward EXP</div>
                            <div class="reward-info mb-3">
                                <i class="bi bi-star-fill" style="color:#7C3AED;font-size:20px;"></i>
                                <div>
                                    <div class="exp" id="modalReward">0</div>
                                    <div class="label">EXP akan diberikan</div>
                                </div>
                            </div>

                            <div class="detail-label">User</div>
                            <div class="detail-value mb-3" id="modalUserName">-</div>

                            <div class="detail-label">Status</div>
                            <div id="modalStatus">-</div>
                        </div>

                        <!-- File Kiriman -->
                        <div class="col-12">
                            <div class="detail-label">Data/File yang dikirim</div>
                            <div class="file-preview mt-1" id="modalFilePreview">
                                <i class="bi bi-file-earmark" style="font-size:32px;color:#D1D5DB;"></i>
                                <p style="color:#9CA3AF;font-size:13px;margin-top:8px;">Tidak ada file</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" id="modalActions">
                    <button type="button" class="btn-back" data-bs-dismiss="modal">Kembali</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Approve (hidden) -->
    <form id="formApprove" method="POST" style="display:none;">
        @csrf @method('PUT')
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Topbar dropdown
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

        // Search filter
        document.getElementById('searchInput').addEventListener('input', function () {
            const q = this.value.toLowerCase();
            document.querySelectorAll('#reviewTable tbody tr').forEach(function (row) {
                row.style.display = row.innerText.toLowerCase().includes(q) ? '' : 'none';
            });
        });

        // Isi modal review
        document.querySelectorAll('.btn-detail').forEach(function (btn) {
            btn.addEventListener('click', function () {
                const reportId = this.dataset.reportId;
                const status = this.dataset.reportStatus;
                const reward = this.dataset.taskReward;
                const userId = this.dataset.userId;
                const reportFile = this.dataset.reportFile;

                document.getElementById('modalTaskTitle').textContent = this.dataset.taskTitle;
                document.getElementById('modalTaskDesc').textContent = this.dataset.taskDesc;
                document.getElementById('modalReportText').textContent = this.dataset.reportText || 'Tidak ada catatan';
                document.getElementById('modalReward').textContent = reward;
                document.getElementById('modalUserName').textContent = this.dataset.userName;

                // Status badge
                const statusMap = {
                    'pending': '<span class="status-pending">Pending</span>',
                    'approved': '<span class="status-approved">Approved</span>',
                    'rejected': '<span class="status-rejected">Rejected</span>',
                };
                document.getElementById('modalStatus').innerHTML = statusMap[status] || status;

                // File preview
                const fileWrap = document.getElementById('modalFilePreview');
                if (reportFile && reportFile !== '' && reportFile !== 'null') {
                    const cleanFile = reportFile.replace(/^reports\//, '');
                    const filePath = '/reports/' + cleanFile.split('/').map(encodeURIComponent).join('/');
                    const ext = cleanFile.split('.').pop().toLowerCase();
                    const isImage = ['jpg', 'jpeg', 'png', 'gif', 'webp'].includes(ext);
                    if (isImage) {
                        fileWrap.innerHTML = `<img src="${filePath}" alt="file" style="max-width:100%;max-height:200px;border-radius:8px;object-fit:contain;">`;
                    } else {
                        fileWrap.innerHTML = `<a href="${filePath}" target="_blank"><i class="bi bi-file-earmark-arrow-down"></i> Download File</a>`;
                    }
                } else {
                    fileWrap.innerHTML = `<i class="bi bi-file-earmark" style="font-size:32px;color:#D1D5DB;"></i><p style="color:#9CA3AF;font-size:13px;margin-top:8px;">Tidak ada file</p>`;
                }

                // Tombol approve/reject hanya jika status pending
                const actions = document.getElementById('modalActions');
                if (status === 'pending') {
                    actions.innerHTML = `
                    <button type="button" class="btn-back" data-bs-dismiss="modal">Kembali</button>
                    <button type="button" class="btn-reject-action" onclick="rejectReport(${reportId})">
                        <i class="bi bi-x-circle me-1"></i>Tolak
                    </button>
                    <button type="button" class="btn-approve" onclick="approveReport(${reportId}, ${reward}, ${userId})">
                        <i class="bi bi-check-circle me-1"></i>Approve & Beri EXP
                    </button>
                `;
                } else {
                    actions.innerHTML = `<button type="button" class="btn-back" data-bs-dismiss="modal">Kembali</button>`;
                }
            });
        });

        // Approve
        function approveReport(reportId, reward, userId) {
            if (confirm(`Approve tugas ini dan berikan ${reward} EXP ke user?`)) {
                const form = document.getElementById('formApprove');
                form.action = `/admin/review/${reportId}/approve`;
                form.submit();
            }
        }

        // Reject
        function rejectReport(reportId) {
            if (confirm('Yakin ingin menolak laporan tugas ini?')) {
                const form = document.getElementById('formApprove');
                form.action = `/admin/review/${reportId}/reject`;
                // Override method
                const methodInput = form.querySelector('input[name="_method"]');
                if (methodInput) methodInput.value = 'PUT';
                form.submit();
            }
        }

        // Konfirmasi reject langsung dari tabel
        document.querySelectorAll('.form-reject').forEach(function (form) {
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                if (confirm('Yakin ingin menolak laporan ini?')) {
                    this.submit();
                }
            });
        });
    </script>
</body>

</html>