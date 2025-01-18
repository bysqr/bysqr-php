<?php


namespace Bysqr;


final readonly class Payment
{
    /**
     * @param \Bysqr\PaymentOption|array<\Bysqr\PaymentOption> $paymentOptions Možnosti platby sa dajú kombinovať. Oddeľujú sa medzerou a treba uviesť vždy aspoň jednu z možností.
     * @param float|int|null $amount Čiastka platby. Povolené sú len kladné hodnoty. Môže ostať nevyplnené, napríklad pre dobrovoľný príspevok (donations).
     * @param string $currencyCode Mena platby v ISO 4217 formáte (3 písmená skratka). Príklad: "EUR".
     * @param string|null $paymentDueDate Dátum splatnosti vo formáte ISO 8601 "RRRR-MM-DD". Nepovinný údaj. V prípade trvalého príkazu označuje dátum prvej platby.
     * @param string|null $variableSymbol Variabilný symbol je maximálne 10 miestne číslo. Nepovinný údaj.
     * @param string|null $constantSymbol Konštantný symbol je 4 miestne identifikačné číslo. Nepovinný údaj.
     * @param string|null $specificSymbol Špecifický symbol je maximálne 10 miestne číslo. Nepovinný údaj.
     * @param string|null $originatorsReferenceInformation Referenčná informácia prijímateľa podľa SEPA.
     * @param string|null $paymentNote Správa pre prijímateľa. Údaje o platbe, na základe ktorých príjemca bude môcť platbu identifikovať. Odporúča sa maximálne 140 Unicode znakov.
     * @param array<\Bysqr\BankAccount> $bankAccounts Zoznam bankových účtov.
     * @param string|null $beneficiaryName Rozšírenie o meno príjemcu
     * @param string|null $beneficiaryAddressLine1 Rozšírenie o adresu príjemcu
     * @param string|null $beneficiaryAddressLine2 Rozšírenie o adresu príjemcu (druhý riadok)
     */
    public function __construct(
        public PaymentOption|array $paymentOptions,
        public float|int|null      $amount,
        public string              $currencyCode,
        #[Property(wrap: 'BankAccount')]
        public array               $bankAccounts,
        public ?string             $paymentDueDate = null,
        public ?string             $variableSymbol = null,
        public ?string             $constantSymbol = null,
        public ?string             $specificSymbol = null,
        public ?string             $originatorsReferenceInformation = null,
        public ?string             $paymentNote = null,
        // TODO: StandingOrderExt
        // TODO: DirectDebitExt
        public ?string             $beneficiaryName = null,
        public ?string             $beneficiaryAddressLine1 = null,
        public ?string             $beneficiaryAddressLine2 = null,
    ) { }
}
