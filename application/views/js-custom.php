<?php
// Ini dicopas ke footer di line paling terakhir
// Berfungsi untuk load js yang ditulis di module_js di controllers
foreach ($module_js as $item_js) {
    echo '
            <script src="' . base_url('assets/js-custom/' . $item_js . '.js') . '"></script>
        ';
}
?>