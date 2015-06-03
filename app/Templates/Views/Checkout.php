{% extends "Layouts/Default.php" %}
{% block content %}
  
  <div class="container">

    <div>
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumbs">
                    <ul class="breadcrumb">
                        <li><a href="/">Home</a>  <span class="divider"></span>
                        </li>
                        <li><a href="/cart">Shopping Cart</a>  <span class="divider"></span>
                        </li>
                        <li class="active">Checkout</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <h2>Checkout</h2>
            </div>
        </div>
        <form method="post" action="{{ siteUrl('checkout') }}" enctype="multipart/form-data" role="form" class="form-horizontal">
            <div class="row box">
                <div class="col-md-6">
                    <h3>Billing Address</h3>
                    <div class="billing-address">
                      {% for field in address %}
                        <div class="form-group">
                            <label for="bill_{{ field.slug }}" class="col-md-4 control-label">{{ field.name }}
                                {% if field.required %}<span class="required">*</span>{% endif %}
                            </label>
                            <div on="field.type" ng-switch="" class="col-md-8">
                              {{ field.input|raw }}
                            </div>
                        </div>
                      {% endfor %}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="shiptobilling clearfix">
                        <h3>Shipping Address</h3>
                        <label class="checkbox"><input type="checkbox" onclick="jQuery('.shipping-address').toggle()"value="1">Ship to billing address?</label>
                    </div>
                    <div style="display: block" class="shipping-address">
                      {% for field in address %}
                        <div class="form-group">
                            <label for="ship_{{ field.slug }}" class="col-md-4 control-label">{{ field.name }}
                                {% if field.required %}<span class="required">*</span>{% endif %}
                            </label>
                            <div on="field.type" ng-switch="" class="col-md-8">
                              {{ field.input|raw }}
                            </div>
                        </div>
                      {% endfor %}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="your_order">
                        <h3>Your Order</h3>
                        <table class="table table-bordered table-responsive">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Qty</th>
                                    <th>Totals</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr class="subtotal">
                                    <td></td>
                                    <td><b>Cart Subtotal</b>
                                    </td>
                                    <td>{{ checkout.cart.totals.post_discount.formatted.without_tax }}</td>
                                </tr>
                                <tr class="subtotal">
                                    <td></td>
                                    <td><b>Order Total</b>
                                    </td>
                                    <td>{{ checkout.cart.totals.post_discount.formatted.with_tax }}</td>
                                </tr>
                            </tfoot>
                            <tbody>
                                {% for hash,product in checkout.cart.contents %}
                                <tr>
                                    <td><a href="/product/{{ product.slug }}">{{ product.title }}</a>
                                    </td>
                                    <td>{{ product.quantity }}</td>
                                    <td>{{ product.totals.post_discount.formatted.without_tax }}</td>
                                </tr>
                                {% endfor %}
                            </tbody>
                        </table>

                        <div ng-if="options.shipping.methods.length" style="margin-bottom: 20px" class="row">
                            <h3>Shipping</h3>
                            <div class="row box">
                              {% for hash,shipping in checkout.shipping.methods %}
                                <div class="carrier">
                                    <label class="radio">
                                        <input type="radio" checked="" value="{{ shipping.id }}" name="carrier">
                                    </label>
                                    <div class="carrier-917">{{ shipping.description }}</div>
                                </div>
                              {% endfor %}
                            </div>
                        </div>
                        <!-- end ngIf: options.shipping.methods.length -->
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h3>Payment</h3>
                </div>
                <!-- ngRepeat: gateway in options.gateways -->
                <div ng-repeat="gateway in options.gateways" class="col-md-4 ng-scope">
                    <div class="box padding">
                        <label class="radio ng-binding">
                            <input type="radio" checked="" ng-model="data.gateway" value="2checkout" name="gateway" class="ng-pristine ng-untouched ng-valid">2Checkout</label>
                        <div class="gateway gateway-2checkout"></div>
                    </div>
                </div>
                <!-- end ngRepeat: gateway in options.gateways -->
                <div ng-repeat="gateway in options.gateways" class="col-md-4 ng-scope">
                    <div class="box padding">
                        <label class="radio ng-binding">
                            <input type="radio" checked="" ng-model="data.gateway" value="dummy" name="gateway" class="ng-pristine ng-untouched ng-valid">Dummy</label>
                        <div class="gateway gateway-dummy"></div>
                    </div>
                </div>
                <!-- end ngRepeat: gateway in options.gateways -->
                <div ng-repeat="gateway in options.gateways" class="col-md-4 ng-scope">
                    <div class="box padding">
                        <label class="radio ng-binding">
                            <input type="radio" checked="" ng-model="data.gateway" value="manual" name="gateway" class="ng-pristine ng-untouched ng-valid">Manual</label>
                        <div class="gateway gateway-manual"></div>
                    </div>
                </div>
                <!-- end ngRepeat: gateway in options.gateways -->
                <div ng-repeat="gateway in options.gateways" class="col-md-4 ng-scope">
                    <div class="box padding">
                        <label class="radio ng-binding">
                            <input type="radio" checked="" ng-model="data.gateway" value="paypal-express" name="gateway" class="ng-pristine ng-untouched ng-valid">PayPal Express</label>
                        <div class="gateway gateway-paypal-express">Descriptive shizzle</div>
                    </div>
                </div>
                <!-- end ngRepeat: gateway in options.gateways -->
                <div ng-repeat="gateway in options.gateways" class="col-md-4 ng-scope">
                    <div class="box padding">
                        <label class="radio ng-binding">
                            <input type="radio" checked="" ng-model="data.gateway" value="px-post" name="gateway" class="ng-pristine ng-untouched ng-valid">PaymentExpress PxPost</label>
                        <div class="gateway gateway-px-post"></div>
                    </div>
                </div>
                <!-- end ngRepeat: gateway in options.gateways -->
                <div ng-repeat="gateway in options.gateways" class="col-md-4 ng-scope">
                    <div class="box padding">
                        <label class="radio ng-binding">
                            <input type="radio" checked="" ng-model="data.gateway" value="realex-remote" name="gateway" class="ng-pristine ng-untouched ng-valid">Realex Remote</label>
                        <div class="gateway gateway-realex-remote">Realex payments</div>
                    </div>
                </div>
                <!-- end ngRepeat: gateway in options.gateways -->
                <div ng-repeat="gateway in options.gateways" class="col-md-4 ng-scope">
                    <div class="box padding">
                        <label class="radio ng-binding">
                            <input type="radio" checked="" ng-model="data.gateway" value="stripe" name="gateway" class="ng-pristine ng-untouched ng-valid">Stripe</label>
                        <div class="gateway gateway-stripe">Moltin Demo testing description!</div>
                    </div>
                </div>
                <!-- end ngRepeat: gateway in options.gateways -->
            </div>
            <button style="margin: 20px 0" type="submit" class="btn btn-primary pull-right">Proceed to Payment</button>
        </form>
    </div>
  </div>

{% endblock %}
