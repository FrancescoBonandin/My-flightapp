import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/scss/app.scss',
                'resources/js/app.js'
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            //Alias per la cartella /resources/
            '~resources': '/resources/',
            //Alias per la cartella /node_modules/bootstrap/
            '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap')
        }
    },
});
