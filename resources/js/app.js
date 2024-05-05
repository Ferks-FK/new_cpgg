import Alpine from 'alpinejs';

// Auth Imports
import login from './auth/login';
import register from './auth/register';

// Admin Imports
import adminUsers from './modules/admin/users';
import adminServers from './modules/admin/servers';
import products from './modules/admin/products';
import store from './modules/admin/store';

// Client Imports
import servers from './modules/servers';
import shop from './modules/shop';

// Components
import usePopper from './components/usePopper';

// Stores
import breakpoints from './stores/breakpoints';
import layout from './stores/layout';
import cart from './stores/cart';

window.Alpine = Alpine;

// components
Alpine.data("usePopper", usePopper);

// Stores
Alpine.store("breakpoints", breakpoints);
Alpine.store("layout", layout);
Alpine.store("cart", cart);

// Auth Data
Alpine.data('login', login);
Alpine.data('register', register);

// Client Modules
Alpine.data('servers', servers);
Alpine.data('shop', shop);

// Admin Modules
Alpine.data('adminUsers', adminUsers);
Alpine.data('adminServers', adminServers);
Alpine.data('products', products);
Alpine.data('store', store);

Alpine.start();