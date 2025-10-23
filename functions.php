<?php

// ファイルを分割
//===================================================================
$function_files = [
  '/func/init.php', // 初期化用
  '/func/general.php', // カスタマイズ用
  '/func/shortcodes.php', // ショートコード追加用
];

foreach ($function_files as $file) {
  if ((file_exists(__DIR__ . $file))) {
    locate_template($file, true, true);
  } else {
    trigger_error("`$file`ファイルが見つかりません", E_USER_ERROR);
  }
}
