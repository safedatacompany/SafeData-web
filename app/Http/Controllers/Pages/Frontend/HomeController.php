<?php

namespace App\Http\Controllers\Pages\Frontend;

use App\Models\Pages\Client;
use Illuminate\Http\Request;
use App\Models\Pages\Hosting;
use App\Models\Pages\Product;
use App\Models\Pages\Service;

use App\Models\Pages\SocialLink;
use App\Models\Pages\PhoneNumbers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{

    public function index()
    {
        $services = Service::query()->get();
        $clients = Client::query()->get();
        $products = Product::query()->get();
        $hosting = Hosting::query()->get();
        $links = SocialLink::first();
        $phone_numbers = PhoneNumbers::all();

        return inertia('Frontend/Home', [
            'clients' => $clients,
            'services' => $services,
            'products' => $products,
            'hosting' => $hosting,
            'links' => $links,
            'phone_numbers' => $phone_numbers,
        ]);
    }

    public function sendMail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $email = $request->email;
        $subject = $request->subject ?? 'No Subject';
        $messageContent = $request->message;

        Mail::send([], [], function ($message) use ($email, $subject, $messageContent) {
            $message->to('info@safedatait.com')
                ->replyTo($email, $email)  // Shows client's email as name
                ->subject($subject . ' - from ' . $email)  // Shows email in subject
                ->html("
                    <p><strong>From:</strong> {$email}</p>
                    <p><strong>Subject:</strong> {$subject}</p>
                    <p><strong>Message:</strong></p>
                    <p>{$messageContent}</p>
                ");
        });

        return back()->with('success', 'Message sent successfully!');
    }
}
