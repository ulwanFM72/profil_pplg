import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";
import vue from "@vitejs/plugin-vue";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/public.css",
                "resources/js/public.js",
                "resources/css/admin.css",
                "resources/js/admin.js",
                "resources/js/admin-charts.js",
            ],
            refresh: true,
        }),
        tailwindcss(),
        vue(),
    ],
    server: {
        watch: {
            ignored: ["**/storage/framework/views/**"],
        },
    },
});
