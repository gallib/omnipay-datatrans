<?php

namespace Omnipay\Datatrans;

/**
 * w-vision
 *
 * LICENSE
 *
 * This source file is subject to the MIT License
 * For the full copyright and license information, please view the LICENSE.md
 * file that are distributed with this source code.
 *
 * @copyright  Copyright (c) 2016 Woche-Pass AG (http://www.w-vision.ch)
 * @license    MIT License
 */

use Omnipay\Datatrans\Message\PurchaseRequest;
use Omnipay\Datatrans\Message\AuthorizeRequest;
use Omnipay\Datatrans\Message\CompletePurchaseRequest;

/**
 * Datatrans Gateway
 */
class Gateway extends AbstractDatatransGateway
{
    public function getName()
    {
        return 'Datatrans';
    }

    /**
     * Start an autjorize request
     *
     * @param array $parameters array of options
     * @return PurchaseRequest
     */
    public function authorize(array $parameters = array())
    {
        return $this->createRequest(AuthorizeRequest::class, $parameters);
    }

    /**
     * Start a purchase request
     *
     * @param array $parameters array of options
     * @return PurchaseRequest
     */
    public function purchase(array $parameters = array())
    {
        return $this->createRequest(PurchaseRequest::class, $parameters);
    }

    /**
     * Complete a purchase
     *
     * @param array $parameters
     * @return CompletePurchaseRequest
     */
    public function completePurchase(array $parameters = array())
    {
        return $this->createRequest(CompletePurchaseRequest::class, $parameters);
    }
}
