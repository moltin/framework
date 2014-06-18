{% extends "Layouts/Default.php" %}
{% block content %}

  <section class="col-md-3" role="sidebar">
    <ul class="list-group">
      <li class="list-group-item">
        <span class="badge">14</span>
        Category Example
      </li>
    </ul>
  </section>

  <section class="col-md-9">

    <div id="product-images" class="col-md-5 carousel slide">
      <ol class="carousel-indicators">
      {% for image in images %}
        <li data-target="#product-images" data-slide-to="{{ loop.index - 1 }}"{% if loop.first %} class="active"{% endif %}></li>
      {% endfor %}
      </ol>
      <div class="carousel-inner">
      {% for image in images %}
        <div class="item{% if loop.first %} active{% endif %}">
          <img src="{{ image.url.http }}" alt="{{ image.name }}" />
        </div>
      {% endfor %}
      </div>
      <a class="left carousel-control" href="#product-images" data-slide="prev">
        <span class="icon-prev"></span>
      </a>
      <a class="right carousel-control" href="#product-images" data-slide="next">
        <span class="icon-next"></span>
      </a>
    </div>

    <div class="col-md-7">

      <h1 class="title"><span class="model">{{ title }}</span></h1>
      <h5>Our Price : <span class="price">&pound;{{ price }}</span></h5>
      <p class="prodid">Product Code : <span>{{ sku }}</span></p>
      <p class="availability">Availability : <span>{{ stock_status.value }} ({{ stock_level }})</span></p>

      <hr />

      <form action="{{ siteUrl('/cart/insert', false) }}" method="post" role="form" class="form-inline">
        <input name="product" value="{{ id }}" type="hidden" />
        <div class="form-group">
          <label for="quantity" class="control-label">Quantity*</label>
          <div class="controls">
            <input type="text" name="quantity" value="1" size="3" class="form-control" />
          </div>

    {% for modifier in modifiers %}
      {% if modifier.type.value == "Variant" %}
        <label for="modifier[{{ modifier.id }}]" class="control-label">{{ modifier.title }}*</label>
        <div class="controls">
          <select class="form-control" required="required" name="modifier[{{ modifier.id }}]">
            <option value="">{{ modifier.instructions }}</option>
            {% for variation in modifier.variations %}
              <option value="{{ variation.id }}">{{ variation.title }} ({{ variation.difference }})</option>
            {% endfor %}
          </select>
        </div>
      {% elseif modifier.type.value == "Single" %}
        <label for="single[{{ modifier.id }}]" class="control-label">{{ modifier.title }}*</label>
        <div class="controls">
          <select class="form-control" name="single[{{ modifier.id }}]">
            <option value="">{{ modifier.instructions }}</option>
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

        </div>
        <button type="submit" class="btn btn-default">Add to Cart</button>
      </form>

    </div>

    <div class="clearfix"></div>

    <div class="col-md-12">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#description">Description</a></li>
      </ul>
      <div class="tab-content">
        <br />
        <div class="tab-pane active" id="description"><p>{{ description|raw }}</p></div>
      </div>
    </div>

  </section>

{% endblock %}
