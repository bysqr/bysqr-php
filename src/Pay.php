<?php


namespace Bysqr;


final readonly class Pay
{
    /**
     * @param array<\Bysqr\Payment> $payments Zoznam jednej alebo viacerých platieb v prípade hromadného príkazu. Hlavná (preferovaná) platba sa uvádza ako prvá.
     */
    public function __construct(
        #[Property(wrap: "Payment")]
        public array $payments,
    ) { }
}
