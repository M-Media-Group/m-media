<?php

namespace App\Http\Controllers;

use App\EmailLog;
use App\Jobs\SaveEmail;
use Illuminate\Http\Request;

class EmailLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('index', EmailLog::class);
        $email_logs = EmailLog::get();
        return view('emailLogs.index', compact('email_logs'));
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
        $request->merge([
            'from_display' => $this->email_split($request->input('email'))['name'],
            'email' => $this->email_split($request->input('email'))['email'],
            'from' => $this->email_split($request->input('from'))['email'],
            'reply_to' => $request->input('reply_to') ? $this->email_split($request->input('reply_to'))['email'] : null,
        ]);

        $request->validate([
            'from_display' => 'nullable|string',
            'email' => 'required|email',
            'from' => 'required|email',
            'reply_to' => 'nullable|email',
            'type' => 'nullable|string',
            'status' => 'nullable|string',
            'subject' => 'nullable|string',
            'aws_id' => 'required|string',
        ]);

        $email = SaveEmail::dispatchNow($request->only('email'));
        $from_email = SaveEmail::dispatchNow($request->only('from'));

        $log = EmailLog::create(
            [
                'from_display' => $request->input('from_display'),
                'email_id' => $from_email->id,
                'notes' => $request->input('notes'),
                'type' => $request->input('type'),
                'to_email_id' => $email->id,
                'reply_to_email_id' => null,
                'aws_message_id' => $request->input('aws_id'),
                'status' => $request->input('status'),
                'subject' => $request->input('subject'),
            ]
        );
        //$from_email->logs = EmailLog::where('email_id', $from_email->id)->get();
        $from_email->log = $log;

        return $from_email;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EmailLog  $emailLog
     * @return \Illuminate\Http\Response
     */
    public function show(EmailLog $emailLog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EmailLog  $emailLog
     * @return \Illuminate\Http\Response
     */
    public function edit(EmailLog $emailLog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EmailLog  $emailLog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmailLog $emailLog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EmailLog  $emailLog
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmailLog $emailLog)
    {
        //
    }
    private function email_split($str)
    {
        $str .= " ";
        //$aMatch = mailparse_rfc822_parse_addresses($str)[0];
        $sPattern = '/([\w\s\'\"]+[\s]+)?[<]?([\w\-\.]+\@(?:[\w]+\.)+[a-zA-Z]{2,4})[>]?/';
        preg_match($sPattern, $str, $aMatch);
        //echo "string";
        //print_r($aMatch);
        $name = (isset($aMatch[1])) ? $aMatch[1] : '';
        $email = (isset($aMatch[2])) ? $aMatch[2] : '';
        return array('name' => trim($name), 'email' => trim($email));
    }
}
