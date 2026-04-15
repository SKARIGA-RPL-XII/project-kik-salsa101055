<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola User - Upvity</title>
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
            padding: 13px 16px;
            font-size: 13px;
            color: #374151;
            vertical-align: middle;
            border-color: #F5F5F5;
        }

        .table tbody tr:hover {
            background: #FAFAFA;
        }

        /* AVATAR USER */
        .user-avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: #F3F0FF;
            color: #7C3AED;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 700;
            overflow: hidden;
            flex-shrink: 0;
        }

        .user-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .user-name {
            font-weight: 600;
            font-size: 13px;
            color: #1F2937;
        }

        .user-email {
            font-size: 12px;
            color: #9CA3AF;
        }

        /* LEVEL BADGE */
        .level-badge {
            background: #F3F0FF;
            color: #7C3AED;
            font-size: 11px;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 20px;
            white-space: nowrap;
        }

        /* PROGRESS BAR */
        .progress-wrap {
            min-width: 80px;
        }

        .progress-label {
            font-size: 11px;
            color: #9CA3AF;
            margin-bottom: 3px;
        }

        .progress {
            height: 5px;
            border-radius: 10px;
            background: #F0F0F0;
        }

        .progress-hp {
            background: linear-gradient(90deg, #EF4444, #F97316);
        }

        .progress-exp {
            background: linear-gradient(90deg, #7C3AED, #A78BFA);
        }

        /* COIN */
        .coin-val {
            font-size: 13px;
            font-weight: 700;
            color: #F59E0B;
        }

        /* ROLE BADGE */
        .role-admin {
            background: #EFF6FF;
            color: #2563EB;
            font-size: 11px;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 20px;
        }

        .role-user {
            background: #F3F4F6;
            color: #6B7280;
            font-size: 11px;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 20px;
        }

        /* TOGGLE STATUS */
        .form-check-input:checked {
            background-color: #7C3AED;
            border-color: #7C3AED;
        }

        .form-check-input:focus {
            box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.15);
            border-color: #7C3AED;
        }

        /* ACTION BUTTONS */
        .btn-edit {
            width: 30px;
            height: 30px;
            border-radius: 8px;
            background: #FFF7ED;
            color: #F97316;
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            cursor: pointer;
            transition: background 0.15s;
        }

        .btn-edit:hover {
            background: #FFEDD5;
        }

        .btn-delete {
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

        .btn-delete:hover {
            background: #FEE2E2;
        }

        /* BTN ADD */
        .btn-add {
            background: #7C3AED;
            color: #fff;
            border: none;
            padding: 9px 18px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: background 0.15s;
        }

        .btn-add:hover {
            background: #6D28D9;
        }

        /* PAGINATION */
        .pagination-info {
            font-size: 13px;
            color: #9CA3AF;
            padding: 14px 24px;
            border-top: 1px solid #F0F0F0;
        }

        .page-link {
            color: #7C3AED;
            border-color: #E5E7EB;
            font-size: 13px;
        }

        .page-item.active .page-link {
            background: #7C3AED;
            border-color: #7C3AED;
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

        .form-label {
            font-size: 13px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 6px;
        }

        .form-control,
        .form-select {
            border: 1px solid #E5E7EB;
            border-radius: 10px;
            padding: 10px 14px;
            font-size: 14px;
            color: #1F2937;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #7C3AED;
            box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.08);
        }

        .btn-save {
            background: #7C3AED;
            color: #fff;
            border: none;
            padding: 10px 24px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
        }

        .btn-save:hover {
            background: #6D28D9;
            color: #fff;
        }

        .btn-cancel {
            background: #F3F4F6;
            color: #6B7280;
            border: none;
            padding: 10px 24px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
        }

        .btn-cancel:hover {
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
        <a href="{{ route('admin.users') }}" class="sidebar-item active">
            <i class="bi bi-people"></i> Kelola User
        </a>
        <a href="{{ route('admin.tasks') }}" class="sidebar-item">
            <i class="bi bi-clipboard-check"></i> Kelola Tugas
        </a>
        <a href="{{ route('admin.review') }}" class="sidebar-item">
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
            <div class="page-title">Kelola User</div>
            <div class="page-subtitle">Manage all users in the system</div>
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
                <span class="title">Daftar User</span>
                <div class="d-flex align-items-center gap-3">
                    <!-- SEARCH FILTER -->
                    <div class="search-filter-wrap">
                        <i class="bi bi-search"></i>
                        <input type="text" class="search-filter" id="searchInput" placeholder="Cari nama / email...">
                    </div>
                    <!-- TAMBAH USER -->
                    <button class="btn-add" data-bs-toggle="modal" data-bs-target="#modalTambahUser">
                        <i class="bi bi-plus-lg"></i> Tambah User
                    </button>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-borderless" id="userTable">
                    <thead>
                        <tr>
                            <th>Pengguna</th>
                            <th>Level</th>
                            <th>HP</th>
                            <th>EXP</th>
                            <th>Coin</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <!-- PENGGUNA -->
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="user-avatar">
                                            @if($user->photo_profile)
                                                <img src="{{ asset('images/' . $user->photo_profile) }}" alt="foto">
                                            @else
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            @endif
                                        </div>
                                        <div>
                                            <div class="user-name">{{ $user->name }}</div>
                                            <div class="user-email">{{ $user->email }}</div>
                                        </div>
                                    </div>
                                </td>

                                <!-- LEVEL -->
                                <td><span class="level-badge">Level {{ $user->id_level ?? 1 }}</span></td>

                                <!-- HP -->
                                <td>
                                    <div class="progress-wrap">
                                        <div class="progress-label">{{ $user->hp ?? 50 }}/50</div>
                                        <div class="progress">
                                            <div class="progress-bar progress-hp"
                                                style="width: {{ (($user->hp ?? 50) / 50) * 100 }}%"></div>
                                        </div>
                                    </div>
                                </td>

                                <!-- EXP -->
                                <td>
                                    <div class="progress-wrap">
                                        <div class="progress-label">{{ $user->exp ?? 0 }}/100</div>
                                        <div class="progress">
                                            <div class="progress-bar progress-exp"
                                                style="width: {{ min((($user->exp ?? 0) / 100) * 100, 100) }}%"></div>
                                        </div>
                                    </div>
                                </td>

                                <!-- COIN -->
                                <td><span class="coin-val"><i class="bi bi-coin"></i>
                                        {{ number_format($user->coin ?? 0) }}</span></td>

                                <!-- ROLE -->
                                <td>
                                    @if($user->id_role == 1)
                                        <span class="role-admin">Admin</span>
                                    @else
                                        <span class="role-user">User</span>
                                    @endif
                                </td>

                                <!-- STATUS TOGGLE -->
                                <td>
                                    <div class="form-check form-switch mb-0">
                                        <input class="form-check-input toggle-status" type="checkbox"
                                            data-id="{{ $user->id_user }}" {{ $user->status === 'active' ? 'checked' : '' }}
                                            style="cursor:pointer; width:36px; height:20px;">
                                    </div>
                                </td>

                                <!-- AKSI -->
                                <td>
                                    <div class="d-flex gap-1">
                                        <button class="btn-edit btn-edit-user" data-id="{{ $user->id_user }}"
                                            data-name="{{ $user->name }}" data-email="{{ $user->email }}"
                                            data-role="{{ $user->id_role }}" data-level="{{ $user->id_level }}"
                                            data-bs-toggle="modal" data-bs-target="#modalEditUser" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <form action="{{ route('admin.users.destroy', $user->id_user) }}" method="POST"
                                            class="form-delete">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn-delete" title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-5">
                                    <i class="bi bi-people"
                                        style="font-size:32px;opacity:0.3;display:block;margin-bottom:8px;"></i>
                                    Belum ada user
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- PAGINATION INFO -->
            <div class="d-flex align-items-center justify-content-between pagination-info">
                <span>Total: {{ $users->count() }} data</span>
                @if(method_exists($users, 'links'))
                    <div>{{ $users->links('pagination::bootstrap-5') }}</div>
                @endif
            </div>
        </div>
    </div>

    <!-- ===== MODAL TAMBAH USER ===== -->
    <div class="modal fade" id="modalTambahUser" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-person-plus me-2 text-purple"
                            style="color:#7C3AED;"></i>Tambah User Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('admin.users.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="name" class="form-control" placeholder="Masukkan nama lengkap"
                                    required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Masukkan email"
                                    required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control"
                                    placeholder="Min. 8 karakter" required minlength="8" autocomplete="new-password"
                                    oninvalid="this.setCustomValidity('Password minimal 8 karakter!')"
                                    oninput="this.setCustomValidity('')">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Role</label>
                                <select name="id_role" class="form-select" required>
                                    <option value="2">User</option>
                                    <option value="1">Admin</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Level Awal</label>
                                <select name="id_level" class="form-select">
                                    @for($i = 1; $i <= 10; $i++)
                                        <option value="{{ $i }}">Level {{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-cancel" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn-save"><i class="bi bi-check-lg me-1"></i>Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ===== MODAL EDIT USER ===== -->
    <div class="modal fade" id="modalEditUser" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-pencil me-2" style="color:#7C3AED;"></i>Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="formEditUser" method="POST">
                    @csrf @method('PUT')
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="name" id="editName" class="form-control" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" id="editEmail" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Password Baru <span
                                        style="color:#9CA3AF;font-weight:400;">(opsional)</span></label>
                                <input type="password" name="password" class="form-control"
                                    placeholder="Kosongkan jika tidak diubah" autocomplete="new-password">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Role</label>
                                <select name="id_role" id="editRole" class="form-select">
                                    <option value="2">User</option>
                                    <option value="1">Admin</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Level</label>
                                <select name="id_level" id="editLevel" class="form-select">
                                    @for($i = 1; $i <= 10; $i++)
                                        <option value="{{ $i }}">Level {{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-cancel" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn-save"><i class="bi bi-check-lg me-1"></i>Simpan
                            Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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

        // Search filter tabel
        document.getElementById('searchInput').addEventListener('input', function () {
            const q = this.value.toLowerCase();
            document.querySelectorAll('#userTable tbody tr').forEach(function (row) {
                const text = row.innerText.toLowerCase();
                row.style.display = text.includes(q) ? '' : 'none';
            });
        });

        // Toggle status
        document.querySelectorAll('.toggle-status').forEach(function (toggle) {
            toggle.addEventListener('change', function () {
                const userId = this.dataset.id;
                const newStatus = this.checked ? 'active' : 'inactive';
                fetch(`/admin/users/${userId}/toggle-status`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ status: newStatus })
                })
                    .then(res => res.json())
                    .then(data => {
                        if (!data.success) {
                            this.checked = !this.checked;
                            alert('Gagal mengubah status!');
                        }
                    })
                    .catch(() => {
                        this.checked = !this.checked;
                        alert('Terjadi kesalahan!');
                    });
            });
        });

        // Isi modal edit
        document.querySelectorAll('.btn-edit-user').forEach(function (btn) {
            btn.addEventListener('click', function () {
                const id = this.dataset.id;
                document.getElementById('editName').value = this.dataset.name;
                document.getElementById('editEmail').value = this.dataset.email;
                document.getElementById('editRole').value = this.dataset.role;
                document.getElementById('editLevel').value = this.dataset.level;
                document.getElementById('formEditUser').action = `/admin/users/${id}`;
            });
        });

        // Konfirmasi hapus
        document.querySelectorAll('.form-delete').forEach(function (form) {
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                if (confirm('Yakin ingin menghapus user ini?')) {
                    this.submit();
                }
            });
        });
    </script>
</body>

</html>