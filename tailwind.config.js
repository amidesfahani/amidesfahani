/** @type {import('tailwindcss').Config} */

const colors = require("tailwindcss/colors");
const plugin = require("tailwindcss/plugin");

function withOpacityValue(variable, opacityValue) {
    return () => {
        if (opacityValue === undefined) {
            return variable;
        }
        return `rgba(${hexToRgb(variable)}, ${opacityValue})`;
    }
}

function hexToRgb(hex) {
    // Expand shorthand form (e.g. "03F") to full form (e.g. "0033FF")
    var shorthandRegex = /^#?([a-f\d])([a-f\d])([a-f\d])$/i;
    hex = hex.replace(shorthandRegex, function(m, r, g, b) {
        return r + r + g + g + b + b;
    });

    var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
    return result ? parseInt(result[1], 16) + ", " + parseInt(result[2], 16) + ", " + parseInt(result[3], 16) : null;
}

const selectedColors = {
    black: colors.black,
    white: colors.white,
    gray: colors.zinc,
    yellow: colors.amber,
    test: colors.lime,

    primary: colors.amber,
    secondary: colors.slate
};

module.exports = {
	mode: 'jit',
    darkMode: 'media',
    content: [
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.{js,jsx,ts,tsx,vue}",
        "./resources/components/**/*.vue",
    ],
    theme: {
        colors: {
            transparent: "transparent",
            current: "currentColor",
            black: selectedColors.black,
            white: selectedColors.white,
            gray: selectedColors.gray,
            yellow: selectedColors.yellow,
            test: selectedColors.test,

            dark: {
                'main-color': selectedColors.primary['400'],
                'shadow-light': withOpacityValue(selectedColors.secondary['900'], .2),
                'shadow-lighter': withOpacityValue(selectedColors.secondary['900'], .1),

                'text-neon': withOpacityValue(selectedColors.secondary['100'], .4),

                'card-color': withOpacityValue(selectedColors.secondary['800'], 1),
                'card-color-light': withOpacityValue(selectedColors.secondary['800'], .98),
                'card-color-lighter': withOpacityValue(selectedColors.secondary['800'], .88),

                'card-color-secondary': withOpacityValue(selectedColors.secondary['900'], 1),
                'card-color-secondary-light': withOpacityValue(selectedColors.secondary['900'], .98),
                'card-color-secondary-lighter': withOpacityValue(selectedColors.secondary['900'], .88),

                'info-bar-primary': withOpacityValue(selectedColors.secondary['800'], 1),
                'info-bar-primary-light': withOpacityValue(selectedColors.secondary['800'], .98),
                'info-bar-primary-lighter': withOpacityValue(selectedColors.secondary['800'], .88),

                'info-bar-secondary': withOpacityValue(selectedColors.secondary['700'], 1),
                'info-bar-secondary-light': withOpacityValue(selectedColors.secondary['700'], .98),
                'info-bar-secondary-lighter': withOpacityValue(selectedColors.secondary['700'], .88),

                'content-color': withOpacityValue(selectedColors.secondary['800'], 1),
                'content-color-light': withOpacityValue(selectedColors.secondary['800'], .98),
                'content-color-lighter': withOpacityValue(selectedColors.secondary['800'], .88),

                'deep-color': withOpacityValue(selectedColors.secondary['900'], 1),
                'deep-color-light': withOpacityValue(selectedColors.secondary['900'], .98),
                'deep-color-lighter': withOpacityValue(selectedColors.secondary['900'], .88),

                'text-color': withOpacityValue(selectedColors.secondary['100'], 1),
                'text-color-light': withOpacityValue(selectedColors.secondary['400'], 1),
                'text-color-lighter': withOpacityValue(selectedColors.secondary['500'], 1),

                'top-bg-gradient': {
                    'lighter': withOpacityValue(selectedColors.secondary['800'], .93),
                    'light': withOpacityValue(selectedColors.secondary['800'], .96),
                    DEFAULT: withOpacityValue(selectedColors.secondary['800'], 1),
                    'dark': withOpacityValue(selectedColors.secondary['800'], .99),
                    'darker': withOpacityValue(selectedColors.secondary['800'], 1),
                },
            },

            light: {
                'main-color': selectedColors.primary['600'],
                'shadow-light': withOpacityValue(selectedColors.secondary['100'], .2),
                'shadow-lighter': withOpacityValue(selectedColors.secondary['100'], .1),

                'text-neon': withOpacityValue(selectedColors.secondary['900'], .4),

                'card-color': withOpacityValue(selectedColors.secondary['200'], 1),
                'card-color-light': withOpacityValue(selectedColors.secondary['200'], .98),
                'card-color-lighter': withOpacityValue(selectedColors.secondary['200'], .88),

                'card-color-secondary': withOpacityValue(selectedColors.secondary['100'], 1),
                'card-color-secondary-light': withOpacityValue(selectedColors.secondary['100'], .98),
                'card-color-secondary-lighter': withOpacityValue(selectedColors.secondary['100'], .88),

                'info-bar-primary': withOpacityValue(selectedColors.secondary['200'], 1),
                'info-bar-primary-light': withOpacityValue(selectedColors.secondary['200'], .98),
                'info-bar-primary-lighter': withOpacityValue(selectedColors.secondary['200'], .88),

                'info-bar-secondary': withOpacityValue(selectedColors.secondary['300'], 1),
                'info-bar-secondary-light': withOpacityValue(selectedColors.secondary['300'], .98),
                'info-bar-secondary-lighter': withOpacityValue(selectedColors.secondary['300'], .88),

                'content-color': withOpacityValue(selectedColors.secondary['200'], 1),
                'content-color-light': withOpacityValue(selectedColors.secondary['200'], .98),
                'content-color-lighter': withOpacityValue(selectedColors.secondary['200'], .88),

                'deep-color': withOpacityValue(selectedColors.secondary['100'], 1),
                'deep-color-light': withOpacityValue(selectedColors.secondary['100'], .98),
                'deep-color-lighter': withOpacityValue(selectedColors.secondary['100'], .88),

                'text-color': withOpacityValue(selectedColors.secondary['900'], 1),
                'text-color-light': withOpacityValue(selectedColors.secondary['600'], 1),
                'text-color-lighter': withOpacityValue(selectedColors.secondary['500'], 1),

                'top-bg-gradient': {
                    'lighter': withOpacityValue(selectedColors.secondary['200'], .93),
                    'light': withOpacityValue(selectedColors.secondary['200'], .96),
                    DEFAULT: withOpacityValue(selectedColors.secondary['200'], 1),
                    'dark': withOpacityValue(selectedColors.secondary['200'], .99),
                    'darker': withOpacityValue(selectedColors.secondary['200'], 1),
                },
            }
        },
        extend: {
            fontFamily: {
                farsi: [
                    "Peyda",
                    "Shabnam",
                    "Tahoma",
                    "Times New Roman",
                    "Times",
                    "serif",
                ],
                sans: ["Poppins", "courier", "Times New Roman", "Times", "serif"],
            },
            container: {
                center: true,
                padding: 0,
            },
			maxWidth: {
				container: '90rem',
                half: '50%',
                '1/4': '25%',
                '1/3': '33.333333%',
                '2/3': '66.666667%',
                '1/2': '50%'
			},
            spacing: {
                15: '3.75rem'
            },
            zIndex: {
                99: 99,
				999: 999,
				9999: 9999,
				99999: 99999,
                high: 99999999,
                max: "2147483647",
            },
        },
    },
    plugins: [
        plugin(function ({ addUtilities }) {
            const newUtilities = {
                ".ltr": {
                    direction: "ltr !important",
                    "text-align": "left",
                },
                ".rtl": {
                    direction: "rtl !important",
                },
            };
            addUtilities(newUtilities, ["responsive", "hover"]);
        }),
    ],
};
