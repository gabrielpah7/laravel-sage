<?php

/**
 * Copyright 2021 Sage Intacct, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"). You may not
 * use this file except in compliance with the License. You may obtain a copy
 * of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * or in the "LICENSE" file accompanying this file. This file is distributed on
 * an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either
 * express or implied. See the License for the specific language governing
 * permissions and limitations under the License.
 */

namespace Intacct\Functions\AccountsPayable;

use Intacct\Xml\XMLWriter;

class ApPaymentDetailCreditMemo implements IApPaymentDetail
{
    /** @var ApPaymentDetailInfo */
    private $info;

    public function __construct(ApPaymentDetailInfo $info)
    {
        $this->info = $info;
    }

    public function writeXml(XMLWriter &$xml): void
    {
        $xml->startElement("APPYMTDETAIL");

        $xml->writeElement("POSADJKEY", $this->info->recordNo, true);

        if (isset($this->info->lineRecordNo)) {
            $xml->writeElement("POSADJENTRYKEY", $this->info->lineRecordNo);
        }

        if (isset($this->info->detailTransaction)) {
            $this->info->detailTransaction->writeXml($xml);
        }

        if (isset($this->info->paymentAmount)) {
            $xml->writeElement("TRX_PAYMENTAMOUNT", $this->info->paymentAmount);
        }

        $xml->endElement(); // APPYMTDETAIL
    }
}
