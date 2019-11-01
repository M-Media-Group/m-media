<?php

namespace App\Http\Controllers;

use App\File;
use App\Http\Requests\StoreFile;
use App\Jobs\UploadFile;
use Illuminate\Http\Request;
use Storage;

class FileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['verified', 'optimizeImages']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('index', File::class);
        //$files = Storage::allFiles('/');
        $files = File::get();

        return view('files.index', compact('files'));
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
        UploadFile::dispatchNow($request);

        return back()->with('success', 'Thanks for sending us your file!');
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
