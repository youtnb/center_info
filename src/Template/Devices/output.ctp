<?php 
// header
$line = [
    '都道府県',
    'お客様名',
    'センター名',
    'TYPE',
    'McA',
    '上位IP',
    '下位IP',
    'サーバー名',
    '予備機',
    '機種',
    '予備HDD',
    '製造番号',
    '保証',
    '保守終了日',
    '設置日',
    'OS',
    'SQL',
    'Administartor',
    '会社',
    'Ver',
    '接続先',
    'リモート',
    '備考',
    ];
echo mb_convert_encoding(implode(',', $line), 'sjis');
echo "\r\n";

// body
foreach ($devices as $device)
{
    $line = [
        $device->has('center') ? $mPrefectures[$device->center->m_prefecture_id]: '',
        $mCustomers[$device->toArray()['center']['m_customer_id']],
        $device->has('center') ? $device->center->name: '',
        $device->has('m_device_type') ? $device->m_device_type->name: '',
        $device->security_flag ? $sec_flag[$device->security_flag] : '',
        $device->ip_higher,
        $device->ip_lower,
        $device->name,
        $device->reserve_flag ? 'v' : '',
        $device->model,
        '',
        $device->seria_no,
        '',
        $device->support_end_date,
        $device->setup_date,
        $device->has('m_operation_system') ? $device->m_operation_system->name: '',
        $device->has('m_sqlserver') ? $device->m_sqlserver->name: '',
        $device->admin_pass,
        $device->has('m_product') ? $device->m_product->name: '',
        $device->has('m_version') ? $device->m_version->name: '',
        $device->connect,
        $device->remote,
        '"'.$device->remarks.'"',
        ];
    echo mb_convert_encoding(implode(',', $line), 'sjis');
    echo "\r\n";
}