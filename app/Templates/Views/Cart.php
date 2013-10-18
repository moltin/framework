{% extends "Layouts/Default.php" %}
{% block content %}

  {% if cart.contents is empty %}
  	<div class="alert alert-warning">There's nothing in your cart!</div>
  {% else %}
  	<table class="table table-bordered table-striped">
  		<thead>
  			<tr>
  				<th>Product</th>
  				<th style="width: 140px">Quantity</th>
  				<th>Price</th>
  				<th>Total</th>
  			</tr>
  		</thead>
  		<tfoot>
  			<tr>
  				<td colspan="3"><strong class="pull-right">Sub-total</strong></td>
  				<td>&pound;{{ cart.total_before_tax|number_format(2, '.', ',') }}
  			</tr>
  			<tr>
  				<td colspan="3"><strong class="pull-right">Total</strong></td>
  				<td>&pound;{{ cart.total|number_format(2, '.', ',') }}
  			</tr>
  		</tfoot>
  		<tbody>
  		{% for hash,item in cart.contents %}
  			<tr>
  				<td><a href="/product/{{ item.slug }}">{{ item.name }}</a></td>
  				<td>
	  				<div class="input-group">
	      			<span class="input-group-btn"><a href="/cart/update/{{ hash }}/{{ item.quantity - 1 }}" class="btn btn-default" type="button">-</a></span>
	      			<input type="text" name="quantity[{{ item.id }}]" value="{{ item.quantity }}" class="form-control" />
	      			<span class="input-group-btn"><a href="/cart/update/{{ hash }}/{{ item.quantity + 1 }}" class="btn btn-default" type="button">+</a></span>
	      		</div>
      		</td>
  				<td>&pound;{{ item.price }}</td>
  				<td>&pound;{{ ( item.price * item.quantity )|number_format(2, '.', ',') }}</td>
  			</tr>
  		{% endfor %}
  		</tbody>
  	</table>
  {% endif %}

{% endblock %}
