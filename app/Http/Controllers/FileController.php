<?php

namespace App\Http\Controllers;

use App\File;
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', File::class);
        $request->validate([
            'file' => 'file|max:976562',
            'title' => 'unique:files,name',
            'public' => 'boolean',
        ]);
        $path = Storage::putFile('files/' . ($request->user()->id ?? 'default'), $request->file, $request->input('public') ?? 'private');
        $request->merge([
            'name' => $request->input('title') ?? $request->file->getClientOriginalName(),
            'url' => $path,
            'extension' => $request->file->extension(),
            //'type' => $request->file->type(),
            'mimeType' => $request->file->getMimeType(),
            'size' => $request->file->getSize(),
            'user_id' => $request->user()->id ?? null,
        ]);
        //return $request;
        $file = File::create($request->only('name', 'url', 'extension', 'mimeType', 'size', 'user_id'));
        //return $file;
        return back()->with('success', 'Thanks for sending us your file!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, File $qr)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(File $file)
    {
        $this->authorize('delete', File::class);
        Storage::delete($file->getOriginal('url'));
    }
}
