module.exports = {
  // content: [
  //   "./index.html", 
  //   "./src/**/*.{js,ts,jsx,tsx,php,html}",
  // ],
  content: [
  "./*.{html,php}",
  "./includes/**/*.php",
  "./templates/**/*.php",
    "./src/views/**/*.html"
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