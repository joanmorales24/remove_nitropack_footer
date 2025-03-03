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

// Agregar el script al frontend para ocultar el div generado
function ocultar_div_generado_script() {
    ?>
    <script>
        (function() {
            function ocultarDivGenerado() {
                // Obtener todos los templates en la página
                const templates = document.querySelectorAll("template");

                templates.forEach(template => {
                    let siguiente = template.nextElementSibling;

                    // Buscar el script que sigue al template
                    while (siguiente && siguiente.tagName !== "SCRIPT") {
                        siguiente = siguiente.nextElementSibling;
                    }

                    // Si hay un script, buscar el siguiente elemento que debe ser el div
                    if (siguiente) {
                        let divGenerado = siguiente.nextElementSibling;
                        
                        if (divGenerado && divGenerado.tagName === "DIV") {
                            divGenerado.style.display = "none !important";
                            console.log("Div generado ocultado:", divGenerado);
                        }
                    }
                });
            }

            // Esperar a que la página termine de cargar
            window.addEventListener("load", function() {
                setTimeout(ocultarDivGenerado, 2000); // Espera 2s por seguridad
            });
        })();
    </script>
    <?php
}
add_action('wp_footer', 'ocultar_div_generado_script', 100);
