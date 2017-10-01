<?php

require_once __DIR__ . '/_bootstrap.php';

$defaults = array(
    //'key'      => '9fe630283b5a62833b04023c20e43915',
    //'secret'   => 'test',
    'key'       => '60ced422',
    'secret'    => '122f3a57615d1190752a6b7fcc60f901',
    'sender'   => array('name' => 'The Acme Company', 'address' => 'fluent@5sq.io'),
    'endpoint' => 'http://localhost/fluent/service/v3',
    //'endpoint' => 'https://fluent.clickapp.co.za/v3',
    'debug'    => true
);

$numbers = array(
    ['value' => '$95.00', 'caption' => 'Billed'], 
    ['value' => '$95.00', 'caption' => 'Paid'],
    ['value' => '$0.00', 'caption' => 'Balance']
);

try {
    $messageId = Fluent\Factory::message($defaults)->create()
        ->paragraph('We have just processed your monthly payment for Musixmatch monthly subscription (10 Feb - 9 Mar).')
        ->number($numbers)
        ->button('http://www.myinvoices.com', 'Download Invoice')
        ->paragraph('Please note the transaction will reflect on your statement as <b>"Musixmatch"</b>. Please <a href="#">contact us</a> if you have any questions about this receipt or your account.')
        ->teaser('This is a test receipt teaser.')
        ->title('Receipt')
        ->subject('Test E-mail Receipt')
        ->header('Reply-To', 'christianjburger@me.com')
        ->to('christianjburger@gmail.com')
        //->send(\Fluent\Transport::LOCAL);
        ->send(\Fluent\Transport::REMOTE);
    echo 'Sent message: ' . $messageId . "\n";
} catch (Fluent\Exception $e) {
    echo 'Error: ' . $e->getMessage() . "\n";
}
