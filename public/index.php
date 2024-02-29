<?php

$codedir = '../src';

require_once("$codedir/Movie.php");
require_once("$codedir/Rental.php");
require_once("$codedir/Customer.php");

$prognosisNegative = new Movie("Prognosis Negative", Movie::NEW_RELEASE);
$sackLunch = new Movie("Sack Lunch", Movie::CHILDRENS);
$painAndYearning = new Movie("The Pain and the Yearning", Movie::REGULAR);

$customer = new Customer("Susan Ross");
$customer->addRental(
  new Rental($prognosisNegative, 3)
);
$customer->addRental(
  new Rental($painAndYearning, 1)
);
$customer->addRental(
  new Rental($sackLunch, 1)
);

$statement = $customer->statement();

// echo '<pre>';
// echo $statement;
// echo '</pre>';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AxisCare</title>

    <style>
        .customer-info{
            display: block;
            box-sizing: border-box;
            padding: 20px;
            border: 1px solid rgba(0, 0, 0, 0.12);
            border-radius: 4px;
            text-align: left;
            width: 100%;
            max-width: 340px;
            font-family: Arial;
        }
        .customer-info h1{
            font-style: italic;
            font-size: 24px;
            line-height: 1.2;
            padding: 0;
            margin: 0 0 5px;
        }
        .customer-info p{
            padding: 5px 0;
            margin: 0;
            font-size: 16px;
            line-height: 1.2;
        }
        .info-footer i{
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="customer-info">
        <div class="customer-name">
            <h1>Rentals for <?php echo $customer->getName(); ?></h1>
        </div>

        <div class="customer-statement">
            <?php echo $statement; ?>
        </div>
    </div>
</body>
</html>
