<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Tugas - Upvity</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background: #F4F5F7; min-height: 100vh; }

        .sidebar { width: 220px; min-height: 100vh; background: #fff; position: fixed; top: 0; left: 0; border-right: 1px solid #EBEBEB; z-index: 100; padding: 24px 0; }
        .sidebar-logo { padding: 0 20px 24px; border-bottom: 1px solid #EBEBEB; display: flex; align-items: center; }
        .sidebar-logo img { height: 40px; width: auto; object-fit: contain; }
        .sidebar-section-label { font-size: 11px; font-weight: 600; color: #9CA3AF; letter-spacing: 0.08em; text-transform: uppercase; padding: 20px 20px 8px; }
        .sidebar-item { display: flex; align-items: center; gap: 10px; padding: 10px 20px; color: #6B7280; font-size: 14px; font-weight: 500; text-decoration: none; border-radius: 8px; margin: 2px 10px; transition: all 0.15s; }
        .sidebar-item:hover { background: #F3F0FF; color: #7C3AED; }
        .sidebar-item.active { background: #7C3AED; color: #fff; }
        .sidebar-item.active i { color: #fff; }
        .sidebar-item i { font-size: 16px; }

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

        .main-content { margin-left: 220px; padding: 28px; }
        .page-title { font-size: 22px; font-weight: 700; color: #1F2937; }
        .page-subtitle { font-size: 14px; color: #9CA3AF; margin-top: 2px; }

        .btn-add { background: #7C3AED; color: #fff; border: none; padding: 10px 20px; border-radius: 10px; font-size: 13px; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 6px; transition: background 0.15s; text-decoration: none; }
        .btn-add:hover { background: #6D28D9; color: #fff; }

        .card-section { background: #fff; border-radius: 16px; border: 1px solid #F0F0F0; overflow: hidden; }
        .card-section-header { padding: 18px 24px; border-bottom: 1px solid #F0F0F0; display: flex; align-items: center; justify-content: space-between; }
        .card-section-header .title { font-size: 15px; font-weight: 700; color: #1F2937; }
        .task-count { font-size: 13px; color: #9CA3AF; font-weight: 500; margin-left: 8px; }

        .search-filter { background: #F4F5F7; border: none; border-radius: 10px; padding: 8px 14px 8px 36px; font-size: 13px; color: #374151; width: 220px; outline: none; }
        .search-filter-wrap { position: relative; }
        .search-filter-wrap i { position: absolute; left: 11px; top: 50%; transform: translateY(-50%); color: #9CA3AF; font-size: 13px; }

        .table { margin: 0; }
        .table thead th { font-size: 11px; font-weight: 600; color: #9CA3AF; text-transform: uppercase; letter-spacing: 0.06em; background: #FAFAFA; border-bottom: 1px solid #F0F0F0; padding: 12px 16px; white-space: nowrap; }
        .table tbody td { padding: 14px 16px; font-size: 13px; color: #374151; vertical-align: middle; border-color: #F5F5F5; }
        .table tbody tr:hover { background: #FAFAFA; }

        .task-title { font-weight: 600; font-size: 13px; color: #1F2937; margin-bottom: 2px; }
        .task-desc { font-size: 12px; color: #9CA3AF; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 200px; }

        .deadline-badge { font-size: 12px; font-weight: 500; color: #374151; background: #F3F4F6; padding: 4px 10px; border-radius: 8px; white-space: nowrap; }
        .deadline-soon { background: #FFF7ED; color: #F97316; }
        .deadline-overdue { background: #FEF2F2; color: #EF4444; }

        .reward-badge { background: #F3F0FF; color: #7C3AED; font-size: 12px; font-weight: 700; padding: 4px 10px; border-radius: 8px; white-space: nowrap; }

        .assigned-list { display: flex; flex-wrap: wrap; gap: 4px; max-width: 150px; }
        .assigned-chip { background: #F0FDF4; color: #059669; font-size: 11px; font-weight: 600; padding: 3px 8px; border-radius: 20px; white-space: nowrap; }
        .assigned-empty { font-size: 12px; color: #D1D5DB; font-style: italic; }

        .status-not_started { background: #F9FAFB; color: #6B7280; font-size: 11px; font-weight: 600; padding: 4px 10px; border-radius: 20px; }
        .status-in_progress { background: #EFF6FF; color: #2563EB; font-size: 11px; font-weight: 600; padding: 4px 10px; border-radius: 20px; }
        .status-done { background: #ECFDF5; color: #059669; font-size: 11px; font-weight: 600; padding: 4px 10px; border-radius: 20px; }
        .status-in_review { background: #FFF7ED; color: #D97706; font-size: 11px; font-weight: 600; padding: 4px 10px; border-radius: 20px; }

        .btn-view { width: 30px; height: 30px; border-radius: 8px; background: #EFF6FF; color: #2563EB; border: none; display: inline-flex; align-items: center; justify-content: center; font-size: 13px; cursor: pointer; transition: background 0.15s; }
        .btn-view:hover { background: #DBEAFE; }
        .btn-edit-act { width: 30px; height: 30px; border-radius: 8px; background: #FFF7ED; color: #F97316; border: none; display: inline-flex; align-items: center; justify-content: center; font-size: 13px; cursor: pointer; transition: background 0.15s; }
        .btn-edit-act:hover { background: #FFEDD5; }
        .btn-delete { width: 30px; height: 30px; border-radius: 8px; background: #FEF2F2; color: #EF4444; border: none; display: inline-flex; align-items: center; justify-content: center; font-size: 13px; cursor: pointer; transition: background 0.15s; }
        .btn-delete:hover { background: #FEE2E2; }

        .attachment-badge { background: #EFF6FF; color: #2563EB; font-size: 11px; font-weight: 600; padding: 3px 10px; border-radius: 20px; display: inline-flex; align-items: center; gap: 4px; }

        .pagination-info { font-size: 13px; color: #9CA3AF; padding: 14px 24px; border-top: 1px solid #F0F0F0; }

        .modal-header { border-bottom: 1px solid #F0F0F0; padding: 20px 24px; }
        .modal-title { font-size: 16px; font-weight: 700; color: #1F2937; }
        .modal-body { padding: 24px; }
        .modal-footer { border-top: 1px solid #F0F0F0; padding: 16px 24px; }
        .modal-content { border-radius: 16px; border: none; }
        .form-label { font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 6px; }
        .form-control, .form-select { border: 1px solid #E5E7EB; border-radius: 10px; padding: 10px 14px; font-size: 14px; color: #1F2937; }
        .form-control:focus, .form-select:focus { border-color: #7C3AED; box-shadow: 0 0 0 3px rgba(124,58,237,0.08); }
        .btn-save { background: #7C3AED; color: #fff; border: none; padding: 10px 24px; border-radius: 10px; font-size: 14px; font-weight: 600; }
        .btn-save:hover { background: #6D28D9; color: #fff; }
        .btn-cancel-modal { background: #F3F4F6; color: #6B7280; border: none; padding: 10px 24px; border-radius: 10px; font-size: 14px; font-weight: 600; }
        .btn-cancel-modal:hover { background: #E5E7EB; color: #6B7280; }

        .user-checkbox-list { max-height: 160px; overflow-y: auto; border: 1px solid #E5E7EB; border-radius: 10px; padding: 8px; }
        .user-checkbox-item { display: flex; align-items: center; gap: 8px; padding: 6px 8px; border-radius: 8px; cursor: pointer; transition: background 0.1s; }
        .user-checkbox-item:hover { background: #F3F0FF; }
        .user-checkbox-item input[type="checkbox"] { accent-color: #7C3AED; width: 15px; height: 15px; cursor: pointer; }
        .user-checkbox-item label { font-size: 13px; color: #374151; cursor: pointer; margin: 0; }
        .user-checkbox-item .user-email-small { font-size: 11px; color: #9CA3AF; }

        .file-upload-area { border: 2px dashed #E5E7EB; border-radius: 10px; padding: 20px; text-align: center; cursor: pointer; transition: all 0.15s; background: #FAFAFA; }
        .file-upload-area:hover { border-color: #7C3AED; background: #F3F0FF; }
        .file-upload-area i { font-size: 28px; color: #9CA3AF; display: block; margin-bottom: 8px; }
        .file-upload-area .upload-text { font-size: 13px; color: #6B7280; margin: 0; }
        .file-upload-area .upload-hint { font-size: 11px; color: #9CA3AF; margin: 4px 0 0; }
        .file-selected { background: #F3F0FF; border-color: #7C3AED; }
        .file-name-preview { margin-top: 8px; background: #F3F0FF; border-radius: 8px; padding: 6px 12px; display: none; align-items: center; gap: 8px; }
        .file-name-preview i { color: #7C3AED; font-size: 14px; }
        .file-name-preview span { font-size: 12px; color: #7C3AED; font-weight: 600; }

        .detail-label { font-size: 11px; font-weight: 600; color: #9CA3AF; text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 4px; }
        .detail-value { font-size: 14px; color: #1F2937; font-weight: 500; }
        .detail-box { background: #F9FAFB; border-radius: 10px; padding: 12px 14px; font-size: 13px; color: #374151; border: 1px solid #F0F0F0; line-height: 1.6; }
        .reward-big { font-size: 22px; font-weight: 700; color: #7C3AED; }
        .file-attachment-box { background: #F9FAFB; border: 1px solid #F0F0F0; border-radius: 10px; padding: 14px 16px; display: flex; align-items: center; gap: 12px; }
        .file-attachment-box .file-icon { width: 40px; height: 40px; border-radius: 10px; background: #EFF6FF; display: flex; align-items: center; justify-content: center; font-size: 18px; color: #2563EB; flex-shrink: 0; }
        .file-attachment-box .file-img-icon { background: #ECFDF5; color: #059669; }
        .file-attachment-box .file-info { flex: 1; }
        .file-attachment-box .file-info .fname { font-size: 13px; font-weight: 600; color: #1F2937; }
        .file-attachment-box .file-info .ftype { font-size: 11px; color: #9CA3AF; }
        .btn-download { background: #7C3AED; color: #fff; border: none; padding: 6px 14px; border-radius: 8px; font-size: 12px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 4px; }
        .btn-download:hover { background: #6D28D9; color: #fff; }

        .alert-success-custom { background: #ECFDF5; border: 1px solid #A7F3D0; color: #065F46; border-radius: 10px; padding: 12px 16px; font-size: 14px; display: flex; align-items: center; gap: 8px; margin-bottom: 20px; }
        .alert-error-custom { background: #FEF2F2; border: 1px solid #FECACA; color: #991B1B; border-radius: 10px; padding: 12px 16px; font-size: 14px; margin-bottom: 20px; }

        .current-file-info { background: #F3F0FF; border-radius: 8px; padding: 8px 12px; display: flex; align-items: center; gap: 8px; margin-bottom: 8px; }
        .current-file-info i { color: #7C3AED; }
        .current-file-info span { font-size: 12px; color: #7C3AED; font-weight: 600; }
        .current-file-info .file-label { font-size: 11px; color: #9CA3AF; font-weight: 400; }
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
    <a href="{{ route('admin.tasks') }}" class="sidebar-item active">
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
    <div class="d-flex align-items-start justify-content-between mb-4">
        <div>
            <div class="page-title">Kelola Tugas</div>
            <div class="page-subtitle">Buat, edit, dan assign tugas ke user</div>
        </div>
        <button class="btn-add" data-bs-toggle="modal" data-bs-target="#modalTambahTugas">
            <i class="bi bi-plus-lg"></i> Tambah Tugas
        </button>
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
                <span class="task-count">({{ $tasks->count() }} tasks)</span>
            </div>
            <div class="search-filter-wrap">
                <i class="bi bi-search"></i>
                <input type="text" class="search-filter" id="searchInput" placeholder="Cari tugas...">
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-borderless" id="taskTable">
                <thead>
                    <tr>
                        <th>Tugas</th>
                        <th>Deadline</th>
                        <th>Reward</th>
                        <th>Assigned To</th>
                        <th>File</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tasks as $task)
                    <tr>
                        <td>
                            <div class="task-title">{{ $task->title }}</div>
                            <div class="task-desc">{{ $task->description }}</div>
                        </td>
                        <td>
                            @php
                                $deadline = \Carbon\Carbon::parse($task->deadline);
                                $diffDays = now()->diffInDays($deadline, false);
                            @endphp
                            <span class="deadline-badge {{ $diffDays < 0 ? 'deadline-overdue' : ($diffDays <= 3 ? 'deadline-soon' : '') }}">
                                <i class="bi bi-calendar3 me-1"></i>{{ $deadline->format('d M Y') }}
                            </span>
                        </td>
                        <td>
                            <span class="reward-badge"><i class="bi bi-star-fill me-1"></i>{{ $task->reward }} EXP</span>
                        </td>
                        <td>
                            @if($task->assignedUsersList && $task->assignedUsersList->count() > 0)
                                <div class="assigned-list">
                                    @foreach($task->assignedUsersList as $au)
                                        <span class="assigned-chip">{{ $au->name }}</span>
                                    @endforeach
                                </div>
                            @else
                                <span class="assigned-empty">Belum diassign</span>
                            @endif
                        </td>
                        <td>
                            {{-- FIX: pakai task_file bukan attachment --}}
                            @if($task->attachment)
                                <span class="attachment-badge"><i class="bi bi-paperclip"></i> Ada file</span>
                            @else
                                <span style="font-size:12px;color:#D1D5DB;">—</span>
                            @endif
                        </td>
                        <td>
                            <span class="status-{{ $task->status }}">
                                {{ match($task->status) {
                                    'not_started' => 'Not Started',
                                    'in_progress' => 'In Progress',
                                    'done'        => 'Done',
                                    'in_review'   => 'In Review',
                                    default       => ucfirst($task->status)
                                } }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                {{-- LIHAT DETAIL --}}
                                <button class="btn-view btn-view-task"
                                    data-title="{{ $task->title }}"
                                    data-description="{{ $task->description }}"
                                    data-deadline="{{ $deadline->format('d M Y') }}"
                                    data-reward="{{ $task->reward }}"
                                    data-status="{{ $task->status }}"
                                    data-taskfile="{{ $task->attachment }}"
                                    data-assigned="{{ $task->assignedUsersList ? $task->assignedUsersList->pluck('name')->join(', ') : '' }}"
                                    data-bs-toggle="modal" data-bs-target="#modalDetailTugas"
                                    title="Lihat Detail">
                                    <i class="bi bi-eye"></i>
                                </button>
                                {{-- EDIT --}}
                                <button class="btn-edit-act btn-edit-task"
                                    data-id="{{ $task->id_task }}"
                                    data-title="{{ $task->title }}"
                                    data-description="{{ $task->description }}"
                                    data-deadline="{{ \Carbon\Carbon::parse($task->deadline)->format('Y-m-d') }}"
                                    data-reward="{{ $task->reward }}"
                                    data-taskfile="{{ $task->attachment }}"
                                    data-assigned="{{ $task->assignedUsersList ? $task->assignedUsersList->pluck('id_user')->toJson() : '[]' }}"
                                    data-bs-toggle="modal" data-bs-target="#modalEditTugas"
                                    title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                {{-- HAPUS --}}
                                <form action="{{ route('admin.tasks.destroy', $task->id_task) }}" method="POST" class="form-delete">
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
                        <td colspan="7" class="text-center text-muted py-5">
                            <i class="bi bi-clipboard-x" style="font-size:32px;opacity:0.3;display:block;margin-bottom:8px;"></i>
                            Belum ada tugas
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="pagination-info">Menampilkan {{ $tasks->count() }} tugas</div>
    </div>
</div>

<!-- ===== MODAL DETAIL TUGAS ===== -->
<div class="modal fade" id="modalDetailTugas" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-eye me-2" style="color:#7C3AED;"></i>Detail Tugas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row g-4">
                    <div class="col-md-7">
                        <div class="detail-label">Judul Tugas</div>
                        <div class="detail-value mb-3" id="detailTitle">-</div>

                        <div class="detail-label">Deskripsi</div>
                        <div class="detail-box mb-3" id="detailDescription">-</div>

                        <div class="detail-label">Ditugaskan kepada</div>
                        <div class="detail-value" id="detailAssigned">-</div>
                    </div>
                    <div class="col-md-5">
                        <div class="detail-label">Deadline</div>
                        <div class="detail-value mb-3">
                            <i class="bi bi-calendar3 me-1" style="color:#7C3AED;"></i>
                            <span id="detailDeadline">-</span>
                        </div>

                        <div class="detail-label">Reward EXP</div>
                        <div class="mb-3">
                            <span class="reward-big" id="detailReward">0</span>
                            <span style="font-size:13px;color:#9CA3AF;"> EXP</span>
                        </div>

                        <div class="detail-label">Status</div>
                        <div id="detailStatus" class="mb-3">-</div>
                    </div>

                    <div class="col-12">
                        <div class="detail-label mb-2">File / Attachment Tugas</div>
                        <div id="detailAttachmentArea"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-cancel-modal" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- ===== MODAL TAMBAH TUGAS ===== -->
<div class="modal fade" id="modalTambahTugas" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-clipboard-plus me-2" style="color:#7C3AED;"></i>Tambah Tugas Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.tasks.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label">Judul Tugas</label>
                            <input type="text" name="title" class="form-control" placeholder="Masukan Judul Tugas" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Deskripsi Tugas</label>
                            <textarea name="description" class="form-control" rows="3" placeholder="Masukan Deskripsi Tugas" required></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Deadline</label>
                            <input type="date" name="deadline" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Reward EXP</label>
                            <input type="number" name="reward" class="form-control" placeholder="Contoh : 50" min="1" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">
                                Upload File / Dokumen
                                <span style="color:#9CA3AF;font-weight:400;">(opsional — JPG, PNG, PDF, DOC, DOCX · Max 5MB)</span>
                            </label>
                            <div class="file-upload-area" id="addUploadArea" onclick="document.getElementById('addFileInput').click()">
                                <i class="bi bi-cloud-arrow-up"></i>
                                <p class="upload-text">Klik untuk pilih file, atau drag & drop di sini</p>
                                <p class="upload-hint">JPG, PNG, PDF, DOC, DOCX maksimal 5MB</p>
                            </div>
                            {{-- FIX: name="attachment" sesuai dengan controller --}}
                            <input type="file" id="addFileInput" name="attachment"
                                accept=".jpg,.jpeg,.png,.pdf,.doc,.docx"
                                style="display:none;"
                                onchange="handleFileSelect(this, 'addUploadArea', 'addFilePreview')">
                            <div class="file-name-preview" id="addFilePreview">
                                <i class="bi bi-paperclip"></i>
                                <span></span>
                                <button type="button" onclick="clearFile('addFileInput','addUploadArea','addFilePreview')" style="margin-left:auto;background:none;border:none;color:#EF4444;font-size:14px;cursor:pointer;"><i class="bi bi-x-circle"></i></button>
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Assign ke User <span style="color:#9CA3AF;font-weight:400;">(opsional)</span></label>
                            <div class="user-checkbox-list">
                                @foreach($users as $u)
                                <div class="user-checkbox-item">
                                    <input type="checkbox" name="assigned_users[]" value="{{ $u->id_user }}" id="user_{{ $u->id_user }}">
                                    <label for="user_{{ $u->id_user }}">
                                        <div>{{ $u->name }}</div>
                                        <div class="user-email-small">{{ $u->email }}</div>
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-cancel-modal" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-save"><i class="bi bi-check-lg me-1"></i>Simpan Tugas</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ===== MODAL EDIT TUGAS ===== -->
<div class="modal fade" id="modalEditTugas" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-pencil me-2" style="color:#7C3AED;"></i>Edit Tugas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="formEditTugas" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label">Judul Tugas</label>
                            <input type="text" name="title" id="editTitle" class="form-control" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Deskripsi Tugas</label>
                            <textarea name="description" id="editDescription" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Deadline</label>
                            <input type="date" name="deadline" id="editDeadline" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Reward EXP</label>
                            <input type="number" name="reward" id="editReward" class="form-control" min="1" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">
                                Ganti File
                                <span style="color:#9CA3AF;font-weight:400;">(kosongkan jika tidak diganti)</span>
                            </label>
                            <div id="editCurrentFileWrap" style="display:none;" class="current-file-info mb-2">
                                <i class="bi bi-paperclip"></i>
                                <div>
                                    <div class="file-label">File saat ini:</div>
                                    <span id="editCurrentFileName"></span>
                                </div>
                            </div>
                            <div class="file-upload-area" id="editUploadArea" onclick="document.getElementById('editFileInput').click()">
                                <i class="bi bi-cloud-arrow-up"></i>
                                <p class="upload-text">Klik untuk upload file baru</p>
                                <p class="upload-hint">JPG, PNG, PDF, DOC, DOCX maksimal 5MB</p>
                            </div>
                            {{-- FIX: name="attachment" sesuai dengan controller --}}
                            <input type="file" id="editFileInput" name="attachment"
                                accept=".jpg,.jpeg,.png,.pdf,.doc,.docx"
                                style="display:none;"
                                onchange="handleFileSelect(this, 'editUploadArea', 'editFilePreview')">
                            <div class="file-name-preview" id="editFilePreview">
                                <i class="bi bi-paperclip"></i>
                                <span></span>
                                <button type="button" onclick="clearFile('editFileInput','editUploadArea','editFilePreview')" style="margin-left:auto;background:none;border:none;color:#EF4444;font-size:14px;cursor:pointer;"><i class="bi bi-x-circle"></i></button>
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Assign ke User <span style="color:#9CA3AF;font-weight:400;">(opsional)</span></label>
                            <div class="user-checkbox-list">
                                @foreach($users as $u)
                                <div class="user-checkbox-item">
                                    <input type="checkbox" name="assigned_users[]" value="{{ $u->id_user }}" id="edit_user_{{ $u->id_user }}" class="edit-user-checkbox">
                                    <label for="edit_user_{{ $u->id_user }}">
                                        <div>{{ $u->name }}</div>
                                        <div class="user-email-small">{{ $u->email }}</div>
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-cancel-modal" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-save"><i class="bi bi-check-lg me-1"></i>Simpan Perubahan</button>
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
    trigger.addEventListener('click', e => { e.stopPropagation(); trigger.classList.toggle('open'); dropdown.classList.toggle('show'); });
    document.addEventListener('click', () => { trigger.classList.remove('open'); dropdown.classList.remove('show'); });
    dropdown.addEventListener('click', e => e.stopPropagation());

    // Search
    document.getElementById('searchInput').addEventListener('input', function() {
        const q = this.value.toLowerCase();
        document.querySelectorAll('#taskTable tbody tr').forEach(row => {
            row.style.display = row.innerText.toLowerCase().includes(q) ? '' : 'none';
        });
    });

    // Handle file select
    function handleFileSelect(input, areaId, previewId) {
        const area = document.getElementById(areaId);
        const preview = document.getElementById(previewId);
        if (input.files && input.files[0]) {
            const file = input.files[0];
            if (file.size > 5 * 1024 * 1024) {
                alert('Ukuran file maksimal 5MB!');
                input.value = '';
                return;
            }
            area.classList.add('file-selected');
            area.innerHTML = `<i class="bi bi-check-circle-fill" style="color:#7C3AED;"></i><p class="upload-text" style="color:#7C3AED;font-weight:600;">File dipilih</p>`;
            preview.style.display = 'flex';
            preview.querySelector('span').textContent = file.name;
        }
    }

    // Clear file
    function clearFile(inputId, areaId, previewId) {
        document.getElementById(inputId).value = '';
        document.getElementById(previewId).style.display = 'none';
        const area = document.getElementById(areaId);
        area.classList.remove('file-selected');
        area.innerHTML = `<i class="bi bi-cloud-arrow-up"></i><p class="upload-text">Klik untuk pilih file, atau drag & drop di sini</p><p class="upload-hint">JPG, PNG, PDF, DOC, DOCX maksimal 5MB</p>`;
    }

    // Modal Detail — FIX: pakai data-taskfile bukan data-attachment
    document.querySelectorAll('.btn-view-task').forEach(btn => {
        btn.addEventListener('click', function() {
            document.getElementById('detailTitle').textContent       = this.dataset.title;
            document.getElementById('detailDescription').textContent = this.dataset.description;
            document.getElementById('detailDeadline').textContent    = this.dataset.deadline;
            document.getElementById('detailReward').textContent      = this.dataset.reward;
            document.getElementById('detailAssigned').textContent    = this.dataset.assigned || 'Belum diassign';

            const statusMap = {
                'not_started': '<span class="status-not_started">Not Started</span>',
                'in_progress': '<span class="status-in_progress">In Progress</span>',
                'in_review':   '<span class="status-in_review">In Review</span>',
                'done':        '<span class="status-done">Done</span>',
            };
            document.getElementById('detailStatus').innerHTML = statusMap[this.dataset.status] || this.dataset.status;

            // FIX: pakai dataset.taskfile & path /images/tasks/
            const taskFile = this.dataset.taskfile;
            const area = document.getElementById('detailAttachmentArea');

            if (taskFile && taskFile !== 'null' && taskFile !== '') {
                const ext     = taskFile.split('.').pop().toLowerCase();
                const isImg   = ['jpg','jpeg','png','gif','webp'].includes(ext);
                const isPdf   = ext === 'pdf';
                const iconClass = isImg ? 'bi-file-image' : (isPdf ? 'bi-file-pdf' : 'bi-file-earmark-word');
                const iconBg    = isImg ? 'file-img-icon' : '';
                const fileUrl   = `/tasks/${taskFile}`;

                area.innerHTML = `
                    <div class="file-attachment-box">
                        <div class="file-icon ${iconBg}"><i class="bi ${iconClass}"></i></div>
                        <div class="file-info">
                            <div class="fname">${taskFile}</div>
                            <div class="ftype">${ext.toUpperCase()} file</div>
                        </div>
                        <a href="${fileUrl}" target="_blank" class="btn-download">
                            <i class="bi bi-download"></i> Buka
                        </a>
                    </div>
                    ${isImg ? `<img src="${fileUrl}" style="max-width:100%;max-height:220px;border-radius:10px;margin-top:10px;border:1px solid #F0F0F0;object-fit:contain;">` : ''}
                `;
            } else {
                area.innerHTML = `
                    <div style="background:#F9FAFB;border:1px dashed #E5E7EB;border-radius:10px;padding:20px;text-align:center;">
                        <i class="bi bi-paperclip" style="font-size:24px;color:#D1D5DB;display:block;margin-bottom:6px;"></i>
                        <span style="font-size:13px;color:#9CA3AF;">Tidak ada file attachment</span>
                    </div>`;
            }
        });
    });

    // Modal Edit — FIX: pakai data-taskfile
    document.querySelectorAll('.btn-edit-task').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            document.getElementById('editTitle').value       = this.dataset.title;
            document.getElementById('editDescription').value = this.dataset.description;
            document.getElementById('editDeadline').value    = this.dataset.deadline;
            document.getElementById('editReward').value      = this.dataset.reward;
            document.getElementById('formEditTugas').action  = `/admin/tasks/${id}`;

            const taskFile    = this.dataset.taskfile;
            const currentWrap = document.getElementById('editCurrentFileWrap');
            if (taskFile && taskFile !== 'null' && taskFile !== '') {
                currentWrap.style.display = 'flex';
                document.getElementById('editCurrentFileName').textContent = taskFile;
            } else {
                currentWrap.style.display = 'none';
            }

            // Reset upload area
            document.getElementById('editFileInput').value = '';
            document.getElementById('editFilePreview').style.display = 'none';
            document.getElementById('editUploadArea').classList.remove('file-selected');
            document.getElementById('editUploadArea').innerHTML = `<i class="bi bi-cloud-arrow-up"></i><p class="upload-text">Klik untuk upload file baru</p><p class="upload-hint">JPG, PNG, PDF, DOC, DOCX maksimal 5MB</p>`;

            // Checkbox assigned users
            document.querySelectorAll('.edit-user-checkbox').forEach(cb => cb.checked = false);
            const assigned = JSON.parse(this.dataset.assigned || '[]');
            assigned.forEach(userId => {
                const cb = document.getElementById('edit_user_' + userId);
                if (cb) cb.checked = true;
            });
        });
    });

    // Konfirmasi hapus
    document.querySelectorAll('.form-delete').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            if (confirm('Yakin ingin menghapus tugas ini? Data tidak bisa dikembalikan.')) this.submit();
        });
    });
</script>
</body>
</html>