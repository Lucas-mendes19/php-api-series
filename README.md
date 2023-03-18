# API Series

Uma API REST de serie utilizando requisições GET, POST, PUT, DELETE.

### 📋 Pré-requisitos

**PHP** 8.1, banco de dados **Sqlite**

## 🔧 Para executar este projeto

Clone o projeto e acesse a pasta.
```
$ git https://github.com/Lucas-mendes19/Api-Series.git
$ cd Api-Series
```

Instale composer.
```
$ composer install
```

Execute o script **databaseCreate** para ser criado o banco de dados sqlite.
```
$ php databaseCreate.php
```

Inicie o servidor.
```
$ php -S localhost:8080
```

## Plataformas
Utilize uma plataforma como **Postman** ou **Insomnia** para fazer requisições na API REST.

## Rotas | Método
Agora basta acessar as rotas de url do sistema e fazer solicitações nos métodos para começar a usar.

exemplo: ***http://localhost:8080/api/serie***

### api/serie | GET

Retorna um json com um lista de todos as series cadastradas.
```
{
    "status": "sucess",
    "data": [
        {
            "id": 1,
            "name": "Serie 1",
            "season": 1,
            "episode": 12
        },
        {
            "id": 2,
            "name": "Serie 2",
            "season": 2,
            "episode": 23
        }
    ]
}
```

### api/serie/{id} | GET

Ao passar na URL o **ID** sera retornado um json com as informações da serie requerida.
```
{
    "status": "sucess",
    "data": {
        "id": 1,
        "name": "Serie 1",
        "season": 1,
        "episode": 12
    }
}
```

### api/serie | POST

Ao enviar parâmetros para API ele ira cadastrar a série com as informações
passadas, para poderem ser acessadas via API.
```
{
    "name": "Serie 3",
    "season": 1,
    "episode": 12
}
```

Também é possível passar o id com as informações como parâmetro em requisições **POST**, fazendo com que a série com o id especificado seja editada invés de cadastrada com os parâmetros informados.
```
{
    "id": 1,
    "name": "Serie Update",
    "season": 2,
    "episode": 22
}
```

### api/serie | PUT

Sera editado a série do **ID** informado com as informações passadas como parâmetros na requisição.
```
{
    "id": 1,
    "name": "Serie Update",
    "season": 2,
    "episode": 22
}
```

### api/serie/{id} | DELETE

Sera deletado a serie com o **ID** informado na **URL**.

## 🎁 Detalhes

⌨️ Feito por [Lucas Mendes de Carvalho](https://github.com/Lucas-mendes19) 