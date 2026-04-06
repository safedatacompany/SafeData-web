<?php

namespace App\Http\Middleware;

use App\Models\Pages\MailInformation;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class MailConfig
{
    /**
     * Apply runtime mail settings from database when available.
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $mailInformation = MailInformation::query()->first();

            if ($mailInformation) {
                if ($mailInformation->mailer) {
                    config(['mail.default' => $mailInformation->mailer]);
                }

                if ($mailInformation->host) {
                    config(['mail.mailers.smtp.host' => $mailInformation->host]);
                }

                if ($mailInformation->port) {
                    config(['mail.mailers.smtp.port' => $mailInformation->port]);
                }

                if (!is_null($mailInformation->encryption)) {
                    config(['mail.mailers.smtp.encryption' => $mailInformation->encryption]);
                }

                if ($mailInformation->username) {
                    config(['mail.mailers.smtp.username' => $mailInformation->username]);
                }

                if ($mailInformation->password) {
                    config(['mail.mailers.smtp.password' => $mailInformation->password]);
                }

                if ($mailInformation->from_address) {
                    config(['mail.from.address' => $mailInformation->from_address]);
                }

                if ($mailInformation->from_name) {
                    config(['mail.from.name' => $mailInformation->from_name]);
                }
            }
        } catch (Throwable $exception) {
            // Fallback to default .env mail settings when DB settings are unavailable.
        }

        return $next($request);
    }
}
