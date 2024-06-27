{% extends "_template.twig.php" %}
{% block content %}
<div class="header">
    <a href="{{ BASE_URL }}"><i class="fa fa-chevron-left"></i> Voltar</a>
</div>

<form id="customer-form" method="POST" enctype="multipart/form-data">
    {% if customer %}
    <input type="hidden" name="id" value="{{ customer.id }}">
    {% endif %}
    <div class="file-input">
        <div class="pre-viewer-image">
            {% if customer %}
            <img src="{{ BASE_URL }}/{{customer.image_url}}" alt="{{ customer.name }}">
            {% endif %}
        </div>
        <input type="file" accept="image/*" name="customer-image" id="customer-image">
        <label for="customer-image" class="select-customer-image"><i class="fa fa-camera"></i> {% if customer %} Alterar
            {% else %} Selecionar {% endif %} imagem</label>
    </div>
    <div class="input-group">
        <label for="name">Nome</label>
        <input type="text" name="name" id="name" placeholder="Nome do cliente" value="{{ customer.name }}" required
               autofocus>
    </div>
    <div class="input-group">
        <label for="email">E-mail</label>
        <input type="email" name="email" id="email" placeholder="email@exemplo.com" value="{{ customer.email }}"
               required>
    </div>
    <div class="input-group">
        <label for="phone_number">Telefone</label>
        <input type="text" name="phone_number" id="phone_number" placeholder="(99) 9 9999-9999"
               value="{{ customer.phone_number }}" required>
    </div>
    {% if customer %}
    <input type="submit" value="Salvar">
    {% else %}
    <input type="submit" value="Cadastrar">
    {% endif %}
</form>
{% endblock %}
{% block customJS %}
<script src="{{ BASE_URL }}/assets/js/jquery.js"></script>
<script src="{{ BASE_URL }}/assets/js/jquery.mask.js"></script>
<script>
    $("input[name='phone_number']").mask("(00) 0 0000-0000");

    const customerImageInput = document.querySelector("#customer-image");
    customerImageInput.addEventListener("change", (_event) => {
        handlePreviewerImage(customerImageInput.files);
    });

    const customerForm = document.querySelector("#customer-form");
    customerForm.addEventListener("submit", async (event) => {
        event.preventDefault();
        const fileInput = document.querySelector("#customer-image");

        /*
        if (fileInput.files.length === 0) {
            displayCustomAlert("Atenção!", "Você precisa inserir uma imagem para continuar", "error");
            return false;
        }*/

        const name = document.querySelector("input[name='name']").value;
        const email = document.querySelector("input[name='email']").value;
        const phone_number = document.querySelector("input[name='phone_number']").value;

        const formData = new FormData();
        if (fileInput.files.length > 0) {
            formData.set("file", fileInput.files[0]);
        }
        formData.set("name", name);
        formData.set("email", email);
        formData.set("phone_number", phone_number.replace(/\D/g, ""));

        const id = document.querySelector("input[name='id']");
        const apiUri = id ? `/edit/${id.value}` : "/insert";
        const response = await handleCustomerForm(`{{ BASE_URL }}/customer${apiUri}`, formData);

        const icon = response.status === 200 ? "success" : "error";
        const title = response.status === 200 ? "Sucesso" : "Atenção";
        displayCustomAlert(title, response.message, icon);
        if (response.status === 200) {
            setTimeout(() => {
                window.location.href = "{{ BASE_URL }}";
            }, 2000);
        }
    });
</script>
{% endblock %}