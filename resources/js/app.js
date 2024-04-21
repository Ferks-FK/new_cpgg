import Alpine from 'alpinejs';

// Auth Imports
import login from './auth/login';
import register from './auth/register';

// Admin Imports
import adminUsers from './modules/admin/users';
import adminServers from './modules/admin/servers';
import products from './modules/admin/products';

// Client Imports
import servers from './modules/servers';

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

// Client Modules
Alpine.data('servers', servers);

// Admin Modules
Alpine.data('adminUsers', adminUsers);
Alpine.data('adminServers', adminServers);
Alpine.data('products', products);

Alpine.start();