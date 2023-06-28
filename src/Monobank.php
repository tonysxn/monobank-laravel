<?php

namespace Neverlxsss\Monobank;

use GuzzleHttp\Exception\GuzzleException;
use Neverlxsss\Monobank\Support\Currency;
use Neverlxsss\Monobank\Support\InitiationKind;
use Neverlxsss\Monobank\Support\MerchantPaymentInfo;
use Neverlxsss\Monobank\Support\Method;
use Neverlxsss\Monobank\Support\PaymentType;
use Neverlxsss\Monobank\Support\Monobank as AbstractMonobank;
use Neverlxsss\Monobank\Support\Response;

class Monobank
{
    protected AbstractMonobank $client;

    public function __construct()
    {
        $this->client = new AbstractMonobank(config('monobank.token'));
    }

    /**
     * Create invoice
     * @param int $amount
     * @param Currency $currency
     * @param MerchantPaymentInfo|null $merchantPaymentInfo
     * @param string|null $redirectUrl
     * @param string|null $webhookUrl
     * @param int|null $validity
     * @param PaymentType $paymentType
     * @param string|null $qrId
     * @return Response
     */
    public function createInvoice(
        int                 $amount,
        Currency            $currency = Currency::UAH,
        MerchantPaymentInfo $merchantPaymentInfo = null,
        string              $redirectUrl = null,
        string              $webhookUrl = null,
        int                 $validity = null,
        PaymentType         $paymentType = PaymentType::DEBIT,
        string              $qrId = null,
    ): Response
    {
        $response = $this->client->api(
            "api/merchant/invoice/create",
            Method::POST->value,
            [],
            [
                'amount' => $amount,
                'ccy' => $currency->value,
                'merchantPaymInfo' => $merchantPaymentInfo,
                'redirectUrl' => $redirectUrl,
                'webHookUrl' => $webhookUrl,
                'validity' => $validity,
                'paymentType' => $paymentType,
                'qrId' => $qrId
            ]
        );

        return $response;
    }

    /**
     * Get invoice status
     * @param string $invoiceId
     * @return Response
     */
    public function getInvoiceStatus(
        string $invoiceId
    ): Response
    {
        $response = $this->client->api(
            "api/merchant/invoice/status",
            Method::GET->value,
            [],
            [
                'invoiceId' => $invoiceId,
            ]
        );

        return $response;
    }

    /**
     * Delete invoice
     * @param string $invoiceId
     * @param string|null $extRef
     * @param int|null $amount
     * @param array|null $items
     * @return Response
     */
    public function deleteInvoice(
        string $invoiceId,
        string $extRef = null,
        int    $amount = null,
        array  $items = null
    ): Response
    {
        $response = $this->client->api(
            "api/merchant/invoice/cancel",
            Method::POST->value,
            [],
            [
                'invoiceId' => $invoiceId,
                'extRef' => $extRef,
                'amount' => $amount,
                'items' => $items
            ]
        );

        return $response;
    }

    /**
     * Invalidate invoice
     * @param string $invoiceId
     * @return Response
     */
    public function invalidateInvoice(
        string $invoiceId
    ): Response
    {
        $response = $this->client->api(
            "api/merchant/invoice/remove",
            Method::POST->value,
            [],
            [
                'invoiceId' => $invoiceId
            ]
        );

        return $response;
    }

    /**
     * Get detailed info about successfully paid invoice
     * @param string $invoiceId
     * @return Response
     */
    public function detailedInfoSuccessInvoice(
        string $invoiceId
    ): Response
    {
        $response = $this->client->api(
            "api/merchant/invoice/payment-info",
            Method::GET->value,
            [],
            [
                'invoiceId' => $invoiceId
            ]
        );

        return $response;
    }

    /**
     * Get verification key for checking validity of webhook requests
     * @return Response
     */
    public function verificationKey(): Response
    {
        $response = $this->client->api(
            "api/merchant/pubkey",
            Method::GET->value,
            [],
            []
        );

        return $response;
    }

    /**
     * Finalize hold sum
     * @param string $invoiceId
     * @return Response
     */
    public function finalizeHoldSum(
        string $invoiceId
    ): Response
    {
        $response = $this->client->api(
            "api/merchant/invoice/finalize",
            Method::POST->value,
            [],
            [
                'invoiceId' => $invoiceId
            ]
        );

        return $response;
    }

    /**
     * Get qr cash info, only for activated qr-cashes
     * @param string $qrId
     * @return Response
     */
    public function infoQrCash(
        string $qrId
    ): Response
    {
        $response = $this->client->api(
            "api/merchant/qr/details",
            Method::GET->value,
            [],
            [
                'qrId' => $qrId
            ]
        );

        return $response;
    }

    /**
     * Reset qr cash amount
     * @param string $qrId
     * @return Response
     */
    public function qrCashResetAmount(
        string $qrId
    ): Response
    {
        $response = $this->client->api(
            "api/merchant/qr/reset-amount",
            Method::POST->value,
            [],
            [
                'qrId' => $qrId
            ]
        );

        return $response;
    }

    /**
     * Get qr cash list
     * @return Response
     */
    public function qrCashList(): Response
    {
        $response = $this->client->api(
            "api/merchant/qr/list",
            Method::GET->value,
            [],
            []
        );

        return $response;
    }

    /**
     * Get your merchant info
     * @return Response
     */
    public function merchantInfo(): Response
    {
        $response = $this->client->api(
            "api/merchant/details",
            Method::GET->value,
            [],
            []
        );

        return $response;
    }

    /**
     * Get merchant statement for selected period
     * @param int $from
     * @param int|null $to
     * @return Response
     */
    public function merchantStatement(
        int $from,
        int $to = null
    ): Response
    {
        $response = $this->client->api(
            "api/merchant/statement",
            Method::GET->value,
            [],
            [
                'from' => $from,
                'to' => $to
            ]
        );

        return $response;
    }

    /**
     * Delete merchant token
     * @param string $cardToken
     * @return Response
     */
    public function deleteMerchantCard(
        string $cardToken
    ): Response
    {
        $response = $this->client->api(
            "api/merchant/wallet/card",
            Method::DELETE->value,
            [],
            [
                'cardToken' => $cardToken
            ]
        );

        return $response;
    }

    /**
     * Get merchant cards in wallet
     * @param string $walletId
     * @return Response
     */
    public function merchantWallet(
        string $walletId
    ): Response
    {
        $response = $this->client->api(
            "api/merchant/wallet",
            Method::GET->value,
            [],
            [
                'walletId' => $walletId
            ]
        );

        return $response;
    }

    /**
     * Create invoice by card token
     * @param string $cardToken
     * @param int $amount
     * @param InitiationKind $initiationKind
     * @param Currency $currency
     * @param bool $tds
     * @param string|null $redirectUrl
     * @param string|null $webhookUrl
     * @return Response
     */
    public function createInvoiceByCardToken(
        string $cardToken,
        int $amount,
        InitiationKind $initiationKind,
        Currency $currency = Currency::UAH,
        bool $tds = null,
        string $redirectUrl = null,
        string $webhookUrl = null
    ): Response
    {
        $response = $this->client->api(
            "api/merchant/wallet/payment",
            Method::POST->value,
            [],
            [
                'cardToken' => $cardToken,
                'amount' => $amount,
                'ccy' => $currency->value,
                'tds' => $tds,
                'redirectUrl' => $redirectUrl,
                'webHookUrl' => $webhookUrl,
                'initiationKind' => $initiationKind
            ]
        );

        return $response;
    }
}
