<?php
return array(
  'feed/edit/([0-9]+)' => 'test/edit/$1',   //удалить запись
  'feed/remove/([0-9]+)' => 'test/remove/$1',   //правка записи
  'feed/([0-9]+)' => 'test/view/$1',   //просмотр записи
  'upd' => 'test/upd',
  'test' => 'test/index',
  '' => 'test/index',
);
