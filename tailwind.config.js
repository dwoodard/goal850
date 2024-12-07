export default {
    content: [
        './resources/**/*.antlers.html',
        './resources/**/*.blade.php',
        './content/**/*.md'
    ],
    theme: {
        fontFamily: {
            sans: ['Inter', 'sans'],
            mono: ['Menlo', 'monospace']
        },
        extend: {
            colors: {
                'teal': '#008483',
                'teal-light': '#a6d0cf',
                'green': {
                    '50': '#f2fcf1',
                    '100': '#e0f9df',
                    '200': '#c0f2c0',
                    '300': '#8fe68f',
                    '400': '#58d157',
                    '500': '#30b730',
                    '600': '#219121',
                    '700': '#1e771e',
                    '800': '#1d5e1e',
                    '900': '#194e1a',
                    '950': '#092a0b',
                },

            }
        }
    },
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography')
    ],
    important: true
}
