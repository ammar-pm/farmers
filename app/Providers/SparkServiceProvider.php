<?php

namespace App\Providers;

use Laravel\Spark\Spark;
use Laravel\Spark\Providers\AppServiceProvider as ServiceProvider;
use Config;
use Mail;
use App\Mail\RegisterNotify;

class SparkServiceProvider extends ServiceProvider
{
    /**
     * Your application and company details.
     *
     * @var array
     */
    protected $details = [
        'vendor' => 'Your Company',
        'product' => 'Your Product',
        'street' => 'PO Box 111',
        'location' => 'Your Town, NY 12345',
        'phone' => '555-555-5555',
    ];

    /**
     * The address where customer support e-mails should be sent.
     *
     * @var string
     */
    protected $sendSupportEmailsTo = null;

    /**
     * All of the application developer e-mail addresses.
     *
     * @var array
     */
    protected $developers = [ 'haitham@pcbs.gov.ps'];

    /**
     * Indicates if the application will expose an API.
     *
     * @var bool
     */
    protected $usesApi = true;

    /**
     * Finish configuring Spark for the application.
     *
     * @return void
     */
    public function booted()
    {

        Spark::freeTeamPlan();

        Spark::createUsersWith(function ($request) {
            $user = Spark::user();
            $data = $request->all();
            $user->forceFill([
                'name'  => $data['name'],
                'email' => $data['email'],
                'role'  => 'member',
                'password' => bcrypt($data['password']),
                'language' => 'ar',
            ])->save();

            Mail::to(Config::get('notify_email'))->send(new RegisterNotify($user));

            return $user;
        });

    }


}
