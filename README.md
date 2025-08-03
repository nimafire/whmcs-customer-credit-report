# WHMCS Customer Credit Report
This is a simple WHMCS admin-only addon module that displays a table of all clients who currently have non-zero credit on their account.
ive always wonder how check all customers credit, who has credit and how much. this module is developed:

## Features

- Displays a sortable list of clients with credit
- Includes Client ID, Name, Email, and Credit Balance
- Links directly to client profiles
- Accessible only by logged-in WHMCS admins
- Secure and minimal: uses native WHMCS Capsule ORM

## Installation
1. Copy the folder `customer_credit_report` into your WHMCS `/modules/addons/` directory.
2. Log in to your WHMCS admin area.
3. Go to **System Settings > Addon Modules** (or **Setup > Addon Modules** in older versions).
4. Activate the **Customer Credit Report** module.
5. Set permissions to allow only authorized admin roles.
6. After activation, access the module from the WHMCS admin sidebar.

## Security
- The module checks for a valid admin session using `$_SESSION['adminid']`
- Cannot be accessed directly without being logged in as an administrator
- No write operations or sensitive data exposure

## Compatibility
- Tested with WHMCS 8.x+
- PHP 7.4 and above

