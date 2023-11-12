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
        'Inter': ['Inter', 'sans-serif'],
      },
      colors: {
        mainColor: '#1A8889',
        secondaryColor: '#F7A623',
        tertiaryColor: '#A7D3D4',
        semiBlack: 'rgba(0,0,0,0.4)',
        lightGrey: '#EDEDED',
        darkGrey: '#5F5F5F',
        mediumGrey: '#5c5c5c',
        mediumRed: '#FF0000',
        semiWhite: '#fefefe',
        plat: '#dedede',
      },
      animation: {
        scale: 'scale 3s infinite linear',
      },
      keyframes: {
        scale: {
          '0%': {
            scale: '100%',
          },
          '50%': {
            scale: '130%',
          },
          '100%': {
            scale: '100%',
          }
        },
      },
    },
  },
  plugins: [],
}
