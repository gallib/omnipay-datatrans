<?php

namespace Omnipay\Datatrans\Traits;

/**
 * Setters and getters for parameters set at the Gateway level.
 */

trait HasGatewayParameters
{
    /**
     * @param $value
     * @return $this
     */
    public function setSign($value)
    {
        return $this->setParameter('sign', $value);
    }

    /**
     * @return string
     */
    public function getSign()
    {
        return $this->getParameter('sign');
    }

    /**
     * @param $value
     * @return string
     */
    public function setReturnMethod($value)
    {
        return $this->setParameter('returnMethod', $value);
    }

    /**
     * @return string
     */
    public function getReturnMethod()
    {
        return $this->getParameter('returnMethod');
    }

    /**
     * @param $value
     * @return string
     */
    public function setErrorUrl($value)
    {
        return $this->setParameter('errorUrl', $value);
    }

    /**
     * @return string
     */
    public function getErrorUrl()
    {
        return $this->getParameter('errorUrl');
    }

    /**
     * @param $value
     * @return string
     */
    public function setLanguage($value)
    {
        return $this->setParameter('language', $value);
    }

    /**
     * @return string
     */
    public function getLanguage()
    {
        return $this->getParameter('language');
    }

    /**
     * @param $value
     * @return mixed will be treated as boolean
     */
    public function setMaskedCard($value)
    {
        return $this->setParameter('maskedCard', $value);
    }

    /**
     * @return mixed
     */
    public function getMaskedCard()
    {
        return $this->getParameter('maskedCard');
    }
}
