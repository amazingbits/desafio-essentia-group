{% extends "_template.twig.php" %}
{% block content %}
<div class="header">
    <a href="{{ BASE_URL }}/customer/insert"><i class="fa fa-plus"></i> Novo cliente</a>
</div>

<div class="customer-list">
    {% for customer in customers %}
    <div class="customer">
        <div class="customer-info">
            <img src="{{ BASE_URL }}/{{ customer.image_url }}" alt="">
            <span>{{ customer.name }}</span>
        </div>
        <div class="customer-actions">
            <a href="{{ BASE_URL }}/customer/profile/{{ customer.id }}" title="Ver informações do cliente"><i class="fa fa-eye"></i></a>
            <a href="{{ BASE_URL }}/customer/edit/{{ customer.id }}" title="Editar cliente"><i class="fa fa-edit"></i></a>
            <a href="#" id="{{ customer.id }}" class="delete-customer" title="Excluir cliente"><i class="fa fa-trash"></i></a>
        </div>
    </div>
    {% endfor %}
    {% if customers is empty %}
    <div>
        <p>Nenhum cliente cadastrado</p>
    </div>
    {% endif %}
</div>
{% endblock %}
{% block customJS %}
<script>
const deleteCustomerButtons = document.querySelectorAll(".delete-customer");
deleteCustomerButtons.forEach((deleteCustomerButton) => {
    const id = deleteCustomerButton.getAttribute("id");
    deleteCustomerButton.addEventListener("click", (event) => {
        event.preventDefault();
        const callback = () => {
            window.location.href = "{{ BASE_URL }}/customer/delete/" + id;
        };
        displayCustomConfirm("Atenção", "Tem certeza que deseja remover este usuário?", callback);
    });
});
</script>
{% endblock %}