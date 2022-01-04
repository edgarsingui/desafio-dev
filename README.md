## IMPORT CNAB

Este é um projecto simples feito utilizando Laravel e Vue JS (CDN)
O Projecto foi feito seguindo as instruções do [Desafio-Dev da ByCoders](https://github.com/ByCodersTec/desafio-dev)
O Projecto não foi feito para a Vaga "mas se quiserem me contratar fiz o desafio 😂🤣", apenas encontrei por aí achei interessante e decidi fazer xD.

Ficheiro [CNAB](https://github.com/ByCodersTec/desafio-dev/blob/main/CNAB.txt) a ser importado.

## Instruções de como configurar

1. Deve deixar uma Estrela :)
2. Deve fazer o clone desse repositorio para a sua máquina
3. Deve ter instalado o PHP em sua máquina.
4. Criar uma base de dados de nome "desafio"
5. Importar a [(base de dados)][https://github.com/edgarsingui/desafio-dev/blob/main/desafio.sql]
6. Renomeiar o arquivo ".env.example" para ".env"
7. Em ".env" Localizar o "DB_DATABASE=laravel" e trocar por "DB_DATABASE=desafio" ou pelo nome da base de dados criada
8. Navegar pelo terminal até a pasta do projecto e rodar o comando "php artisan key:generate"
9. Rodar o comando "php artisan serve" deverá ser iniciado o servidor de dev em http://127.0.0.1:8000 se for setada outra porta diferente da padrão deverá ir até "public/scripts/config.js" e definir o host e a porta iniciada.
10. Depois desses 9 passos simples deve estar pronto para testar :).

## O Projecto

O Projecto conta com uma api de 3 Rotas bem simples

1. /api/importar - verbo (post) - rota utilizada para importar os dados do arquivo CNAB para a base de dados.
2. /api/listar - verbo (get) - rota utilizada para listar as lojas e todos os movimentos.
3. /api/ver-loja/nome da loja - verbo(get) - rota utilizada para listar os movimentos/transações de uma determinada loja.
