# Introdução

    O efeito resultante de misturas de produtos fitossanitários é um assunto de grande interesse para todos os atuantes da área agronômica, sejam estes engenheiros agrônomos, profissionais especializados e até mesmo produtores rurais, uma vez que o ato de combinar tais compostos promove uma série de benefícios como a otimização do tempo, economia de recursos financeiros, equipamentos, água etc. Em vista da ausência de uma boa plataforma de software que seja capaz de compor uma grande base de dados a respeito de misturas de produtos químicos utilizados na agricultura - e de forma gratuita - surgiu o objetivo desta iniciação científica. O ponto principal deste trabalho é o desenvolvimento de uma plataforma em software capaz de promover aos seus usuários finais o acesso a informações científicas sobre compatibilidade de tais produtos, de forma rápida e eficaz, unificando os resultados disponibilizados nos principais indexadores científicos conhecidos em uma única aplicação.
    
    A aplicação em questão permitirá o cadastro de usuários finais por meio de um aplicativo celular, no qual, após finalizado o mesmo, poderão criar misturas combinando diversas substâncias químicas disponíveis e submetê-las para serem avaliadas por um profissional da área que, por meio de um sistema web, será capaz de visualizar uma série de misturas pendentes para avaliação. Durante a avaliação, o profissional irá inserir referências, através de links, de diversos estudos e artigos científicos sobre a combatibilidade dos produtos fitossanitários presentes na mistura. Uma vez que o estudo sobre tal combinação entre substâncias for finalizado, o avaliador irá concluir o processo informando o efeito resultante gerado pela reação entre os princípios ativos presentes nessas substâncias, que será disponibilizado para qualquer usuário que pesquisar a mesma combinação entre princípios ativos.

    O desenvolvimento da aplicação será dividido em duas partes: sistema web e aplicativo celular. A primeira etapa consiste em criar a plataforma na qual terá dois tipos de perfis, administrador e avaliador. O Administrador é o responsável por uma série de funcionalidades, entre elas: cadastrar, atualizar e excluir as substâncias que serão utilizadas para compor as misturas, cadastrar atualizar e excluir usuários avaliadores. O avaliador, como mencionado anteriormente, possui a responsabilidade de avaliar as misturas pendentes que foram cadastradas por usuários do aplicativo, além disso, é atribuído ao mesmo a tarefa de manter as misturas da aplicação, atualizando, removendo e, em alguns casos, criando novas.

    A segunda etapa corresponde ao desenvolvimento do app que será utilizado pelos usuários finais, na qual sua principal funcionalidade é fornecer um meio para que os mesmos pesquisem por compatibilidade de produtos fitossanitários, criando misturas. Ao pesquisar por uma certa combinação de substâncias, caso não seja encontrado nenhum resultado, será oferecido ao usuário uma opção de submeter a mistura criada para a avaliação por um profissional da área. Quando essa mistura tiver sido avaliada, será enviada uma notificação ao usuário informando que já é possível a visualização do efeito resultante de tal combinação.

# Fundamentação Teórica

    Assim como mencionado anteriormente, a primeira parte do projeto consiste no desenvolvimento de um sistema web, que por sua vez, é uma implementação do modelo cliente/servidor amplamente utilizado na internet. Este modelo, basicamente, é uma representação na qual o cliente envia requisições ao servidor, que este por sua vez, realizará algum processamento e logo enviará uma resposta ao solicitante. Neste projeto foram utilizas diferentes tecnologias para implementar tais camadas mencinadas, dentre elas podemos destacar: HTML, CSS, JavaScript, jQuery e PHP. Além disso, a aplicação deverá manter diversas informações sobre usuários, produtos químicos, diferentes combinações de misturas de produtos, e diversos outros dados, que serão mantidos através do SGBD (Sistema de Gerenciamento de Banco de Dados) mysql padrão ANSI SQL.

    A segunda parte do projeto, a aplicação mobile, será desenvolvida utilizando a tecnologia PWA (Progressive Web Apps), que basicamente, são aplicativos construídos utilizando recursos de navegadores web capazes de promover vários benefícios da experiência móvel, possibilitando diversas vantagens e funcionalidades, dentre elas podemos citar:
        
        * Implementação usando tecnologias web (HTML, CSS e JavaScript)
        * Capacidade de ser acessado através de diversos sistemas operacionais (Desktop, Android, iOS, Windows Phone, Symbian, dentre outros)
        * Acesso a recursos nativos do dispositivo móvel (notificações, ícone na home do smartphone, suporte a funcionamento em modo offline, acesso a geolocalização, contatos etc)
    
    Para o projeto em questão, uma das principais vantagens que a tecnologia PWA oferece é a possibilidade de fornecer uma boa experiência mobile ao usuário sem que o mesmo realize o download do aplicativo por meio de plataformas como a Play Store (Android), Apple Store (iOS), dentre outras. Utilizando esta tecnologia, o usuário poderá simplesmente adicionar o site da aplicação em sua tela inicial em formato de ícone, cujo resultado final gera a impressão de que a aplicação está instalada localmente em seu dispositivo.    

