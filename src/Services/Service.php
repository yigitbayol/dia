<?php

namespace Yigitbayol\Dia\Services;

use Illuminate\Support\Facades\Http;

class Service
{
    private $dia;

    public function __construct(Dia $dia)
    {
        $this->dia = $dia;
    }


    /**
     * createService - Dia'da yeni bir servis kaydı oluşturur.
     *
     * @param  mixed $firmaKodu
     * @param  mixed $donemKodu
     * @param  mixed $kart
     * @return array
     */
    public function create($firmaKodu, $donemKodu, $kart): array
    {
        $this->dia->initialize();
        $sessionId = $this->dia->getSessionId();

        $baseUrl = config('dia.url') . 'shy/json';
        $postData = [
            "shy_servisformu_ekle" => [
                "session_id" => $sessionId,
                "firma_kodu" => intval($firmaKodu),
                "donem_kodu" => intval($donemKodu),
                "kart" => $kart
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
     * updateService - Dia'da varolan bir servis kaydını günceller.
     *
     * @param  mixed $firmaKodu
     * @param  mixed $donemKodu
     * @param  mixed $kart
     * @return array
     */
    public function update($firmaKodu, $donemKodu, $kart): array
    {
        $this->dia->initialize();
        $sessionId = $this->dia->getSessionId();

        $baseUrl = config('dia.url') . 'shy/json';
        $postData = [
            "shy_servisformu_guncelle" => [
                "session_id" => $sessionId,
                "firma_kodu" => intval($firmaKodu),
                "donem_kodu" => intval($donemKodu),
                "kart" => $kart
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
     * getService - Dia'dan servis bilgilerini alır
     *
     * @param  mixed $firmaKodu
     * @param  mixed $donemKodu
     * @param  mixed $key
     * @return array
     */
    public function get($firmaKodu, $donemKodu, $key, $params = ""): array
    {
        $this->dia->initialize();
        $sessionId = $this->dia->getSessionId();

        $baseUrl = config('dia.url') . 'shy/json';

        $postData = [
            "shy_servisformu_getir" => [
                "session_id" => $sessionId,
                "firma_kodu" => intval($firmaKodu),
                "donem_kodu" => intval($donemKodu),
                "key" => $key,
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
     * deleteService - Dia'da varolan bir servis kaydını siler.
     *
     * @param  mixed $firmaKodu
     * @param  mixed $donemKodu
     * @param  mixed $key
     * @return array
     */
    public function delete($firmaKodu, $donemKodu, $key, $params = ""): array
    {
        $this->dia->initialize();
        $sessionId = $this->dia->getSessionId();

        $baseUrl = config('dia.url') . 'shy/json';

        $postData = [
            "shy_servisformu_sil" => [
                "session_id" => $sessionId,
                "firma_kodu" => intval($firmaKodu),
                "donem_kodu" => intval($donemKodu),
                "key" => $key,
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
     * getServices - Dia'dan servis listesini alır.
     *
     * @param  mixed $firmaKodu
     * @param  mixed $donemKodu
     * @param  mixed $limit
     * @param  mixed $offset
     * @param  mixed $filters
     * @param  mixed $sorts
     * @param  mixed $params
     * @return void
     */
    public function list($firmaKodu, $donemKodu, $limit = 10, $offset = 0, $filters = '', $sorts = '', $params = ''): array
    {
        $this->dia->initialize();
        $sessionId = $this->dia->getSessionId();

        $baseUrl = config('dia.url') . 'shy/json';

        $postData = [
            "shy_servisformu_tipi_listele" => [
                "session_id" => $sessionId,
                "firma_kodu" => intval($firmaKodu),
                "donem_kodu" => intval($donemKodu),
                "filters" => array($filters),
                "sorts" => $sorts,
                "params" => $params,
                "limit" => $limit,
                "offset" => $offset
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
