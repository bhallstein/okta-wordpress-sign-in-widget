<?php include plugin_dir_path(__FILE__).'/../includes/widget.php'; ?>

<style type="text/css">
    body {
        font-family: montserrat,Arial,Helvetica,sans-serif;
    }

    #wordpress-login{
        text-align: center;
    }

    #wordpress-login a{
        font-size:10px;
        color: #999;
        text-decoration:none;
    }

    #error {
        max-width: 500px;
        margin: 20px auto;
        padding: 20px;
        border: 1px #d93934 solid;
        border-radius: 6px;
    }
    #error h2 {
        color: #d93934;
    }
</style>

<?php if(isset($_GET['error'])): ?>
<div id="error">
    <h2>Error: <?php echo htmlspecialchars($_GET['error']) ?></h2>
    <p><?php echo htmlspecialchars($_GET['error_description']) ?></p>
</div>
<?php endif ?>

<div id="primary" class="content-area">
  <div id="okta-login-container"></div>
  <?php if(get_option('okta-allow-wordpress-login')): ?>
      <div id="wordpress-login"><a href="<?php echo wp_login_url(); ?>?wordpress_login=true">Login via Wordpress</a></div>
  <?php endif ?>
</div>

<script>
    <?php include plugin_dir_path(__FILE__).'/../includes/initialize-widget.js.php'; ?>

    oktaSignIn.on('afterError', function (context, error) {
      console.log(context.controller);
      console.log(error.name);
      console.log(error.message);
      console.log(error.statusCode);
    });

    function authenticate() {
      oktaSignIn.showSignIn({
        el: '#okta-login-container'
      })
        .then(function(result) {
          oktaSignIn.authClient.handleLoginRedirect(result.tokens);
        })
        .catch(function(err) {
          console.log('//showSignIn err/', err)
        })
    }

    function getUser() {
      return oktaSignIn.authClient.token.getUserInfo()
        .then(function(user) {
          oktaSignIn.authClient.tokenManager.get('idToken')
            .then(function(idToken) {
              window.location = 'http://localhost:8080/wp-login.php?log_in_from_id_token='+idToken.idToken;
            });
        })
    }

    getUser()
      .catch(function(err) {
        console.log('//getUser err/', err)
        authenticate()
      })
</script>
