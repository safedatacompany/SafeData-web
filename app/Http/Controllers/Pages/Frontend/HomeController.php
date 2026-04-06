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
use Illuminate\Support\Facades\App;
use App\Models\Pages\MailInformation;

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

    public function localizedIndex(string $locale)
    {
        if (!in_array($locale, ['en', 'ar', 'ckb'])) {
            abort(404);
        }

        session()->put('locale', $locale);
        App::setLocale($locale);

        return $this->index();
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
        // dd($messageContent);
        $mail_information = MailInformation::first();
        if (!$mail_information) {
            return back()->withErrors([
                'message' => 'Mail settings are not configured yet. Please contact administrator.',
            ]);
        }

        //    return  $mail_information;
        config([
            'mail.mailers.smtp.host' => $mail_information->host,
            'mail.mailers.smtp.port' => $mail_information->port,
            'mail.mailers.smtp.encryption' => $mail_information->encryption,
            'mail.mailers.smtp.username' => $mail_information->username,
            'mail.mailers.smtp.password' => $mail_information->password,
            'mail.from.address' => $mail_information->from_address,
            'mail.from.name' => $mail_information->from_name,
        ]);

        $meessg = Mail::send([], [], function ($message) use ($email, $subject, $messageContent, $mail_information) {
            $message->to($mail_information->username)
                ->from($mail_information->from_address, $mail_information->from_name) // Use directly from mail_information
                ->replyTo($email)
                ->subject($subject . ' - Safe Data Website - Contact Form')
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
