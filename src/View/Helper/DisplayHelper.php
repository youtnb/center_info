<?php
namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\View;

/**
 * Display helper
 */
class DisplayHelper extends Helper
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    function thermo_list(Object $center)
    {
        $list = [];
        if($center->thermo_dry_flag)
        {
            $list[] = 'ドライ';
        }
        if($center->thermo_chilled_flag)
        {
            $list[] = 'チルド';
        }
        if($center->thermo_frozen_flag)
        {
            $list[] = 'フローズン';
        }
        
        if($list)
        {
            return implode(' / ', $list);
        }
        else
        {
            return '未設定';
        }
    }
}
