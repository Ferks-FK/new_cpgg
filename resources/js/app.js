import Alpine from 'alpinejs';
import anchor from '@alpinejs/anchor'

// Auth Imports
import login from './auth/login';
import register from './auth/register';

// Admin Imports
import adminUsers from './modules/admin/users';
import adminServers from './modules/admin/servers';
import products from './modules/admin/products';
import store from './modules/admin/store';
import gateways from './modules/admin/gateways';
import settings from './modules/admin/settings';

// Client Imports
import servers from './modules/servers';
import shop from './modules/shop';
import cart from './modules/cart';
import checkout from './modules/checkout';

// Stores
import breakpoints from './stores/breakpoints';
import layout from './stores/layout';

window.Alpine = Alpine;

// Plugins
Alpine.plugin(anchor);

// Stores
Alpine.store("breakpoints", breakpoints);
Alpine.store("layout", layout);

// Auth Data
Alpine.data('login', login);
Alpine.data('register', register);

// Client Modules
Alpine.data('servers', servers);
Alpine.data('shop', shop);
Alpine.data('cart', cart);
Alpine.data('checkout', checkout);

// Admin Modules
Alpine.data('adminUsers', adminUsers);
Alpine.data('adminServers', adminServers);
Alpine.data('products', products);
Alpine.data('store', store);
Alpine.data('gateways', gateways);
Alpine.data('settings', settings);

Alpine.start();
