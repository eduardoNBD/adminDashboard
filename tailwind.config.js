/** @type {import('tailwindcss').Config} */
export default {
  content: [ 
    "./resources/**/*.blade.php",
    "./resources/**/*.js", 
  ],
  theme: {
    extend: {
      backgroundImage: {
        'user-bg': "url('../img/bgUserRounded.svg')",
      }
    },
    screens: {
      'xs': '530px',
      'sm': '758px',
      'md': '960px',
      'lg': '1440px',
    },
  },
  plugins: [],
}

