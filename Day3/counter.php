<?php
$counter = new Counter();

$counter->increment_and_update();
$value = $counter->get_count();
echo "<p> count = $value</p>";
