<?php
/**
 * Plugin Name: NTK Cookie Solution
 * Plugin URI: https://github.com/Manuel-ntk/wp-plugin-repository
 * Description: Un plugin per la gestione del consenso ai cookie con blocco di script di terze parti come Google Maps fino all'accettazione dell'utente.
 * Version: 1.0.0
 * Author: Manuel NTK
 * Author URI: https://github.com/Manuel-ntk
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: ntk-cookie-solution
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Define plugin constants
define( 'NTK_COOKIE_SOLUTION_VERSION', '1.0.0' );
define( 'NTK_COOKIE_SOLUTION_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'NTK_COOKIE_SOLUTION_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

/**
 * Activation hook
 * Runs when the plugin is activated
 */
function ntk_cookie_solution_activate() {
    // Add default options on activation
    add_option( 'ntk_cookie_solution_active', '1' );
}
register_activation_hook( __FILE__, 'ntk_cookie_solution_activate' );

/**
 * Deactivation hook
 * Runs when the plugin is deactivated
 */
function ntk_cookie_solution_deactivate() {
    // Clean up on deactivation
    delete_option( 'ntk_cookie_solution_active' );
}
register_deactivation_hook( __FILE__, 'ntk_cookie_solution_deactivate' );

/**
 * Display cookie banner on frontend
 */
function ntk_cookie_solution_display_banner() {
    // Only display if user hasn't accepted cookies
    ?>
    <div id="ntk-cookie-banner" class="ntk-cookie-banner" style="display: none;">
        <div class="ntk-cookie-content">
            <p class="ntk-cookie-message">
                <?php _e( 'Questo sito utilizza cookie tecnici e di terze parti per migliorare la tua esperienza di navigazione. Continuando a navigare accetti l\'utilizzo dei cookie.', 'ntk-cookie-solution' ); ?>
            </p>
            <button id="ntk-cookie-accept" class="ntk-cookie-accept-btn">
                <?php _e( 'Accetta', 'ntk-cookie-solution' ); ?>
            </button>
        </div>
    </div>
    <?php
}
add_action( 'wp_footer', 'ntk_cookie_solution_display_banner' );

/**
 * Enqueue banner styles
 */
function ntk_cookie_solution_enqueue_styles() {
    ?>
    <style>
        .ntk-cookie-banner {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: rgba(0, 0, 0, 0.9);
            color: #ffffff;
            padding: 20px;
            z-index: 999999;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.3);
        }
        
        .ntk-cookie-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 15px;
        }
        
        .ntk-cookie-message {
            margin: 0;
            flex: 1;
            font-size: 14px;
            line-height: 1.5;
        }
        
        .ntk-cookie-accept-btn {
            background-color: #0073aa;
            color: #ffffff;
            border: none;
            padding: 10px 30px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            border-radius: 3px;
            transition: background-color 0.3s ease;
        }
        
        .ntk-cookie-accept-btn:hover {
            background-color: #005a87;
        }
        
        @media (max-width: 768px) {
            .ntk-cookie-content {
                flex-direction: column;
                text-align: center;
            }
            
            .ntk-cookie-accept-btn {
                width: 100%;
            }
        }
    </style>
    <?php
}
add_action( 'wp_head', 'ntk_cookie_solution_enqueue_styles' );

/**
 * Enqueue banner scripts
 */
