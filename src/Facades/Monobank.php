<?php

namespace Neverlxsss\Monobank\Facades;

use Illuminate\Support\Facades\Facade;
use Neverlxsss\Monobank\Support\Currency;
use Neverlxsss\Monobank\Support\InitiationKind;
use Neverlxsss\Monobank\Support\MerchantPaymentInfo;
use Neverlxsss\Monobank\Support\PaymentType;
use Neverlxsss\Monobank\Support\Response;

/**
 * Class Monobank
 *
 * @method static Response createInvoice(int $amount, Currency $currency = Currency::UAH, MerchantPaymentInfo $merchantPaymentInfo = null, string $redirectUrl = null, string $webhookUrl = null, int $validity = null, PaymentType $paymentType = PaymentType::DEBIT, string $qrId = null)
 * @method static Response getInvoiceStatus(string $invoiceId)
 * @method static Response deleteInvoice(string $invoiceId, string $extRef = null, int $amount = null, array $items = null)
 * @method static Response invalidateInvoice(string $invoiceId)
 * @method static Response detailedInfoSuccessInvoice(string $invoiceId)
 * @method static Response verificationKey()
 * @method static Response finalizeHoldSum(string $invoiceId)
 * @method static Response infoQrCash(string $qrId)
 * @method static Response qrCashResetAmount(string $qrId)
 * @method static Response qrCashList()
 * @method static Response merchantInfo()
 * @method static Response merchantStatement(int $from, int $to = null)
 * @method static Response deleteMerchantCard(string $cardToken)
 * @method static Response merchantWallet(string $walletId)
 * @method static Response createInvoiceByCardToken(string $cardToken, int $amount, InitiationKind $initiationKind, Currency $currency = Currency::UAH, bool $tds = null, string $redirectUrl = null, string $webhookUrl = null)
 *
 * @package Neverlxsss\Monobank\Facades
 */
class Monobank extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'monobank';
    }
}
