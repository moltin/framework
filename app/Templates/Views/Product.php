{% extends "Layouts/Default.php" %}
{% block content %}

  <ul class="breadcrumb prod ng-scope">
    <li><a href="/">Home</a> <span class="divider"></span></li>
    <!-- ngIf: product.category.parent.data.parent -->
    <li ng-if="product.category.parent.data.parent" class="ng-scope">
      <a href="/category/living-room" class="ng-binding">Living Room</a>
      <span class="divider"></span>
    </li>
    <li ng-if="product.category.parent" class="ng-scope">
      <a href="/category/sofas-and-armchairs" class="ng-binding">Sofas &amp; Armchairs</a>
      <span class="divider"></span>
    </li><!-- end ngIf: product.category.parent -->
    <li>
      <a href="/category/sofa-beds" class="ng-binding">Sofa Beds</a> 
      <span class="divider"></span>
    </li>
    <li class="active ng-binding">LYCKSELE HÅVET - Two-seat sofa-bed</li>
  </ul>

  <div class="row product-info">
    <div class="col-md-6">
        <div class="image">
            <img src="{{ images|first.url.http }}" alt="{{ title }}" />
        </div>
        <div class="image-additional">
          {% for image in images %}
              <a href="#"><img src="http://{{ image.segments.domain }}w74/h74/fit/{{ image.segments.suffix }}" alt="{{ title }}" /></a>
          {% endfor %}
        </div>
    </div>
    <div class="col-md-6">
        <h1>{{ title }}</h1>
        <div class="line"></div>
        <ul>
            <li><span>Product Code:</span> {{ sku }}</li>
            <li><span>Availability:</span> {{ stock_status.value }}</li>
            <li><span>Brand:</span> {{ brand.value }}</li>
            <li><span>Collection:</span> {{ collection.value }}</li>
        </ul>
        <div class="price">Price <strong>{{ price.value }}</strong>
        </div>
        <div id="modifiers">

        </div>


        <form class="form-inline product-add" action="{{ siteUrl('/cart/insert', false) }}" method="post">

          {% for modifier in modifiers %}
            {% if modifier.type.value == "Variant" %}
              <div class="controls">
                <select class="form-control" required="required" name="modifier[{{ modifier.id }}]">
                  {% if modifier.instructions %}
                  <option value="">{{ modifier.instructions }}</option>
                  {% endif %}
                  {% for variation in modifier.variations %}
                    <option value="{{ variation.id }}">{{ variation.title }} ({{ variation.difference }})</option>
                  {% endfor %}
                </select>
              </div>
            {% elseif modifier.type.value == "Single" %}
              <div class="controls">
                <select class="form-control" name="single[{{ modifier.id }}]">
                  {% if modifier.instructions %}
                  <option value="">{{ modifier.instructions }}</option>
                  {% endif %}
                  {% for variation in modifier.variations %}
                    <option value="{{ variation.id }}">{{ variation.title }} ({{ variation.difference }})</option>
                  {% endfor %}
                </select>
              </div>
            {% elseif modifier.type.value == "Input" %}
              <label for="input[{{ modifier.id }}]" class="control-label">{{ modifier.title }}</label>
              <div class="controls">
                <input class="form-control" type="text" name="input[{{ modifier.id }}]" />
              </div>
            {% endif %}
          {% endfor %}

        <div class="line"></div>

          <button class="btn btn-primary">Add to Cart</button>
          <input type="hidden" name="product" value="{{ id }}">
          <label>Qty:</label>
          <input type="text" class="col-md-1" id="qty" name="qty" value="1" placeholder="1">
        </form>
        <div class="tabs">
            <ul id="myTab" class="nav nav-tabs">
                <li class="active"><a href="#description">Description</a></li>
            </ul>
            <div class="tab-content">
                <div id="description" class="tab-pane active">{{ description }}</div>
            </div>
        </div>
    </div>
</div>

{% endblock %}
