<?php

class Customer
{
    private $name;
    private $rentals = array();

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function addRental(Rental $rental)
    {
        array_push($this->rentals, $rental);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function statement(): string
    {
        $totalAmount = 0;
        $frequentRenterPoints = 0;
        $result = "";
        // $result = "<h1>Rental Record for " . $this->getName() . "\n</h1>";

        // determine amounts for each line
        foreach ($this->rentals as $rental) {
            $thisAmount = 0;

            switch ($rental->getMovie()->getPriceCode()) {
                case Movie::REGULAR:
                    $thisAmount += 2;
                    if($rental->getDaysRented() > 2)
                        $thisAmount += ($rental->getDaysRented() - 2) * 1.5;
                    break;
                case Movie::NEW_RELEASE:
                    $thisAmount += $rental->getDaysRented() * 3;
                    break;
                case Movie::CHILDRENS:
                    $thisAmount += 1.5;
                    if($rental->getDaysRented() > 3)
                        $thisAmount += ($rental->getDaysRented() - 3) *1.5;
                    break;
            }

            // add frequent renter points
            $frequentRenterPoints++;

            // add bonus for a two day new release rental
            if (($rental->getMovie()->getPriceCode() == Movie::NEW_RELEASE) && $rental->getDaysRented() > 1) {
                $frequentRenterPoints++;
            }

            // show figures for this rental
            $result .= '<p class="movie-item">';
            $result .= $rental->getMovie()->getTitle() . ': <strong>' . $thisAmount . '</strong>';
            $result .= '</p>';
            $totalAmount += $thisAmount;
        }

        // add footer lines
        $result .= '<footer class="info-footer">';
        $result .= '<p>Amount owed is : <i>' . $totalAmount . '</i></p>';
        $result .= '<p>You earned <i>' . $frequentRenterPoints . '</i> frequent renter points</p>';
        $result .= '</footer">';

        return $result;
    }
}
