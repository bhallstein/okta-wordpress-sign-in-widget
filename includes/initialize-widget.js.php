<?php
  $issuer = get_option('okta-issuer-url');
  $baseUrl =
    parse_url($issuer, PHP_URL_SCHEME) . '://' .
    parse_url($issuer, PHP_URL_HOST);
  $wp_url = get_site_url();
?>

var oktaSignIn = new OktaSignIn({
  baseUrl: '<?php echo $baseUrl ?>',
  redirectUri: '<?php echo $wp_url ?>',
  clientId: '<?php echo get_option('okta-widget-client-id') ?>',
  scopes: '<?php echo apply_filters('okta_widget_token_scope', 'openid email') ?>'.split(' '),
  issuer: '<?php echo get_option('okta-issuer-url') ?>',
  codeChallenge: false,
  useInteractionCodeFlow: false,
});
