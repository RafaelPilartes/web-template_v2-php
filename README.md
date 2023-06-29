#

## Estrutura de Pasta do Projeto PHP

A estrutura de pasta do projeto PHP é organizada da seguinte maneira:

Projeto
├── app
│ ├── controllers
│ │ └──BaseController.php
│ │ └──BaseTemplateController.php
│ │ └──DashboardController.php
│ │ └──DashboardTemplateController.php
│ ├── core
│ │ └──Controller.php
│ │ └──Router.php
│ │ └──RoutersFilter.php
│ ├── helpers
│ │ └──constants.php
│ ├── routes
│ │ └──Routes.php
│ ├── support
│ │ └──RequestType.php
│ │ └──Uri.php
│ └── views
├── public
│ └── index.php
└── vendor

Essa estrutura de pasta segue um padrão MVC (Model-View-Controller), onde a pasta `app` contém os controladores, a pasta `views` contém as visualizações e a pasta `core` contém as classes principais responsáveis pela lógica de roteamento e controle. O arquivo `index.php` na pasta `public` é o ponto de entrada da aplicação, que inicializa o roteamento. As classes nas pastas `helpers` e `routes` fornecem funcionalidades auxiliares e definem as rotas da aplicação, respectivamente.

Aqui está uma explicação sobre cada pasta e arquivo neste projeto:

### Pasta `app`

Esta pasta contém os componentes principais da aplicação.

- **controllers**: Esta pasta armazena os controladores (classes) responsáveis por processar as solicitações e fornecer as respostas adequadas. Os controladores geralmente contêm métodos que correspondem às rotas definidas na pasta `routes`.
- **core**: Esta pasta contém as classes essenciais para o funcionamento da aplicação. Neste caso, encontramos a classe `Router` e a classe `Controller`, que são responsáveis pelo roteamento das solicitações e pela execução dos controladores correspondentes.
- **helpers**: Esta pasta contém arquivos ou classes auxiliares que podem ser usados em toda a aplicação para fornecer funcionalidades adicionais.
- **routes**: Esta pasta contém arquivos ou classes que definem as rotas da aplicação. Cada rota é mapeada para um controlador e método específicos.
- **support**: Esta pasta contém classes auxiliares relacionadas ao suporte e funcionalidades adicionais da aplicação. Os arquivos `RequestType.php` e `Uri.php` estão localizados dentro dessa pasta.
- **views**: Esta pasta contém os arquivos de visualização da aplicação. Geralmente, são arquivos HTML misturados com código PHP para exibir o conteúdo dinâmico.

> #### - **controllers**:

A pasta **`controllers`** contém os controladores do aplicativo, que são responsáveis por processar as requisições e fornecer respostas adequadas. Nesta pasta, temos os seguintes arquivos:

- **`BaseController.php`**: Este arquivo contém a classe **_BaseController_**, que define métodos para lidar com as requisições relacionadas à parte principal do aplicativo.
- **`BaseTemplateController.php`**: Este arquivo contém a classe **_BaseTemplateController_**, que é responsável por renderizar as visualizações relacionadas à parte principal do aplicativo.
- **`DashboardController.php`**: Este arquivo contém a classe **_DashboardController_**, que define métodos para lidar com as requisições relacionadas ao painel de controle do aplicativo.
- **`DashboardTemplateController.php`**: Este arquivo contém a classe **_DashboardTemplateController_**, que é responsável por renderizar as visualizações relacionadas ao painel de controle do aplicativo.

> #### - **core**:

A pasta **core** contém os componentes principais do framework ou do núcleo do aplicativo. Nesta pasta, temos os seguintes arquivos:

- **`Controller.php`**: Este arquivo contém a classe **_Controller_**, que fornece funcionalidades básicas para os controladores do aplicativo.
- **`Router.php`**: Este arquivo contém a classe **_Router_**, responsável por analisar a rota solicitada e executar o controlador apropriado.
- **`RoutersFilter.php`**: Este arquivo contém a classe **_RoutersFilter_**, que filtra e seleciona a rota adequada com base na URI e no método da requisição.

