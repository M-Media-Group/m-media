<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFile;
use Illuminate\Http\Request;
use App\Jobs\UploadFile;

class InternshipController extends Controller
{
    public function create(Request $request)
    {
        return view('internship');
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
    	$request->validate([
            'interest' => 'required',
            'question_1' => 'required|string',
            'question_2' => 'required|string',
            'question_3' => 'required|string',
            'file' => 'required|file|mimes:pdf|max:976562',
        ]);

    	$data = UploadFile::dispatchNow($request);

    	$user = \App\User::where('id', config('blog.super_admin_id'))->firstOrFail();

		return $user->notify(new \App\Notifications\CustomNotification(
            [
                'send_email' => 1,
                'send_database' => 1,
                'title' => 'New internship request',
                'action_text' => 'Open the CV',
                'action' => $data->url,
                'message' => "Interest: " . $request->input('interest') . "\n\nQ1: " . $request->input('question_1') . "\n\nQ2: " . $request->input('question_2') . "\n\nQ3: " . $request->input('question_3'),
            ]
        ));

    }
}
