{% extends "Layouts/Default.php" %}
{% block content %}

  <section class="col-md-3" role="sidebar">
  	Sidebar
  </section>

  <section class="col-md-9">

  	<h1>{{ title }}</h1>

  	<div class="col-md-12 products">
  	{% for product in products %}
	  	<div class="col-md-4 product">
		  	{% if product.images is empty %}<b class="glyphicon glyphicon-camera"></b>{% else %}<img src="{{ product.images|first.url.http }}" alt="Image" />{% endif %}
		  	<h4><a href="/product/{{ product.slug }}">{{ product.title }}</a></h4>
		  	<div class="btn-group">
		  		<span class="btn btn-default">&pound;{{ product.price.value }}</span>
		  		<a href="/product/{{ product.slug }}" class="btn btn-default">View</a>
		  		<a href="/cart/insert/{{ product.id }}" class="btn btn-default">Add to Cart</a>
		  	</div>
	  	</div>
  	{% endfor %}
  	</div>

  </section>

{% endblock %}