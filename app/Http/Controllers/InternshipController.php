<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFile;
use Illuminate\Http\Request;
use App\Jobs\UploadFile;
use App\Jobs\ProcessPdf;
use App\Jobs\NotifyAdminInternshipRequest;
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
      // Validate the data from the request
    	$internshipData = $request->validate([
            'interest' => 'required|max:25',
            'question_1' => 'required|string|max:15',
            'question_2' => 'required|string|max:15',
            'question_3' => 'required|string|max:15',
            'file' => 'required|file|mimes:pdf|max:10240',
        ]);
      // Save the file into the database
    	$file = UploadFile::dispatchNow($request);
      // Extract emails/phone number/website from pdf
      /* Arguments of ProcessPdf jobs :
          file       (Required)
          reSaveFile (Optional, store the processed pdf into database, boolean, by default=true)
          saveData   (Optional, save all the data extrated into database, boolean, by default=false)
      */
      $processedData = ProcessPdf::dispatchNow($file, true, true);
      // Notify the admin
      $admin = \App\User::where('id', config('blog.super_admin_id'))->firstOrFail();
      return $admin->notify(new \App\Notifications\CustomNotification(
              [
                  'send_email' => 1,
                  'send_database' => 1,
                  'title' => 'Internship request for '.$internshipData['interest'],
                  'action_text' => 'Open the CV',
                  'action' => $file['url'],
                  'message' => "Email: " . $processedData['emails'][0] . "\n\n" . "Interest: " . $internshipData['interest'] . "\nQ1: " . $internshipData['question_1'] . "\nQ2: " . $internshipData['question_2'] . "\nQ3: " . $internshipData['question_3'],
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
