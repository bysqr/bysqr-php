<?php

use Bysqr\BankAccount;
use Bysqr\Pay;
use Bysqr\Payment;
use Bysqr\PaymentOption;
use Bysqr\Serializer;

test('it should serialize to XML', function () {
    $pay = new Pay(payments: [
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

    $serializer = new Serializer();

    $json = $serializer->serialize($pay);

    expect($json)->json()
        ->Payments->Payment->toHaveCount(1)
        ->Payments->Payment->{0}->PaymentOptions->toBe('standingorder')
        ->Payments->Payment->{0}->Amount->toBe(12.34)
        ->Payments->Payment->{0}->CurrencyCode->toBe('EUR')
        ->Payments->Payment->{0}->BankAccounts->BankAccount->toHaveCount(1)
        ->Payments->Payment->{0}->BankAccounts->BankAccount->{0}->IBAN->toBe('SK8811000000002945102347')
    ;
});
