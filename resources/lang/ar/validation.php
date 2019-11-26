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

    'accepted'             => 'يجب قبول :attribute',
    'active_url'           => ':attribute ليس رابط صحيح.',
    'after'                => ':attribute يجب أن يكون تاريخ بعد :date.',
    'alpha'                => ':attribute يجب أن يحتوي أحرف فقط.',
    'alpha_dash'           => ':attribute يجب أن يحتوي أحرف, أرقام, وشرطات.',
    'alpha_num'            => ':attribute يجب أن يحتوي أحرف وأرقام.',
    'array'                => ':attribute يجب أن تكون مصفوفة.',
    'before'               => ':attribute يجب أن يكون تاريخ قبل :date.',
    'between'              => [
        'numeric' => ':attribute يجب أن يكون بين :min و :max.',
        'file'    => ':attribute يجب أن يكون بين :min و :max كيلوبايت.',
        'string'  => ':attribute يجب أن يكون بين :min و :max رمز.',
        'array'   => ':attribute يجب أن تحتوي بين :min و :max عناصر.',
    ],
    'boolean'              => ':attribute يجب أن يكون نعم أو لا.',
    'confirmed'            => 'تأكيد :attribute لا تتطابق',
    'country'              => ':attribute ليس بلداً صحيحاً.',
    'date'                 => ':attribute ليس تاريخاً صحيحاً.',
    'date_format'          => ':attribute لا يطابق التق :format.',
    'different'            => ':attribute و :other يجب أن يختلفان.',
    'digits'               => ':attribute يجب أن تكون :digits رقم.',
    'digits_between'       => ':attribute يجب أن تكون بين :min و :max رقم.',
    'distinct'             => ':attribute يحتوي قيم مكررة.',
    'email'                => 'يجب أن يكون :attribute صحيح.',
    'exists'               => ':attribute المحددة غير صحيحة.',
    'filled'               => 'حقل :attribute اجباري.',
    'image'                => ':attribute يجب أن تكون صورة.',
    'in'                   => ':attribute المحددة غير صحيحة.',
    'in_array'             => ':attribute غير موجود في :other.',
    'integer'              => ':attribute يجب أن يكون رقماً.',
    'ip'                   => ':attribute يجب أن يكون عنوان IP صحيح.',
    'json'                 => ':attribute يجب أن يكون بتنسيق JSON.',
    'max'                  => [
        'numeric' => ':attribute يجب أن لا يكون أكبر من :max.',
        'file'    => ':attribute يجب أن لا يكون أكبر من :max كيلوبايت.',
        'string'  => ':attribute يجب أن لا يكون أكبر من :max رمز.',
        'array'   => ':attribute يجب أن لا يحتوي أكثر من :max عناصر.',
    ],
    'mimes'                => ':attribute يجب أن يكون ملف من نوع type: :values.',
    'min'                  => [
        'numeric' => ':attribute لا بد أن يكون على الأقل :min.',
        'file'    => ':attribute لا بد أن يكون على الأقل :min كيلوبايت.',
        'string'  => ':attribute يجب أن لا تقل عن :min أحرف.',
        'array'   => ':attribute لا بد أن يحتوي على الأقل :min عناصر.',
    ],
    'not_in'               => ':attribute المحدد غير صحيح.',
    'numeric'              => ':attribute يجب أن يكون رقم.',
    'present'              => 'حقل :attribute يجب أن يكون موجود.',
    'regex'                => 'تنسيق :attribute غير صحيح.',
    'required'             => 'حقل :attribute اجباري.',
    'required_if'          => 'حقل :attribute اجباري عندما يكون :other :value.',
    'required_unless'      => 'حقل :attribute اجباري إلا أذا :other يكون :values.',
    'required_with'        => 'حقل :attribute اجباري عندما :values يكون موجود.',
    'required_with_all'    => 'حقل :attribute اجباري عندما :values يكون موجود.',
    'required_without'     => 'حقل :attribute اجباري عندما :values لا يكون موجود.',
    'required_without_all' => 'حقل :attribute اجباري عندما لا شيئ من :values موجود.',
    'same'                 => ':attribute و :other يجب أن يتطابقا.',
    'size'                 => [
        'numeric' => ':attribute يجب أن يكون :size.',
        'file'    => ':attribute يجب أن يكون :size كيلوبايت.',
        'string'  => ':attribute يجب أن يكون :size رمز.',
        'array'   => ':attribute يجب أن يحتوي :size عناصر.',
    ],
    'state'                => 'هذه الولاية غير صحيحة للبلد المحدد.',
    'string'               => ':attribute يحب أن تكون كلمات.',
    'timezone'             => ':attribute يجب أن تكون منطقة صحيحة.',
    'unique'               => 'تم استعمال :attribute من قبل.',
    'url'                  => 'تنسيق :attribute غير صحيح.',
    'vat_id'               => 'رقم تعريف ضريبة القيمة المضافة هذا غير صحيح.',

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
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'team' => Spark::teamString(),
        'email' => "البريد الالكتروني",
        'password' => "كلمة السر",
        'name' => "الاسم",
        'terms' => "شروط الخدمة"
    ],

];
