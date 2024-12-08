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
                'red': {
                    '100': '#f9d3cc',
                    '200': '#f3a699',
                    '300': '#ed7a66',
                    '400': '#e74d33',
                    '500': '#e12100',
                    '600': '#b41a00',
                    '700': '#871400',
                    '800': '#5a0d00',
                    '900': '#2d0700'
                },
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
                'blue': {
                    '50': '#f0f5fe',
                    '100': '#dee8fb',
                    '200': '#c4d9f9',
                    '300': '#9cc1f4',
                    '400': '#6d9eed',
                    '500': '#4b7de6',
                    '600': '#365fda',
                    '700': '#2d4cc8',
                    '800': '#2a3fa3',
                    '900': '#25367a',
                    '950': '#1c254f',
                },
                'yellow': {
                    '50': '#fffbed',
                    '100': '#fff7d4',
                    '200': '#ffeba8',
                    '300': '#ffda72',
                    '400': '#febe39',
                    '500': '#fda712',
                    '600': '#ef8b08',
                    '700': '#c56a09',
                    '800': '#9c5210',
                    '900': '#7e4510',
                    '950': '#442106',
                },



            },
            borderRadius: {
                // Add new sizes
                '3xl': '1.5rem',
                '4xl': '2rem',
                '2xl': '1.25rem',
            },
        }
    },
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography')
    ],
    important: true
}
