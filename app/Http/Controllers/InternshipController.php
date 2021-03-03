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
            'interest' => 'required|max:25',
            'question_1' => 'required|string|max:15',
            'question_2' => 'required|string|max:15',
            'question_3' => 'required|string|max:15',
            'file' => 'required|file|mimes:pdf|max:10240',
        ]);

    	$data = UploadFile::dispatchNow($request);

    	$user = \App\User::where('id', config('blog.super_admin_id'))->firstOrFail();

		return $user->notify(new \App\Notifications\CustomNotification(
            [
                'send_email' => 1,
                'send_database' => 1,
                'title' => 'Internship request for '.strtolower($request->input('interest')),
                'action_text' => 'Open the CV',
                'action' => $data->url,
                'message' => "Interest: " . $request->input('interest') . "\n\nQ1: " . $request->input('question_1') . "\nQ2: " . $request->input('question_2') . "\nQ3: " . $request->input('question_3'),
            ]
        ));

    }
}