> #### - **helpers**:

A pasta **helpers** contém arquivos que contêm funções auxiliares e constantes utilizadas em todo o aplicativo. Nesta pasta, temos o seguinte arquivo:

- **`constants.php`**: Este arquivo contém definições de constantes que podem ser usadas em diferentes partes do aplicativo.

> #### - **routes**:

A pasta **routes** contém arquivos relacionados à definição e configuração de rotas no aplicativo. Nesta pasta, temos o seguinte arquivo:

- **`Routes.php` **: Este arquivo contém a classe **_Routes_**, que define as rotas disponíveis no aplicativo e associa cada rota a um controlador e método específicos.

> #### - **support**:

A pasta **support** contém classes de suporte para o funcionamento do aplicativo. Nesta pasta, temos os seguintes arquivos:

- **`RequestType.php` **: Este arquivo contém a classe **_RequestType_**, que fornece um método estático para obter o tipo de requisição HTTP (GET, POST, etc.).
- **`Uri.php` **: Este arquivo contém a classe Uri, que fornece um método estático para obter a **_URI_** (Uniform Resource Identifier) da requisição atual.

> #### - **views**:

A pasta **views** contém os arquivos de visualização do aplicativo, que são responsáveis por exibir os dados para o usuário. Os arquivos de visualização são organizados em subpastas correspondentes aos controladores relevantes.

### Pasta `public`

A pasta **public** é a raiz do aplicativo e contém o arquivo **`index.php`**. Este é o ponto de entrada do aplicativo, onde todas as requisições são direcionadas.

- **index.php**: Este arquivo PHP é o ponto de entrada para a aplicação. Ele inicia o roteamento chamando o método `run()` da classe `Router` do diretório `core`.

### Pasta `vendor`

Esta pasta contém as dependências externas da aplicação, que são instaladas usando o Composer (gerenciador de pacotes PHP).

#

Os aquivos mencionados a baixo desempenham papéis fundamentais para a funcionalidade da Website:

- 1- **Router.php**: Este arquivo define a classe `Router` no namespace `app\core`. A classe `Router` contém um método estático chamado `run()` que é chamado no arquivo `index.php` e é responsável por determinar o controlador e o método a serem executados com base na rota solicitada. Ele usa a classe `RoutersFilter` para obter a rota correspondente.
- 2- **Controller.php**: Este arquivo define a classe `Controller` no namespace `app\core`. A classe `Controller` possui um método chamado `execute()` que é responsável por verificar se o controlador e o método solicitados existem e, em seguida, executar o método correspondente no controlador.
- 3- **RoutersFilter.php**: Este arquivo define a classe `RoutersFilter` no namespace `app\core`. A classe `RoutersFilter` é responsável por filtrar e corresponder a rota solicitada com base na URI e no método de solicitação. Ele verifica se a rota é simples (correspondência exata) ou dinâmica (correspondência com base em padrões regulares) e retorna a rota correspondente ou uma rota padrão se não for encontrada nenhuma correspondência.
- 4- **Routes.php**: Este arquivo define a classe `Routes` no namespace `app\routes`. A classe `Routes` contém um método estático chamado `get()` que retorna um array associativo com as rotas definidas para cada método de solicitação (por exemplo, GET, POST). Cada rota é mapeada para um controlador e método específicos.
- 5- **RequestType.php**: Este arquivo define a classe `RequestType` no namespace `app\support`. A classe `RequestType` possui um método estático chamado `get()` que retorna o método de solicitação (GET, POST, PUT, DELETE, etc.) em minúsculas com base na variável global `$_SERVER['REQUEST_METHOD']`.
- 6- **Uri.php**: Este arquivo define a classe `Uri` no namespace `app\support`. A classe `Uri` possui um método estático chamado `get()` que retorna a parte da URI solicitada após o nome de domínio, removendo quaisquer parâmetros de consulta ou fragmento.

É importante mencionar que essa é apenas uma visão geral da estrutura de pasta e dos arquivos presentes neste template criado pelo **Tchossy**.
