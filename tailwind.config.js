module.exports = {
  // content: [
  //   "./index.html", 
  //   "./src/*/.{js,ts,jsx,tsx,php,html}",
  // ],
  content: [
  "./*.{html,php}",
  "./includes/**/*.php",
  "./templates/**/*.php"
],
  theme: {
    extend: {
      colors: {
        primary: '#FF6B35',
        secondary: '#4ECDC4',
        accent: '#FFE66D',
      },
    },
  },
  plugins: [],
}