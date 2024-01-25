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

function getTransaction(string $fileDir) : array {
  if(!file_exists($fileDir)) {
    trigger_error('File ' . $fileDir . ' does not exist', E_USER_ERROR);
  }

  $file = fopen($fileDir, 'r');
  $transactions = [];

  while (($transaction=fgetcsv($file))!==false) {
    $transactions[] = $transaction;
  }
  return $transactions;
}