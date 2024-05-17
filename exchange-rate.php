<?php

$amount = (float)readline("Enter amount: ");
$fromCurrency = strtoupper(readline("Enter currency to convert from: "));
$toCurrency = strtoupper(readline("Enter currency to convert to: "));

$url = "https://api.frankfurter.app/latest";
$data = file_get_contents($url);
$rates = json_decode($data);

if ($fromCurrency === 'EUR') {
    $fromRate = 1.0;
} else {
    if (!isset($rates->rates->$fromCurrency)) {
        echo "Invalid currency input for converting from." . PHP_EOL;
        exit(1);
    }
    $fromRate = $rates->rates->$fromCurrency;
}

if (!isset($rates->rates->$toCurrency)) {
    echo "Invalid currency input for converting to." . PHP_EOL;
    exit(1);
}
$toRate = $rates->rates->$toCurrency;

$convertedAmount = ($amount / $fromRate) * $toRate;

echo number_format($convertedAmount, 2) . PHP_EOL;
