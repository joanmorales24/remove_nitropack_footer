<?php
/*
Plugin Name: Remove Nitropack Footer
Description: Este plugin remueve el footer de nitropack en la version gratuita
Plugin URI: https://joanmorales.com/remove-nitropack-footer/
Version: 3.2
Author: Joan Morales
Author URI: https://joanmorales.com/
*/

if (!defined('ABSPATH')) {
    exit; // Evitar acceso directo
}

// Agregar el script al frontend
function ocultar_nitropack_script() {
    ?>
    <script>
        (function() {
            document.addEventListener("DOMContentLoaded", function() {
                setTimeout(function() {
                    document.querySelectorAll("body > div").forEach(div => {
                        try {
                            if (div.shadowRoot) {
                                const style = document.createElement("style");
                                style.innerHTML = `div { display: none !important; }`;
                                div.shadowRoot.appendChild(style);
                            }
                        } catch (e) {
                            console.warn("No se pudo modificar el Shadow DOM");
                        }
                        div.style.display = "none";
                    });
                }, 2000);
            });
        })();
    </script>
    <?php
}
add_action('wp_footer', 'ocultar_nitropack_script', 100);
