<?php
/*
Plugin Name: Remove Nitropack Footer
Description: Este plugin remueve el footer de nitropack en la version gratuita
Plugin URI: https://joanmorales.com/remove-nitropack-footer/
Version: 3.0
Author: Joan Morales
Author URI: https://joanmorales.com/
*/

if (!defined('ABSPATH')) {
    exit; // Evita el acceso directo.
}

// Agrega el script al footer para que se ejecute al final
function forzar_display_none_script() {
    ?>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const template = document.querySelector("template");
            if (template) {
                const previousElement = template.previousElementSibling;
                if (previousElement && previousElement.tagName.toLowerCase() === "div") {
                    previousElement.style.display = "none";
                }
            }
        });
    </script>
    <?php
}
add_action('wp_footer', 'forzar_display_none_script', 999); // 999 para ejecutarlo al final