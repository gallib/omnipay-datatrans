<?php

namespace Omnipay\Datatrans\Traits;

/**
 * Provides support for AcceptNotification and CompleteResponse,
 * which both read the final transaction results from the gateway.
 */

use Omnipay\Datatrans\Gateway;

trait HasCompleteResponse
{
    /**
     * @param string $name name of the data item
     * @param mixed the default value if the data item is not present
     * @return mixed
     */
    protected function getDataItem($name, $default = null)
    {
        if (array_key_exists($name, $this->getData())) {
            return $this->getData()[$name];
        }

        return $default;
    }

    /**
     * @return bool
     */
    public function isRedirect()
    {
        return false;
    }

    /**
     * Get the last 4 digits of the card number.
     *
     * @return string
     */
    public function getNumberLastFour()
    {
        return substr($this->getDataItem('maskedCC'), -4, 4) ?: null;
    }

    /**
     * Returns a masked credit card number with only the last 4 chars visible
     * Return an Omnipay format mask by default.
     * Set $mast to null to return the raw gateway masked card number.
     *
     * @param string $mask Character to use in place of numbers
     * @return string
     */
    public function getNumberMasked($mask = 'X')
    {
        $cardNumber = $this->getDataItem('maskedCC');

        if ($mask === null) {
            return $cardNumber;
        }

        $maskLength = strlen($cardNumber) - 4;
        return str_repeat($mask, $maskLength) . $this->getNumberLastFour();
    }

    /**
     * Get the card expiry month.
     *
     * @return int
     */
    public function getExpiryMonth()
    {
        return intval($this->getDataItem('expm'));
    }

    /**
     * Get the card expiry year.
     *
     * @return int
     */
    public function getExpiryYear()
    {
        return intval($this->getDataItem('expy'));
    }

    /**
     * Get the card expiry date, using the specified date format string.
     *
     * @param string $format
     * @return string
     */
    public function getExpiryDate($format)
    {
        return gmdate($format, gmmktime(0, 0, 0, $this->getExpiryMonth(), 1, $this->getExpiryYear()));
    }

    /**
     * @return bool
     */
    public function isSuccessful()
    {
        $status = $this->getStatus();

        return $status === Gateway::STATUS_SUCCESS;
    }

    /**
     * CHECKME: is the virtualCardno the same thing, but for specific payment methods?
     *
     * @return string|null the reusable card reference if requested by setting createCard
     */
    public function getCardReference()
    {
        return $this->getDataItem('aliasCC');
    }

    /**
     * Get the payment method used.
     *
     * @return string
     */
    public function getUsedPaymentMethod()
    {
        return $this->getDataItem('pmethod');
    }

    /**
     * Authorization code returned by credit card issuing bank
     * (length depending on payment method).
     * The internal authorizationCode is deprecated and should not
     * be used now.
     *
     * @return srtring
     */
    public function getAuthorizationCode()
    {
        return $this->getDataItem('acqAuthorizationCode');
    }

    /**
     * @return strong ISO currency code.
     */
    public function getCurrencyCode()
    {
        return $this->getDataItem('currency');
    }

    /**
     * This leaves room for the Omnipay 3.x version will return a Money
     * object for getAmount()
     *
     * @return int the amount in minor units
     */
    public function getAmountMinorUnits()
    {
        return intval($this->getDataItem('amount'));
    }

    /**
     * Authorization response code. See docs for details.
     * @return string '01' or '02'
     */
    public function getResponseCode()
    {
        return $this->getDataItem('responseCode');
    }

    public function getErrorDetail()
    {
        return $this->getDataItem('errorDetail');
    }

    /**
     * @return bool true if the original request was an authorize only
     */
    public function isAuthorize()
    {
        return $this->getDataItem('reqtype') === Gateway::REQTYPE_AUTHORIZE;
    }

    /**
     * @return bool true if the original request was a purchase (authorize+clearing)
     */
    public function isPurchase()
    {
        return $this->getDataItem('reqtype') === Gateway::REQTYPE_PURCHASE;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->getDataItem('errorMessage') ?: $this->getDataItem('responseMessage');
    }

    /**
     * @return string
     */
    public function getTransactionId()
    {
        return $this->getDataItem('refno', '');
    }

    /**
     * @return string
     */
    public function getTransactionReference()
    {
        return $this->getDataItem('uppTransactionId', '');
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->getDataItem('status');
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->getDataItem('errorCode');
    }
}