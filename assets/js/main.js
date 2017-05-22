/**
 * Setup webpack public path
 * to enable lazy-including of
 * js chunks
 *
 */
import './vendor/webpack.publicPath';

/**
 * Your theme's js starts
 * Utility
 */
import './utils/_foundation';
import './utils/_page-scroll';
import './utils/_file';
import './utils/_sticky';

/**
 * Your theme's js starts
 * here...
 */
import './scripts/_header';
import './scripts/_contact';