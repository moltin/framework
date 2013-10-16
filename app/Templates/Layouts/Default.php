<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ title }} | {{ config.app_name }}</title>

    <link rel="shortcut icon" href="{{ siteUrl('/assets/ico/favicon.ico', false) }}">
    <link rel="apple-touch-icon-precomposed" href="{{ siteUrl('/assets/ico/apple-touch-icon.png', false) }}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ siteUrl('/assets/ico/apple-touch-icon-72x72.png', false) }}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ siteUrl('/assets/ico/apple-touch-icon-114x114.png', false) }}">

    <link rel="stylesheet" type="text/css" href="{{ siteUrl('/assets/css/bootstrap.css', false) }}">
    <link rel="stylesheet" type="text/css" href="{{ siteUrl('/assets/css/bootstrap-theme.css', false) }}">

    <script type="text/javascript" src="{{ siteUrl('/assets/js/jquery.min.js', false) }}"></script>
    <script type="text/javascript" src="{{ siteUrl('/assets/js/bootstrap.min.js', false) }}"></script>
    <script type="text/javascript" src="{{ siteUrl('/assets/js/application.js', false) }}"></script>

    <!--[if lt IE 9]>
      <script type="text/javascript" src="{{ siteUrl('/assets/js/html5shiv.js', false) }}"></script>
      <script type="text/javascript" src="{{ siteUrl('/assets/js/respond.min.js', false) }}"></script>
    <![endif]-->

  </head>

  <body>

    <div class="container">

      <header class="row">
        <nav class="navbar navbar-default" role="navigation">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle Navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">{{ config.app_name }}</a>
          </div>
          <div class="collapse navbar-collapse navbar-collapse">
            <ul class="nav navbar-nav">
              <li class="active"><a href="/">Home</a></li>
            </ul>
          </div>
        </nav>
      </header>

      <div class="row">
      {% block content %}{% endblock %}
      </div>

    </div>

  </body>

</html>