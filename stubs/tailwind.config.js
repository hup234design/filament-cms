/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./vendor/hup234design/filament-cms/**/*.php",
    ],
    theme: {
        container: {
            center: true,
            padding: {
                DEFAULT: '2rem',
                sm: '3rem',
                lg: '4rem',
                xl: '6rem',
            },
        },
        extend: {},
    },
    plugins: [
        require('@tailwindcss/typography'),
        require('@tailwindcss/forms'),
    ],
}
