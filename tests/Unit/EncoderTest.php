<?php

use Bysqr\BankAccount;
use Bysqr\Binary;
use Bysqr\Encoder;
use Bysqr\Pay;
use Bysqr\Payment;
use Bysqr\PaymentOption;

function createPay(): Pay
{
    return new Pay(payments: [
        new Payment(
            paymentOptions: PaymentOption::STANDING_ORDER,
            amount: 12.34,
            currencyCode: 'EUR',
            bankAccounts: [
                new BankAccount(
                    iban: 'SK8811000000002945102347',
                )
            ]
        )
    ]);
}

it('should encode to svg', function () {
    $svg = Encoder::make(createPay())->toSvg();

    expect($svg)->toStartWith('<svg');
})->skip(fn () => Binary::unsupported());

it('should encode to png', function () {
    $svg = Encoder::make(createPay())->toPng();

    expect($svg)->toStartWith('data:image/png;base64,');
})->skip(fn () => Binary::unsupported());

it('should encode to jpeg', function () {
    $svg = Encoder::make(createPay())->toJpeg();

    expect($svg)->toStartWith('data:image/jpeg;base64,');
})->skip(fn () => Binary::unsupported());
