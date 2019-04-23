<p align="center">
  <img src="https://www.devninjas.com.br/wp-content/themes/understrap-child/img/logo-devninjas.png" width="250">
</p>

# < back >Developer</ end >

Objetivo deste desafio é avaliarmos o seu domínio em back-end, ou seja, sua organização, lógica e boas práticas com o 
código, conhecimento dos frameworks e tecnologias utilizadas.

## Regras

1. Todo o seu código deve ser disponibilizado num repositório **público** ou **privado** em seu Github, Gitlab ou Bitbucket 
pessoal. Envie o link para contato@devninjas.com.br ou faça um pull-request;  

2. Desenvolver o projeto utilizando:  
  - Algum framework PHP (Atualmente estamos trabalhando com **Slim Framework e Zend Expressive**, mas use o que achar melhor);
  
3. A aplicação deve comportar-se como uma REST FULL Api.

4. Readme que explique como rodar o projeto, como executar quaisquer scripts necessários.

5. A aplicação deve possuir um script que popula o banco inicialmente com produtos, clientes e pedidos fictícios para 
demonstração.

## Extra

- Utilizar Doctrine
- Utilizar Cache
- Autenticação nas requisições
- Utilizar Docker

## O Desafio

O desafio consiste em criar uma API REST para a lojinha da Dona Maria que será consumida por um aplicativo (Android e iOS). 
Todos os itens serão colocados em um carrinho do lado do aplicativo e passados para a API para realizar 
uma transação e-commerce.

### POST `/v1/products`

Esse método deve receber um produto novo e inseri-lo em um banco de dados para ser consumido pela própria API.

```json
{
   "id": 0,
   "sku": 8552515751438644,
   "name": "Casaco Jaqueta Outletdri Inverno Jacquard",
   "price": 109.90,
   "createdAt": "2018-08-27T02:11:43Z",
   "updatedAt": null
}
```

| Campo       | Tipo     |
|-------------|----------|
| id          | int      |
| sku         | int      |
| name        | string   |
| price       | double   |
| createdAt   | datetime |
| updatedAt   | datetime |

##### Critérios de aceitação:

- Todos os atributos são obrigatórios.
- ID, SKU e Nome não podem se repetir.
- Preço é monetário e deve ser maior que zero.

### GET `/v1/products`

Esse método da API deve retornar o seguinte JSON.

```json
[
  {
    "id": 1,
    "sku": 8552515751438644,
    "name": "Casaco Jaqueta Outletdri Inverno Jacquard",
    "price": 109.90,
    "createdAt": "2018-08-27T02:11:43Z",
    "updatedAt": "2018-08-27T02:30:20Z"
  },
  {
    "id": 2,
    "sku": 8552515751438645,
    "name": "Camiseta Colcci Estampada Azul",
    "price": 79.90,
    "createdAt": "2018-08-27T02:11:43Z",
    "updatedAt": null
  }
]
```

### POST `/v1/customers`

Esse método deve receber um cliente novo e inseri-lo em um banco de dados para ser consumido pela própria API.

```json
{
   "id": 0,
   "name": "Maria Aparecida de Souza",
   "cpf": "81258705044",
   "email": "mariasouza@email.com",
   "createdAt": "2018-08-27T02:11:43Z",
   "updatedAt": null
}
```

| Campo       | Tipo     |
|-------------|----------|
| id          | int      |
| name        | string   |
| cpf         | string   |
| email       | string   |
| createdAt   | datetime |
| updatedAt   | datetime |

##### Critérios de aceitação:

- Todos os atributos são obrigatórios.
- ID, CPF e e-mail não podem se repetir.
- CPF deve ser válido.

### POST `/v1/orders`

Esse método deve receber um pedido de venda novo e inseri-lo em um banco de dados para ser consumido pela própria API.

```json
{
  "id": 0,
  "createdAt": "2018-08-27T02:11:43Z",
  "status": "CONCLUDED",
  "total": 189.80,
  "buyer": {
    "id": 1,
    "name": "Maria Aparecida de Souza",
    "cpf": "81258705044",
    "email": "mariasouza@email.com"
  },
  "items": [
    {
      "amount": 1,
      "price_unit": 109.90,
      "total": 109.90,
      "product": {
        "id": 1,
        "sku": 8552515751438644,
        "title": "Casaco Jaqueta Outletdri Inverno Jacquard"
      }
    },
    {
      "amount": 1,
      "price_unit": 79.90,
      "total": 79.90,
      "product": {
        "id": 2,
        "sku": 8552515751438645,
        "title": "Camiseta Colcci Estampada Azul"
      }
    }
  ]
}
```

+ Order

| Campo       | Tipo     |
|-------------|----------|
| id          | int      |
| customer_id | int      |
| total       | double   |
| status      | string   |
| createdAt   | datetime |

+ Order Items

Um pedido por ter um ou mais item.

| Campo       | Tipo     |
|-------------|----------|
| id          | int      |
| order_id    | int      |
| product_id  | int      |
| amount      | int      |
| price_unit  | double   |
| total       | double   |

##### Critérios de aceitação:

- Todos os atributos são obrigatórios.
- ID não podem se repetir.
- Todos os valores numéricos devem ser maior que zero.
- Total é monetário e deve ser maior que zero.


### PUT `/v1/orders{{ID_ORDER}}`

Esse método atualiza o status para "CANCELED" o pedido de venda informado.

```json
{
  "order_id": 1,
  "status": "CANCELED"
}
```

| Campo       | Tipo     |
|-------------|----------|
| order_id    | int      |
| status      | string   |

##### Critérios de aceitação:

- Todos os atributos são obrigatórios.


### GET `/v1/orders`

Esse método da API deve retornar o seguinte JSON.

```json
[
  {
    "id": 1,
    "createdAt": "2018-08-27T02:11:43Z",
    "cancelDate": "2018-08-30T03:15:42Z",
    "status": "CANCELED",
    "total": 189.80,
    "buyer": {
      "id": 1,
      "name": "Maria Aparecida de Souza",
      "cpf": "81258705044",
      "email": "mariasouza@email.com"
    },
    "items": [
      {
        "product": {
          "id": 1,
          "sku": 8552515751438644,
          "title": "Casaco Jaqueta Outletdri Inverno Jacquard"
        },
        "amount": 1,
        "price_unit": 109.90,
        "total": 109.90
      },
      {
        "product": {
          "id": 2,
          "sku": 8552515751438645,
          "title": "Camiseta Colcci Estampada Azul"
        },
        "amount": 1,
        "price_unit": 79.90,
        "total": 79.90
      }
    ]
  },
  {
    "id": 2,
    "createdAt": "2018-08-27T02:11:43Z",
    "cancelDate": null,
    "status": "CONCLUDED",
    "total": 109.90,
    "buyer": {
      "id": 1,
      "name": "Lurdes da Silva",
      "cpf": "46793282077",
      "email": "lurdesdasilva@email.com"
    },
    "items": [
      {
        "product": {
          "id": 1,
          "sku": 8552515751438644,
          "title": "Casaco Jaqueta Outletdri Inverno Jacquard"
        },
        "amount": 1,
        "price_unit": 109.90,
        "total": 109.90
      }
    ]
  }
]
```

## Dúvidas

Envie suas dúvidas diretamente para contato@devninjas.com.br ou abrindo uma issue.
