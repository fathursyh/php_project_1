<?php

declare(strict_types=1);

// Your Code

function getTransactionFiles($dir): array
{
  $files = [];

  foreach (scandir($dir) as $file) { // SCAN DIRECTORY
    if (is_dir($file)) { 
      continue; ## KALO DIA FOLDER, SKIP SCAN
    }
    else {
      $files[] = $dir . $file; ## MASUKIN PATH FILE KE ARRAY
    }
  }
  return $files;
}

## FUNCTION FOR GETTING THE TRANSACTIONS FROM CSV FILE AND INSERT THEM INTO ARRAY 
// transactionHandler jaga2 kalo format isi file transaksi lain (ex. beda urutan)
function getTransaction(string $fileDir, ?callable $transactionHandler = null) : array {
  if(!file_exists($fileDir)) {
    trigger_error('File ' . $fileDir . ' does not exist', E_USER_ERROR);
  }

  $file = fopen($fileDir, 'r');
  fgetcsv($file);

  $transactions = [];

  while (($transaction=fgetcsv($file))!==false) {
    if($transactionHandler!==null) {
      $transaction = $transactionHandler($transaction);
    }
    $transactions[] = $transaction;
  }
  return $transactions;
}

/** FUNCTION FOR MAKING THE ARRAY HAS KEYS 
 * AND CLEAN THE AMOUNT TABLE AND ALSO MAKE THE
 * VARIABLE OF AMOUNT TABLE TO FLOAT DATA TYPE*/ 
function readTransaction(array $transactionRow) : array {
  [$date, $checkNumber, $desc, $amount] = $transactionRow; // declare variable with initial value of the arguments given

  $amount = (float)str_replace(['$', ','], '', $amount);
  return [
    'date' => $date,
    'checkNumber' => $checkNumber,
    'description' => $desc,
    'amount' => $amount,
  ];
}

function sumTotal(array $transactions) : array {
  $total = ['netTotal' => 0, 'totalIncome' => 0, 'totalExpense' => 0];
  foreach($transactions as $transaction) {
    $total['netTotal'] += $transaction['amount'];
    if($transaction['amount'] >= 0) {
      $total['totalIncome'] += $transaction['amount'];
    } else {
      $total['totalExpense'] += $transaction['amount'];
    }
  }
  return $total;
}