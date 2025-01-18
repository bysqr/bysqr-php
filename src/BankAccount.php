<?php


namespace Bysqr;


final readonly class BankAccount
{
    /**
     * @param string      $iban Medzinárodné číslo bankového účtu vo formáte IBAN.
     *                          Príklad: "SK8209000000000011424060".
     *                          Viac na http://www.sbaonline.sk/sk/projekty/financne-vzdelavanie/slovnik-bankovych-pojmov/iii/.
     * @param string|null $bic  Medzinárodný bankový identifikačný kód (z ang. Bank Identification Code).
     *                          Viac na http://www.sbaonline.sk/sk/projekty/financne-vzdelavanie/slovnik-bankovych-pojmov/bbb/bic.html.
     */
    public function __construct(
        #[Property(name: 'IBAN')]
        public string  $iban,

        #[Property(name: 'BIC')]
        public ?string $bic = null,
    ) { }
}
