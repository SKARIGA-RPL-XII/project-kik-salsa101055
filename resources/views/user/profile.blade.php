<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - Upvity</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background: #F4F5F7; min-height: 100vh; }

        .sidebar { width: 220px; min-height: 100vh; background: #fff; position: fixed; top: 0; left: 0; border-right: 1px solid #EBEBEB; z-index: 100; padding: 24px 0; }
        .sidebar-logo { padding: 0 20px 24px; border-bottom: 1px solid #EBEBEB; }
        .sidebar-logo img { height: 40px; width: auto; object-fit: contain; }
        .sidebar-section-label { font-size: 11px; font-weight: 600; color: #9CA3AF; letter-spacing: 0.08em; text-transform: uppercase; padding: 20px 20px 8px; }
        .sidebar-item { display: flex; align-items: center; gap: 10px; padding: 10px 20px; color: #6B7280; font-size: 14px; font-weight: 500; text-decoration: none; border-radius: 8px; margin: 2px 10px; transition: all 0.15s; }
        .sidebar-item:hover { background: #F3F0FF; color: #7C3AED; }
        .sidebar-item.active { background: #7C3AED; color: #fff; }
        .sidebar-item i { font-size: 16px; }

        .topbar { margin-left: 220px; background: #fff; border-bottom: 1px solid #EBEBEB; padding: 14px 28px; display: flex; align-items: center; justify-content: flex-end; position: sticky; top: 0; z-index: 99; gap: 12px; }
        .topbar-coin { display: flex; align-items: center; gap: 6px; background: #FFF8E7; border: 1px solid #FDE68A; border-radius: 20px; padding: 5px 14px; font-weight: 700; font-size: 13px; color: #92400E; }
        .topbar-coin i { color: #F59E0B; font-size: 16px; }
        .user-trigger { display: flex; align-items: center; gap: 10px; cursor: pointer; position: relative; user-select: none; }
        .user-trigger .name { font-size: 14px; font-weight: 600; color: #1F2937; text-align: right; }
        .user-trigger .role-text { font-size: 12px; color: #9CA3AF; text-align: right; }
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
        .dropdown-menu-item:hover { background: #F9FAFB; }
        .dropdown-menu-item i { font-size: 16px; color: #6B7280; }
        .dropdown-menu-item.logout { color: #DC2626; border-top: 1px solid #F0F0F0; }
        .dropdown-menu-item.logout i { color: #DC2626; }
        .dropdown-menu-item.logout:hover { background: #FEF2F2; }

        .main-content { margin-left: 220px; padding: 28px; }
        .page-title { font-size: 22px; font-weight: 700; color: #1F2937; margin-bottom: 4px; }
        .breadcrumb-row { display: flex; align-items: center; gap: 6px; font-size: 13px; color: #9CA3AF; margin-bottom: 24px; }
        .breadcrumb-row a { color: #7C3AED; text-decoration: none; }

        /* PROFILE LAYOUT */
        .profile-layout { display: grid; grid-template-columns: 300px 1fr; gap: 24px; align-items: start; }

        /* LEFT CARD */
        .left-card { background: #fff; border-radius: 16px; border: 1px solid #F0F0F0; padding: 28px 24px; text-align: center; }

        .avatar-wrap { position: relative; width: 100px; height: 100px; margin: 0 auto 16px; cursor: pointer; }
        .avatar-large { width: 100px; height: 100px; border-radius: 50%; background: #7C3AED; color: #fff; font-weight: 700; font-size: 36px; display: flex; align-items: center; justify-content: center; overflow: hidden; box-shadow: 0 6px 20px rgba(124,58,237,0.25); }
        .avatar-large img { width: 100%; height: 100%; object-fit: cover; }
        .avatar-edit-overlay { position: absolute; bottom: 0; right: 0; width: 30px; height: 30px; background: #7C3AED; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 13px; border: 2px solid #fff; }

        .profile-left-name { font-size: 18px; font-weight: 700; color: #1F2937; margin-bottom: 8px; }

        .level-badge { display: inline-flex; align-items: center; gap: 4px; background: #F3F0FF; color: #7C3AED; font-size: 11px; font-weight: 600; padding: 4px 12px; border-radius: 20px; margin-bottom: 6px; }
        .role-badge { display: inline-flex; align-items: center; gap: 4px; background: #F0FDF4; color: #059669; font-size: 11px; font-weight: 600; padding: 4px 12px; border-radius: 20px; margin-bottom: 18px; }

        .stat-bar-row { display: flex; align-items: center; gap: 8px; margin-bottom: 6px; }
        .stat-bar-icon.hp { color: #EF4444; font-size: 12px; }
        .stat-bar-icon.exp { color: #F59E0B; font-size: 12px; }
        .stat-bar-track { flex: 1; height: 7px; background: #F0F0F0; border-radius: 10px; overflow: hidden; }
        .stat-bar-fill.hp { height: 100%; border-radius: 10px; background: linear-gradient(90deg, #EF4444, #F87171); }
        .stat-bar-fill.exp { height: 100%; border-radius: 10px; background: linear-gradient(90deg, #F59E0B, #FCD34D); }
        .stat-bar-text { font-size: 11px; font-weight: 600; color: #9CA3AF; min-width: 50px; text-align: right; }

        .stat-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-top: 18px; }
        .stat-item { background: #F9FAFB; border-radius: 12px; padding: 12px; text-align: center; border: 1px solid #F0F0F0; }
        .stat-value { font-size: 18px; font-weight: 800; color: #7C3AED; }
        .stat-label { font-size: 11px; color: #9CA3AF; margin-top: 2px; }

        .btn-back { display: flex; align-items: center; justify-content: center; gap: 6px; background: #F3F4F6; color: #6B7280; border: none; border-radius: 10px; padding: 10px 18px; font-weight: 600; font-size: 13px; cursor: pointer; text-decoration: none; margin-top: 18px; width: 100%; }
        .btn-back:hover { background: #E5E7EB; color: #374151; }

        /* RIGHT CARD */
        .right-card { background: #fff; border-radius: 16px; border: 1px solid #F0F0F0; overflow: hidden; }
        .right-card-header { padding: 18px 24px; border-bottom: 1px solid #F0F0F0; display: flex; align-items: center; justify-content: space-between; }
        .right-card-header .title { font-size: 15px; font-weight: 700; color: #1F2937; display: flex; align-items: center; gap: 8px; }
        .right-card-header .title i { color: #7C3AED; }

        /* TABS */
        .profile-tabs { display: flex; border-bottom: 1px solid #F0F0F0; }
        .profile-tab { padding: 14px 24px; font-size: 13px; font-weight: 600; color: #9CA3AF; cursor: pointer; border-bottom: 2px solid transparent; transition: all 0.15s; background: none; border-top: none; border-left: none; border-right: none; }
        .profile-tab.active { color: #7C3AED; border-bottom-color: #7C3AED; }
        .profile-tab:hover { color: #7C3AED; }

        .tab-content-area { padding: 24px; }
        .tab-pane { display: none; }
        .tab-pane.active { display: block; }

        /* INFO VIEW */
        .info-field { border-bottom: 1px solid #F5F5F5; padding: 14px 0; }
        .info-field:last-child { border-bottom: none; }
        .info-field-label { font-size: 11px; font-weight: 600; color: #7C3AED; margin-bottom: 5px; display: flex; align-items: center; gap: 6px; }
        .info-field-value { font-size: 14px; color: #1F2937; padding-left: 18px; font-weight: 500; }

        /* EDIT FORM */
        .form-label { font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 6px; }
        .form-control { border: 1.5px solid #E5E7EB; border-radius: 10px; padding: 10px 14px; font-size: 14px; color: #1F2937; }
        .form-control:focus { border-color: #7C3AED; box-shadow: 0 0 0 3px rgba(124,58,237,0.08); outline: none; }
        .form-text { font-size: 12px; color: #9CA3AF; margin-top: 4px; }
        .btn-save { background: #7C3AED; color: #fff; border: none; border-radius: 10px; padding: 11px 28px; font-weight: 600; font-size: 14px; cursor: pointer; }
        .btn-save:hover { background: #6D28D9; }
        .password-toggle { position: relative; }
        .password-toggle .toggle-eye { position: absolute; right: 12px; top: 50%; transform: translateY(-50%); color: #9CA3AF; cursor: pointer; font-size: 16px; }

        /* ALERT */
        .alert-custom { border-radius: 10px; font-size: 14px; padding: 12px 16px; margin-bottom: 20px; display: flex; align-items: center; gap: 8px; }
        .alert-success-custom { background: #ECFDF5; color: #065F46; border: 1px solid #A7F3D0; }
        .alert-error-custom { background: #FEF2F2; color: #991B1B; border: 1px solid #FECACA; }

        /* PHOTO UPLOAD MODAL */
        .modal-content { border-radius: 16px; border: none; }
        .modal-header { border-bottom: 1px solid #F0F0F0; padding: 18px 24px; }
        .modal-body { padding: 24px; }
        .modal-footer { border-top: 1px solid #F0F0F0; padding: 16px 24px; }
        .modal-title { font-weight: 700; color: #1F2937; font-size: 15px; }
        .btn-primary-modal { background: #7C3AED; color: #fff; border: none; border-radius: 10px; padding: 10px 24px; font-weight: 600; font-size: 14px; }
        .btn-primary-modal:hover { background: #6D28D9; color: #fff; }
        .btn-secondary-modal { background: #F5F5F5; color: #6B7280; border: none; border-radius: 10px; padding: 10px 24px; font-weight: 600; font-size: 14px; }

        .photo-preview { width: 100px; height: 100px; border-radius: 50%; background: #F0F0F0; margin: 0 auto 16px; overflow: hidden; display: flex; align-items: center; justify-content: center; font-size: 36px; font-weight: 700; color: #9CA3AF; }
        .photo-preview img { width: 100%; height: 100%; object-fit: cover; }
        .upload-area { border: 2px dashed #E5E7EB; border-radius: 10px; padding: 24px; text-align: center; cursor: pointer; transition: all 0.15s; }
        .upload-area:hover { border-color: #7C3AED; background: #F3F0FF; }
        .upload-area i { font-size: 28px; color: #9CA3AF; display: block; margin-bottom: 8px; }
        .upload-area p { font-size: 13px; color: #9CA3AF; margin: 0; }
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
    <a href="{{ route('user.history') }}" class="sidebar-item">
        <i class="bi bi-clock-history"></i> Riwayat
    </a>
</div>

<!-- TOPBAR -->
<div class="topbar">
    <div class="topbar-coin">
        <i class="bi bi-coin"></i> {{ number_format($user->coin ?? 0) }}
    </div>
    <div class="user-trigger" id="userTrigger">
        <div>
            <div class="name">{{ $user->name }}</div>
            <div class="role-text">{{ $user->level ? $user->level->level_name : 'User' }}</div>
        </div>
        <div class="avatar">
            @if($user->photo_profile)
                <img src="{{ asset('images/' . $user->photo_profile) }}" alt="foto">
            @else
                {{ strtoupper(substr($user->name, 0, 1)) }}
            @endif
        </div>
        <i class="bi bi-chevron-down chevron"></i>
        <div class="profile-dropdown" id="profileDropdown">
            <div class="dropdown-user-info">
                <div class="dropdown-avatar">
                    @if($user->photo_profile)
                        <img src="{{ asset('images/' . $user->photo_profile) }}" alt="foto">
                    @else
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    @endif
                </div>
                <div>
                    <div class="dropdown-user-name">{{ $user->name }}</div>
                    <div class="dropdown-user-role">{{ $user->role ? $user->role->role_name : 'User' }}</div>
                    <div class="dropdown-user-email"><i class="bi bi-envelope"></i> {{ $user->email }}</div>
                </div>
            </div>
            <a href="{{ route('user.profile') }}" class="dropdown-menu-item" style="background:#F8F5FF;color:#7C3AED;">
                <i class="bi bi-person" style="color:#7C3AED;"></i> Profil Saya
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
    <div class="page-title">Profil Saya</div>
    <div class="breadcrumb-row">
        <i class="bi bi-house-fill" style="color:#7C3AED;"></i>
        <a href="{{ route('user.dashboard') }}">Dashboard</a>
        <i class="bi bi-chevron-right" style="font-size:11px;"></i>
        <span>Profil Saya</span>
    </div>

    @if(session('success'))
        <div class="alert-custom alert-success-custom"><i class="bi bi-check-circle-fill"></i>{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert-custom alert-error-custom">
            <i class="bi bi-exclamation-triangle-fill"></i>
            {{ $errors->first() }}
        </div>
    @endif

    <div class="profile-layout">
        <!-- LEFT CARD -->
        <div class="left-card">
            <!-- Avatar + edit overlay -->
            <div class="avatar-wrap" onclick="document.getElementById('modalFoto') && new bootstrap.Modal(document.getElementById('modalFoto')).show()" data-bs-toggle="modal" data-bs-target="#modalFoto" title="Ganti foto profil">
                <div class="avatar-large">
                    @if($user->photo_profile)
                        <img src="{{ asset('images/' . $user->photo_profile) }}" alt="foto" id="previewImg">
                    @else
                        <span id="avatarInitial">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                    @endif
                </div>
                <div class="avatar-edit-overlay"><i class="bi bi-camera-fill"></i></div>
            </div>

            <div class="profile-left-name">{{ $user->name }}</div>
            <div><span class="level-badge"><i class="bi bi-star-fill" style="font-size:9px;"></i>{{ $user->level ? $user->level->level_name : 'Beginner' }}</span></div>
            <div><span class="role-badge"><i class="bi bi-person-badge-fill" style="font-size:10px;"></i>{{ $user->role ? $user->role->role_name : 'User' }}</span></div>

            <!-- HP & EXP bars -->
            <div style="width:100%;">
                <div class="stat-bar-row">
                    <i class="bi bi-heart-fill stat-bar-icon hp"></i>
                    <div class="stat-bar-track">
                        <div class="stat-bar-fill hp" style="width:{{ ($currentHp / $maxHp) * 100 }}%"></div>
                    </div>
                    <span class="stat-bar-text">{{ $currentHp }}/{{ $maxHp }}</span>
                </div>
                <div class="stat-bar-row">
                    <i class="bi bi-star-fill stat-bar-icon exp"></i>
                    <div class="stat-bar-track">
                        <div class="stat-bar-fill exp" style="width:{{ $maxExp > 0 ? min(($user->exp / $maxExp) * 100, 100) : 0 }}%"></div>
                    </div>
                    <span class="stat-bar-text">{{ $user->exp ?? 0 }}/{{ $maxExp }}</span>
                </div>
            </div>

            <!-- Stat grid -->
            <div class="stat-grid">
                <div class="stat-item">
                    <div class="stat-value">{{ $user->exp ?? 0 }}</div>
                    <div class="stat-label">Total EXP</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value" style="color:#F59E0B;">{{ number_format($user->coin ?? 0) }}</div>
                    <div class="stat-label">Koin</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value" style="color:#059669;">{{ $completedTasks }}</div>
                    <div class="stat-label">Selesai</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value" style="color:#EF4444;">{{ $currentHp }}</div>
                    <div class="stat-label">HP</div>
                </div>
            </div>

            <a href="{{ route('user.dashboard') }}" class="btn-back">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>

        <!-- RIGHT CARD -->
        <div class="right-card">
            <div class="profile-tabs">
                <button class="profile-tab active" onclick="switchTab('info', this)">
                    <i class="bi bi-info-circle me-1"></i>Informasi
                </button>
                <button class="profile-tab" onclick="switchTab('edit', this)">
                    <i class="bi bi-pencil me-1"></i>Edit Profil
                </button>
                <button class="profile-tab" onclick="switchTab('password', this)">
                    <i class="bi bi-lock me-1"></i>Ganti Password
                </button>
            </div>

            <div class="tab-content-area">
                <!-- TAB INFO -->
                <div class="tab-pane active" id="tabInfo">
                    <div class="info-field">
                        <div class="info-field-label"><i class="bi bi-person-fill"></i> Nama Lengkap</div>
                        <div class="info-field-value">{{ $user->name }}</div>
                    </div>
                    <div class="info-field">
                        <div class="info-field-label"><i class="bi bi-envelope-fill"></i> Email</div>
                        <div class="info-field-value">{{ $user->email }}</div>
                    </div>
                    <div class="info-field">
                        <div class="info-field-label"><i class="bi bi-people-fill"></i> Role</div>
                        <div class="info-field-value">{{ $user->role ? $user->role->role_name : 'User' }}</div>
                    </div>
                    <div class="info-field">
                        <div class="info-field-label"><i class="bi bi-star-fill"></i> Level</div>
                        <div class="info-field-value">{{ $user->level ? $user->level->level_name : 'Beginner' }}</div>
                    </div>
                    <div class="info-field">
                        <div class="info-field-label"><i class="bi bi-activity"></i> Status Akun</div>
                        <div class="info-field-value">
                            @if($user->status === 'active')
                                <span style="color:#059669;font-weight:700;"><i class="bi bi-circle-fill" style="font-size:8px;"></i> Aktif</span>
                            @else
                                <span style="color:#EF4444;font-weight:700;"><i class="bi bi-circle-fill" style="font-size:8px;"></i> Nonaktif</span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- TAB EDIT PROFIL -->
                <div class="tab-pane" id="tabEdit">
                    <form action="{{ route('user.profile.update') }}" method="POST">
                        @csrf @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                        </div>
                        <button type="submit" class="btn-save"><i class="bi bi-check-lg me-1"></i>Simpan Perubahan</button>
                    </form>
                </div>

                <!-- TAB GANTI PASSWORD -->
                <div class="tab-pane" id="tabPassword">
                    <form action="{{ route('user.profile.update') }}" method="POST">
                        @csrf @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">Password Baru</label>
                            <div class="password-toggle">
                                <input type="password" name="password" id="passNew" class="form-control" placeholder="Minimal 8 karakter">
                                <i class="bi bi-eye toggle-eye" onclick="togglePass('passNew', this)"></i>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Konfirmasi Password</label>
                            <div class="password-toggle">
                                <input type="password" name="password_confirmation" id="passConf" class="form-control" placeholder="Ulangi password baru">
                                <i class="bi bi-eye toggle-eye" onclick="togglePass('passConf', this)"></i>
                            </div>
                            <div class="form-text">Kosongkan jika tidak ingin mengganti password</div>
                        </div>
                        <button type="submit" class="btn-save"><i class="bi bi-lock me-1"></i>Ganti Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL GANTI FOTO -->
<div class="modal fade" id="modalFoto" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-camera me-2" style="color:#7C3AED;"></i>Ganti Foto Profil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('user.profile.photo') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="photo-preview" id="photoPreviewCircle">
                        @if($user->photo_profile)
                            <img src="{{ asset('images/' . $user->photo_profile) }}" alt="foto" id="photoPreviewImg">
                        @else
                            <span>{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                        @endif
                    </div>
                    <div class="upload-area" onclick="document.getElementById('photoInput').click()">
                        <i class="bi bi-cloud-upload"></i>
                        <p>Klik untuk pilih foto</p>
                        <small style="color:#9CA3AF;font-size:11px;">JPG, PNG · Maks. 2MB</small>
                    </div>
                    <input type="file" id="photoInput" name="photo_profile" accept=".jpg,.jpeg,.png" style="display:none;" onchange="previewPhoto(this)" required>
                    <div id="photoFileName" style="font-size:12px;color:#7C3AED;font-weight:600;margin-top:8px;text-align:center;display:none;"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-secondary-modal" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-primary-modal"><i class="bi bi-upload me-1"></i>Upload Foto</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Dropdown topbar
    const trigger = document.getElementById('userTrigger');
    const dropdown = document.getElementById('profileDropdown');
    trigger.addEventListener('click', e => { e.stopPropagation(); trigger.classList.toggle('open'); dropdown.classList.toggle('show'); });
    document.addEventListener('click', () => { trigger.classList.remove('open'); dropdown.classList.remove('show'); });
    dropdown.addEventListener('click', e => e.stopPropagation());

    // Tab switching
    function switchTab(tab, btn) {
        document.querySelectorAll('.profile-tab').forEach(t => t.classList.remove('active'));
        document.querySelectorAll('.tab-pane').forEach(p => p.classList.remove('active'));
        btn.classList.add('active');
        document.getElementById('tab' + tab.charAt(0).toUpperCase() + tab.slice(1)).classList.add('active');
    }

    // Toggle password visibility
    function togglePass(id, icon) {
        const input = document.getElementById(id);
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('bi-eye', 'bi-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('bi-eye-slash', 'bi-eye');
        }
    }

    // Preview foto sebelum upload
    function previewPhoto(input) {
        if (input.files && input.files[0]) {
            const file = input.files[0];
            if (file.size > 2 * 1024 * 1024) {
                alert('Ukuran foto maksimal 2MB!');
                input.value = '';
                return;
            }
            const reader = new FileReader();
            reader.onload = function(e) {
                const circle = document.getElementById('photoPreviewCircle');
                circle.innerHTML = `<img src="${e.target.result}" style="width:100%;height:100%;object-fit:cover;">`;
            };php artisan optimize:clear
            reader.readAsDataURL(file);
            const nameEl = document.getElementById('photoFileName');
            nameEl.style.display = 'block';
            nameEl.textContent = '📎 ' + file.name;
        }
    }

    // Buka tab yang sesuai jika ada error/success
    @if($errors->has('password') || $errors->has('password_confirmation'))
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.profile-tab')[2].click();
        });
    @elseif($errors->has('name') || $errors->has('email'))
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.profile-tab')[1].click();
        });
    @endif
</script>
</body>
</html>