<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Essentia Group {% if title %} - {{ title }} {% endif %}</title>
    <link rel="shortcut icon" href="{{ BASE_URL }}/assets/media/img/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="{{ BASE_URL }}/assets/css/styles.css">
</head>
<body>
    <main>
        <div class="logo-image">
            <a href="{{ BASE_URL }}">
                <img src="{{ BASE_URL }}/assets/media/img/icon.png" alt="Logo da Essentia Group">
            </a>
        </div>
        {% block content %} {% endblock %}
    </main>
    <script src="{{ BASE_URL }}/assets/js/font-awesome.js"></script>
    <script src="{{ BASE_URL }}/assets/js/sweetalert2.js"></script>
    <script src="{{ BASE_URL }}/assets/js/scripts.js"></script>
    {% block customJS %} {% endblock %}
</body>
</html>