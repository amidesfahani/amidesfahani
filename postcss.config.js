module.exports = {
    processCssUrls: false,
    plugins: [
        require('tailwindcss')('./tailwind.config.js'),
		// require('postcss-color-function')(),
    ]
}