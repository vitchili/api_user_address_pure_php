## Projeto de API REST: User & Address. PHP 8.2 Sem frameworks

Recomendo utilizar primeiro a API do repositório 'https://github.com/vitchili/api_user_address' pois está sendo usado o mesmo banco de dados.

Ao rodar o comando artisan migrate no outro projeto, o banco será criado com todas tabelas necessárias e alguns registros populados. Portanto, decidi criar este container em outra porta da aplicação, mas mesma porta do banco. Então você pode utilizar ambas aplicações rodando: a primeira na porta 8083 e esta na 8084, e ambas conectadas no mesmo banco.

.

O ambiente de desenvolvimento foi criado via Docker e está utilizando o serviço Nginx como proxy reverso.

Optei por colocar todos os passos da utilização da forma mais detalhada aqui, para evitar que hajam pré-requisitos de conhecimentos independente de quem serão os utilizadores dessa API.

### Guia de utilização
Após o clone do repositório, na raiz do projeto /:

```console
$ docker-compose up -d --build
```

## Documentação API User & Address

A documentação da outra versão (em Laravel) está completa e esta segue a mesma regra, embora de forma resumida.

Para esta, verifique a collection exportada do Postman para se orientar, pois os nomes das rotas são ligeiramente diferentes.

/api/public/Mentes Notáveis PHP Puro.postman_collection.json

#### Observação
Database name: mentes-notaveis

PS: Infelizmente o tempo era curto e o sistema de rotas ficou abaixo da expectativa. Com mais tempo, posso refatorar se for necessário.

