<?php 
// header
$line = [
    '拠点ID',
    '拠点名',
    '端末ID',
    '端末種別',
    '端末名称',
    '受入No',
    '上位IP',
    '下位IP',
    '予備機フラグ',
    'セキュリティソフト',
    '型式',
    '製造番号',
    '保守終了日',
    '設置日',
    'OS',
    'SQLServer',
    'AdminPass',
    '製造',
    'Appバージョン',
    'リモート',
    '稼働フラグ',
    '削除フラグ',
    ];
echo mb_convert_encoding(implode(',', $line), 'sjis');
echo "\r\n";

// body
if (!empty($center->devices))
{
    foreach ($center->devices as $d)
    {
        $line = [
            $center->id,
            $center->name,
            $d->id,
            $mDeviceTypes[$d->m_device_type_id],
            $d->name,
            $d->accepted_no,
            $d->ip_higher,
            $d->ip_lower,
            $d->reserve_flag,
            $d->security_flag,
            $d->model,
            $d->serial_no,
            $d->support_end_date,
            $d->setup_date,
            $d->m_operation_system_id,
            $d->m_sqlserver_id,
            $d->admin_pass,
            $d->m_product_id,
            $d->m_version_id,
            $d->remote,
            $d->running_flag,
            $d->delete_flag,
            ];
        echo mb_convert_encoding(implode(',', $line), 'sjis');
        echo "\r\n";
    }
}