# Desenvolvimento

    O desenvolvimento desta aplicação foi divida em duas partes, sendo a primeira a implementação de um sistema web, e a segunda o desenvolvimento de um aplicativo. Durante os 6 primeiros meses do projeto foram desenvolvidas apenas funcionalidades do sistema web, são estas: 
    
        * Cadastro de usuários
        * Cadastro de substâncias
        * Cadastro de misturas
        * Avaliação de  misturas - inserindo referências científicas

    O desenvolvimento do sistema web foi dividido em duas partes: front-end e back-end. A etapa de desenvolver o front-end consiste em planejar como serão as interfaces do sistema, ou seja, a camada de apresentação do site, enquanto a etapa de back-end se preocupa no funcionamento do site como um tudo. Nesta primeira etapa, é desenvolvido um design de interface seguindo diversas regras para melhor dispor o conteúdo na tela, de forma que o usuário final entenda a mensagem que o site está transmitindo de forma simples e clara ao passo que a aparência do mesmo fique agradável. 
    Em vista de propor uma boa experiência ao usuário, foi desenvolvido os seguintes protótipos de interface seguindo boas práticas de IHC (Interação Humano-Computador):

        * Figura 1: Protótipo de interface para exibir as misturas
        * Figura 2: Protótipo de interface para cadastrar uma nova mistura
        * Figura 3: Porótipo de interface para cadastrar uma referência para a nova mistura
    
    Seguindo o design proposto acima, foram implementadas as correspondentes telas:

        * Figura 4: Tela principal de misturas
        * Figura 5: Formulário para cadastrar nova mistura
        * Figura 6: Formulário para cadastrar nova referência para a mistura

    Seguindo o modelo proposto pelos protótipos, foram implementadas outras interfaces seguindo o mesmo padrão:

        * Figura 7: Tela principal de substâncias (produtos)
        * Figura 8: Formulário para cadastrar nova substância
    
    Outras telas implementadas: 

        * Figura 9: Tela de login

    Durante o desenvolvimento do back-end - etapa que visa processar a entrada do usuário e realizar as funcionalidades que a aplicação se dispõe - foram utilizados alguns padrões de projetos com o objetivo de separar a funcionalidade de cada componente além de realizar uma boa documentação do projeto. São estes: 

        * MVC (Model View Controller)
        * DAO (Data Access Object)
        * Adapter

# Cronograma Restante

    Os 6 últimos meses do prazo de vigência deste projeto será destinado, principalmente, ao desenvolvimento do aplicativo celular e, consequentemente, a sincronização entre o app e o site. Além disso, será adicionado mais funcionalidades ao sistema web, ao passo que testes e correções serão feitas constantementes.

    Dentre as principais funcionalidades do app, podemos destacar: Cadastro do usuário e edição de seu perfil, submeter misturas para avaliação, pesquisar resultados de misturas já existentes, realização de filtros em tais resultados, dentre outras.

    Outras atividades que serão realizadas: Realização de filtros de misturas - filtrar resultados por data de cadastro, data de avaliação, nome do avaliador, nome do usuário quem submeteu a mistura etc - no site, correções de bugs identificados após testes, correções e melhorias na interface tanto do site quanto do aplicativo, realizar deploy da aplicação em um servidor para que a aplicação entre em "produção", escrita do relatório final, dentre outras.