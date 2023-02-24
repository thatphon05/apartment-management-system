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
    ]
];
