{% extends "Layouts/Default.php" %}
{% block content %}

  <h1>Checkout</h1>


                    <form class="tab-content form-horizontal" method="post" action="{{ siteUrl('order/create') }}" enctype="multipart/form-data">
                            
                            <fieldset class="col-sm-12">
                            <h2>Customer Details</h2>
                            <div class="form-group" id="customer_container">
                            {% for field in customer %}
                              {% if field.input %}
                                <div class="form-group">
                                    <label class="control-label" for="{{ field.slug }}">{{ field.name }} {% if field.required %}*{% endif %}</label>
                                    <div class="controls">
                                        {{ field.input|raw }}
                                    </div>
                                </div>
                              {% endif %}
                            {% endfor %}
                            </div>
                            </fieldset>

                            <fieldset class="col-sm-6">
                            <h2>Shipping Address</h2>
                            <div class="form-group" id="shipping_container">
                            {% for field in address %}
                              {% if field.input %}
                                <div class="form-group">
                                    <label class="control-label" for="{{ field.slug }}">{{ field.name }} {% if field.required %}*{% endif %}</label>
                                    <div class="controls">
                                        {{ field.input|raw }}
                                    </div>
                                </div>
                              {% endif %}
                            {% endfor %}
                            </div> 
                            </fieldset>

                            <fieldset class="col-sm-6">
                            <h2>Billing Address</h2>
                            <div class="form-group" id="billing_container">
                            {% for field in address %}
                              {% if field.input %}
                                <div class="form-group">
                                    <label class="control-label" for="{{ field.slug }}">{{ field.name }} {% if field.required %}*{% endif %}</label>
                                    <div class="controls">
                                        {{ field.input|raw }}
                                    </div>
                                </div>
                              {% endif %}
                            {% endfor %}
                            </div>  
                            </fieldset>

                            <fieldset class="col-sm-6">
                            <h2>Shipping Method</h2>
                            	<select name="shipping">
                            	{% for method in shipping %}
                            		<option value="{{ method.slug }}">{{ method.title }}</option>
                            	{% endfor %}
                            	</select>
                            </fieldset>

                            <fieldset class="col-sm-6">
                            <h2>Gateway</h2>
                            	<select name="gateway">
                            	{% for gateway in checkout.gateways %}
                            		<option value="{{ gateway.slug }}">{{ gateway.name }}</option>
                            	{% endfor %}
                            	</select>
                            </fieldset>
                            
                            <fieldset class="col-sm-12">                                                                                 
                            <h2>Cart</h2>
                            <div class="form-group" id="order_container">
  							{% if cart.contents is empty %}
  								<div class="alert alert-warning">There's nothing in your cart!</div>
  							{% else %}
  								<table class="table table-bordered table-striped">
  									<thead>
  										<tr>
  											<th>Product</th>
  											<th style="width: 140px">Quantity</th>
  											<th style="width: 140px">Price</th>
  											<th style="width: 140px">Total</th>
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
                            </div>
                            </fieldset>


  								<div class="pull-right">
  									<a href="/checkout/process" class="btn btn-default">Checkout</a>
  								</div>

                    </form>

{% endblock %}
