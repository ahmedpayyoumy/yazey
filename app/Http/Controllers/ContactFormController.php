<?php

namespace App\Http\Controllers;

use App\ContactForm;
use App\ContactFormReply;
use App\Mail\ContactFormReplyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ContactFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $contactForm = ContactForm::all();
        return view('pages.contact-form.index', [
            'contactForm' => $contactForm
        ]);
    }

    public function reply($id, Request $request)
    {
        $contactForm = ContactForm::findOrFail($id);
        return view('pages.contact-form.reply', [
            'contactForm' => $contactForm
        ]);
    }

    public function postReply($id, Request $request)
    {
        $contactForm = ContactForm::findOrFail($id);

        if (isset($request->content) && $request->content != "") {
            $reply = new ContactFormReply();
            $reply->form_id = $id;
            $reply->user_id = Auth::user()->id;
            $reply->content = $request->content;
            $reply->save();

            $contactForm->is_reply = 1;
            $contactForm->update();

            Mail::use($contactForm->contact->email)->send(new ContactFormReplyEmail($request->content));
            if (count(Mail::failures()) > 0) {
                toastr()->error('Có lỗi xảy ra khi gửi mail. Hãy thử lại sau!');
            } else {
                toastr()->success('Reply Success!');
            }
        }

        return view('pages.contact-form.reply', [
            'contactForm' => $contactForm
        ]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ContactForm  $contactForm
     * @return \Illuminate\Http\Response
     */
    public function show(ContactForm $contactForm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ContactForm  $contactForm
     * @return \Illuminate\Http\Response
     */
    public function edit(ContactForm $contactForm)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ContactForm  $contactForm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContactForm $contactForm)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ContactForm  $contactForm
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContactForm $contactForm)
    {
        //
    }
}
