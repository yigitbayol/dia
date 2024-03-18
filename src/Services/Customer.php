<?php

namespace Yigitbayol\Dia\Services;

use Illuminate\Support\Facades\Http;

class Customer
{
    private $dia;

    public function __construct(Dia $dia)
    {
        $this->dia = $dia;
    }

    /**
     * getCompanies - Dia'da cari kartları listeler.
     *
     * @param  mixed $firmaKodu
     * @param  mixed $donemKodu
     * @param  mixed $limit
     * @param  mixed $offset
     * @param  mixed $sorts
     * @param  mixed $params
     * @return array
     */
    public function getCustomers($firmaKodu, $donemKodu, $limit = 10, $offset = 0, $filters = "", $sorts = [['field' => 'carikartkodu', 'sorttype' => 'DESC']], $params = ['irsaliyeleriDahilEt' => 'False']): array
    {
        $this->dia->initialize();
        $sessionId = $this->dia->getSessionId();

        $baseUrl = config('dia.url') . 'scf/json';

        $postData = [
            "scf_carikart_listele" => [
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

    /**
     * getCustomer - Dia'da cari kartı getirir.
     *
     * @param  mixed $firmaKodu
     * @param  mixed $donemKodu
     * @param  mixed $key
     * @return array
     */
    public function get($firmaKodu, $donemKodu, $key): array
    {
        $this->dia->initialize();
        $sessionId = $this->dia->getSessionId();

        $baseUrl = config('dia.url') . 'scf/json';

        $postData = [
            "scf_carikart_getir" => [
                "session_id" => $sessionId,
                "firma_kodu" => intval($firmaKodu),
                "donem_kodu" => intval($donemKodu),
                "key" => $key,
                "params" => ""
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
     * createCustomer - Dia'da cari kart oluşturur.
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

        $baseUrl = config('dia.url') . 'scf/json';

        $postData = [
            "scf_carikart_ekle" => [
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
     * updateCustomer - Dia'da cari kart günceller.
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

        $baseUrl = config('dia.url') . 'scf/json';

        $postData = [
            "scf_carikart_guncelle" => [
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
     * deleteCustomer - Dia'da cari kartı siler.
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

        $baseUrl = config('dia.url') . 'scf/json';

        $postData = [
            "scf_carikart_sil" => [
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


}
