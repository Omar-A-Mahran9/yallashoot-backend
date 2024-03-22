<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Mail\ContactUs as MailContactUs;
use App\Models\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('view_contact_us');

        if ($request->ajax())
        {
            $messages = getModelData( model: new ContactUs() );

            return response()->json($messages);

        }

        return view('dashboard.contact_us.index');
    }

    public function edit($id)
    {
        $this->authorize('update_contact_us');

        $message = ContactUs::find($id);

        return view('dashboard.contact_us.edit',compact('message'));
    }

    public function update(Request $request , $id)
    {
         $this->authorize('update_contact_us');

        $contactUsRequest = ContactUs::find($id);

        $data = $request->validate(['reply' => 'required|string']);
 
        $contactUsRequest->update($data);

        try {

            // Mail::send('mails.contact-us',[ 'reply' =>  $contactUsRequest->reply ],function($message) use ($contactUsRequest){
            //     $message->to([$contactUsRequest->email])
            //         ->subject('Reply to: ' . $contactUsRequest->title);
            // });

        } catch (\Throwable $th) {
            dd($th->getMessage()) ;
        }

    }

}
