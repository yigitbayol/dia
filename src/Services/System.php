<?php

namespace Yigitbayol\Dia\Services;

use Illuminate\Support\Facades\Http;

class System
{
    private $dia;

    public function __construct(Dia $dia)
    {
        $this->dia = $dia;
    }

    /**
     * getInfo Dia'da yer alan şirketler ve dönemler bilgisini çeker
     *
     * @return void
     */
    public function getInfo(): array
    {
        $this->dia->initialize();
        $session_id = $this->dia->getSessionId();

        $baseUrl = config('dia.url') . 'sis/json';

        $postData = [
            "sis_yetkili_firma_donem_sube_depo" => [
                "session_id" => $session_id
            ]
        ];

        $response = Http::asJson()->post($baseUrl, $postData);

        if ($response->successful()) {
            return $response->json();
        } else {
            return [
                'error' => true,
                'message' => 'Bir hata oluştu: ' . $response->body()
            ];
        }
    }

    /**
     * getCompany Dia'da tanımlı verilen şirkete ait bilgileri döner
     *
     * @param  mixed $firmaKodu
     * @param  mixed $params
     * @return array
     */
    public function getCompany($firmaKodu = '1', $params = ''): array
    {
        $this->dia->initialize();
        $sessionId = $this->dia->getSessionId();

        $baseUrl = config('dia.url') . 'sis/json';

        $postData = [
            "sis_firma_getir" => [
                "session_id" => $sessionId,
                "firma_kodu" => $firmaKodu,
                "params" => $params
            ]
        ];

        $response = Http::asJson()->post($baseUrl, $postData);

        if ($response->successful()) {
            return $response->json();
        } else {
            return [
                'error' => true,
                'message' => 'Bir hata oluştu: ' . $response->body()
            ];
        }
    }

    /**
     * getCompanyPermissions Verilen şirkete ait yetki bilgilerini döner.
     *
     * @param  mixed $firmaKodu
     * @return array
     */
    public function getCompanyPermissions($firmaKodu): array
    {
        $this->dia->initialize();
        $sessionId = $this->dia->getSessionId();

        $baseUrl = config('dia.url') . 'sis/json';

        $postData = [
            "sis_firma_yetki_listesi_getir" => [
                "session_id" => $sessionId,
                "firma_kodu" => $firmaKodu
            ]
        ];

        $response = Http::asJson()->post($baseUrl, $postData);

        if ($response->successful()) {
            return $response->json();
        } else {
            return [
                'error' => true,
                'message' => 'Bir hata oluştu: ' . $response->body()
            ];
        }
    }


}
