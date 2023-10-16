/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      fontFamily: {
        'Trip': ['Trip', 'sans'],
        'TripBold': ['TripBold', 'sans'],
      },
      colors: {
        mainColor: '#1A8889',
        secondaryColor: '#F7A623',
        tertiaryColor: '#A7D3D4',
        semiBlack: 'rgba(0,0,0,0.4)'
      },
    },
  },
  plugins: [],
}
