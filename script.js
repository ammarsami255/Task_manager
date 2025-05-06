document.addEventListener('DOMContentLoaded', () => {
  const loginForm = document.getElementById('loginForm');
  const registerForm = document.getElementById('registerForm');

  if (loginForm) {
      loginForm.addEventListener('submit', (e) => {
          const username = loginForm.username.value;
          const password = loginForm.password.value;

          if (username.length < 3) {
              alert('Username must be at least 3 characters');
              e.preventDefault();
          }
          if (password.length < 6) {
              alert('Password must be at least 6 characters');
              e.preventDefault();
          }
      });
  }

  if (registerForm) {
      registerForm.addEventListener('submit', (e) => {
          const username = registerForm.username.value;
          const email = registerForm.email.value;
          const password = registerForm.password.value;

          if (username.length < 3) {
              alert('Username must be at least 3 characters');
              e.preventDefault();
          }
          if (!email.includes('@')) {
              alert('Please enter a valid email');
              e.preventDefault();
          }
          if (password.length < 6) {
              alert('Password must be at least 6 characters');
              e.preventDefault();
          }
      });
  }
});