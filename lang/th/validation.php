<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'ต้องยอมรับ :attribute',
    'accepted_if' => 'ต้องยอมรับ :attribute เมื่อ :other คือ :value.',
    'active_url' => ':attribute ไม่ใช่ URL ที่ถูกต้อง',
    'after' => 'ข้อมูล :attribute ต้องเป็นวันที่หลังจาก :date.',
    'after_or_equal' => 'ข้อมูล :attribute ต้องเป็นวันที่หลังหรือเท่ากับ :date',
    'alpha' => 'ข้อมูล :attribute ต้องมีตัวอักษรเท่านั้น',
    'alpha_dash' => 'ข้อมูล :attribute ต้องประกอบด้วยตัวอักษร ตัวเลข ขีดกลาง และขีดล่างเท่านั้น',
    'alpha_num' => 'ข้อมูล :attribute ต้องประกอบด้วยตัวอักษรและตัวเลขเท่านั้น',
    'array' => 'ข้อมูล :attribute ต้องเป็น array',
    'ascii' => 'ข้อมูล :attribute ต้องประกอบด้วยอักขระและตัวเลขและตัวอักษรแบบไบต์เดี่ยวเท่านั้น',
    'before' => 'ข้อมูล :attribute ต้องเป็นวันที่ก่อน :date.',
    'before_or_equal' => 'ข้อมูล :attribute ต้องเป็นวันที่ก่อนหรือเท่ากับ :date',
    'between' => [
        'array' => 'ข้อมูล :attribute ต้องมีรายการระหว่าง :min และ :max รายการ',
        'file' => 'ข้อมูล :attribute ต้องอยู่ระหว่าง :min และ :max กิโลไบต์',
        'numeric' => 'ข้อมูล :attribute ต้องอยู่ระหว่าง :min และ :max.',
        'string' => 'ข้อมูล :attribute ต้องอยู่ระหว่าง :min และ :max ตัวอักษร',
    ],
    'boolean' => 'ช่อง :attribute ต้องเป็นจริงหรือเท็จ',
    'confirmed' => 'การยืนยัน :attribute ไม่ตรงกัน',
    'current_password' => 'รหัสผ่านไม่ถูกต้อง',
    'date' => 'ข้อมูล :attribute ไม่ใช่วันที่ที่ถูกต้อง',
    'date_equals' => 'ข้อมูล :attribute ต้องเป็นวันที่เท่ากับ :date.',
    'date_format' => 'ข้อมูล :attribute ไม่ตรงกับรูปแบบ :format.',
    'decimal' => 'ข้อมูล :attribute ต้องมี :ทศนิยม',
    'declined' => 'ข้อมูล :attribute ต้องถูกปฏิเสธ',
    'declined_if' => 'ข้อมูล :attribute ต้องถูกปฏิเสธเมื่อ :other คือ :value.',
    'different' => 'ข้อมูล :attribute และ :other ต้องแตกต่างกัน',
    'digits' => 'ข้อมูล :attribute ต้องเป็น :digits หลัก',
    'digits_between' => 'ข้อมูล :attribute ต้องอยู่ระหว่าง :min และ :max หลัก',
    'dimensions' => 'ข้อมูล :attribute มีขนาดภาพที่ไม่ถูกต้อง',
    'distinct' => 'ฟิลด์ :attribute มีค่าซ้ำกัน',
    'doesnt_end_with' => 'ข้อมูล :attribute ต้องไม่ลงท้ายด้วย :values.',
    'doesnt_start_with' => 'ข้อมูล :attribute ต้องไม่ขึ้นต้นด้วย :values.',
    'email' => 'ข้อมูล :attribute ต้องเป็นที่อยู่อีเมลที่ถูกต้อง',
    'ends_with' => 'ข้อมูล :attribute ต้องลงท้ายด้วย :values.',
    'enum' => 'ข้อมูล :attribute ที่เลือกไม่ถูกต้อง',
    'exists' => 'ข้อมูล :attribute ที่เลือกไม่ถูกต้อง',
    'file' => 'ข้อมูล :attribute ต้องเป็นไฟล์',
    'filled' => 'ช่อง :attribute ต้องมีค่า',
    'gt' => [
        'array' => 'ข้อมูล :attribute ต้องมีมากกว่า :value รายการ',
        'file' => 'ข้อมูล :attribute ต้องมากกว่า :value กิโลไบต์',
        'numic' => 'ข้อมูล :attribute ต้องมากกว่า :value.',
        'string' => 'ข้อมูล :attribute ต้องมากกว่า :value ตัวอักษร',
    ],
    'gte' => [
        'array' => 'ข้อมูล :attribute ต้องมี :value รายการขึ้นไป',
        'file' => 'ข้อมูล :attribute ต้องมากกว่าหรือเท่ากับ :value กิโลไบต์',
        'numeric' => 'ข้อมูล :attribute ต้องมากกว่าหรือเท่ากับ :value.',
        'string' => 'ข้อมูล :attribute ต้องมากกว่าหรือเท่ากับ :value ตัวอักษร',
    ],
    'image' => 'ข้อมูล :attribute ต้องเป็นรูปภาพ',
    'in' => 'ข้อมูล :attribute ที่เลือกไม่ถูกต้อง',
    'in_array' => 'ฟิลด์ :attribute ไม่มีอยู่ใน :other.',
    'integer' => 'ข้อมูล :attribute ต้องเป็นจำนวนเต็ม',
    'ip' => 'ข้อมูล :attribute ต้องเป็นที่อยู่ IP ที่ถูกต้อง',
    'ipv4' => 'ข้อมูล :attribute ต้องเป็นที่อยู่ IPv4 ที่ถูกต้อง',
    'ipv6' => 'ข้อมูล :attribute ต้องเป็นที่อยู่ IPv6 ที่ถูกต้อง',
    'json' => 'ข้อมูล :attribute ต้องเป็นสตริง JSON ที่ถูกต้อง',
    'lowercase' => 'ข้อมูล :attribute ต้องเป็นตัวพิมพ์เล็ก',
    'lt' => [
        'array' => 'ข้อมูล :attribute ต้องมีน้อยกว่า :value รายการ',
        'file' => 'ข้อมูล :attribute ต้องน้อยกว่า :value กิโลไบต์',
        'numic' => 'ข้อมูล :attribute ต้องมีค่าน้อยกว่า :value.',
        'string' => 'ข้อมูล :attribute ต้องน้อยกว่า :value ตัวอักษร',
    ],
    'lte' => [
        'array' => 'ข้อมูล :attribute ต้องไม่มีมากกว่า :value รายการ',
        'file' => 'ข้อมูล :attribute ต้องน้อยกว่าหรือเท่ากับ :value กิโลไบต์',
        'numic' => 'ข้อมูล :attribute ต้องน้อยกว่าหรือเท่ากับ :value.',
        'string' => 'ข้อมูล :attribute ต้องน้อยกว่าหรือเท่ากับ :value ตัวอักษร',
    ],
    'mac_address' => 'ข้อมูล :attribute ต้องเป็นที่อยู่ MAC ที่ถูกต้อง',
    'max' => [
        'array' => 'ข้อมูล :attribute ต้องไม่เกิน :max รายการ',
        'file' => 'ข้อมูล :attribute ต้องไม่เกิน :max กิโลไบต์',
        'numeric' => 'ข้อมูล :attribute ต้องไม่เกิน :max.',
        'string' => 'ข้อมูล :attribute ต้องไม่เกิน :max ตัวอักษร',
    ],
    'max_digits' => 'ข้อมูล :attribute ต้องไม่เกิน :max หลัก',
    'mimes' => 'ข้อมูล :attribute ต้องเป็นไฟล์ประเภท: :values.',
    'mimetypes' => 'ข้อมูล :attribute ต้องเป็นไฟล์ประเภท : :values.',
    'min' => [
        'array' => 'ข้อมูล :attribute ต้องมีอย่างน้อย :min รายการ',
        'file' => 'ข้อมูล :attribute ต้องมีขนาดอย่างน้อย :min กิโลไบต์',
        'numeric' => 'ข้อมูล :attribute ต้องเป็น :min.',
        'string' => 'ข้อมูล :attribute ต้องมีความยาวอย่างน้อย :min ตัวอักษร',
    ],
    'min_digits' => 'ข้อมูล :attribute ต้องมี :min หลักเป็นอย่างน้อย',
    'multiple_of' => 'ข้อมูล :attribute ต้องเป็นผลคูณของ :value.',
    'not_in' => 'ข้อมูล :attribute ที่เลือกไม่ถูกต้อง',
    'not_regex' => 'รูปแบบ :attribute ไม่ถูกต้อง',
    'numeric' => 'ข้อมูล :attribute ต้องเป็นตัวเลข',
    'รหัสผ่าน' => [
        'letters' => 'ข้อมูล :attribute ต้องมีอย่างน้อย 1 ตัวอักษร',
        'mixed' => 'ข้อมูล :attribute ต้องมีอย่างน้อยหนึ่งตัวพิมพ์ใหญ่และหนึ่งตัวพิมพ์เล็ก',
        'numbers' => 'ข้อมูล :attribute ต้องมีอย่างน้อยหนึ่งตัวเลข',
        ' symbols' => ' :attribute ต้องมีอย่างน้อยหนึ่งสัญลักษณ์',
        'uncompromised' => 'ข้อมูล :attribute ที่ระบุปรากฏในการรั่วไหลของข้อมูล โปรดเลือก :attribute.',
    ],
    'present' => 'ช่อง :attribute ต้องมีอยู่',
    'prohibited' => 'ฟิลด์ :attribute เป็นสิ่งต้องห้าม',
    'prohibited_if' => 'ฟิลด์ :attribute ถูกห้ามเมื่อ :other คือ :value.',
    'prohibited_unless' => 'ช่อง :attribute เป็นสิ่งต้องห้าม เว้นแต่ :other จะอยู่ใน :values.',
    'prohibits' => 'ช่อง :attribute ห้าม :other ไม่ให้มีอยู่',
    'regex' => 'รูปแบบ :attribute ไม่ถูกต้อง',
    'required' => 'ต้องใส่ :attribute',
    'required_array_keys' => 'ฟิลด์ :attribute ต้องมีรายการสำหรับ: :values.',
    'required_if' => 'ฟิลด์ :attribute จำเป็นเมื่อ :other คือ :value.',
    'required_if_accepted' => 'ช่อง :attribute จำเป็นเมื่อ :other ได้รับการยอมรับ',
    'required_unless' => 'ช่อง :attribute จำเป็น ยกเว้น :other อยู่ใน :values.',
    'required_with' => 'ฟิลด์ :attribute จำเป็นเมื่อ :values มีอยู่',
    'required_with_all' => 'ฟิลด์ :attribute จำเป็นเมื่อ :values มีอยู่',
    'required_without' => 'ฟิลด์ :attribute จำเป็นเมื่อ :values ไม่มีอยู่',
    'required_without_all' => 'ช่อง :attribute จำเป็นเมื่อไม่มี :values อยู่',
    'same' => 'ข้อมูล :attribute และ :other ต้องตรงกัน',
    'size' => [
        'array' => 'ข้อมูล :attribute ต้องมี :size รายการ',
        'file' => 'ข้อมูล :attribute ต้องเป็น :size กิโลไบต์',
        'numic' => 'ข้อมูล :attribute ต้องเป็น :size.',
        'string' => 'ข้อมูล :attribute ต้องเป็น :size ตัวอักษร',
    ],
    'starts_with' => 'ข้อมูล :attribute ต้องขึ้นต้นด้วย :values.',
    'string' => 'ข้อมูล :attribute ต้องเป็นสตริง',
    'timezone' => 'ข้อมูล :attribute ต้องเป็นเขตเวลาที่ถูกต้อง',
    'unique' => 'ข้อมูล :attribute ได้ถูกนำไปใช้แล้ว',
    'uploaded' => ':attribute ล้มเหลวในการอัปโหลด',
    'uppercase' => 'ข้อมูล :attribute ต้องเป็นตัวพิมพ์ใหญ่',
    'url' => 'ข้อมูล :attribute ต้องเป็น URL ที่ถูกต้อง',
    'ulid' => 'ข้อมูล :attribute ต้องเป็น ULID ที่ถูกต้อง',
    'uuid' => 'ข้อมูล :attribute ต้องเป็น UUID ที่ถูกต้อง',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
