<?php
  $issuer = get_option('okta-issuer-url');
  $loginRedirect = get_option('okta-widget-login-redirect') ?: get_home_url();
  $baseUrl =
    parse_url($issuer, PHP_URL_SCHEME) . '://' .
    parse_url($issuer, PHP_URL_HOST);
?>

var oktaSignIn = new OktaSignIn({
  baseUrl: '<?php echo $baseUrl ?>',
  redirectUri: '<?php echo $loginRedirect ?>',
  clientId: '<?php echo get_option('okta-widget-client-id') ?>',
  scopes: '<?php echo apply_filters('okta_widget_token_scope', 'openid email') ?>'.split(' '),
  issuer: '<?php echo get_option('okta-issuer-url') ?>',
  codeChallenge: false,
  useInteractionCodeFlow: false,
});
