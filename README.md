# WordPress Okta Sign-In Widget

Fork of Okta sample WP plugin to replace the WordPress login screen with the Okta sign-in widget.

Install:

- Drop this folder into the WordPress plugins folder
- Enable the plugin
- NB jwt-authentication-for-wp-rest-api is also required for JWT generation.
- Go to the plugins settings page, add the issuer URI, client ID, and set the desired redirect.


### Note

If you leave `enable native WordPress logins` unchecked, **make sure** your admin user matches an email address of an Okta user for your app, otherwise your admin user will be locked out of your app.


## Development Environment

- Copy jwt-authentication-for-wp-rest-api into this folder.
- Run `sh scripts/up.sh` to start a dev environment using Docker.
- Open http://localhost:8080

On first run, you'll need to go through initial wordpress setup.
