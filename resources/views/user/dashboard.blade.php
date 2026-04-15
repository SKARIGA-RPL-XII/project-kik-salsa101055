<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Upvity</title>
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
        .sidebar-item.active i { color: #fff; }
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
        .dropdown-menu-item:hover { background: #F9FAFB; color: #374151; }
        .dropdown-menu-item i { font-size: 16px; color: #6B7280; }
        .dropdown-menu-item.logout { color: #DC2626; border-top: 1px solid #F0F0F0; }
        .dropdown-menu-item.logout i { color: #DC2626; }
        .dropdown-menu-item.logout:hover { background: #FEF2F2; }

        .main-content { margin-left: 220px; padding: 28px; }

        .profile-card { background: #fff; border-radius: 16px; border: 1px solid #F0F0F0; padding: 20px 24px; display: flex; align-items: center; gap: 18px; margin-bottom: 20px; }
        .profile-avatar { width: 60px; height: 60px; border-radius: 50%; background: #7C3AED; color: #fff; font-weight: 700; font-size: 22px; display: flex; align-items: center; justify-content: center; overflow: hidden; flex-shrink: 0; }
        .profile-avatar img { width: 100%; height: 100%; object-fit: cover; }
        .profile-name { font-size: 17px; font-weight: 700; color: #1F2937; margin-bottom: 4px; }
        .level-badge { display: inline-flex; align-items: center; gap: 4px; background: #F3F0FF; color: #7C3AED; font-size: 11px; font-weight: 600; padding: 3px 10px; border-radius: 20px; margin-bottom: 10px; }
        .stat-bars { display: flex; flex-direction: column; gap: 5px; }
        .stat-bar-row { display: flex; align-items: center; gap: 8px; }
        .stat-bar-icon.hp { color: #EF4444; font-size: 12px; }
        .stat-bar-icon.exp { color: #F59E0B; font-size: 12px; }
        .stat-bar-track { width: 200px; height: 6px; background: #F0F0F0; border-radius: 10px; overflow: hidden; }
        .stat-bar-fill { height: 100%; border-radius: 10px; }
        .stat-bar-fill.hp { background: #EF4444; }
        .stat-bar-fill.exp { background: #F59E0B; }
        .stat-bar-text { font-size: 11px; font-weight: 600; color: #9CA3AF; min-width: 40px; }

        .tasks-card { background: #fff; border-radius: 16px; border: 1px solid #F0F0F0; overflow: hidden; }
        .tasks-header { padding: 18px 24px; border-bottom: 1px solid #F0F0F0; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px; }
        .tasks-header .title { font-size: 15px; font-weight: 700; color: #1F2937; }
        .search-wrap { position: relative; }
        .search-wrap i { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #9CA3AF; font-size: 13px; }
        .search-box { background: #F4F5F7; border: none; border-radius: 10px; padding: 8px 16px 8px 36px; font-size: 13px; color: #374151; width: 200px; outline: none; }
        .btn-report { background: #7C3AED; color: #fff; border: none; border-radius: 8px; padding: 8px 16px; font-size: 13px; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 6px; }
        .btn-report:hover { background: #6D28D9; }

        .filter-tabs { padding: 16px 24px 0; display: flex; gap: 8px; flex-wrap: wrap; }
        .filter-tab { padding: 6px 16px; border-radius: 20px; font-size: 13px; font-weight: 600; cursor: pointer; border: 1.5px solid #E5E7EB; background: #fff; color: #6B7280; transition: all 0.15s; }
        .filter-tab:hover { border-color: #7C3AED; color: #7C3AED; }
        .filter-tab.active { background: #7C3AED; color: #fff; border-color: #7C3AED; }

        .task-list { padding: 16px 24px; }
        .task-item { background: #FAFAFA; border: 1px solid #F0F0F0; border-radius: 12px; padding: 14px 18px; margin-bottom: 10px; display: flex; align-items: center; gap: 14px; transition: all 0.15s; cursor: pointer; }
        .task-item:hover { border-color: #C4B5FD; background: #F8F5FF; }
        .task-item.hidden { display: none; }
        .task-icon { width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 16px; flex-shrink: 0; }
        .task-icon.not_started { background: #F1F5F9; color: #64748B; }
        .task-icon.in_progress { background: #EFF6FF; color: #3B82F6; }
        .task-icon.submitted { background: #FFF7ED; color: #F59E0B; }
        .task-icon.completed { background: #F0FDF4; color: #22C55E; }
        .task-icon.overdue { background: #FEF2F2; color: #EF4444; }
        .task-info { flex: 1; }
        .task-title-text { font-size: 14px; font-weight: 700; color: #1F2937; margin-bottom: 3px; }
        .task-desc-text { font-size: 12px; color: #9CA3AF; margin-bottom: 5px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 380px; }
        .task-meta { display: flex; align-items: center; gap: 14px; flex-wrap: wrap; }
        .task-meta-item { display: flex; align-items: center; gap: 4px; font-size: 12px; color: #9CA3AF; }
        .deadline-warning { color: #EF4444 !important; font-weight: 600; }
        .deadline-soon { color: #F59E0B !important; font-weight: 600; }
        .task-reward { display: flex; align-items: center; gap: 4px; font-size: 12px; font-weight: 700; color: #7C3AED; }
        .task-actions { display: flex; align-items: center; gap: 8px; flex-shrink: 0; }
        .status-badge { padding: 3px 10px; border-radius: 20px; font-size: 11px; font-weight: 600; }
        .badge-not_started { background: #F9FAFB; color: #6B7280; }
        .badge-in_progress { background: #EFF6FF; color: #2563EB; }
        .badge-submitted { background: #FFF7ED; color: #D97706; }
        .badge-completed { background: #ECFDF5; color: #059669; }
        .badge-overdue { background: #FEF2F2; color: #DC2626; }
        .btn-action { padding: 6px 14px; border-radius: 8px; font-size: 12px; font-weight: 600; border: none; cursor: pointer; transition: all 0.15s; display: inline-flex; align-items: center; gap: 5px; }
        .btn-mulai { background: #7C3AED; color: #fff; }
        .btn-mulai:hover { background: #6D28D9; }
        .btn-submit-task { background: #10B981; color: #fff; }
        .btn-submit-task:hover { background: #059669; }
        @keyframes pulseBorder { 0%,100% { border-color: #FECACA; } 50% { border-color: #EF4444; } }
        .task-item.overdue-task { animation: pulseBorder 2s infinite; }
        .empty-state { text-align: center; padding: 50px 20px; color: #9CA3AF; }
        .empty-state i { font-size: 40px; margin-bottom: 12px; display: block; }
        .pagination-info { padding: 14px 24px; border-top: 1px solid #F0F0F0; font-size: 13px; color: #9CA3AF; }

        .attachment-chip { background: #EFF6FF; color: #2563EB; font-size: 10px; font-weight: 600; padding: 2px 8px; border-radius: 20px; display: inline-flex; align-items: center; gap: 3px; }

        .alert-custom { border-radius: 12px; font-size: 14px; font-weight: 500; padding: 12px 16px; margin-bottom: 20px; display: flex; align-items: center; gap: 8px; }
        .alert-success-custom { background: #ECFDF5; color: #065F46; border: 1px solid #A7F3D0; }
        .alert-error-custom { background: #FEF2F2; color: #991B1B; border: 1px solid #FECACA; }

        .modal-content { border-radius: 16px; border: none; }
        .modal-header { border-bottom: 1px solid #F0F0F0; padding: 18px 24px; }
        .modal-body { padding: 24px; }
        .modal-footer { border-top: 1px solid #F0F0F0; padding: 16px 24px; }
        .modal-title { font-weight: 700; color: #1F2937; font-size: 15px; }
        .form-label { font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 6px; }
        .form-control, .form-select { border: 1.5px solid #E5E7EB; border-radius: 10px; padding: 10px 14px; font-size: 14px; }
        .form-control:focus, .form-select:focus { border-color: #7C3AED; box-shadow: 0 0 0 3px rgba(124,58,237,0.08); }
        .btn-primary-modal { background: #7C3AED; color: #fff; border: none; border-radius: 10px; padding: 10px 24px; font-weight: 600; font-size: 14px; }
        .btn-primary-modal:hover { background: #6D28D9; color: #fff; }
        .btn-secondary-modal { background: #F5F5F5; color: #6B7280; border: none; border-radius: 10px; padding: 10px 24px; font-weight: 600; font-size: 14px; }

        .detail-label { font-size: 11px; font-weight: 600; color: #9CA3AF; text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 4px; }
        .detail-value { font-size: 14px; color: #1F2937; font-weight: 500; }
        .detail-box { background: #F9FAFB; border-radius: 10px; padding: 12px 14px; font-size: 13px; color: #374151; border: 1px solid #F0F0F0; }
        .reward-big { font-size: 20px; font-weight: 700; color: #7C3AED; }
        .file-box { background: #F9FAFB; border: 1px solid #F0F0F0; border-radius: 10px; padding: 12px 16px; display: flex; align-items: center; gap: 12px; }
        .file-box-icon { width: 38px; height: 38px; border-radius: 8px; background: #EFF6FF; display: flex; align-items: center; justify-content: center; font-size: 16px; color: #2563EB; flex-shrink: 0; }
        .file-box-icon.img { background: #ECFDF5; color: #059669; }
        .btn-dl { background: #7C3AED; color: #fff; border: none; padding: 5px 12px; border-radius: 7px; font-size: 12px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 4px; }
        .btn-dl:hover { background: #6D28D9; color: #fff; }

        /* Task select in report modal */
        .task-option-info { font-size: 11px; color: #9CA3AF; margin-top: 4px; }
        .status-info-box { background: #F3F0FF; border-radius: 10px; padding: 10px 14px; font-size: 13px; color: #7C3AED; font-weight: 600; display: none; margin-top: 8px; }
        .status-info-box i { margin-right: 6px; }
    </style>
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <div class="sidebar-logo">
        <img src="{{ asset('images/Logo Upvity.png') }}" alt="Upvity">
    </div>
    <div class="sidebar-section-label">Beranda</div>
    <a href="{{ route('user.dashboard') }}" class="sidebar-item active">
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
    @if(session('success'))
        <div class="alert-custom alert-success-custom"><i class="bi bi-check-circle-fill"></i>{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert-custom alert-error-custom"><i class="bi bi-exclamation-triangle-fill"></i>{{ session('error') }}</div>
    @endif

    <!-- PROFILE CARD -->
    <div class="profile-card">
        <div class="profile-avatar">
            @if($user->photo_profile)
                <img src="{{ asset('images/' . $user->photo_profile) }}" alt="foto">
            @else
                {{ strtoupper(substr($user->name, 0, 1)) }}
            @endif
        </div>
        <div class="profile-info">
            <div class="profile-name">{{ $user->name }}</div>
            <div class="level-badge"><i class="bi bi-star-fill" style="font-size:9px;"></i>{{ $levelName }}</div>
            <div class="stat-bars">
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
        </div>
    </div>

    <!-- TASKS CARD -->
    <div class="tasks-card">
        <div class="tasks-header">
            <span class="title">Daftar Tugas</span>
            <div class="d-flex align-items-center gap-2">
                <div class="search-wrap">
                    <i class="bi bi-search"></i>
                    <input type="text" class="search-box" id="searchInput" placeholder="Cari tugas...">
                </div>
                <button class="btn-report" data-bs-toggle="modal" data-bs-target="#modalSubmitLaporan">
                    <i class="bi bi-file-earmark-text"></i> Report
                </button>
            </div>
        </div>

        <div class="filter-tabs">
            <button class="filter-tab active" onclick="filterTasks('all', this)">Semua</button>
            <button class="filter-tab" onclick="filterTasks('not_started', this)">Not Started</button>
            <button class="filter-tab" onclick="filterTasks('in_progress', this)">In Progress</button>
            <button class="filter-tab" onclick="filterTasks('submitted', this)">In Review</button>
            <button class="filter-tab" onclick="filterTasks('completed', this)">Done</button>
        </div>

        <div class="task-list" id="taskList">
            @forelse($tasks as $task)
                @php
                    $isOverdue = $task->deadline < now() && !in_array($task->pivot_status, ['completed']);
                    $isDeadlineSoon = !$isOverdue && $task->deadline->diffInDays(now()) <= 3 && $task->deadline >= now();
                    $pivotStatus = $task->pivot_status;
                    $statusIcons = ['not_started' => 'bi-circle', 'in_progress' => 'bi-arrow-clockwise', 'submitted' => 'bi-hourglass-split', 'completed' => 'bi-check-circle-fill'];
                    $icon = $statusIcons[$pivotStatus] ?? 'bi-circle';
                    $statusClass = $isOverdue ? 'overdue' : $pivotStatus;
                @endphp
                <div class="task-item {{ $isOverdue ? 'overdue-task' : '' }}"
                     data-status="{{ $pivotStatus }}"
                     data-title="{{ strtolower($task->title) }}"
                     onclick="openDetailModal(
                         '{{ addslashes($task->title) }}',
                         '{{ addslashes($task->description) }}',
                         '{{ $task->deadline->format('d M Y') }}',
                         {{ $task->reward }},
                         '{{ $task->status }}',
                         '{{ $task->attachment ?? '' }}',
                         {{ $task->pivot_id }},
                         '{{ $pivotStatus }}',
                         {{ $task->id_task }}
                     )">
                    <div class="task-icon {{ $statusClass }}">
                        <i class="bi {{ $icon }}"></i>
                    </div>
                    <div class="task-info">
                        <div class="task-title-text">
                            {{ $task->title }}
                            @if($task->attachment)
                                <span class="attachment-chip ms-1"><i class="bi bi-paperclip"></i> Ada file</span>
                            @endif
                        </div>
                        @if($task->description)
                            <div class="task-desc-text">{{ $task->description }}</div>
                        @endif
                        <div class="task-meta">
                            <span class="task-meta-item {{ $isOverdue ? 'deadline-warning' : ($isDeadlineSoon ? 'deadline-soon' : '') }}">
                                <i class="bi bi-calendar-event"></i>
                                {{ $task->deadline->format('d M Y') }}
                                @if($isOverdue) <i class="bi bi-exclamation-triangle-fill"></i> Overdue
                                @elseif($isDeadlineSoon) <i class="bi bi-clock-fill"></i> Segera
                                @endif
                            </span>
                            <span class="task-reward"><i class="bi bi-star-fill" style="color:#F59E0B;font-size:11px;"></i>+{{ $task->reward }} EXP</span>
                            <span class="task-meta-item"><i class="bi bi-coin" style="color:#F59E0B;"></i>+{{ $task->reward }} Koin</span>
                        </div>
                    </div>
                    <div class="task-actions" onclick="event.stopPropagation()">
                        <span class="status-badge badge-{{ $pivotStatus }}">
                            @switch($pivotStatus)
                                @case('not_started') Not Started @break
                                @case('in_progress') In Progress @break
                                @case('submitted') In Review @break
                                @case('completed') Done @break
                            @endswitch
                        </span>
                        @if($pivotStatus === 'not_started')
                            <button class="btn-action btn-mulai" onclick="updateStatus({{ $task->pivot_id }}, 'in_progress', this)">
                                <i class="bi bi-play-fill"></i> Mulai
                            </button>
                        @elseif($pivotStatus === 'submitted')
                            <span style="font-size:12px;color:#D97706;font-weight:600;"><i class="bi bi-hourglass-split"></i> Menunggu Review</span>
                        @elseif($pivotStatus === 'completed')
                            <span style="font-size:12px;color:#059669;font-weight:600;"><i class="bi bi-check-circle-fill"></i> Selesai</span>
                        @endif
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <i class="bi bi-clipboard-x"></i>
                    <p>Belum ada tugas yang diberikan</p>
                </div>
            @endforelse
        </div>

        @if($tasks->count() > 0)
        <div class="pagination-info">
            <span id="taskCount">Menampilkan {{ $tasks->count() }} tugas</span>
        </div>
        @endif
    </div>
</div>

<!-- ===== MODAL DETAIL TUGAS ===== -->
<div class="modal fade" id="modalDetailTugas" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-clipboard-check me-2" style="color:#7C3AED;"></i>Detail Tugas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-md-7">
                        <div class="detail-label">Judul Tugas</div>
                        <div class="detail-value mb-3" id="dtTitle">-</div>
                        <div class="detail-label">Deskripsi</div>
                        <div class="detail-box mb-3" id="dtDesc">-</div>
                    </div>
                    <div class="col-md-5">
                        <div class="detail-label">Deadline</div>
                        <div class="detail-value mb-3"><i class="bi bi-calendar3 me-1" style="color:#7C3AED;"></i><span id="dtDeadline">-</span></div>
                        <div class="detail-label">Reward EXP</div>
                        <div class="mb-3"><span class="reward-big" id="dtReward">0</span> <span style="font-size:13px;color:#9CA3AF;">EXP</span></div>
                        <div class="detail-label">Status Tugasmu</div>
                        <div id="dtStatus" class="mb-3">-</div>
                    </div>
                    <div class="col-12">
                        <div class="detail-label mb-2">File / Materi dari Admin</div>
                        <div id="dtAttachment"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" id="dtFooter">
                <button type="button" class="btn-secondary-modal" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- ===== MODAL SUBMIT LAPORAN ===== -->
<div class="modal fade" id="modalSubmitLaporan" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-file-earmark-text me-2" style="color:#7C3AED;"></i>Submit Laporan Tugas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('user.tasks.submit') }}" method="POST" enctype="multipart/form-data" id="formSubmitLaporan">
                @csrf
                <input type="hidden" name="pivot_id" id="submitPivotId">
                <input type="hidden" name="task_id" id="submitTaskId">
                <div class="modal-body">

                    {{-- DROPDOWN PILIH TUGAS (hanya tampil jika dibuka dari tombol Report di header) --}}
                    <div class="mb-3" id="taskSelectWrap">
                        <label class="form-label">Pilih Tugas <span style="color:#EF4444;">*</span></label>
                        <select class="form-select" id="taskSelectDropdown" onchange="onTaskSelected(this)">
                            <option value="">-- Pilih tugas yang ingin dilaporkan --</option>
                            @foreach($tasks as $task)
                                <option value="{{ $task->pivot_id }}"
                                    data-taskid="{{ $task->id_task }}"
                                    data-title="{{ $task->title }}"
                                    data-deadline="{{ $task->deadline->format('d M Y') }}"
                                    data-status="{{ $task->pivot_status }}">
                                    {{ $task->title }} — {{ $task->deadline->format('d M Y') }}
                                </option>
                            @endforeach
                        </select>
                        <div class="task-option-info">Pilih tugas yang ingin kamu laporkan</div>
                        <div class="status-info-box" id="selectedTaskInfo">
                            <i class="bi bi-info-circle-fill"></i>
                            <span id="selectedTaskInfoText"></span>
                        </div>
                    </div>

                    <div class="mb-3" id="reportTitleWrap" style="display:none;">
                        <label class="form-label">Tugas</label>
                        <input type="text" class="form-control" id="submitTaskTitle" readonly style="background:#F8F8F8;">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi Laporan <span style="color:#EF4444;">*</span></label>
                        <textarea class="form-control" name="report_text" rows="4" placeholder="Jelaskan apa yang sudah kamu kerjakan, progress saat ini, atau kendala yang dihadapi..." required minlength="10"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">File Lampiran <span style="color:#9CA3AF;">(opsional)</span></label>
                        <input type="file" class="form-control" name="report_file" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.zip">
                        <small class="text-muted mt-1 d-block">Format: PDF, Word, Gambar, ZIP. Maks. 5MB</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-secondary-modal" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-primary-modal" id="btnKirimLaporan"><i class="bi bi-send me-1"></i>Kirim Laporan</button>
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

    // Filter
    function filterTasks(status, btn) {
        document.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('active'));
        btn.classList.add('active');
        let count = 0;
        document.querySelectorAll('.task-item').forEach(task => {
            const show = status === 'all' || task.dataset.status === status;
            task.classList.toggle('hidden', !show);
            if (show) count++;
        });
        const el = document.getElementById('taskCount');
        if (el) el.textContent = 'Menampilkan ' + count + ' tugas';
    }

    // Search
    document.getElementById('searchInput').addEventListener('input', function() {
        const q = this.value.toLowerCase();
        document.querySelectorAll('.task-item').forEach(task => {
            task.style.display = (task.dataset.title || '').includes(q) ? '' : 'none';
        });
    });

    // Update status
    function updateStatus(pivotId, newStatus, btn) {
        btn.disabled = true;
        btn.innerHTML = '<i class="bi bi-arrow-clockwise"></i> Memproses...';
        fetch(`/user/tasks/${pivotId}/status`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: JSON.stringify({ status: newStatus })
        })
        .then(r => r.json())
        .then(data => { if (data.success) location.reload(); else { alert('Gagal!'); btn.disabled = false; } })
        .catch(() => { alert('Error!'); btn.disabled = false; });
    }

    // ===== MODAL REPORT =====
    // Reset modal setiap kali dibuka
    document.getElementById('modalSubmitLaporan').addEventListener('show.bs.modal', function() {
        document.getElementById('submitPivotId').value = '';
        document.getElementById('submitTaskId').value = '';
        document.getElementById('taskSelectDropdown').value = '';
        document.getElementById('selectedTaskInfo').style.display = 'none';
        const form = document.getElementById('formSubmitLaporan');
        form.querySelector('textarea[name="report_text"]').value = '';
        form.querySelector('input[name="report_file"]').value = '';
    });

    // Ketika user pilih tugas dari dropdown
    function onTaskSelected(select) {
        const opt = select.options[select.selectedIndex];
        const pivotId = opt.value;
        const infoBox = document.getElementById('selectedTaskInfo');
        const infoText = document.getElementById('selectedTaskInfoText');

        if (pivotId) {
            document.getElementById('submitPivotId').value = pivotId;
            document.getElementById('submitTaskId').value = opt.dataset.taskid;
            infoBox.style.display = 'block';
            infoText.textContent = opt.dataset.title + ' — Deadline: ' + opt.dataset.deadline;
        } else {
            document.getElementById('submitPivotId').value = '';
            document.getElementById('submitTaskId').value = '';
            infoBox.style.display = 'none';
        }
    }

    // Validasi form sebelum submit — pastikan tugas sudah dipilih
    document.getElementById('formSubmitLaporan').addEventListener('submit', function(e) {
        const pivotId = document.getElementById('submitPivotId').value;
        const taskId  = document.getElementById('submitTaskId').value;
        if (!pivotId || !taskId) {
            e.preventDefault();
            alert('Pilih tugas terlebih dahulu!');
            return;
        }
    });


    // Update status dari dropdown di modal detail
    function updateStatusFromModal(select, pivotId) {
        const newStatus = select.value;
        select.disabled = true;
        fetch(`/user/tasks/${pivotId}/status`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: JSON.stringify({ status: newStatus })
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                bootstrap.Modal.getInstance(document.getElementById('modalDetailTugas')).hide();
                location.reload();
            } else {
                alert('Gagal mengubah status!');
                select.disabled = false;
            }
        })
        .catch(() => { alert('Error!'); select.disabled = false; });
    }
    // Open detail modal
    function openDetailModal(title, desc, deadline, reward, taskStatus, attachment, pivotId, pivotStatus, taskId) {
        document.getElementById('dtTitle').textContent = title;
        document.getElementById('dtDesc').textContent = desc || 'Tidak ada deskripsi';
        document.getElementById('dtDeadline').textContent = deadline;
        document.getElementById('dtReward').textContent = reward;

        const statusMap = {
            'not_started': '<span style="background:#F9FAFB;color:#6B7280;font-size:11px;font-weight:600;padding:4px 10px;border-radius:20px;">Not Started</span>',
            'in_progress': '<span style="background:#EFF6FF;color:#2563EB;font-size:11px;font-weight:600;padding:4px 10px;border-radius:20px;">In Progress</span>',
            'submitted':   '<span style="background:#FFF7ED;color:#D97706;font-size:11px;font-weight:600;padding:4px 10px;border-radius:20px;">In Review</span>',
            'completed':   '<span style="background:#ECFDF5;color:#059669;font-size:11px;font-weight:600;padding:4px 10px;border-radius:20px;">Done</span>',
        };
        document.getElementById('dtStatus').innerHTML = statusMap[pivotStatus] || pivotStatus;

        const area = document.getElementById('dtAttachment');
        if (attachment && attachment !== '' && attachment !== 'null') {
            const ext = attachment.split('.').pop().toLowerCase();
            const isImg = ['jpg','jpeg','png','gif','webp'].includes(ext);
            area.innerHTML = `
                <div class="file-box">
                    <div class="file-box-icon ${isImg ? 'img' : ''}">
                        <i class="bi ${isImg ? 'bi-file-image' : (ext === 'pdf' ? 'bi-file-pdf' : 'bi-file-earmark-word')}"></i>
                    </div>
                    <div style="flex:1;">
                        <div style="font-size:13px;font-weight:600;color:#1F2937;">${attachment}</div>
                        <div style="font-size:11px;color:#9CA3AF;">${ext.toUpperCase()} file dari admin</div>
                    </div>
                    <a href="/tasks/${attachment}" target="_blank" class="btn-dl"><i class="bi bi-download"></i> Buka</a>
                </div>
                ${isImg ? `<img src="/tasks/${attachment}" style="max-width:100%;max-height:200px;border-radius:10px;margin-top:10px;object-fit:contain;border:1px solid #F0F0F0;">` : ''}
            `;
        } else {
            area.innerHTML = `<div style="background:#F9FAFB;border:1px dashed #E5E7EB;border-radius:10px;padding:20px;text-align:center;"><i class="bi bi-paperclip" style="font-size:24px;color:#D1D5DB;display:block;margin-bottom:6px;"></i><span style="font-size:13px;color:#9CA3AF;">Tidak ada file dari admin</span></div>`;
        }

        const footer = document.getElementById('dtFooter');

        const statusOptions = [
            { value: 'not_started', label: 'Not Started', disabled: false },
            { value: 'in_progress', label: 'In Progress', disabled: false },
            { value: 'submitted',   label: 'In Review',   disabled: false },
            { value: 'do_revision', label: 'Do Revision', disabled: false },
            { value: 'completed',   label: '🔒 Done (Admin Only)', disabled: true },
        ];

        const optionsHtml = statusOptions.map(s =>
            `<option value="${s.value}" ${s.value === pivotStatus ? 'selected' : ''} ${s.disabled ? 'disabled style="color:#D1D5DB;"' : ''}>${s.label}</option>`
        ).join('');

        let submitBtn = '';
        if (pivotStatus === 'in_progress') {
            submitBtn = `
                <button type="button" class="btn-primary-modal" onclick="bootstrap.Modal.getInstance(document.getElementById('modalDetailTugas')).hide(); setTimeout(() => openSubmitModal(${pivotId}, '${title.replace(/'/g,"\\'")}', ${taskId}), 300);">
                    <i class="bi bi-upload me-1"></i> Submit Tugas
                </button>`;
        }

        footer.innerHTML = `
            <div class="d-flex align-items-center gap-2 me-auto">
                <label style="font-size:12px;font-weight:600;color:#6B7280;white-space:nowrap;">Ubah Status:</label>
                <select id="statusSelectModal" class="form-select form-select-sm" style="width:185px;border-radius:8px;font-size:13px;" onchange="updateStatusFromModal(this, ${pivotId})">
                    ${optionsHtml}
                </select>
            </div>
            <button type="button" class="btn-secondary-modal" data-bs-dismiss="modal">Tutup</button>
            ${submitBtn}
        `;

        new bootstrap.Modal(document.getElementById('modalDetailTugas')).show();
    }
</script>
</body>
</html>