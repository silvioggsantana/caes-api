# Caes API 🐶

Uma API RESTful para gerenciamento de adoção de cães, permitindo criar, listar, atualizar e deletar usuários, cães, fotos e adoções.
Desenvolvida em PHP com MySQL.

---

## Tecnologias Utilizadas

* PHP 8+
* MySQL
* JSON para requisições e respostas
* Git e GitHub para versionamento

---

## Estrutura do Projeto

```
caes-api/
│
├─ src/
│  ├─ Usuarios.php
│  ├─ UsuariosService.php
│  ├─ Caes.php
│  ├─ CaesService.php
│  ├─ Fotos.php
│  ├─ FotosService.php
│  ├─ Adocoes.php
│  └─ AdocoesService.php
│
├─ códigoCriaçãoDoBanco.txt
├─ .gitignore
└─ README.md
```

* `códigoCriaçãoDoBanco.txt`: arquivo de configuração do banco de dados.
* `Service.php`: contém os endpoints para cada recurso (GET, POST, PUT, DELETE).

---

## Banco de Dados

Banco: `adocao_caes`

Tabelas principais:

* `usuarios` (id, nome, email, senha, telefone, tipo, criado_em)
* `caes` (id, nome, idade, porte, descricao, id_usuario, criado_em)
* `fotos` (id, id_cao, url_foto, criado_em)
* `adocoes` (id, id_cao, id_usuario, data_adocao, descricao, criado_em)

---

## Endpoints

### Usuários

* `GET /usuarios` → lista todos os usuários
* `GET /usuarios/{id}` → retorna usuário específico
* `POST /usuarios` → cria um novo usuário
* `PUT /usuarios/{id}` → atualiza usuário
* `DELETE /usuarios/{id}` → deleta usuário

### Cães

* `GET /caes` → lista todos os cães
* `GET /caes/{id}` → retorna cão específico
* `POST /caes` → cria um novo cão

```json
{
  "nome": "Rex",
  "idade": 3,
  "descricao": "Cão amigável",
  "porte": "Médio",
  "id_usuario": 1
}
```

* `PUT /caes/{id}` → atualiza um cão

```json
{
  "nome": "Rex Atualizado",
  "idade": 4,
  "descricao": "Cão brincalhão",
  "porte": "Médio"
}
```

* `DELETE /caes/{id}` → deleta um cão

### Fotos

* `GET /fotos` → lista todas as fotos
* `GET /fotos/{id}` → retorna foto específica
* `POST /fotos` → adiciona foto

```json
{
  "id_cao": 1,
  "url_foto": "https://meusite.com/fotos/rex.jpg"
}
```

* `PUT /fotos/{id}` → atualiza foto

```json
{
  "url_foto": "https://meusite.com/fotos/rex-atualizado.jpg"
}
```

* `DELETE /fotos/{id}` → deleta foto

### Adoções

* `GET /adocoes` → lista todas as adoções
* `GET /adocoes/{id}` → retorna adoção específica
* `POST /adocoes` → cria uma adoção

```json
{
  "id_usuario": 1,
  "id_cao": 2,
  "data_adocao": "2025-10-30",
  "descricao": "Adoção responsável"
}
```

* `PUT /adocoes/{id}` → atualiza adoção

```json
{
  "id_usuario": 1,
  "id_cao": 2,
  "data_adocao": "2025-10-31",
  "descricao": "Adoção atualizada"
}
```

* `DELETE /adocoes/{id}` → deleta adoção

---

## Como Rodar

1. Clone o repositório:

```bash
git clone https://github.com/silvioggsantana/caes-api.git
```

2. Configure o banco de dados em `códigoCriaçãoDoBanco.txt`.

3. Crie o banco de dados:

```sql
CREATE DATABASE IF NOT EXISTS adocao_caes;
```

4. Crie as tabelas conforme o SQL fornecido.

5. Inicie o servidor PHP:

```bash
php -S localhost:8000
```

6. Teste os endpoints usando Postman, Insomnia ou fetch/Axios.

---

## Contato

Desenvolvedores: Silvio Gabriel, Alessandro Junior e Gabriel Damasceno
GitHub: [silvioggsantana](https://github.com/silvioggsantana)

---

## License

MIT
