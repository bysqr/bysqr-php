<?php


namespace Bysqr;


enum PaymentOption: string
{
    /** platobný príkaz */
    case PAYMENT_ORDER = "paymentorder";
    /** trvalý príkaz, údaje sa vyplnia do StandingOrderExt */
    case STANDING_ORDER = "standingorder";
    /** inkaso, údaje sa vyplnia do DirectDebitExt */
    case DIRECT_DEBIT = "directdebit";
}
