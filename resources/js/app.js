import Alpine from 'alpinejs';

// Auth Imports
import login from './auth/login';
import register from './auth/register';

window.Alpine = Alpine;

// Auth Data
Alpine.data('login', login);
Alpine.data('register', register);

Alpine.start();