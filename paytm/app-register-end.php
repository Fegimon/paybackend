<?php
if(function_exists('memory_get_usage') && ($usage = memory_get_usage()) != '')
{
$memory='Memory in use: ' . number_format($usage) . ' ('. ((memory_get_usage() / 1024) / 1024) .'MB)';
}
$bn->mark('loading_time:_base_classes_start');
$elapsed = $bn->elapsed_time('total_execution_time_start', 'total_execution_time_end');
$lodinginfo=<<<HTML
<p style="text-align: right;font-size: 11px;border-top: 1px solid #D0D0D0;line-height: 12px;bottom: 0;left: 0;position: fixed;right: 0;background-color: #fff;font: 13px/20px normal Helvetica, Arial, sans-serif;color: #4F5155;z-index:100000;">{$memory}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Page rendered in <strong>{$elapsed}</strong> seconds</p>
HTML;
if($App->page->response){echo $lodinginfo;}
?>