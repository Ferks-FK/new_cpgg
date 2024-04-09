import Alpine from 'alpinejs';

// Auth Imports
import login from './auth/login';
import register from './auth/register';

import usePopper from './components/usePopper';

import breakpoints from './stores/breakpoints';
import layout from './stores/layout';

window.Alpine = Alpine;

// components
Alpine.data("usePopper", usePopper);

// Stores
Alpine.store("breakpoints", breakpoints);
Alpine.store("layout", layout);

// Auth Data
Alpine.data('login', login);
Alpine.data('register', register);

Alpine.start();