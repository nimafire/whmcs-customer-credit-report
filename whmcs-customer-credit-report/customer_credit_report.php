<?php

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

use WHMCS\Database\Capsule;

/**
 * Module configuration
 */
function customer_credit_report_config()
{
    return [
        'name' => 'Customer Credit Report',
        'description' => 'Show list of clients with credit balance',
        'author' => 'AfaghHosting',
        'language' => 'english',
        'version' => '1.0',
        'fields' => []
    ];
}

/**
 * Module activation
 */
function customer_credit_report_activate()
{
    return [
        'status' => 'success',
        'description' => 'Module activated successfully',
    ];
}

/**
 * Module deactivation
 */
function customer_credit_report_deactivate()
{
    return [
        'status' => 'success',
        'description' => 'Module deactivated successfully',
    ];
}

/**
 * Admin area output
 */
function customer_credit_report_output($vars)
{
    echo '<h2>Clients with Available Credit</h2>';

    try {
        $clients = Capsule::table('tblclients')
            ->where('credit', '>', 0)
            ->select('id', 'firstname', 'lastname', 'email', 'credit')
            ->orderBy('credit', 'desc')
            ->get();

        if ($clients->isEmpty()) {
            echo '<p>No clients with credit found.</p>';
            return;
        }

        echo '<table style="border-collapse: collapse; width: 90%; margin-top: 20px; background: #fff; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">';
        echo '<tr style="background: #0073e6; color: white;">';
        echo '<th style="padding: 10px; border: 1px solid #ccc; text-align: left;">ID</th>';
        echo '<th style="padding: 10px; border: 1px solid #ccc; text-align: left;">Full Name</th>';
        echo '<th style="padding: 10px; border: 1px solid #ccc; text-align: left;">Email</th>';
        echo '<th style="padding: 10px; border: 1px solid #ccc; text-align: left;">Credit Amount</th>';
        echo '</tr>';

        foreach ($clients as $client) {
            $fullName = htmlspecialchars($client->firstname . ' ' . $client->lastname);
            $email = htmlspecialchars($client->email);
            $credit = number_format($client->credit, 2);
            $profileLink = "clientssummary.php?userid=" . intval($client->id);

            echo '<tr style="border: 1px solid #ccc;">';
            echo '<td style="padding: 10px; border: 1px solid #ccc;">' . intval($client->id) . '</td>';
            echo '<td style="padding: 10px; border: 1px solid #ccc;">';
            echo '<a href="' . $profileLink . '" target="_blank" style="color: #0073e6; text-decoration: none;">' . $fullName . '</a>';
            echo '</td>';
            echo '<td style="padding: 10px; border: 1px solid #ccc;">' . $email . '</td>';
            echo '<td style="padding: 10px; border: 1px solid #ccc;">$' . $credit . '</td>';
            echo '</tr>';
        }

        echo '</table>';
    } catch (Exception $e) {
        echo '<p style="color: red;">Error fetching data: ' . htmlspecialchars($e->getMessage()) . '</p>';
    }
}
