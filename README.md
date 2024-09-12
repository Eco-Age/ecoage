# ♻️ **EcoAge** 

**EcoAge** é um sistema web interativo que conscientiza sobre tecidos sustentáveis, utilizando gamificação. Com um portal de notícias, quiz educativo e o jogo "Guess the Tissue", **EcoAge** ensina de forma divertida o impacto ambiental causado pelos diferentes tecidos.

---

## **Índice**

- [Descrição](#descrição)
- [Funcionalidades](#funcionalidades)
- [Tecnologias Utilizadas](#tecnologias-utilizadas)
- [Instalação](#instalação)
- [Configuração do Banco de Dados](#configuração-do-banco-de-dados)
- [Uso](#uso)
- [Validação e Testes](#validação-e-testes)
- [Colaboradores](#colaboradores)
- [Licença](#licença)



## **Descrição**

> 🌍 *A indústria da moda exerce um impacto ambiental significativo.* <br>
> O **EcoAge** propõe uma solução sustentável, conscientizando a população sobre tecidos ecológicos.

O sistema possui:
- **Portal de notícias** sobre moda sustentável.
- **Quiz interativo** para testar conhecimentos.
- **Jogo educativo** com gamificação: **Guess the Tissue**.

<img width="440" alt="ecoage" src="https://github.com/user-attachments/assets/93ff52f8-5335-45c6-b942-b923bab0e575">

## ⭐️ **Funcionalidades**

|   Funcionalidade             |  Descrição                                                                                          |
|------------------------------|------------------------------------------------------------------------------------------------------|
| **Cadastro de Usuários**      | Permite o registro e login no sistema.                                                               |
| **Portal de Notícias**        | Notícias sobre avanços na moda sustentável.                                                          |
| **Quiz**                      | Teste seu conhecimento sobre tecidos ecológicos.                                                     |
| **Jogo: Guess the Tissue**    | Jogo interativo com gamificação.                                                                     |
| **Sistema de Pontuação**      | Os usuários ganham pontos ao participar do quiz e do jogo.                                           |
| **Ranking**                   | Classificação com as maiores pontuações.                  |
| **Visão Administrativa**      | Acesso exclusivo para administradores gerenciarem a plataforma.                                       |
| **Gestão de Tecidos**         | Administradores podem adicionar novos tecidos que se tornarão patentes no jogo "Guess the Tissue".    |
| **Gerenciamento de Dúvidas**  | Administradores podem verificar e responder dúvidas enviadas por usuários via e-mail.                |

---

## 🛠️ **Tecnologias Utilizadas**

```plaintext
 Back-end: PHP, MySQL
 Front-end: HTML5, CSS3, JavaScript (Ajax, JQuery, JSON), Bootstrap
 APIs: Google Material Icons, SweetAlert2
 Servidor Web: Apache
```

---

## ⚙️ **Instalação**

### 1. Clone o Repositório

```bash
git clone https://github.com/usuario/ecoage.git
```

### 2. Mova os Arquivos para o Servidor Web

```bash
mv ecoage /caminho/para/servidor/htdocs
```

### 3. Instale Dependências

```bash
composer install
```

### 4. Acesse o Sistema

```plaintext
http://localhost/ecoage
```

---

## 💾 **Configuração do Banco de Dados**

1. Importe o arquivo SQL no seu MySQL:
   ```sql
   mysql -u usuário -p senha ecoage < script.sql

   ```

2. Configure o arquivo `conexao.php` com as credenciais:
   ```php
   function obterConexao() {
      $servidor = "nomeDoDominioOuIP:Porta";
      $usuario = "usuarioDoMysql";
      $senha = "senhaDoUsuario";
      $banco = "nomeDaTable";
   ```

---

## 🎮 **Uso**

1. Faça o login ou crie uma conta.
2. Acesse as funcionalidades:
   - **Portal de Notícias**
   - **Quiz**
   - **Jogo Guess the Tissue**
3. Acompanhe sua pontuação e compare na **Ranking**.



## 🔍 **Validação e Testes**

**Usuários-Teste:** Faixa etária de 15 a 25 anos.<br>
**Métodos:** Questionários quantitativos e qualitativos.<br>
**Resultados:** Alta satisfação, com feedback positivo sobre a experiência e conscientização proporcionada.


## 💡 Colaboradores

|      Nome       |                 GitHub                   |
|-----------------|------------------------------------------|
| Ana Beatriz Duarte    | [Ana Beatriz Duarte](https://github.com/AnaDuarte1) |
| Eduardo Bonifacio     | [Eduardo Bonifacio](https://github.com/edu-boni) |
| Gabrielle Ulisses     | [Gabrielle Ulisses](https://github.com/gabi-ulisses) |


> 🙋‍♀️ *Quer contribuir? Faça um fork e envie um pull request!*

---

## 📜 **Licença**

Este projeto está licenciado sob a licença **MIT**.

---
