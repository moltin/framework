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
    <link rel="stylesheet" type="text/css" href="{{ siteUrl('/assets/css/style.css', false) }}">

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
        <h1 class="title">{{ config.app_name }}</h1>
      </header>

      <div class="row">
        <nav class="navbar navbar-default" role="navigation">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle Navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          </div>
          <div class="collapse navbar-collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-left">
            {% for category in categories %}
            {% if category.children is empty %}
              <li><a href="/category/{{ category.slug }}">{{ category.title }}</a></li>
            {% else %}
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ category.title }} <b class="caret"></b></a>
                <ul class="dropdown-menu">
                {% for sub_category in category.children %}
                  <li><a href="/category/{{ sub_category.slug }}">{{ sub_category.title }}</a></li>
                {% endfor %}
                </ul>
              </li>
            {% endif %}
            {% endfor %}
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                <a href="/cart" class="dropdown-toggle" data-toggle="dropdown"><b class="glyphicon glyphicon-shopping-cart"></b> {{ cart.total_items }} Item{% if cart.total_items != 1 %}s{% endif %} (&pound;{{ cart.total|number_format(2, '.', ',') }}) <b class="caret"></b></a>
                <ul class="dropdown-menu">
                {% for item in cart.contents %}
                  <li><a href="#">{{ item.quantity }} x {{ item.name }} - &pound;{{ item.price }}</a></li>
                {% endfor %}
                  <li class="divider"></li>
                  <li><a href="/cart">View Cart</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </div>

      <div class="row">
      {% block content %}{% endblock %}
      </div>

    </div>

  </body>

</html>
