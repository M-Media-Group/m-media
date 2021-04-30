<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFile;
use Illuminate\Http\Request;
use App\Jobs\UploadFile;
use App\Internship;

class InternshipController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->input('user');

        $this->authorize('index', Internship::class);

        $internships = Internship::with('certificate')
            ->when($user, function ($query, $user) {
                return $query->where('user_id', $user);
            })->get();

        return view('internships.index', compact('internships'));
    }

    public function createApplication(Request $request)
    {
        $this->authorize('createApplication', Internship::class);
        return view('internship');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function apply(StoreFile $request)
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
                'action' => '/files/'.$data->id,
                'message' => "Interest: " . $request->input('interest') . "\n\nQ1: " . $request->input('question_1') . "\nQ2: " . $request->input('question_2') . "\nQ3: " . $request->input('question_3'),
            ]
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Internship $internship)
    {
        $this->authorize('show', $internship);
        $internship->load('certificate.file');
        return view('internships.show', compact('internship'));
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
}
