<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Task;
use App\Models\TaskUser;
use App\Models\TaskReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    // ==================== DASHBOARD ====================
    public function dashboard()
    {
        $totalUsers = User::where('id_role', 2)->count();
        $totalTasks = Task::count();
        $pendingTasks = TaskReport::where('status', 'pending')->count();
        $doneTasks = Task::where('status', 'done')->count();
        $recentUsers = User::where('id_role', 2)->latest()->take(5)->get();
        $recentTasks = Task::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalUsers', 'totalTasks', 'pendingTasks', 'doneTasks', 'recentUsers', 'recentTasks'
        ));
    }

    // ==================== PROFILE ====================
    public function profile()
    {
        $user = auth()->user();
        return view('admin.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => [
                'required', 'email',
                Rule::unique('users', 'email')->ignore($user->id_user, 'id_user')
            ],
            'password' => 'nullable|string|min:8',
            'password_confirmation' => 'nullable|string|same:password',
            'photo_profile' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'name.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.unique' => 'Email sudah digunakan',
            'password.min' => 'Password minimal 8 karakter',
            'photo_profile.image' => 'File harus berupa gambar',
            'photo_profile.max' => 'Ukuran foto maksimal 2MB',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput(
                $request->except(['password', 'password_confirmation'])
            );
        }

        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('photo_profile')) {
            if ($user->photo_profile) {
                $oldPath = public_path('images/' . $user->photo_profile);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }
            $file = $request->file('photo_profile');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $updateData['photo_profile'] = $filename;
        }

        $user->update($updateData);

        return redirect()->route('admin.profile')->with('success', 'Profil berhasil diupdate!');
    }

    // ==================== KELOLA USER ====================
    public function users()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.users', compact('users'));
    }

    public function storeUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'id_role' => 'required|integer|in:1,2',
            'id_level' => 'nullable|integer|min:1|max:10',
        ], [
            'name.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 8 karakter',
            'id_role.required' => 'Role wajib dipilih',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'id_role' => $request->id_role,
            'id_level' => $request->id_level ?? 1,
            'exp' => 0,
            'coin' => 0,
            'status' => 'active',
        ]);

        return redirect()->route('admin.users')->with('success', 'User berhasil ditambahkan!');
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::where('id_user', $id)->firstOrFail();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => [
                'required', 'email',
                Rule::unique('users', 'email')->ignore($user->id_user, 'id_user')
            ],
            'id_role' => 'required|integer|in:1,2',
            'id_level' => 'nullable|integer|min:1|max:10',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'id_role' => $request->id_role,
            'id_level' => $request->id_level ?? $user->id_level,
        ];

        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        $user->update($updateData);

        return redirect()->route('admin.users')->with('success', 'User berhasil diupdate!');
    }

    public function destroyUser($id)
    {
        $user = User::where('id_user', $id)->firstOrFail();

        if ($user->id_user == auth()->user()->id_user) {
            return redirect()->route('admin.users')->with('error', 'Anda tidak bisa menghapus akun sendiri!');
        }

        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User berhasil dihapus!');
    }

    public function toggleStatus(Request $request, $id)
    {
        $user = User::where('id_user', $id)->firstOrFail();
        $user->update(['status' => $request->status]);

        return response()->json([
            'success' => true,
            'message' => 'Status user berhasil diubah',
            'new_status' => $request->status
        ]);
    }

    // ==================== KELOLA TUGAS ====================
    public function tasks()
    {
        $tasks = Task::orderBy('created_at', 'desc')->get();

        foreach ($tasks as $task) {
            $assignedUserIds = TaskUser::where('id_task', $task->id_task)->pluck('id_user')->toArray();
            $task->assignedUsersList = User::whereIn('id_user', $assignedUserIds)->get();
        }

        $users = User::where('id_role', 2)->where('status', 'active')->get();

        return view('admin.kelola-tugas', compact('tasks', 'users'));
    }

    public function storeTask(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'deadline' => 'required|date',
            'reward' => 'required|integer|min:1',
            'assigned_users' => 'nullable|array',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:5120',
        ], [
            'title.required' => 'Judul tugas wajib diisi',
            'description.required' => 'Deskripsi wajib diisi',
            'deadline.required' => 'Deadline wajib diisi',
            'reward.required' => 'Reward EXP wajib diisi',
            'attachment.mimes' => 'File harus berformat JPG, PNG, PDF, DOC, atau DOCX',
            'attachment.max' => 'Ukuran file maksimal 5MB',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $attachmentName = null;
            if ($request->hasFile('attachment')) {
                $file = $request->file('attachment');
                $attachmentName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('tasks'), $attachmentName);
            }

            $task = Task::create([
                'title' => $request->title,
                'description' => $request->description,
                'deadline' => $request->deadline,
                'reward' => $request->reward,
                'status' => 'not_started',
                'attachment' => $attachmentName,
                'created_by_admin_id' => auth()->user()->id_user,
            ]);

            if ($request->assigned_users && is_array($request->assigned_users)) {
                foreach ($request->assigned_users as $userId) {
                    TaskUser::create([
                        'id_task' => $task->id_task,
                        'id_user' => $userId,
                        'status' => 'assigned',
                    ]);
                }
            }

            return redirect()->route('admin.tasks')->with('success', 'Tugas berhasil ditambahkan!');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function updateTask(Request $request, $id)
    {
        $task = Task::where('id_task', $id)->firstOrFail();

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'deadline' => 'required|date',
            'reward' => 'required|integer|min:1',
            'assigned_users' => 'nullable|array',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:5120',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $updateData = [
                'title' => $request->title,
                'description' => $request->description,
                'deadline' => $request->deadline,
                'reward' => $request->reward,
            ];

            // Jika ada file baru diupload, hapus file lama & simpan yang baru
            if ($request->hasFile('attachment')) {
                if ($task->attachment) {
                    $oldPath = public_path('tasks/' . $task->attachment);
                    if (file_exists($oldPath)) unlink($oldPath);
                }
                $file = $request->file('attachment');
                $attachmentName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('tasks'), $attachmentName);
                $updateData['attachment'] = $attachmentName;
            }

            $task->update($updateData);

            TaskUser::where('id_task', $task->id_task)->delete();

            if ($request->assigned_users && is_array($request->assigned_users)) {
                foreach ($request->assigned_users as $userId) {
                    TaskUser::create([
                        'id_task' => $task->id_task,
                        'id_user' => $userId,
                        'status' => 'assigned',
                    ]);
                }
            }

            return redirect()->route('admin.tasks')->with('success', 'Tugas berhasil diupdate!');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroyTask($id)
    {
        $task = Task::where('id_task', $id)->firstOrFail();

        try {
            // Hapus file attachment jika ada
            if ($task->attachment) {
                $oldPath = public_path('tasks/' . $task->attachment);
                if (file_exists($oldPath)) unlink($oldPath);
            }
            TaskUser::where('id_task', $task->id_task)->delete();
            $task->delete();
            return redirect()->route('admin.tasks')->with('success', 'Tugas berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // ==================== REVIEW TUGAS ====================
    public function review()
    {
        $reports = TaskReport::with(['task', 'user'])
            ->orderByRaw("FIELD(status, 'pending', 'approved', 'rejected')")
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.review-tugas', compact('reports'));
    }

    public function approveReport($id)
    {
        $report = TaskReport::findOrFail($id);

        if ($report->status !== 'pending') {
            return redirect()->route('admin.review')->with('error', 'Laporan ini sudah diproses!');
        }

        $report->update(['status' => 'approved']);

        if ($report->task) {
            $report->task->update(['status' => 'done']);
        }

        $user = User::find($report->id_user);
        if ($user && $report->task) {
            $user->increment('exp', $report->task->reward);
            $user->increment('coin', $report->task->reward);
        }

        return redirect()->route('admin.review')->with('success', 'Tugas diapprove dan EXP diberikan ke user!');
    }

    public function rejectReport($id)
    {
        $report = TaskReport::findOrFail($id);

        if ($report->status !== 'pending') {
            return redirect()->route('admin.review')->with('error', 'Laporan ini sudah diproses!');
        }

        $report->update(['status' => 'rejected']);

        return redirect()->route('admin.review')->with('success', 'Laporan tugas berhasil ditolak!');
    }

    // ==================== MONITORING ====================
    public function monitoring()
    {
        $totalUsers = User::where('id_role', 2)->count();
        $activeUsers = User::where('id_role', 2)->where('status', 'active')->count();
        $inactiveUsers = User::where('id_role', 2)->where('status', 'inactive')->count();
        $doneTasks = TaskReport::where('status', 'approved')->count();
        $pendingTasks = TaskReport::where('status', 'pending')->count();
        $overdueTasks = Task::where('deadline', '<', now())
            ->whereNotIn('status', ['done'])
            ->count();

        $taskStats = [
            'not_started' => Task::where('status', 'not_started')->count(),
            'in_progress' => Task::where('status', 'in_progress')->count(),
            'in_review'   => Task::where('status', 'in_review')->count(),
            'done'        => Task::where('status', 'done')->count(),
        ];

        $topUsers = User::where('id_role', 2)
            ->orderBy('exp', 'desc')
            ->take(5)
            ->get();

        $userStats = User::where('id_role', 2)
            ->orderBy('exp', 'desc')
            ->get()
            ->map(function($user) {
                $taskIds = TaskUser::where('id_user', $user->id_user)->pluck('id_task');

                $user->done_count = TaskReport::where('id_user', $user->id_user)
                    ->where('status', 'approved')->count();

                $user->pending_count = TaskReport::where('id_user', $user->id_user)
                    ->where('status', 'pending')->count();

                $user->overdue_count = Task::whereIn('id_task', $taskIds)
                    ->where('deadline', '<', now())
                    ->whereNotIn('status', ['done'])
                    ->count();

                return $user;
            });

        return view('admin.monitoring', compact(
            'totalUsers', 'activeUsers', 'inactiveUsers',
            'doneTasks', 'pendingTasks', 'overdueTasks',
            'taskStats', 'topUsers', 'userStats'
        ));
    }
}