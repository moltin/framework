<!DOCTYPE html>
<html lang="en" ng-app="store">
<head>

  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Montserrat:200,300,400,600,700">
  <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans:200,300,400,600,700">
  <link rel="stylesheet" type="text/css" href="{{ siteUrl('/assets/css/bootstrap.css', false) }}">
  <link rel="stylesheet" type="text/css" href="{{ siteUrl('/assets/css/bootstrap-theme.css', false) }}">
  <link rel="stylesheet" type="text/css" href="{{ siteUrl('/assets/css/font-awesome.css', false) }}">
  <link rel="stylesheet" type="text/css" href="{{ siteUrl('/assets/css/style.css', false) }}">

  <script type="text/javascript" src="/js/store.min.js"></script>

  <title>{{ title }} &bull; {{ config.app_name }}</title>

</head>
<body>

    <script type="text/javascript" src="{{ siteUrl('/assets/js/jquery.min.js', false) }}"></script>
    <script type="text/javascript" src="{{ siteUrl('/assets/js/bootstrap.min.js', false) }}"></script>
    <script type="text/javascript" src="{{ siteUrl('/assets/js/application.js', false) }}"></script>

    <div class="page-container">
     
       <div class="header">
         <nav class="navbar container">
           <div class="navbar-header">
             <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
               <span class="sr-only">Toggle navigation</span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
             </button>
             <a href="/" class="navbar-brand">
               <img src="/assets/img/logo.png" alt="{{ config.app_name }}" />{{ config.app_name }}
             </a>
           </div>
           <div class="navbar-collapse collapse navbar-right">

             <ul class="nav navbar-nav">
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

             <ul class="nav navbar-right cart">
               <li class="dropdown">
                 {% if cart.contents is empty %}
                 <a href="/cart"><span>{{ cart.total_items }}</span></a>
                 {% else %}
                 <a href="/cart" class="dropdown-toggle" data-toggle="dropdown"><span>{{ cart.total_items }}</span></a>
                 <div class="cart-info dropdown-menu">
                   <table class="table">
                     <tbody>
                        {% for hash,item in cart.contents %}
                        <tr>
                          <td class="image"><img alt="{{ item.title }}" class="img-responsive" src="http://{{ item.images|first.segments.domain }}w100/h100/fit/{{ item.images|first.segments.suffix }}" /></td>
                          <td class="name"><a href="/product/{{ item.slug }}">{{ item.title }}</a></td>
                          <td class="quantity">x&nbsp;{{ item.quantity }}</td>
                          <td class="total"></td>
                          <td class="remove"><a href="{{ siteUrl('cart/delete/', false) }}{{ hash }}"><img src="/img/remove-small.png" alt="Remove" title="Remove"/></a></td>
                        </tr>
                        {% endfor %}
                     </tbody>
                   </table>
                   <div class="cart-total">
                     <table>
                       <tbody>
                       <tr>
                         <td><b>Sub-Total:&nbsp;</b></td>
                         <td>&nbsp;{{ cart.totals.formatted.without_tax }}</td>
                       </tr>
                       <tr>
                         <td><b>Total:&nbsp;</b></td>
                         <td>&nbsp;{{ cart.totals.formatted.with_tax }}</td>
                       </tr>
                       </tbody>
                     </table>
                     <div class="checkout">
                       <a href="/cart" class="ajax_right">View Cart</a> | <a href="/checkout" class="ajax_right">Checkout</a>
                     </div>
                   </div>
                 </div>
                 {% endif %}
               </li>
             </ul>
             <form class="navbar-form navbar-search navbar-right" role="search" ng-submit="Page.search(term)">
               <div class="input-group"> 
                 <input type="text" name="search" ng-model="term" placeholder="Search" class="search-query col-md-2" />
                 <button type="submit" class="btn btn-default icon-search"></button> 
               </div>
             </form>
           </div>
         </nav>
       </div>
     
       {% if flash.error %}
       <div class="container">
         <div class="alert alert-success">{{ flash.success|raw }}</div>
       </div>
       {% endif %}

       {% if flash.success %}
       <div class="container">
         <div class="alert alert-danger">{{ flash.error|raw }}</div>
       </div>
       {% endif %}

       {% if flash.warning %}
       <div class="container">
         <div class="alert alert-warning">{{ flash.error|raw }}</div>
       </div>
       {% endif %}

      <div class="container">
      {% block content %}{% endblock %}
      </div>

       <div class="footer black">
         <div class="container">
           <div class="row">
             <div class="col-md-3">
               <div>
                 <h3>Information</h3>
                 <ul>
                   <li ng-repeat="page in pages" ng-if="page.menu.data.key == 'info'"><a href="/{{ page.slug }}">{{ page.title }}</a></li>
                 </ul>
               </div>
             </div>
             <div class="col-md-3">
               <div>
                 <h3>Customer Service</h3>
                 <ul>
                   <li ng-repeat="page in pages" ng-if="page.menu.data.key == 'customer'"><a href="/{{ page.slug }}">{{ page.title }}</a></li>
                 </ul> 
               </div>
             </div>
             <div class="col-md-3"></div>
             <div class="col-md-3 social">
               <div class="copy">Copyright &copy; {{ config.app_name }}</div>
               <ul class="social-network">
                 <li><a href=""><i class="fa fa-facebook"></i></a></li>
                 <li><a href=""><i class="fa fa-google-plus"></i></a></li>
                 <li><a href=""><i class="fa fa-pinterest"></i></a></li>
                 <li><a href=""><i class="fa fa-rss"></i></a></li>
                 <li><a href=""><i class="fa fa-twitter"></i></a></li> 
               </ul>
             </div>
           </div>
         </div>
       </div>
    
    </div>

  </body>

</html>
