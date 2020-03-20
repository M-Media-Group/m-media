<?php

namespace App\Http\Controllers;

use App\File;
use App\Http\Requests\StoreFile;
use App\Jobs\UploadFile;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Storage;

class FileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['optimizeImages']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->input('user');
        $type = $request->input('extension');
        $visibility = $request->input('visibility');
        //dd(isset($visibility));
        // since both formats are the same check for both extensions if either exists
        if ($type) {
            if (in_array('jpg', $type)) {
                array_push($type, 'jpeg');
            } elseif (in_array('jpeg', $type)) {
                array_push($type, 'jpg');
            }
        }

        $search_query = $request->input('q');

        $this->authorize('index', File::class);
        //$files = Storage::allFiles('/');
        $files = File::when($search_query, function ($query, $search_query) {
            return $query->where('name', 'SOUNDS LIKE', $search_query)
                ->orWhere('name', 'like', "%{$search_query}%");
        })
            ->when($user, function ($query, $user) {
                return $query->where('user_id', $user);
            })
            ->when($visibility, function ($query, $visibility) {
                return $query->where('is_public', $visibility == 'private' ? 0 : 1);
            })
            ->when($type, function ($query, $type) {
                return $query->whereIn('extension', $type);
            })
            ->latest()
            ->paginate(10);

        $all_users = \App\User::all();
        $users = collect();

        foreach ($all_users as $user) {
            $data = [
                'full_name' => $user->full_name,
                'id' => $user->id,
            ];
            $users->push($data);
        }

        return view('files.index', compact('files', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', File::class);

        return view('files.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFile $request)
    {
        // NO need for authorize as thats handled by the request StoreFile
        //$this->authorize('create', File::class);

        $data = UploadFile::dispatchNow($request);

        return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function storeFromEmail(Request $request)
    {
        // NO need for authorize as thats handled by the request StoreFile
        //$this->authorize('create', File::class);

        $request->validate([
            'email' => 'required|email|exists:users,email',
            'file' => 'required|file|max:976562',
            'title' => 'nullable|string|max:191',
            'public' => 'boolean',
        ]);

        $user = \App\User::where('email', $request->input('email'))->firstOrFail();

        if ($user->cant('create', File::class)) {
            abort(403);
        }

        $request->merge(['user_id' => $user->id]);

        $data = UploadFile::dispatchNow($request);

        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, File $file)
    {
        //return $file;
        $this->authorize('show', $file);

        return view('files.show', compact('file'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, File $file)
    {
        //
        $this->authorize('update', $file);

        $current_file_user = $file->user_id;

        $request->validate([
            'is_public' => 'nullable|boolean',
            'user_id' => 'nullable',
        ]);

        $file->update($request->only('is_public', 'user_id'));

        if (isset($request->is_public)) {
            Storage::setVisibility($file->getOriginal('url'), $request->is_public ? 'public' : 'private');
        }

        if ($request->user_id && $request->user_id !== $current_file_user) {
            $hash = Str::random(40);
            $new_url = 'files/' . ($request->user_id ?? 'default') . '/' . $hash . '.' . $file->extension;
            $path = Storage::move($file->getOriginal('url'), $new_url);
            $file->update(['url' => $new_url]);
        }

        return $file;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(File $file)
    {
        $this->authorize('delete', $file);
        Storage::delete($file->getOriginal('url'));
        $file->delete();

        return 'Successfully deleted file';
    }
}
