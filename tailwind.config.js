/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./**/*.{html,js,php}"],
  theme: {
    extend: {
      colors: {
        H_519d71: '#519d71',
        H_DFE3DE: '#DFE3DE',
        H_393737: '#393737',
        H_6FCF97: '#6FCF97',
        H_CCE8D8: '#CCE8D8',
        H_A7E08E: '#A7E08E',
        H_38813B: '#38813B',
        H_4B4848: '#4B4848',
        H_95C8AA: '#95C8AA',
        H_618762: '#618762',
        H_7DB092: '#7DB092',
        H_DAE5E0: '#DAE5E0',
        H_E7EBE9: '#E7EBE9',
        H_ECECEC: '#ECECEC',
        H_F5F5F5: '#F5F5F5',
        H_EDF7A3: '#EDF7A3',
        H_B8F7A3: '#B8F7A3',
        H_B3B3B3: '#B3B3B3',
        H_455B3C: '#455B3C',
        H_E08E8E: '#E08E8E',
        H_5B3C3C: '#5B3C3C',
        H_C3CFC9: '#C3CFC9',
        H_EBF3F0: '#EBF3F0',
        H_F2F5F0: '#F2F5F0',
        H_E5E9E4: '#E5E9E4',
        H_F7F4F4: '#F7F4F4',

      },
      fontFamily: {
        roboto: ['Roboto', 'sans-serif'],
      },
      keyframes: {
        fadeIn: {
          '0%': { opacity: '0' },
          '100%': { opacity: '1' },
        },
        fadeInRight: {
            '0%': {
                opacity: '0',
                transform: 'translateX(-50px)',
            },
            '100%': {
                opacity: '1',
                transform: 'translateX(0)',
            },
        },
        pulse: {
          '0%': { opacity: '1' },
          '50%': { opacity: '.5' },
          '100%': { opacity: '1' },
        },
        rotateIn: {
          '0%': {
              transform: 'rotate(0deg)',
              opacity: '0',
          },
          '100%': {
              transform: 'rotate(360deg)',
              opacity: '1',
          },
        },
      },
      animation: {
          'fade-in-right': 'fadeInRight 1s ease-out',
          'fade-in': 'fadeIn 1s ease-in-out',
          'pulse': 'pulse 2s ease-in-out infinite',
          'rotateIn': 'rotateIn 1s ease-out',
      },
    },
  },
  plugins: [],
}

