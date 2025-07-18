import laravel from 'laravel-vite-plugin';
import { defineConfig } from 'vite';
import { run } from 'vite-plugin-run';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: [`resources/views/**/*`]
        }),
        run({
            input: [
                {
                    build: false,
                    run: ['php', 'artisan', 'ide-helper:generate']
                },
                {
                    run: ['php', 'artisan', 'ide-helper:models', '-N'],
                    pattern: ['app/Models/**/*.php']
                }
            ]
        })
    ],
    server: {
        cors: true
    }
});
