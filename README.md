<p align="center">
    <img src="https://attachments.gupy.io/production/companies/32213/career/73435/images/2022-06-29_14-57_logo.jpg" width="120px" />
</p>
<br>
<div align="center" style="display: inline-flex; gap: 8px; text-align: center;">
    <img src="https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white" alt="PHP" />
    <img src="https://img.shields.io/badge/mysql-4479A1.svg?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL" />
    <img src="https://img.shields.io/badge/apache-%23D42029.svg?style=for-the-badge&logo=apache&logoColor=white" alt="Apache" />
    <img src="https://img.shields.io/badge/docker-%230db7ed.svg?style=for-the-badge&logo=docker&logoColor=white" alt="Docker" />
</div>

## Desafio Full-stack: Cadastro de Clientes

### Descrição do Desafio

Crie, conforme seus conhecimentos, um pequeno sistema de cadastro de clientes, com uma tela de visualização e exclusão de registros e formulário(s) para inserção e edição dos cadastros já inseridos. Essas informações devem ser registradas em um banco de dados relacional (Mysql e/ou Postgres).

### Requisitos Técnicos

O formulário deve conter, pelo menos, o nome, e-mail, telefone e uma foto, que dever, ser enviada para o servidor HTTP (LAMP, XAMP, MAMP...) instalado na sua maquina, essa imagem deve ser apresentada ao lado do nome do cliente na lista de visualização, em miniatura.

### Instruções para Submissão

- Crie uma conta grátis ou caso já possua, envie todo o código para um repositório `GIT` (`GitHub` ou `BitBucket`);

- Descreva uma breve documentação/instruções de como executar seu projeto, utilizando o `Readme.md`

- Use a linguagem `PHP 7.0+`

- Explore ao máximo conceitos de Orientação a objetos, `DRY` e `S.O.L.I.D.`

- Fique a vontade para usar qualquer framework que você possua conhecimento, como `Laravel`, `Zend Framework`, `CakePHP`.

### Pré-requisitos para rodar o projeto

- `PHP ^8.0`;
- Ter o `Docker` instalado;
- Ter o `Composer` instalado;

### Estrutura de pastas

```
├── assets/
│   ├── css/
│   ├── js/
│   ├── media/
│   │   └── img/
├── docker/
│   ├── apache/
│   ├── mysql/
│   ├── php/
├── Src
│   ├── Controllers/
│   │   └── Twig/
│   ├── Core/
│   ├── Database/
│   │   └── Entities/
│   │   └── Factories/
│   │   └── Migrations/
│   │   └── Repositories/
├── tests/
│   ├── unit/
│   ├── integration/
├── views/
│   ├── twig/
```

### Resumo da minha Solução

Não quis utilizar nenhum framework. Fiz todo o teste com `PHP` puro para sugerir um controle de organização de pastas e do projeto em si.

Inicialmente pensei em estruturas que trariam uma complexidade que não é necessária para onde queremos chegar aqui. As únicas coisas que me atentei foi não repetir código (`DRY`) e alguns princípios do `SOLID`. Queria ter criado uma camada de serviço para isolar as responsabilidades dos serviços requeridos (criação e alteração de cliente), mas não tive muito tempo hábil pra trabalhar nesse projeto devido a demanda de trabalho.

Basicamente criei um sistema `MVC`. Na camada de `Controllers` eu criei uma classe abstrata chamada `BaseController` onde implemento uma função que retornará um dos tipos de resposta requeridos pelo sistema: `JSON`. Também criei uma `interface` que é responsável pela assinatura do método que retorna o outro tipo de resposta que o sistema comporta, utilizando uma `View`. Já nas implementações eu utilizei o template engine `Twig`.

Para a persistência, utilizei o ORM `Eloquent`. O uso dele é bastante intuitivo e simples de configurar. O arquivo com as configurações de execução estão em `Core/Connection.php`. Já as `entidades`, `migrations` e `repositórios` estão dentro da camada `Database`. Também na camada `Database` eu utilizei o padrão de projeto `Factory` para criar um repositório de clientes já instanciado. Assim, eu não preciso instanciá-lo sempre que quiser usá-lo. Eu poderia ter criado uma camada de `Serviço` com arquivos que consomem este e/ou outros repositórios do sistema.

Na camada `Helpers` eu criei classes que podem ser reutilizadas no sistema, como a criação de arquivos e formatação de alguns tipos de texto.

Habilitei também o sistema para testes com o `PHPUnit`. Criei apenas um teste unitário para validar um dos arquivos da camada `Helpers`. Em um ambiente profissional, haveria a obrigação de testes de integração e end-to-end para validação nos serviços de `CI` e `CD`. Como eu tinha pouco tempo, utilizei o `Insomnia` para testar os endpoints.

A camada `views` contém os arquivos de visão do sistema. Como estou utilizando apenas o `Twig`, criei uma subpasta com o mesmo nome e disponibilizei as views do twig lá.

### Objetivos Atingidos

- [x] Cadastrar cliente
- [x] Editar cliente
- [x] Excluir cliente
- [x] Visualizar cliente
- [x] Exibe lista com miniatura da foto ao lado

