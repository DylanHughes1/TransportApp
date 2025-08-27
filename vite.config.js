import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/scripts/Viajes/NuevoViaje.js',
                'resources/scripts/Spinner/Spinner.js',
                'resources/scripts/Sueldo/nomina.js',
                'resources/scripts/Sueldo/nuevaLinea.js',
                'resources/scripts/Sueldo/eliminarLinea.js',
            ],
            refresh: true,
            build: {
                rollupOptions: {
                    external: ['flowbite'],
                },
            },
        }),
    ],
});
