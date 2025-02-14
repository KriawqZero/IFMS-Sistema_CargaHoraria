/** @type {import('tailwindcss').Config} */
export default {
    mode: 'jit',
    important: true,
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.css',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {},
        screens: {
            sm: '640px',
            md: '768px',
            lg: '1024px',
            xl: '1281px',
        },
    },
    plugins: [],
    darkMode: 'false',
};
