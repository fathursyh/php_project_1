<!DOCTYPE html>
<html>

<head>
    <title>Transactions</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
        }

        table tr th,
        table tr td {
            padding: 5px;
            border: 1px #eee solid;
        }

        tfoot tr th,
        tfoot tr td {
            font-size: 20px;
        }

        tfoot tr th {
            text-align: right;
        }
    </style>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Check #</th>
                <th>Description</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <!-- YOUR CODE -->
            <?php
            if (!empty($transactions)) :
                foreach ($transactions as $transaction) : ?>
                    <tr>
                        <td><?= formatDate($transaction['date']) ?></td>
                        <td><?= $transaction['checkNumber'] ?></td>
                        <td><?= $transaction['description'] ?></td>
                        <td><span style='color: <?= ($transaction['amount']<0)? 'red' : 'green' ?>'><?= formatDollarAmount($transaction['amount']) ?></span></td>
                    </tr>
            <?php endforeach;
            endif;
            ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3">Total Income:</th>
                <td><?= formatDollarAmount($totals['totalIncome'] ?? 0) ?></td>
            </tr>
            <tr>
                <th colspan="3">Total Expense:</th>
                <td><?= formatDollarAmount($totals['totalExpense'] ?? 0) ?></td>
            </tr>
            <tr>
                <th colspan="3">Net Total:</th>
                <td><strong><?= formatDollarAmount($totals['netTotal'] ?? 0) ?></strong></td>
            </tr>
        </tfoot>
    </table>
</body>

</html>