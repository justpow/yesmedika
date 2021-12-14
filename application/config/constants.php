<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code


/*
|--------------------------------------------------------------------------
| PERMISSION MAPPING LIST
|--------------------------------------------------------------------------
|
| Do not edit or change the key and value. 
| The Key and Value must identical with the data in database.
| Update it only if there are permission changes in the database. 
*/
// Superadmin Permission.
define('READ_ALL', 100);
define('WRITE_ALL', 200);

// Register.
define('READ_REGISTER', 101);
define('WRITE_REGISTER', 201);

// Login.
define('READ_LOGIN', 102);
define('WRITE_LOGIN', 202);

// Logout.
define('LOGOUT', 103);

// Add to Cart.
define('ADD_TO_CART', 300);

// Checkout.
define('CHECKOUT', 400);

// MAPPING DB STATUS.

//Product.
$product = array(
    'DELETED' => 0,
    'NOT_ACTIVE' => 1,
    'ACTIVE' => 2
);
define('PRODUCT', $product);

//Variant.
$variant = array(
    'DELETED' => 0,
    'NOT_ACTIVE' => 1,
    'ACTIVE' => 2
);
define('VARIANT', $variant);


// MISC.
$misc = array(
    'MAX_PAGE' => 20
);
define('MISC', $misc);

// TRANSACTION STATUS.
$trans = array(
    'CANCELLED' => 0,
    'WAITING_PAYMENT' => 1,
    'ON_PROCESS' => 2,
    'ON_DELIVERY' => 3,
    'DELIVERED' => 4,
    'DONE' => 5,

    // FRONTEND NEEDS.
    0 => 'Dibatalkan',
    1 => 'Menunggu Pembayaran',
    2 => 'Diproses',
    3 => 'Dikirim',
    4 => 'Sampai Tujuan',
    5 => 'Selesai'
);
define('TRANS', $trans);


// PICKUP TYPE.
$pickup = array(
    'PICKUP_IN_STORE' => 1,
    'KURIR_TOKO' => 2,
    'JNE' => 3,
    //... DLL, Tapi bagusnya nanti ada tabel khusus kurir ya.

    1 => 'Ambil di Toko',
    2 => 'Kurir Toko',
    3 => 'JNE'
);
define('PICKUP', $pickup);


// PAYMENT TYPE.
$payment = array(
    'COD' => 1,
    'MANUAL' => 2,
    1 => 'COD',
    2 => 'Transfer Manual'
);
define('PAYMENT_TYPE', $payment);

// PAYMENT DOC.
$payment_doc = array(
    'WAITING' => 1,
    'DECLINED' => 2,
    'APPROVED' => 3,

    1 => 'Menunggu validasi',
    2 => 'Ditolak',
    3 => 'Disetujui'
);
define('PAYMENT_DOC_STATUS', $payment_doc);

// PAYMENT PROVIDER.
$payment_provider = array(
    'BCA' => 1,
    'BNI' => 2,
    'BRI' => 3,
    'MANDIRI' => 4,

    1 => 'BCA',
    2 => 'BNI',
    3 => 'BRI',
    4 => 'MANDIRI'
);
define('PAYMENT_PROVIDER', $payment_provider);


// COURIER CONFIG
$COURIER = array(
    'RAJAONGKIR_COST_URL' => 'https://api.rajaongkir.com/starter/cost',
    'KEY' => '7627644004174fe2cb9640722529485c',
);
define('COURIER', $COURIER);