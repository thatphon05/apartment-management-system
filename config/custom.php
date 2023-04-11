<?php

return [
    /**
     * Attachment path
     */
    'id_card_copy_path' => 'id_card_copy',
    'copy_house_registration_path' => 'copy_house_registration',
    'rent_contract_path' => 'rent_contract',
    'payment_attachment_path' => 'payment_attachment',

    /**
     * Payment config
     */
    'due_date' => 5, // date which late payment every month
    'pay_within_day' => 15, // pay within how many days

    /**
     * Labels message
     */
    'labels' => [
        'room_available' => 'ว่าง',
        'room_booking' => 'ไม่ว่าง',
    ],

    /**
     * Apartment address
     */
    'address' => [
        'name' => 'โทพาซ',
        'line1' => '20/20 ม.2 ถ.กิ่งแก้ว',
        'line2' => 'ต.ราชาเทวะ อ.บางพลี',
        'line3' => 'จ.สมุทรปราการ 10540',
    ],

    /**
     * Bank account
     */
    'banking_account' => [
        'bank_name' => 'xxxx',
        'number' => 'xxx-xxx-xxx',
        'name' => 'xxxx xxxx',
    ],
];
