<?php

return [
    'userManagement'    => [
        'title'          => 'إدارة المستخدمين',
        'title_singular' => 'إدارة المستخدمين',
    ],
    'permission'        => [
        'title'          => 'الصلاحيات',
        'title_singular' => 'الصلاحية',
        'fields'         => [
            'id'                => 'الرقم',
            'id_helper'         => ' ',
            'title'             => 'الاسم',
            'title_helper'      => ' ',
            'created_at'        => 'تم الإنشاء في',
            'created_at_helper' => ' ',
            'updated_at'        => 'تم التعديل في',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'تم الحذف في',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role'              => [
        'title'          => 'أدوار',
        'title_singular' => 'دور',
        'fields'         => [
            'id'                => 'الرقم',
            'id_helper'         => ' ',
            'title'             => 'الاسم',
            'title_helper'       => ' ',
            'permissions'        => 'الصلاحيات',
            'permissions_helper' => ' ',
            'created_at'         => 'تم الإنشاء في',
            'created_at_helper'  => ' ',
            'updated_at'         => 'تم التعديل في',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'تم الحذف في',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'user'              => [
        'title'          => 'المستخدمين',
        'title_singular' => 'مستخدم',
        'fields'         => [
            'id'                        => 'الرقم',
            'id_helper'                 => ' ',
            'name'                      => 'الإسم',
            'name_helper'               => ' ',
            'email'                     => 'البريد الإليكتروني',
            'email_helper'              => ' ',
            'email_verified_at'         => 'تم تأكيد الإميل في',
            'email_verified_at_helper'  => ' ',
            'password'                  => 'كلمه المرور',
            'password_helper'           => ' ',
            'roles'                     => 'الأدوار',
            'roles_helper'              => ' ',
            'remember_token'            => 'Remember Token',
            'remember_token_helper'     => ' ',
            'created_at'                => 'تم الإنشاء في',
            'created_at_helper'         => ' ',
            'updated_at'                => 'تم التحديث في',
            'updated_at_helper'         => ' ',
            'deleted_at'                => 'تم الحذف في',
            'deleted_at_helper'         => ' ',
            'branch'                    => 'الفرع',
            'branch_helper'             => ' ',
            'approved'                  => 'مفعل ؟',
            'approved_helper'           => ' ',
            'verified'                  => 'تم تأكيده',
            'verified_helper'           => ' ',
            'verified_at'               => 'تم تأكيده في',
            'verified_at_helper'        => ' ',
            'verification_token'        => 'Verification token',
            'verification_token_helper' => ' ',
            'user_no'                   => 'رقم المستخدم',
            'user_no_helper'            => ' ',
            'gender'                    => 'النوع',
            'gender_helper'             => ' ',
            'mobile_no'                 => 'رقم الجوال',
            'mobile_no_helper'          => ' ',
            'sales_perc'                => 'نسبه المبيعات',
            'sales_perc_helper'         => ' ',
            'photo'                     => 'الصوره',
            'photo_helper'              => ' ',
        ],
    ],
    'expenseManagement' => [
        'title'          => 'إدارة المصاريف',
        'title_singular' => 'إدارة المصاريف',
    ],
    'expenseCategory'   => [
        'title'          => 'تصنيف النفقات',
        'title_singular' => 'تصنيف المصروفات',
        'fields'         => [
            'id'                        => 'الرقم',
            'id_helper'                 => ' ',
            'name'                      => 'الإسم',
            'name_helper'       => ' ',
            'created_at'        => 'تم الإنشاء في',
            'created_at_helper' => ' ',
            'updated_at'        => 'تم التعديل في',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'تم الحذف في',
            'deleted_at_helper' => ' ',
        ],
    ],
    'incomeCategory'    => [
        'title'          => 'تصنيفات الإيراد',
        'title_singular' => 'الإيراد حسب التصنيف',
        'fields'         => [
            'id'                        => 'الرقم',
            'id_helper'                 => ' ',
            'name'                      => 'الإسم',
            'name_helper'       => ' ',
            'created_at'        => 'تم الإنشاء في',
            'created_at_helper' => ' ',
            'updated_at'        => 'تم التعديل في',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'تم الحذف في',
            'deleted_at_helper' => ' ',
        ],
    ],
    'expense'           => [
        'title'          => 'المصروفات',
        'title_singular' => 'اعدادات',
        'fields'         => [
            'id'                      => 'الرقم',
            'id_helper'               => ' ',
            'expense_category'        => 'مجموعه المصروف',
            'expense_category_helper' => ' ',
            'entry_date'              => 'تاريخ الإدخال',
            'entry_date_helper'       => ' ',
            'amount'                  => 'القيمه',
            'amount_helper'           => ' ',
            'description'             => 'الوصف',
            'description_helper'      => ' ',
            'supplier'             => 'المورد',
            'supplier_helper'      => ' ',

            'created_at'              => 'تم الإنشاء في',
            'created_at_helper'       => ' ',
            'updated_at'              => 'تم التعديل في',
            'updated_at_helper'       => ' ',
            'deleted_at'              => 'تم الحذف في',
            'deleted_at_helper'       => ' ',
        ],
    ],
    'income'            => [
        'title'          => 'الإيرادات',
        'title_singular' => 'الإيرادات',
        'fields'         => [
            'id'                     => 'الرقم',
            'id_helper'              => ' ',
            'income_category'        => 'مجموعه الدخل',
            'income_category_helper' => ' ',
            'entry_date'             => 'تاريخ الإدخال',
            'entry_date_helper'      => ' ',
            'customer'             => 'العميل',
            'customer_helper'      => ' ',

            'amount'                 => 'القيمه',
            'amount_helper'          => ' ',
            'description'            => 'الوصف',
            'description_helper'     => ' ',
            'created_at'             => 'تم الإنشاء في',
            'created_at_helper'      => ' ',
            'updated_at'             => 'تم التعديل في',
            'updated_at_helper'      => ' ',
            'deleted_at'             => 'تم الحذف في',
            'deleted_at_helper'      => ' ',
        ],
    ],
    'expenseReport'     => [
        'title'          => 'تقرير شهري',
        'title_singular' => 'تقرير شهري',
        'reports'        => [
            'title'             => 'التقارير',
            'title_singular'    => 'تقرير',
            'incomeReport'      => 'تقرير الإيرادات',
            'incomeByCategory'  => 'الإيراد حسب التصنيف',
            'expenseByCategory' => 'المصروف حسب التصنيف',
            'income'            => 'الإيرادات',
            'expense'           => 'المصروف',
            'profit'            => 'ربح',
        ],
    ],
    'branch'            => [
        'title'          => 'الفروع',
        'title_singular' => 'فرع',
        'fields'         => [
            'id'                     => 'الرقم',
            'id_helper'              => ' ',
            'name_arabic'            => 'الإسم عربي',
            'name_arabic_helper'     => ' ',
            'name_english'           => 'الإسم انجليزي',
            'name_english_helper'    => ' ',
            'address_arabic'         => 'العنوان عربي',
            'address_arabic_helper'  => ' ',
            'addtrss_english'        => 'العنوان انجليزي',
            'addtrss_english_helper' => ' ',
            'phone'                  => 'التليفون',
            'phone_helper'           => ' ',
            'tax_no'                 => 'الرقم الضريبي',
            'tax_no_helper'          => ' ',
            'tax_percent'            => 'نسبه الضريبه',
            'tax_percent_helper'     => ' ',
            'created_at'             => 'تم الإنشاء في',
            'created_at_helper'      => ' ',
            'updated_at'             => 'تم التعديل في',
            'updated_at_helper'      => ' ',
            'deleted_at'             => 'تم الحذف في',
            'deleted_at_helper'      => ' ',
        ],
    ],
    'setting'           => [
        'title'          => 'الإعدادات',
        'title_singular' => 'إعدادات',
        'fields'         => [
            'id'                           => 'الرقم',
            'id_helper'                    => ' ',
            'company_name_arabic'          => 'إسم الشركه عربي',
            'company_name_arabic_helper'   => ' ',
            'company_name_english'         => 'إسم الشركه إنجليزي',
            'company_name_english_helper'  => ' ',
            'barecode_printer'             => 'طابعه الباركود',
            'barecode_printer_helper'      => ' ',
            'recet_printer'                => 'طابعه الفواتير 8 سم',
            'recet_printer_helper'         => ' ',

            'recet_print_no'               => 'عدد نسخ طباعه الفواتير',
            'recet_print_no_helper'        => ' ',
            'purchse_tax'                  => 'ضريبه المبيعات',
            'purchse_tax_helper'           => ' ',
            'created_at'                   => 'تم الإنشاء في',
            'created_at_helper'            => ' ',
            'updated_at'                   => 'تم التعديل في',
            'updated_at_helper'            => ' ',
            'deleted_at'                   => 'تم الحذف في',
            'deleted_at_helper'            => ' ',
            'photo'                        => 'الصوره',
            'photo_helper'                 => ' ',
            'reports_email'                => 'إميل إرسال التقارير',
            'reports_email_helper'         => ' ',
            'reports_phone'                => 'رقم جوال التقارير',
            'reports_phone_helper'         => ' ',
            'send_invoice_customer'        => 'إرسال الفاتوره للعملاء',
            'send_invoice_customer_helper' => ' ',
        ],
    ],
    'basicData'         => [
        'title'          => 'البيانات الأساسيه',
        'title_singular' => 'Basic Data',
    ],
    'customer'          => [
        'title'          => 'العملاء',
        'title_singular' => 'عميل',
        'fields'         => [
            'id'                => 'الرقم',
            'id_helper'         => ' ',
            'name'              => 'الإسم',
            'name_helper'       => ' ',
            'address'           => 'العنوان',
            'address_helper'    => ' ',
            'phone'             => 'التليفون',
            'phone_helper'      => ' ',
            'company'           => 'الشركه',
            'company_helper'    => ' ',
            'email'             => 'البريد الإليكتروني',
            'email_helper'      => ' ',
            'photo'             => 'الصوره',
            'photo_helper'      => ' ',
            'first_mony'        => 'الرصيد الإفتتاحي',
            'first_mony_helper' => ' ',
            'fin_mony'          => 'الرصيد الختامي',
            'fin_mony_helper'   => ' ',

            'created_at'        => 'تم الإنشاء في',
            'created_at_helper' => ' ',
            'updated_at'        => 'تم التعديل في',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'تم الحذف في',
            'deleted_at_helper' => ' ',
        ],
    ],
    'smsSetting'        => [
        'title'          => 'إعدادات الرسائل القصيره',
        'title_singular' => 'إعداد الرسائل',
        'fields'         => [
            'id'                   => 'الرقم',
            'id_helper'            => ' ',
            'user_name'            => 'إسم المستخدم',
            'user_name_helper'     => ' ',
            'password'             => 'كلمه المرور',
            'password_helper'      => ' ',
            'sender_name'          => 'إسم المرسل',
            'sender_name_helper'   => ' ',
            'message'              => 'الرساله',
            'message_helper'       => ' ',
            'receiver_no_1'        => 'رقم المستقبل 1',
            'receiver_no_1_helper' => ' ',
            'receiver_no_2'        => 'رقم المستقبل 2',
            'receiver_no_2_helper' => ' ',
            'receiver_no_3'        => 'رقم المستقبل 3',
            'receiver_no_3_helper' => ' ',
            'created_at'           => 'تم الإنشاء في',
            'created_at_helper'    => ' ',
            'updated_at'           => 'تم التعديل في',
            'updated_at_helper'    => ' ',
            'deleted_at'           => 'تم الحذف في',
            'deleted_at_helper'    => ' ',
        ],
    ],
    'salesInvoice'      => [
        'title'          => 'فواتير البيع',
        'title_singular' => 'فاتوره بيع',
        'fields'         => [
            'id'                     => 'الرقم',
            'id_helper'              => ' ',
            'inv_date'               => 'تاريخ الفاتوره',
            'date_helper'        => ' ',
            'invoice_time'           => 'وقت الفاتوره',
            'invoice_time_helper'    => ' ',
            'type'                   => 'تجزئه',
            'type_helper'            => ' ',
            'vat'                   => 'الضريبه',
            'vat_helper'            => ' ',
            'type'                   => 'تجزئه',
            'type_helper'            => ' ',
            'customer'               => 'العميل',
            'customer_helper'        => ' ',
            'customer_mobile'        => 'موبايل العميل',
            'customer_mobile_helper' => ' ',
            'customer_email'        => 'إميل العميل',
            'customer_email_helper' => ' ',

            'go_date'                => 'تاريخ الإرسال',
            'go_date_helper'         => ' ',
            'go_time'                => 'وقت الإرسال',
            'go_time_helper'         => ' ',
            'created_at'             => 'تم الإنشاء في',
            'created_at_helper'      => ' ',
            'updated_at'             => 'تم التعديل في',
            'updated_at_helper'      => ' ',
            'deleted_at'             => 'تم الحذف في',
            'deleted_at_helper'      => ' ',
            'total'              => 'إجمالي الأصناف',
            'total_helper'       => ' ',
            'total_due'              => 'إجمالي الفاتوره',
            'total_due_helper'       => ' ',
            'disc_perc'              => 'الخصم نسبه',
            'disc_perc_helper'       => ' ',
            'disc_val'              => 'الخصم قيمه',
            'disc_val_helper'       => ' ',
            'notes'              => 'ملاحظات',
            'notes_helper'       => ' ',
            'right' => 'Right',
            'left' => 'Left',

            'add' => 'Add',
            'add_helper'       => ' ',

            'axis' => 'Axis',
            'axis_helper'       => ' ',

            'cyl' => 'Cyl',
            'cyl_helper'       => ' ',

            'sph' => 'Sph',
            'sph_helper'       => ' ',

            'pid/d' => 'Pid/D',
            'pid/d_helper'       => ' ',
            


        ],
    ],
    'dailyWork'         => [
        'title'          => 'العمل اليومي',
        'title_singular' => 'Daily Work',
    ],
    'stockManagement'   => [
        'title'          => 'إداره المخزون',
        'title_singular' => 'إداره مخزون',
        'fields'         => [
            'id'                       => 'الرقم',
            'id_helper'                => ' ',
            'product'                  => 'المنتج',
            'product_helper'           => ' ',
            'prod_name'                => 'إسم المنتج',
            'prod_name_helper'         => ' ',
            'quant'                    => 'الكميه',
            'quant_helper'             => ' ',
            'add_to_stock'             => 'إضافه للمخزون',
            'add_to_stock_helper'      => ' ',
            'delete_from_stock'        => 'خصم من المخزون',
            'delete_from_stock_helper' => ' ',
            'created_at'               => 'تم الإنشاء في',
            'created_at_helper'        => ' ',
            'updated_at'               => 'تم التعديل في',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'تم الحذف في',
            'deleted_at_helper'        => ' ',
            'type'               => 'حاله الرصيد',
            'type_helper'        => ' ',
        ],
    ],
    'lensCompany'       => [
        'title'          => 'شركات العدسات',
        'title_singular' => 'شركه عدسات',
        'fields'         => [
            'id'                => 'الرقم',
            'id_helper'         => ' ',
            'name'              => 'الإسم',
            'name_helper'       => ' ',
            'created_at'        => 'تم الإنشاء في',
            'created_at_helper' => ' ',
            'updated_at'        => 'تم التعديل في',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'تم الحذف في',
            'deleted_at_helper' => ' ',
        ],
    ],
    'userAlert'         => [
        'title'          => 'User Alerts',
        'title_singular' => 'User Alert',
        'fields'         => [
            'id'                => 'الرقم',
            'id_helper'         => ' ',
            'alert_text'        => 'Alert Text',
            'alert_text_helper' => ' ',
            'alert_link'        => 'Alert Link',
            'alert_link_helper' => ' ',
            'user'              => 'Users',
            'user_helper'       => ' ',
            'created_at'        => 'تم الإنشاء في',
            'created_at_helper' => ' ',
            'updated_at'        => 'تم التعديل في',
            'updated_at_helper' => ' ',
        ],
    ],
    'category'          => [
        'title'          => 'أنواع الأصناف',
        'title_singular' => 'نوع الصنف',
        'fields'         => [
            'id'                 => 'الرقم',
            'id_helper'          => ' ',
            'name'               => 'الإسم',
            'name_helper'        => ' ',
            'created_at'         => 'تم الإنشاء في',
            'created_at_helper'  => ' ',
            'updated_at'         => 'تم التعديل في',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'تم الحذف في',
            'deleted_at_helper'  => ' ',
            'description'        => 'الوصف',
            'description_helper' => ' ',
            'photo'              => 'الصوره',
            'photo_helper'       => ' ',
        ],
    ],
    'product'           => [
        'title'          => 'الأصناف',
        'title_singular' => 'الصنف',
        'fields'         => [
            'id'                     => 'الرقم',
            'id_helper'              => ' ',
            'name'                   => 'الإسم',
            'name_helper'            => ' ',
            'description'            => 'الوصف',
            'description_helper'     => ' ',
            'price'                  => 'السعر',
            'price_helper'           => ' ',
            'supplier_price'         => 'سعر المورد',
            'supplier_price_helper'  => ' ',
            'tagzaa_price'           => 'سعر التجزئه',
            'tagzaa_price_helper'    => ' ',
            'gomla_price'            => 'سعر الجمله',
            'gomla_price_helper'     => ' ',
            'quant'                  => 'الكميه',
            'quant_helper'           => ' ',
            'max_discount'           => 'أقصي خصم',
            'max_discount_helper'    => ' ',
            'sales_incentive'        => 'عموله البيع',
            'sales_incentive_helper' => ' ',
            'type'                   => 'النوع',
            'type_helper'            => ' ',
            'barecode'                => 'الباركود',
            'barecode_helper'         => ' ',

            'category'               => 'نوع الصنف',
            'category_helper'        => ' ',
            'created_at'             => 'تم الإنشاء في',
            'created_at_helper'      => ' ',
            'updated_at'             => 'تم التعديل في',
            'updated_at_helper'      => ' ',
            'deleted_at'             => 'تم الحذف في',
            'deleted_at_helper'      => ' ',
            'lens_comp'              => 'شركه العدسات',
            'lens_comp_helper'       => ' ',
            'supplier'               => 'المورد',
            'supplier_helper'        => ' ',
            'photo'                  => 'الصوره',
            'photo_helper'           => ' ',
        ],
    ],
    'supplier'          => [
        'title'          => 'الموردين',
        'title_singular' => 'مورد',
        'fields'         => [
            'id'                => 'الرقم',
            'id_helper'         => ' ',
            'name'              => 'الإسم',
            'name_helper'       => ' ',
            'address'           => 'العنوان',
            'address_helper'    => ' ',
            'phone'             => 'التليفون',
            'phone_helper'      => ' ',
            'tax_no'             => 'الرقم الضريبي',
            'tax_no_helper'      => ' ',
            'email'             => 'البريد الإليكتروني',
            'email_helper'      => ' ',
            'created_at'        => 'تم الإنشاء في',
            'created_at_helper' => ' ',
            'updated_at'        => 'تم التعديل في',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'تم الحذف في',
            'deleted_at_helper' => ' ',
        ],
    ],
    'sphFrom'            => [
        'title'          => 'Sph From',
        'title_singular' => 'Sph From',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'sph_from'          => 'من Sph',
            'sph_from_helper'   => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'sphTo'              => [
        'title'          => 'Cylinder',
        'title_singular' => 'Cylinder',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'sph_to'            => 'Cylinder',
            'sph_to_helper'     => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'signaltype'         => [
        'title'          => 'Signaltype',
        'title_singular' => 'Signaltype',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'signal_type'        => 'نوع الإشاره',
            'signal_type_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'lensDiameter'       => [
        'title'          => 'Lens Diameter',
        'title_singular' => 'Lens Diameter',
        'fields'         => [
            'id'                   => 'ID',
            'id_helper'            => ' ',
            'lens_diameter'        => 'قطر العدسه',
            'lens_diameter_helper' => ' ',
            'created_at'           => 'Created at',
            'created_at_helper'    => ' ',
            'updated_at'           => 'Updated at',
            'updated_at_helper'    => ' ',
            'deleted_at'           => 'Deleted at',
            'deleted_at_helper'    => ' ',
        ],
    ],
    'len'                => [
        'title'          => 'العدسات',
        'title_singular' => 'العدسات',
        'fields'         => [
            'id'                   => 'ID',
            'id_helper'            => ' ',
            'lens_type'            => 'نوع العدسه',
            'lens_type_helper'     => ' ',
            'created_at'           => 'Created at',
            'created_at_helper'    => ' ',
            'updated_at'           => 'Updated at',
            'updated_at_helper'    => ' ',
            'deleted_at'           => 'Deleted at',
            'deleted_at_helper'    => ' ',
            'signal_type'          => 'نوع الإشاره',
            'signal_type_helper'   => ' ',
            'lens_diameter'        => 'قطر العدسه',
            'lens_diameter_helper' => ' ',
            'sph_from'             => 'من Sph',
            'sph_from_helper'      => ' ',
            'sph_to'               => 'إلي Sph',
            'sph_to_helper'        => ' ',
            'allowed_disc'         => 'الخصم المسموح به',
            'allowed_disc_helper'  => ' ',
            'notes'                => 'ملاحظات',
            'notes_helper'         => ' ',
        ],
    ],

];
