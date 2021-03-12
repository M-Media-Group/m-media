<?php

namespace App\Http\Controllers;

use App\InternshipCertificate;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InternshipCertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $this->authorize('create', InternshipCertificate::class);
        $uuid = (string) Str::orderedUuid();
        $request->merge([
            'uuid' => $uuid,
        ]);
        $request->validate([
            'uuid' => 'string|unique:internship_certificates,uuid',
            'internship_id' => 'required|unique:internship_certificates,internship_id|exists:internships,id',
            'file_id' => 'required|unique:internship_certificates,file_id|exists:files,id',
            'personal_message_title' => 'nullable|string',
            'personal_message_body' => 'nullable|string',
            'congratulations_page_is_public' => 'boolean',
        ]);
        $result = InternshipCertificate::create($request->input());
        return $result;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\InternshipCertificate  $internshipCertificate
     * @return \Illuminate\Http\Response
     */
    public function show(InternshipCertificate $internshipCertificate)
    {
        return redirect($internshipCertificate->file->url);
    }

    public function showCongrats(Request $request, InternshipCertificate $internshipCertificate)
    {
        if(!$internshipCertificate->congratulations_page_is_public && $internshipCertificate->internship->user_id !== $request->user()->id) {
            abort(404);
        }
        $internshipCertificate->load('internship.user');
        return view('internshipCertificate', compact('internshipCertificate'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\InternshipCertificate  $internshipCertificate
     * @return \Illuminate\Http\Response
     */
    public function edit(InternshipCertificate $internshipCertificate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\InternshipCertificate  $internshipCertificate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InternshipCertificate $internshipCertificate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InternshipCertificate  $internshipCertificate
     * @return \Illuminate\Http\Response
     */
    public function destroy(InternshipCertificate $internshipCertificate)
    {
        //
    }
}
