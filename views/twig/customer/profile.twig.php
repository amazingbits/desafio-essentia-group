{% extends "_template.twig.php" %}
{% block content %}
<div class="header">
    <a href="{{ BASE_URL }}"><i class="fa fa-chevron-left"></i> Voltar</a>
</div>

<div class="customer-profile">
    <div class="customer-image">
        <img src="{{ BASE_URL }}/{{ customer.image_url }}" alt="{{ customer.name }}">
    </div>
    <div class="customer-informations">
        <div class="customer-information">
            <p><b>Nome:</b> {{ customer.name }}</p>
        </div>
        <div class="customer-information">
            <p><b>E-mail:</b> {{ customer.email }}</p>
        </div>
        <div class="customer-information">
            <p><b>Telefone:</b> {{ customer.phone_number_formatted }}</p>
        </div>
    </div>
</div>
{% endblock %}