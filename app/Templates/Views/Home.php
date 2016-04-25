{% extends "Layouts/Default.php" %}
{% block content %}

	<div class="row">
	<section class="col-md-12">
		<img src="/assets/img/slideshow/sub.jpg" alt="Slider" style="margin-bottom: 30px;"/>
	</section>

  	<section class="col-md-3 left-menu" role="sidebar">
  		<div>
  			<h3>Collections</h3>
  				<ul>
  				{% for collection in collections %}
					<li><a href="/collection/{{ collections.slug }}">{{ collection.title }}</a></li>
  				{% endfor %}
  			</ul>
  		</div>

   		<div class="options">
  			<select>
  				{% for currency in currencies %}
				<option value="{{ currency.code }}">{{ currency.title }}</option>
				{% endfor %}
  			</select>
  		</div>
  	</section>

  	<section class="col-md-9">
  		<div class="row">
  			<div class="products">
  			{% for product in products %}
	  		<div class="col-md-4">
	  			<div class="product">
	  			<a class="img-cont" href="/product/{{ product.slug }}">
			  	{% if product.images is empty %}
			  		<b class="glyphicon glyphicon-camera"></b>
			  	{% else %}
			  		<img src="http://{{ product.images|first.segments.domain }}/w213/h213/fit/5/{{ product.images|first.segments.suffix }}" alt="{{ product.title }}" />
			  	{% endif %}
			  	</a>
			  	<div class="name"><a href="/product/{{ product.slug }}">{{ product.title }}</a></div>
			  	<div class="price"><p><strong>{{ product.price.value }}</strong></p></div>
			  	</div>
	  		</div>
  			{% endfor %}
  			</div>
  		</div>
  	</section>
  	</div>

{% endblock %}
