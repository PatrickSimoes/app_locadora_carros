# Comandos usados no Projeto #

## Listar Rotas ##

    php artisan route:list

## Criar Rota ##

    php artisan make:controller ExempleController

## LocalHost do PHP ##

    php artisan serve

## Limpar o Cache da View Compiladas ##
    
    php artisan view:clear

## Criação de Models ##
    
  - Criar de um Model 
    ```
    php artisan make:model NomeModel
    ```
    
  - Criar de um Model com arquivo de Migrations
    ```
    php artisan make:model NomeModel -m
    ```
    
## Criar Arquivo de Migração para o Banco de Dados ##

    php artisan migrate

## Criar Artivo de Migração após Model ser criado ##

    php artisan make:migration create_nome_model_table 

## Verificação se a Extensão está habilitada no PHP.ini ##

     php -r "var_dump(extension_loaded( 'nome_extension'));

## Comando para Criar Migrações de Atualizações ##

    php artisan make:migration nome_atualiza_tables
    
## Executa o metodo Down de uma Migração ##
    
  - Executa apenas 1 Roll Back
    ```
    php artisan migrate:rollback
    ```
  - Define o n° de Roll Backs
    ```
    php artisan migrate:rollback --step= 
    ```
    
## Exclui todas as tabelas do banco de dados e recria as Migration ##

    php artisan migrate:fresh

## Abrindo o Tinker ##

    php artisan tinker

## Cria um Seeder ##

    php artisan make:seeder classSeeder

## Envia os Cadastros para o banco de Dados pelo Seeder/Factories ##
    
  - Envia Tudo Que estiver no database\seeders
    ```
    php artisan db:seed
    ```
    
  - Envia apenas um Seeder
    ```
    php artisan db:seed --class=NomeClassSeeder
    ```
