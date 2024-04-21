<?php

namespace Yigitbayol\Dia\Services;

use Illuminate\Support\Facades\Http;

class Order
{
    private $dia;

    public function __construct(Dia $dia)
    {
        $this->dia = $dia;
    }


    /**
     * createOrder - Dia'da yeni bir sipariş oluşturur.
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
            "scf_siparis_ekle" => [
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
     * updateOrder - Dia'da varolan bir siparişi günceller.
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
            "scf_siparis_guncelle" => [
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
     * getOrder - Dia'da sipariş bilgilerini alır.
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

        $baseUrl = config('dia.url') . 'scf/json';

        $postData = [
            "scf_siparis_getir" => [
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
     * deleteOrder - Dia'da siparişi siler.
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
            "scf_siparis_sil" => [
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
     * getOrders - Dia'da sipariş listesi alır.
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

        $baseUrl = config('dia.url') . 'scf/json';

        $postData = [
            "scf_siparis_listele" => [
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
     * getInvoicesDetailed - Dia'da fatura içeriğini ve detaylı bilgileri alır.
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
    public function listDetailed($firmaKodu, $donemKodu, $limit = 10, $offset = 0, $filters = '', $sorts = '', $params = ''): array
    {
        $this->dia->initialize();
        $sessionId = $this->dia->getSessionId();

        $baseUrl = config('dia.url') . 'scf/json';

        $postData = [
            "scf_siparis_listele_ayrintili" => [
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