### Prints do Sistema

Tela Inicial
<div align="center">
    <img style="width: 100%" src="https://i.postimg.cc/fT58nQcW/tela-inicial.jpg" alt="Tela Inicial" />
</div>

Tela de Cadastro
<div align="center">
    <img style="width: 100%" src="https://i.postimg.cc/SQ6ZdMjM/tela-cadastro.jpg" alt="Tela de Cadastro" />
</div>

Tela de Edição
<div align="center">
    <img style="width: 100%" src="https://i.ibb.co/Dg9mGn9/tela-edicao.jpg" alt="Tela de Edição" />
</div>

Tela de Visualização
<div align="center">
    <img style="width: 100%" src="https://i.ibb.co/0K8wfs3/tela-profile.jpg" alt="Tela de Visualização" />
</div>

### Como utilizar

Inicialmente, os arquivos de configuração do sistema estão localizados na raíz, no arquivo `.env`.

```dotenv
BASE_URL=http://localhost:8080

DB_DRIVER=mysql
DB_HOST=setup-mysql
DB_PORT=3306
DB_NAME=db_project
DB_USER=owner
DB_PASSWORD=pass2024!

MAX_FILE_SIZE_IN_MB=10
```

<p>`BASE_URL`: local onde estão apontados os arquivos do sistema.</p>
<p>`DB_DRIVER`: driver do gerenciador do banco de dados utilizado.</p>
<p>`DB_HOST`: local onde está rodando o servidor. Pode ser um container do `Docker`, um endereço local ou externo.</p>
<p>`DB_PORT`: porta de entrada do servidor de banco de dados.</p>
<p>`DB_NAME`: nome do banco de dados, pode ser o criado pelo `Docker` ou um banco criado localmente.</p>
<p>`DB_USER`: nome do usuário do banco de dados `Docker` ou local instalado na máquina.</p>
<p>`DB_PASSWORD`: senha do usuário do banco de dados `Docker` ou local instalado na máquina.</p>
<p>`MAX_FILE_SIZE_IN_MB`: limite de tamanho para o upload de imagens. Neste caso, 10mb.</p>

- 1. Faça o clone do repositório para a sua máquina.
- 2. Abra o terminal na raíz do projeto recém clonado.
- 3. Utilize o comando `composer update` para que sejam instaladas todas as dependências do projeto nas versões que foram concebidas.

Nesta parte, os passos se dividem, dependendo da forma que você preferir testar.

#### Com `Docker`

- Ainda no terminal do projeto, digite o comando `docker-compose up -d` para subir um ambiente de desenvolvimento pronto.
- O endpoint para criar a `migration` da tabela de clientes é: `http://localhost:8080/migrate`. Você pode acessá-lo diretamente por linha de comando no próprio terminal com o `curl`: `curl -X POST http://localhost:8080/migrate` ou abrir no navegador este mesmo link para uma requisição `GET`. A requisição `POST` retorna um `JSON` e a `GET` retorna uma `View`.
- Com o projeto rodando e a migration criada, o projeto pode ser acessado em: http://localhost:8080

OBS: se o seu computador já utiliza a porta `8080` em algum serviço, será necessário efetuar a mudança da porta no arquivo `docker-compose.yml`.

#### Localmente

Para rodar o projeto localmente, você precisa ter um servidor PHP (versão 8.0 ou superior) rodando na sua máquina e uma instação do `MySQL Server`.

Se você tiver o `XAMPP` instalado, por exemplo, a pasta do projeto deve ser inserida dentro da pasta `htdocs`.

Uma vez que você tem o `PHP` 8+ e o servidor MySQL rodando, altere as variáveis do arquivo `.env` na raíz do projeto de acordo com as suas configurações.

```dotenv
BASE_URL=http://{SEU_HOST}:{SUA_PORTA}/{PASTA_DO_PROJETO}

DB_DRIVER=mysql
DB_HOST={SEU_HOST_LOCAL} #ex: Localhost
DB_PORT={PORTA_BANCO_DE_DADOS_LOCAL} # ex: 3306
DB_NAME={NOME_DO_BANCO_QUE_VOCE_CRIOU}
DB_USER={USUARIO_LOCAL_BANCO_DE_DADOS}
DB_PASSWORD={PASSWORD_LOCAL_BANCO_DE_DADOS}
```

Assim que o arquivo `.env` estiver devidamente configurado, crie um banco de dados com o mesmo nome que você colocou na variável `DB_NAME`.

Com o arquivo `.env` configurado e o banco de dados criado, é possível realizar a `migration` explicada no passo 2 da instalação com `Docker`.

O sistema estará pronto para ser acessado no destino que você configurou no arquivo `.env` na variável `BASE_URL`.

#### Testes

É possível rodar testes através do comando `.\vendor\bin\phpunit`.

Não cheguei a criar testes de integração mas, se criasse, provavelmente seria preciso utilizar as variáveis de ambiente do arquivo de manifesto do `PHPUnit`, que é o `phpunit.xml`.

That's all, folks!

Qualquer dúvida, estou à disposição.
