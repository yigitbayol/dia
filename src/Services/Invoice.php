<?php

namespace Yigitbayol\Dia\Services;

use Illuminate\Support\Facades\Http;

class Invoice
{
    private $dia;

    public function __construct(Dia $dia)
    {
        $this->dia = $dia;
    }


    /**
     * createInvoice - Dia'da yeni bir fatura oluşturur.
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
            "scf_fatura_ekle" => [
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
     * updateInvoice - Dia'da varolan bir faturayı günceller.
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
            "scf_fatura_guncelle" => [
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
     * getInvoice - Dia'da fatura bilgilerini alır.
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
            "scf_fatura_getir" => [
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
     * deleteInvoice - Dia'da fatura siler.
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
            "scf_fatura_sil" => [
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
     * getInvoices - Dia'da fatura listesi alır.
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
            "scf_fatura_listele" => [
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
            "scf_fatura_listele_ayrintili" => [
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
