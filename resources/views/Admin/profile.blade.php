<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - Upvity</title>
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

        .profile-photo-card {
            background: #fff;
            border-radius: 16px;
            border: 1px solid #F0F0F0;
            padding: 32px 24px;
            text-align: center;
        }

        .profile-photo-wrap {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: #F3F0FF;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
            font-weight: 700;
            color: #7C3AED;
            margin: 0 auto 16px;
            overflow: hidden;
            border: 3px solid #E9D5FF;
        }

        .profile-photo-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-name {
            font-size: 18px;
            font-weight: 700;
            color: #1F2937;
            margin-bottom: 4px;
        }

        .profile-role-badge {
            display: inline-block;
            background: #7C3AED;
            color: #fff;
            font-size: 12px;
            font-weight: 600;
            padding: 4px 14px;
            border-radius: 20px;
            margin-bottom: 16px;
        }

        .profile-info-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: #6B7280;
            justify-content: center;
            margin-bottom: 6px;
        }

        .profile-info-item i {
            color: #9CA3AF;
        }

        .btn-upload {
            background: #F3F0FF;
            color: #7C3AED;
            border: none;
            padding: 8px 18px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.15s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-top: 8px;
        }

        .btn-upload:hover {
            background: #EDE9FE;
        }

        .form-card {
            background: #fff;
            border-radius: 16px;
            border: 1px solid #F0F0F0;
            overflow: hidden;
        }

        .form-card-header {
            padding: 18px 24px;
            border-bottom: 1px solid #F0F0F0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-card-header .title {
            font-size: 15px;
            font-weight: 700;
            color: #1F2937;
        }

        .form-card-header .icon {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            background: #F3F0FF;
            color: #7C3AED;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
        }

        .form-card-body {
            padding: 24px;
        }

        .form-label {
            font-size: 13px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 6px;
        }

        .form-control {
            border: 1px solid #E5E7EB;
            border-radius: 10px;
            padding: 10px 14px;
            font-size: 14px;
            color: #1F2937;
            transition: border-color 0.15s;
        }

        .form-control:focus {
            border-color: #7C3AED;
            box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.08);
            outline: none;
        }

        .btn-save {
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

        .btn-save:hover {
            background: #6D28D9;
        }

        .btn-cancel {
            background: #F3F4F6;
            color: #6B7280;
            border: none;
            padding: 10px 24px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.15s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }

        .btn-cancel:hover {
            background: #E5E7EB;
            color: #6B7280;
        }

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
            <div class="page-title">Profil Saya</div>
            <div class="page-subtitle">Kelola informasi akun kamu</div>
        </div>

        @if(session('success'))
            <div class="alert-success-custom">
                <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert-error-custom">
                <i class="bi bi-exclamation-circle-fill"></i>
                <ul class="mb-0 mt-1 ps-3">
                    @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                </ul>
            </div>
        @endif

        {{-- SATU FORM BESAR yang membungkus semua kolom --}}
        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" id="profileForm">
            @csrf
            @method('PUT')

            {{-- Input file disembunyikan di dalam form --}}
            <input type="file" id="photoInput" name="photo_profile" accept="image/*" style="display:none;">

            <div class="row g-3">
                <!-- FOTO PROFIL -->
                <div class="col-md-4">
                    <div class="profile-photo-card">
                        <div class="profile-photo-wrap" id="photoPreviewWrap">
                            @if($user->photo_profile)
                                <img src="{{ asset('images/' . $user->photo_profile) }}" alt="foto">
                            @else
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            @endif
                        </div>
                        <div class="profile-name">{{ $user->name }}</div>
                        <div class="profile-role-badge">Admin</div>
                        <div class="profile-info-item"><i class="bi bi-envelope"></i> {{ $user->email }}</div>
                        <div class="profile-info-item"><i class="bi bi-shield-check"></i> Role: Admin</div>

                        <label for="photoInput" class="btn-upload">
                            <i class="bi bi-camera"></i> Ganti Foto
                        </label>
                        <div id="photoFileName" style="font-size:12px;color:#9CA3AF;margin-top:8px;"></div>
                    </div>
                </div>

                <!-- FORM EDIT -->
                <div class="col-md-8">
                    <!-- INFORMASI DASAR -->
                    <div class="form-card mb-3">
                        <div class="form-card-header">
                            <div class="icon"><i class="bi bi-person"></i></div>
                            <span class="title">Informasi Dasar</span>
                        </div>
                        <div class="form-card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nama Lengkap</label>
                                    <input type="text" name="name" class="form-control"
                                        value="{{ old('name', $user->name) }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control"
                                        value="{{ old('email', $user->email) }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Role</label>
                                    <input type="text" class="form-control" value="Admin" disabled
                                        style="background:#F9FAFB; color:#9CA3AF;">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- GANTI PASSWORD -->
                    <div class="form-card mb-3">
                        <div class="form-card-header">
                            <div class="icon"><i class="bi bi-lock"></i></div>
                            <span class="title">Ganti Password</span>
                        </div>
                        <div class="form-card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Password Baru <span
                                            style="color:#9CA3AF;font-weight:400;">(opsional)</span></label>
                                    <input type="password" name="password" class="form-control"
                                        placeholder="" autocomplete="new-password">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Konfirmasi Password</label>
                                    <input type="password" name="password_confirmation" class="form-control"
                                        placeholder="" autocomplete="new-password">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn-save">
                            <i class="bi bi-check-lg me-1"></i> Simpan Perubahan
                        </button>
                        <a href="{{ route('admin.dashboard') }}" class="btn-cancel">Kembali</a>
                    </div>
                </div>
            </div>
        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Dropdown topbar
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

        // Preview foto & tampilkan nama file
        document.getElementById('photoInput').addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (file) {
                document.getElementById('photoFileName').textContent = file.name;
                const reader = new FileReader();
                reader.onload = function (ev) {
                    const wrap = document.getElementById('photoPreviewWrap');
                    wrap.innerHTML = '<img src="' + ev.target.result + '" alt="preview" style="width:100%;height:100%;object-fit:cover;">';
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>

</html>