import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        tailwindcss(),
        laravel({
            input: [
                'resources/css/media.css',
                'resources/css/root.css',
                'resources/css/style.css',
                'resources/css/auth.css',
                'resources/css/fonts.css',
                'resources/css/variables.css',
                'resources/css/orders.css',
                'resources/css/users.css',

                'resources/js/module.js',
                'resources/js/theme.js',
                'resources/js/orders.js',
                'resources/js/profile.js'
            ],
            refresh: true,
        }),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
