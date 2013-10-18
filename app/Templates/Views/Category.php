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
	  		<div class="sharing">
					<a class="facebook_popup link" data-original-title="Share this on Facebook" target="_blank" onclick="return !window.open(this.href, 'Facebook', 'width=640,height=300')" href="http://www.facebook.com/sharer.php?s=100&amp;p[title]={{ product.title }}&amp;p[url]={{ baseUrl('') }}/product/{{ product.slug }}">Facebook</a>
					<a class="twitter_popup link" data-original-title="Share this on Twitter" href="http://twitter.com/share?url={{ baseUrl('') }}/product/{{ product.slug }}&amp;text={{ product.title }}%20is%20awesome!">Twitter</a>            		            															
				</div>
		  	{% if product.images is empty %}<b class="glyphicon glyphicon-camera"></b>{% else %}<img src="{{ product.images|first.url.http }}" alt="Image" />{% endif %}
		  	<h4><a href="/product/{{ product.slug }}">{{ product.title }}</a></h4>
		  	<div class="btn-group">
		  		<span class="btn btn-default">&pound;{{ product.price }}</span>
		  		<a href="/product/{{ product.slug }}" class="btn btn-default">View</a>
		  		<a href="/cart/insert/{{ product.id }}" class="btn btn-default">Add to Cart</a>
		  	</div>
	  	</div>
  	{% endfor %}
  	</div>

  </section>

{% endblock %}