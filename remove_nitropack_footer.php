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
    exit; // Evita el acceso directo.
}

// Agrega el script al footer para que se ejecute al final
function forzar_display_none_script() {
    ?>
    <script>
    jQuery(document).ready(function(){
        // Primera estrategia: buscar por template
        const template = document.querySelector("template");
        if (template) {
            const previousElement = template.previousElementSibling;
            if (previousElement && previousElement.tagName.toLowerCase() === "div") {
                previousElement.style.display = "none";
            }
        }

        // Segunda estrategia: buscar elementos específicos de Nitropack
        function ocultarNitropack() {
            // Buscar todos los templates
            jQuery("template").each(function() {
                // Ocultar el elemento anterior si es un div
                let prev = jQuery(this).prev('div');
                if(prev.length) {
                    prev.css('display', 'none');
                }
                
                // Intentar ocultar por ID
                let templateId = jQuery(this).attr('id');
                if(templateId) {
                    jQuery("#" + templateId).css('display', 'none');
                    jQuery("#" + templateId).next().css('display', 'none');
                    jQuery("#" + templateId).next().next().css('display', 'none');
                }
            });

            // Buscar elementos que contengan texto específico de Nitropack
            jQuery("div").each(function() {
                if(jQuery(this).text().toLowerCase().includes('nitropack')) {
                    jQuery(this).css('display', 'none');
                }
            });
        }

        // Ejecutar múltiples veces para asegurar que se aplique
        ocultarNitropack();
        setTimeout(ocultarNitropack, 500);
        setTimeout(ocultarNitropack, 1500);
    });
    </script>
    <?php
}
add_action('wp_footer', 'forzar_display_none_script', 999);
