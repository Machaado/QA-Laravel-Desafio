CASOS DE USO - DESAFIO LARAVEL


Caso de Teste 1 - Cadastro com Dados Válidos
Objetivo: Garantir que um cliente seja cadastrado com sucesso com todos os campos válidos.

Pré-condição: Usuário autenticado como Cooperativa.

Passos:

    1. Acessar o formulário de cadastro de clientes.

    2.Preencher os campos obrigatórios: Nome, CNPJ válido, E-mail válido, Telefone válido.

    3.Submeter o cadastro.

Resultado Esperado: Cliente cadastrado com status "Pendente" e aparece na listagem.

-=-=-=-=-=-=-=

Caso de Teste 2 - Cadastro com CNPJ Inválido
Objetivo: Validar a regra de CNPJ.

Pré-condição: Usuário autenticado.

Passos:

    1. Acessar o formulário de cadastro.

    2. Informar um CNPJ inválido (ex.: 12345678900000).

    3. Preencher os demais campos corretamente.

    4. Submeter o cadastro.

Resultado Esperado: Sistema exibe mensagem de erro: "CNPJ inválido".




Caso de Teste 3 - Cadastro com CNPJ Duplicado
Objetivo: Garantir que o sistema não permita CNPJ repetido.

Pré-condição: Já existe um cliente com o CNPJ 12345678000195.

Passos:

    1. Tentar cadastrar um novo cliente com o mesmo CNPJ.

Resultado Esperado: Mensagem de erro: "CNPJ já cadastrado".




Caso de Teste 4 - Listagem com Filtro por Nome
Objetivo: Verificar a busca de clientes por nome.

Pré-condição: Existência de clientes cadastrados com nomes variados.

Passos:

    1. Acessar a listagem de clientes.

    2. Informar um nome existente no campo de filtro.

    3. Aplicar o filtro.

Resultado Esperado: Lista apenas com clientes cujo nome contém o termo filtrado.




Caso de Teste 5 - Aprovação de Cadastro
Objetivo: Verificar o fluxo de aprovação de cliente.

Pré-condição: Cliente com status "Pendente".

Passos:

    1. Logar como administrador.

    2. Acessar a lista de clientes pendentes.

    3. Clicar em "Aprovar".

Resultado Esperado: Status do cliente muda para "Aprovado" e ele aparece na lista de aprovados.

