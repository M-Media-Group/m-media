<?php

namespace App\Http\Controllers;

use App\File;
use DB;
use Illuminate\Http\Request;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->is('api*')) {
            return File::with('category')->get();
        } else {
            return view('map');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$this->authorize('create', File::class);
        $validatedData = $request->validate([
            'category' => 'required|exists:categories,id',
            'lat' => 'required',
            'lng' => 'required',
        ]);

        $location = DB::raw("(GeomFromText('POINT(" . $request->lat . " " . $request->lng . ")'))");

        $result = new File(
            [
                'location' => $location,
                'category_id' => $request->input('category'),
                'user_id' => $request->user()->id,
            ]
        );
        $result->save();

        if ($request->is('api*')) {
            return $result;
        } else {
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, File $qr)
    {
        if (!$request->user()) {
            $user_id = null;
        } else {
            $user_id = $request->user()->id;
        }
        \App\FileView::create(
            [
                "File_id" => $qr->id,
                "user_id" => $user_id,
                "ip" => $request->ip(),
            ]
        );
        $query_parameters = ['utm_source' => 'real_world', 'utm_medium' => 'File', 'utm_campaign' => 'website_Files', 'utm_content' => $qr->id];
        return redirect($qr->redirect_to . '?' . http_build_query($query_parameters));
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
    public function destroy($id)
    {
        //
    }
}
