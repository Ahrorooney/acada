<?php
echo '<pre>' . var_export($auth_item_items, true) . '</pre>';
foreach ($auth_item_items as $item) {
    echo $item->name."<hr>";
}