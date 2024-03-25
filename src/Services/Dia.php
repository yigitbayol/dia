<?php

namespace Yigitbayol\Dia\Services;

use App\Models\DiaSetting;
use Illuminate\Support\Facades\Http;
use Yigitbayol\Dia\Services\General;
use Yigitbayol\Dia\Services\Customer;


class Dia
{
    private $session_id;

    public $system, $customer;

    public function __construct()
    {
        $this->initialize();
        $this->system = new System($this);
        $this->customer = new Customer($this);
        $this->invoice = new Invoice($this);
    }

    /**
     * initialize
     *
     * @return void
     */
    public function initialize()
    {
        $tokenDetails = $this->getSessionIdFromDatabaseOrApi();
        $this->session_id = $tokenDetails['session_id'];
    }

    private function getSessionIdFromDatabaseOrApi()
    {
        // Önce veritabanından token'i deneyin
        $setting = DiaSetting::first();
        if ($setting && $setting->session_id) {
            return [
                'session_id' => $setting->session_id
            ];
        }

        // Token yoksa veya süresi dolmuşsa, API'den yeni bir token alın
        return $this->fetchSessionIdFromApi();
    }

    private function fetchSessionIdFromApi()
    {
        $parameters = [
            "login" => [
                "username" => config('dia.username'),
                "password" => config('dia.password'),
                "disconnect_same_user" => true,
                "lang" => "tr",
                "params" => [
                    "apikey" => config('dia.api_key')
                ]
            ]
        ];

        // POST isteği yap ve yanıtı al
        $response = Http::asJson()->post(config('dia.url'), $parameters);

        // Yanıtın gövdesini JSON olarak ayrıştır
        $responseBody = $response->json();

        if (isset ($responseBody['msg'])) {
            $this->setSessionId($responseBody['msg']);
        }

        return [
            'session_id' => $this->session_id,
        ];
    }

    private function setSessionId($token)
    {
        $this->session_id = $token;

        // Veritabanında token ve süresini güncelleyin
        DiaSetting::updateOrCreate(['id' => 1], [
            'session_id' => $token,
        ]);
    }

    public function getSessionId()
    {
        return $this->session_id;
    }
}
