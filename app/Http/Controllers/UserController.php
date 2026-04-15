<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskUser;
use App\Models\TaskReport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // ==================== DASHBOARD ====================
    public function dashboard()
    {
        $user = Auth::user();

        $taskUsers = TaskUser::where('id_user', $user->id_user)->get();
        $taskIds = $taskUsers->pluck('id_task')->toArray();
        $tasks = Task::whereIn('id_task', $taskIds)
            ->orderBy('deadline', 'asc')
            ->get();

        foreach ($tasks as $task) {
            $taskUser = $taskUsers->where('id_task', $task->id_task)->first();
            $task->pivot_id = $taskUser->id;
            $task->pivot_status = $taskUser->status;
        }

        $overdueTasks = $tasks->filter(function ($task) {
            return $task->deadline < now() && $task->pivot_status != 'completed';
        })->count();

        $maxHp = 50;
        $currentHp = max(0, $maxHp - ($overdueTasks * 10));
        $levelName = $user->level ? $user->level->level_name : 'Beginner';
        $maxExp = $user->level ? ($user->level->exp_required ?? 100) : 100;

        return view('user.dashboard', compact('user', 'tasks', 'currentHp', 'maxHp', 'levelName', 'maxExp'));
    }

    // ==================== UPDATE STATUS TASK ====================
    public function updateStatus(Request $request, $pivotId)
    {
        $taskUser = TaskUser::where('id', $pivotId)
            ->where('id_user', Auth::user()->id_user)
            ->firstOrFail();

        $request->validate([
            'status' => 'required|string|in:assigned,not_started,in_progress,submitted,do_revision,completed',
        ]);

        if ($request->status === 'completed') {
            return response()->json([
                'success' => false,
                'message' => 'Hanya admin yang bisa mengubah status menjadi Done!',
            ], 403);
        }

        $taskUser->update(['status' => $request->status]);

        return response()->json([
            'success' => true,
            'message' => 'Status berhasil diupdate!',
            'new_status' => $request->status,
        ]);
    }

    // ==================== PROFILE ====================
    public function profile()
    {
        $user = Auth::user()->load(['level', 'role']);

        $taskUsers = TaskUser::where('id_user', $user->id_user)->get();
        $taskIds = $taskUsers->pluck('id_task')->toArray();
        $tasks = Task::whereIn('id_task', $taskIds)->get();

        foreach ($tasks as $task) {
            $tu = $taskUsers->where('id_task', $task->id_task)->first();
            $task->pivot_status = $tu->status;
        }

        $overdueTasks = $tasks->filter(function ($task) {
            return $task->deadline < now() && $task->pivot_status != 'completed';
        })->count();

        $maxHp = 50;
        $currentHp = max(0, $maxHp - ($overdueTasks * 10));
        $maxExp = $user->level ? ($user->level->exp_required ?? 100) : 100;
        $completedTasks = $taskUsers->where('status', 'completed')->count();

        return view('user.profile', compact('user', 'currentHp', 'maxHp', 'maxExp', 'completedTasks'));
    }

    // ==================== UPDATE PROFILE (nama, email, password, foto sekaligus) ====================
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'name'                  => 'nullable|string|max:255',
            'email'                 => ['nullable', 'email', Rule::unique('users', 'email')->ignore($user->id_user, 'id_user')],
            'password'              => 'nullable|string|min:8',
            'password_confirmation' => 'nullable|string|same:password',
            'photo_profile'         => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'email.unique'               => 'Email sudah digunakan',
            'password.min'               => 'Password minimal 8 karakter',
            'password_confirmation.same' => 'Konfirmasi password tidak cocok',
            'photo_profile.image'        => 'File harus berupa gambar',
            'photo_profile.mimes'        => 'Format foto harus JPG atau PNG',
            'photo_profile.max'          => 'Ukuran foto maksimal 2MB',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $updateData = [];

        if ($request->filled('name'))     $updateData['name']     = $request->name;
        if ($request->filled('email'))    $updateData['email']    = $request->email;
        if ($request->filled('password')) $updateData['password'] = Hash::make($request->password);

        // Handle upload foto
        if ($request->hasFile('photo_profile')) {
            if ($user->photo_profile) {
                $oldPath = public_path('images/' . $user->photo_profile);
                if (file_exists($oldPath)) unlink($oldPath);
            }
            $file     = $request->file('photo_profile');
            $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            $file->move(public_path('images'), $filename);
            $updateData['photo_profile'] = $filename;
        }

        if (!empty($updateData)) $user->update($updateData);

        return redirect()->route('user.profile')->with('success', 'Profil berhasil diupdate!');
    }

    // updatePhoto tetap ada untuk backward compatibility
    public function updatePhoto(Request $request)
    {
        $request->validate([
            'photo_profile' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = Auth::user();

        if ($user->photo_profile) {
            $oldPath = public_path('images/' . $user->photo_profile);
            if (file_exists($oldPath)) unlink($oldPath);
        }

        $file     = $request->file('photo_profile');
        $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
        $file->move(public_path('images'), $filename);
        $user->update(['photo_profile' => $filename]);

        return redirect()->route('user.profile')->with('success', 'Foto profil berhasil diupdate!');
    }

    // ==================== HISTORY ====================
    public function history()
    {
        $user = Auth::user();

        $reports = TaskReport::where('id_user', $user->id_user)
            ->with('task')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.history', compact('reports'));
    }

    // ==================== SUBMIT LAPORAN ====================
    public function submitTask(Request $request)
    {
        $request->validate([
            'pivot_id'    => 'required|integer',
            'task_id'     => 'required|integer',
            'report_text' => 'required|string|min:10',
            'report_file' => 'nullable|file|max:5120|mimes:pdf,doc,docx,jpg,jpeg,png,zip',
        ], [
            'report_text.required' => 'Deskripsi laporan wajib diisi',
            'report_text.min'      => 'Deskripsi minimal 10 karakter',
            'report_file.max'      => 'Ukuran file maksimal 5MB',
            'report_file.mimes'    => 'Format file tidak didukung',
        ]);

        $user     = Auth::user();
        $taskUser = TaskUser::where('id', $request->pivot_id)
            ->where('id_user', $user->id_user)
            ->firstOrFail();

        $reportDir = public_path('reports');
        if (!file_exists($reportDir)) {
            mkdir($reportDir, 0755, true);
        }

        $filePath = null;
        if ($request->hasFile('report_file')) {
            $file         = $request->file('report_file');
            $originalName = str_replace(' ', '_', $file->getClientOriginalName());
            $filename     = time() . '_' . $originalName;
            $file->move($reportDir, $filename);
            $filePath = $filename;
        }

        TaskReport::create([
            'id_task'     => $request->task_id,
            'id_user'     => $user->id_user,
            'report_text' => $request->report_text,
            'report_file' => $filePath,
            'status'      => 'pending',
        ]);

        $taskUser->update(['status' => 'submitted']);

        return redirect()->route('user.dashboard')
            ->with('success', 'Laporan berhasil disubmit! Menunggu review admin.');
    }
}