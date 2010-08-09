# Service APIs for Kohana

The following services are supported:

- twitter
- *Want to add one? Fork and send a pull request!*

To enable an individual API, add it to your `Kohana::modules` call:

    Kohana::modules(array(
        'twitter' => MODPATH.'apis/twitter',
    ));