function ntk_cookie_solution_enqueue_scripts() {
    ?>
    <script>
        (function() {
            // Check if cookie consent has been given
            function getCookie(name) {
                var value = "; " + document.cookie;
                var parts = value.split("; " + name + "=");
                if (parts.length === 2) return parts.pop().split(";").shift();
            }
            
            // Set cookie
            function setCookie(name, value, days) {
                var expires = "";
                if (days) {
                    var date = new Date();
                    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                    expires = "; expires=" + date.toUTCString();
                }
                document.cookie = name + "=" + (value || "") + expires + "; path=/";
            }
            
            // Show banner if consent not given
            var consent = getCookie('ntk_cookie_consent');
            if (!consent) {
                var banner = document.getElementById('ntk-cookie-banner');
                if (banner) {
                    banner.style.display = 'block';
                }
            }
            
            // Handle accept button click
            var acceptBtn = document.getElementById('ntk-cookie-accept');
            if (acceptBtn) {
                acceptBtn.addEventListener('click', function() {
                    // Set consent cookie for 365 days
                    setCookie('ntk_cookie_consent', 'accepted', 365);
                    
                    // Hide banner
                    var banner = document.getElementById('ntk-cookie-banner');
                    if (banner) {
                        banner.style.display = 'none';
                    }
                    
                    // Load blocked scripts
                    loadBlockedScripts();
                });
            }
            
            // Load blocked scripts after consent
            function loadBlockedScripts() {
                var blockedScripts = document.querySelectorAll('script[type="text/plain"][data-cookie-consent="required"]');
                blockedScripts.forEach(function(script) {
                    var newScript = document.createElement('script');
                    newScript.type = 'text/javascript';
                    
                    // Copy attributes
                    if (script.src) {
                        newScript.src = script.src;
                    }
                    if (script.innerHTML) {
                        newScript.innerHTML = script.innerHTML;
                    }
                    
                    // Copy other attributes
                    Array.from(script.attributes).forEach(function(attr) {
                        if (attr.name !== 'type' && attr.name !== 'data-cookie-consent') {
                            newScript.setAttribute(attr.name, attr.value);
                        }
                    });
                    
                    script.parentNode.insertBefore(newScript, script);
                    script.remove();
                });
                
                // Trigger custom event for additional handling
                if (typeof Event === 'function') {
                    var event = new Event('ntkCookieConsentGranted');
                    document.dispatchEvent(event);
                }
            }
            
            // Auto-load scripts if consent already given
            if (consent === 'accepted') {
                document.addEventListener('DOMContentLoaded', function() {
                    loadBlockedScripts();
                });
            }
        })();
    </script>
    <?php
}
add_action( 'wp_footer', 'ntk_cookie_solution_enqueue_scripts', 20 );

/**
 * Block Google Maps scripts until consent
 * This is a placeholder function that demonstrates how to block scripts
 * 
 * Usage: When adding Google Maps or other third-party scripts to your theme/plugins,
 * use type="text/plain" and data-cookie-consent="required" attributes:
 * 
 * Example:
 * <script type="text/plain" data-cookie-consent="required" src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY"></script>
 * 
 * The script will be automatically converted to a regular script and loaded after user consent.
 */
function ntk_cookie_solution_block_google_maps() {
    // This function serves as documentation for the blocking mechanism
    // The actual blocking is handled by the JavaScript in ntk_cookie_solution_enqueue_scripts()
    
    // Developers should add their Google Maps scripts with the following format:
    // <script type="text/plain" data-cookie-consent="required" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY"></script>
    
    // You can also add inline scripts:
    // <script type="text/plain" data-cookie-consent="required">
    //     // Your Google Maps initialization code here
    // </script>
}

/**
 * Add admin notice with usage instructions
 */
function ntk_cookie_solution_admin_notice() {
    $screen = get_current_screen();
    if ( $screen && $screen->id === 'plugins' ) {
        ?>
        <div class="notice notice-info">
            <p>
                <strong><?php _e( 'NTK Cookie Solution attivato!', 'ntk-cookie-solution' ); ?></strong>
            </p>
            <p>
                <?php _e( 'Per bloccare script di terze parti come Google Maps, utilizzare il seguente formato:', 'ntk-cookie-solution' ); ?>
            </p>
            <pre>&lt;script type="text/plain" data-cookie-consent="required" src="URL_SCRIPT"&gt;&lt;/script&gt;</pre>
        </div>
        <?php
    }
}
add_action( 'admin_notices', 'ntk_cookie_solution_admin_notice' );
