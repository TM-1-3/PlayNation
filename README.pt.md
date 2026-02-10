<img src='https://sigarra.up.pt/feup/pt/imagens/LogotipoSI' width="30%"/>

<div align="center">
🌍 <a href="README.md">Inglês</a> | 🇵🇹 <a href="README.pt.md">Português</a>
</div>

<h3 align="center">Licenciatura em Engenharia Informática e Computação<br> L.EIC023 - Laboratório de Bases de Dados e Aplicações Web<br> 2025/2026 </h3>

---
<h3 align="center"> Colaboradores &#129309 </h2>

<div align="center">

| Nome | Número |
|---------------|-------------|
| Carolina Ferreira | up202303547 |
| Gabriela Silva | up202304064 |
| João Marques | up202307612 |
| Tomás Morais  | up202304692 |

Nota: 17,6

</div>

# Relatório PlayNation

- [Visão geral do projeto](#project-overview)
  - [Credenciais para teste](#credentials)
  - [Autores](#authors)
- [ER: Componente de Especificação de Requisitos](#er)
  - [A1: PlayNation](#a1)
  - [A2: Atores e histórias de usuários](#a2)
    - [1. Atores](#actors)
    - [2. Histórias de usuários](#us)
       - [2.1. Usuário](#2.1)
       - [2.2. Usuário não autenticado](#2.2)
       - [2.3. Usuário autenticado](#2.3)
       - [2.4. Usuário verificado](#2.4)
       - [2.5. Proprietário do grupo](#2.5)
       - [2.6. Administrador](#2.6)
    - [3. Requisitos Complementares](#3)
       - [3.1. Regras de negócios](#3.1)
       - [3.2. Requisitos Técnicos](#3.2)
       - [3.3. Restrições](#3.3)
  - [A3: Arquitetura da Informação](#a3)
    - [1. Mapa do site](#a31)
    - [2. Wireframes](#a32)
- [EBD: Componente de Especificação de Banco de Dados](#ebd)
  - [A4: Modelo de Dados Conceituais](#a4)
    - [1. Diagrama de classes](#a41)
    - [2. Regras comerciais adicionais](#a42)
  - [A5: Esquema Relacional, Validação e Refinamento de Esquema](#a5)
    - [1. Esquema Relacional](#a51)
    - [2. Domínios](#a52)
    - [3. Validação de esquema](#a53)
  - [A6: Índices, gatilhos, transações e população de banco de dados](#a6)
    - [1. Carga de trabalho do banco de dados](#a61)
    - [2. Índices Propostos](#a62)
      - [2.1. Índices de Desempenho](#a62.1)
      - [2.2. Índices de pesquisa de texto completo](#a62.2)
    - [3. Gatilhos](#a63)
    - [4. Transações](#a64)
  - [Anexo A. Código SQL](#sql)
    - [A.1. Esquema de banco de dados](#sqla)
    - [A.2. População do banco de dados](#sqlb)
- [EAP: Especificação de Arquitetura e Protótipo](#eap)
  - [A7: Especificação de recursos da Web](#a7)
    - [1. Visão geral](#a71)
    - [2. Permissões](#a72)
    - [3. Especificação OpenAPI](#a73)
  - [A8: Protótipo vertical](#a8)
    - [1. Recursos implementados](#a81)
      - [1.1. Histórias de usuários implementadas](#a81.1)
      - [1.2. Recursos da Web implementados](#a81.2)
    - [2. Protótipo](#a82)
    - [3. Credenciais para teste](#a83)
- [PA: Produto e Apresentação](#pa)
  - [A9: Produto](#a9)
    - [1. Instalação](#a91)
    - [2. Uso](#a92)
      - [2.1. Credenciais de administração](#a92.1)
      - [2.2. Credenciais do usuário](#a92.2)
    - [3. Ajuda do aplicativo](#a93)
    - [4. Validação de entrada](#a94)
    - [5. Verifique a acessibilidade e usabilidade](#a95)
    - [6. Validação de HTML e CSS](#a96)
    - [7. Revisões do Projeto](#a97)
    - [8. Detalhes de implementação](#a98)
      - [8.1. Bibliotecas usadas](#a98.1)
      - [8.2 Histórias de usuários](#a98.2)
  - [A10: Apresentação](#a10)
    - [1. Apresentação do produto](#a101)
    


<a id="project-overview"></a>
## Visão geral do projeto

PlayNation é uma rede social baseada na web dedicada exclusivamente aos entusiastas do esporte.
Esta plataforma foi projetada para oferecer aos usuários um espaço personalizado onde possam compartilhar seu estilo de vida fitness, seguir suas modalidades favoritas, interagir com pessoas que pensam como você e participar ativamente de uma vibrante comunidade esportiva. Além disso, este sistema pode servir como uma rica fonte de conhecimento sobre fitness, permitindo aos utilizadores partilhar, descobrir, aprender e explorar uma vasta gama de conteúdos relacionados com desporto, ao mesmo tempo que promove a interacção entre atletas, adeptos, equipas, treinadores e praticantes de fitness.
Suas principais funcionalidades apoiam esse objetivo ao permitir que os usuários postem fotos, vídeos e depoimentos; interagir com o conteúdo de outros usuários por meio de curtidas, comentários, salvamentos e compartilhamentos; participar de bate-papos privados; e pesquise contas e conteúdos específicos usando filtros para esportes ou atletas.
Os usuários são organizados em grupos com permissões distintas. Esses grupos incluem Visitantes que só podem visualizar conteúdo público; Usuários básicos, os principais usuários registrados que podem interagir, postar e seguir; Contas verificadas para atualizações oficiais sobre atletas e equipes; e Administradores que gerenciam todos os usuários e conteúdos para garantir a integridade da plataforma.
A plataforma será responsiva aos diferentes dispositivos utilizados e fácil de gerenciar, garantindo uma experiência agradável ao usuário.

<a id="credentials"></a>
### Credenciais para teste

**Usuário regular:** nome de usuário: hvegan; senha: senha

**Administrador:** nome de usuário: administrador; senha: senha

<a id="authors"></a>
### Autores

**Carolina Alves Ferreira**, up202303547@edu.fe.up.pt

**Gabriela de Mattos Barboza da Silva**, up202304064@edu.fe.up.pt

**João Pedro Magalhães Marques**, up202307612@edu.fe.up.pt

**Tomás da Silva Morais**, up202304692@edu.fe.up.pt

<a id="er"></a>
## ER: Componente de Especificação de Requisitos


<a id="a1"></a>
### A1: PlayNation

No atual mundo digital, onde as plataformas de redes sociais de uso geral geralmente apresentam uma experiência complicada para os utilizadores que procuram conteúdo relacionado com os seus interesses específicos, a PlayNation está a ser desenvolvida como uma rede social baseada na web dedicada exclusivamente aos entusiastas do desporto. 

Esta plataforma foi projetada para oferecer aos usuários um espaço personalizado onde possam compartilhar seu estilo de vida fitness, seguir suas modalidades favoritas, interagir com pessoas que pensam como você e participar ativamente de uma vibrante comunidade esportiva. Além disso, este sistema pode servir como uma rica fonte de conhecimento sobre fitness, permitindo aos utilizadores partilhar, descobrir, aprender e explorar uma vasta gama de conteúdos relacionados com desporto, ao mesmo tempo que promove a interacção entre atletas, adeptos, equipas, treinadores e praticantes de fitness.

Suas principais funcionalidades apoiam esse objetivo ao permitir que os usuários postem fotos, vídeos e depoimentos; interagir com o conteúdo de outros usuários por meio de curtidas, comentários, salvamentos e compartilhamentos; participar de bate-papos privados; e pesquise contas e conteúdos específicos usando filtros para esportes ou atletas.

Os usuários são organizados em grupos com permissões distintas. Esses grupos incluem Visitantes que só podem visualizar conteúdo público; Usuários básicos, os principais usuários autenticados que podem interagir, postar e seguir; Contas verificadas para atualizações oficiais sobre atletas e equipes; e Administradores que gerenciam todos os usuários e conteúdos para garantir a integridade da plataforma.

A plataforma será responsiva aos diferentes dispositivos utilizados e fácil de gerenciar, garantindo uma experiência agradável ao usuário.



---

<a id="a2"></a>
### A2: Atores e histórias de usuários


<a id="actors"></a>
#### 1. Atores

Para PlayNation, os atores estão representados na Figura 1 e descritos na Tabela 1.

<div align="center">
<img width="764" height="675" alt="image" src="https://github.com/user-attachments/assets/23e4dbdb-0d69-4f55-b745-f2720b37f751" />


Figura 1: Atores da PlayNation.
</div>

| Identificador | Descrição |
| ------------- | --------------------------------- |
| Usuário | Usuário genérico que pode visualizar conteúdo público (como postagens e comentários) e pesquisar contas. |
| Usuário não autenticado (visitante) | Usuário não autenticado que está limitado a visualizar conteúdo público. Eles podem se cadastrar (cadastrar) ou fazer login no sistema para interagir com ele.|
| Usuário autenticado | Um usuário autenticado que pode realizar todas as principais interações sociais, como criar postagens, comentar, curtir, compartilhar, seguir outros usuários e gerenciar seu próprio perfil. Eles são autores de suas próprias postagens e comentários.|
| Usuário verificado | Um usuário autenticado que representa entidades oficiais como atletas, equipes ou criadores de conteúdo. Eles podem postar atualizações oficiais, programações e resultados. Sua função é marcada por um crachá de verificação e eles são autores de anúncios oficiais.|
| Proprietário do grupo | Usuário autenticado que cria e gerencia um grupo, possuindo privilégios administrativos e ações relacionadas ao grupo e aos usuários que dele fazem parte.|
| Administrador | Um usuário autenticado com privilégios em todo o sistema para gerenciamento e moderação. Este ator pode gerenciar todas as contas de usuários, moderar conteúdo (excluir qualquer postagem ou comentário) e garantir a integridade da plataforma, transcendendo as permissões de usuários autenticados padrão.|
| API OAuth | API OAuth externa que pode ser usada para registrar ou autenticar no sistema usando a conta do Google.|
| API do Gmail | API externa do Gmail usada para enviar e-mails.|
 
<div align="center">
Tabela 1: Descrição dos atores do PlayNation. 
</div>

<a id="us"></a>
#### 2. Histórias de usuários

<a id="2.1"></a>
##### 2.1. Usuário
| Identificador | Nome | Prioridade | Responsável | Descrição |
| ------------ | --------- | ----------- | ------------------ | ----------------------------------------------------- |
|  US01 | Linha do tempo pública | Alto | Carolina Ferreira | Como usuário, quero acessar uma linha do tempo que exiba conteúdo público popular de todos os usuários para que eu possa me manter atualizado com as postagens mais populares. |
|  US02 | Ver conta | Alto | João Marques | Como Utilizador pretendo visualizar um perfil, cujo conteúdo me seja acessível, para poder ter facilmente acesso às suas publicações e detalhes. |
|  US03 | Pesquisar conta | Alto | Gabriela Mattos | Como usuário, desejo pesquisar contas para poder visualizar diretamente seu conteúdo, se estiver acessível para mim. |
|  US04 | Ver postagem | Alto | Carolina Ferreira | Como usuário, quero visualizar uma postagem, se estiver acessível para mim, para poder compreender completamente seu conteúdo, contexto e qualquer informação associada. |
|  US05 | Pesquisar postagem | Alto | Gabriela Mattos | Como usuário, desejo pesquisar postagens usando palavras-chave relacionadas ao seu conteúdo, para poder encontrar e visualizar rapidamente as postagens mais relevantes aos meus interesses. |
|  US06 | Ver comentários na postagem | Alto | Carolina Ferreira | Como usuário, quero ver os comentários em uma postagem para poder entender as opiniões e perspectivas de outros usuários sobre essa publicação. |
|  US07 | Ver curtidas na postagem | Alto | Carolina Ferreira | Como usuário autenticado, quero ver o número de curtidas em uma postagem, bem como a conta que gostou dela, para poder entender seu envolvimento. |
|  US08 | Pesquisa de correspondência exata | Alto | Gabriela Mattos |  Como Usuário quero pesquisar o nome exato do conteúdo desejado, para que apenas esse apareça. |
|  US09 | Pesquisa de texto | Alto | Gabriela Mattos |  Como usuário, desejo pesquisar usando texto para que todo o conteúdo relacionado a ele apareça nos resultados. |
|  EUA10 | Filtrar pesquisa | Alto | Gabriela Mattos | Como Usuário desejo filtrar minha busca de contas, grupos ou postagens para categorias específicas, como modalidades, equipes, datas ou número de curtidas, para que apenas conteúdos específicos sejam retornados. |
|  EUA11 | Informações do produto | Alto | João Marques |  Como Usuário desejo acessar informações sobre o aplicativo, como uma descrição geral, uma visão geral de suas principais funcionalidades e os contatos dos criadores, para poder entender melhor a finalidade do aplicativo, suas funcionalidades e como entrar em contato com a equipe de desenvolvimento, se necessário. |
|  EUA12 | Informações Contextuais e Dicas | Alto | Gabriela Mattos |  Como Usuário desejo receber dicas relacionadas às ações dos artefatos da UI, como placeholders nos inputs do formulário que indicam o que deve ser inserido ou dicas que aparecem ao passar o mouse sobre os botões, para que eu possa entender melhor como interagir com a interface e utilizar a aplicação de forma mais eficaz. |
|  EUA13 | Mensagens de erro contextuais | Alto | Gabriela Mattos |  Como usuário, desejo receber uma mensagem sempre que uma ação que tentei realizar não puder ser concluída, juntamente com uma explicação do motivo da falha, para que eu possa entender o que deu errado e tomar as medidas apropriadas para corrigi-lo ou tentar novamente ou se estou impedido de executar uma ação específica. |
|  EUA14 | Pesquisar comentários na postagem | Médio | Gabriela Mattos | Como usuário, quero filtrar os comentários de uma postagem por autor, número de curtidas ou data de publicação, para poder personalizar a forma como os comentários são apresentados para mim. |

<div align="center">
Tabela 2: Histórias de usuários. 
</div>

<a id="2.2"></a>
##### 2.2. Usuário não autenticado

| Identificador | Nome | Prioridade | Responsável | Descrição |
| ------------ | --------- | ----------- | ------------------ | ----------------------------------------------------- |
|  EUA15 | Inscreva-se | Alto | Tomás Morais | Como Usuário Não Autenticado desejo criar uma conta para que, quando logado, possa acessar todas as funcionalidades de um usuário Autenticado. |
|  EUA16 | Login | Alto | Tomás Morais | Como usuário não autenticado, quero fazer login em uma conta existente para poder experimentar a rede social como usuário autenticado. |
|  EUA17 | Recuperar senha | Alto | Tomás Morais |  Como usuário não autenticado desejo recuperar minha senha, caso a tenha esquecido, para poder entrar no sistema com sucesso. |
|  EUA18 | Acesso somente para visitantes | Alto | Tomás Morais | Como Usuário Não Autenticado quero poder acessar a rede social sem registro para poder acessar apenas as funcionalidades de um usuário não Autenticado. |
|  EUA19 | Inscrição na API OAuth | Baixo | Tomás Morais | Como usuário não autenticado, quero me inscrever usando minha conta do Google para poder criar uma conta rapidamente, sem passar por um processo completo de registro manual. |
|  EUA20 | Login da API OAuth | Baixo | Tomás Morais | Como usuário não autenticado, desejo fazer login usando minha conta do Google para poder autenticar e acessar facilmente o sistema. |

<div align="center">
Tabela 3: Histórias de usuários não autenticados. 
</div>

<a id="2.3"></a>
##### 2.3. Usuário autenticado

| Identificador | Nome | Prioridade | Responsável | Descrição |
| ------------ | --------- | ----------- | ------------------ | ----------------------------------------------------- |
|  EUA21 | Visibilidade do perfil | Alto | Tomás Morais | Como Usuário Autenticado quero tornar meu perfil público ou privado para que apenas meus amigos possam acessar seu conteúdo. |
|  EUA22 | Sair | Alto | Tomás Morais | Como usuário autenticado, desejo sair para poder usar o sistema apenas como visitante. |
|  EUA23 | Excluir conta | Alto | Tomás Morais | Como usuário autenticado, desejo excluir minha conta para poder remover uma conta não utilizada do sistema. |
|  EUA24 | Carregar/atualizar foto do perfil | Alto | Tomás Morais | Como usuário autenticado, quero adicionar ou alterar minha foto de perfil para poder personalizar meu perfil e facilitar que outras pessoas me reconheçam. |
|  EUA25 | Editar perfil | Alto | Tomás Morais | Como usuário autenticado, desejo editar meu perfil para poder alterar suas informações, visibilidade e detalhes conforme necessário e mantê-lo atualizado. |
|  EUA26 | Linha do tempo personalizada | Alto | Carolina Ferreira | Como usuário autenticado, quero acessar uma linha do tempo personalizada que mostre postagens de contas das quais sou amigo e conteúdos relacionados aos meus interesses para que eu possa interagir com o que é mais relevante para mim. |
|  EUA27 | Criar postagem | Alto | Carolina Ferreira | Como usuário autenticado, desejo publicar uma foto, vídeo ou declaração na forma de postagem para poder compartilhar minhas idéias, experiências e interesses com outras pessoas na plataforma. |
|  EUA28 | Adicionar legenda à postagem | Alto | Carolina Ferreira | Como usuário autenticado, quero poder adicionar uma legenda à minha postagem para poder complementá-la com texto descritivo ou contexto. |
|  EUA29 | Editar postagem | Alto | Carolina Ferreira | Como usuário autenticado, quero editar minhas próprias postagens para poder atualizar ou refinar seu conteúdo para que outros usuários vejam. |
|  US30 | Excluir postagem | Alto | Carolina Ferreira | Como usuário autenticado, desejo excluir minhas próprias publicações para que sejam removidas permanentemente da rede social e não fiquem mais visíveis para outros usuários. |
|  US31 | Curtir postagem | Alto | Carolina Ferreira | Como usuário autenticado, quero curtir uma postagem para poder mostrar meu apreço e apoio ao seu conteúdo. |
|  US32 | Postagem de relatório | Alto | Gabriela Mattos | Como usuário autenticado, quero denunciar uma postagem para poder alertar os administradores sobre conteúdo impróprio ou prejudicial. |
|  US33 | Comente na postagem | Alto | Carolina Ferreira | Como usuário autenticado, quero deixar um comentário público em uma postagem para poder compartilhar minha opinião e pensamentos sobre seu conteúdo. |
|  US34 | Editar Comentário | Alto | Carolina Ferreira | Como usuário autenticado, desejo editar meu comentário para poder atualizar ou refinar seu conteúdo para que outros usuários possam ver. |
|  US35 | Excluir comentário | Alto | Carolina Ferreira | Como usuário autenticado, desejo excluir um comentário publicado anteriormente em uma postagem de minha propriedade para poder remover conteúdo que não desejo mais que apareça na plataforma. |
|  US36 | Comentário do relatório | Alto | Gabriela Mattos | Como usuário autenticado, quero denunciar o comentário de um usuário para poder alertar os administradores sobre conteúdo prejudicial, de ódio ou inapropriado na plataforma. |
|  EUA37 | Enviar solicitação de amizade | Alto | João Marques | Como usuário autenticado, desejo enviar uma solicitação de amizade para outro perfil para poder me conectar e interagir com esse usuário. |
|  EUA38 | Gerenciar solicitações de amizade recebidas | Alto | João Marques | Como usuário autenticado, quero aceitar ou negar solicitações de amizade recebidas de outros usuários para poder controlar quem se conecta comigo na plataforma. |
|  EUA39 | Ver lista de amigos | Alto | João Marques | Como usuário autenticado desejo visualizar quais perfis sou amigo para poder gerenciar minhas conexões na plataforma. |
|  US40 | Perfil do relatório | Alto | Gabriela Mattos | Como usuário autenticado, quero denunciar um perfil para poder alertar os administradores sobre conteúdo impróprio ou prejudicial. |
|  US41 | Ver grupo | Alto | João Marques | Como usuário desejo visualizar um grupo do qual sou membro, para poder ter acesso ao seu conteúdo e qualquer informação associada. |
|  US42 | Grupo de pesquisa | Alto | João Marques | Como usuário, quero pesquisar grupos públicos para poder acessar seu conteúdo. |
|  US43 | Sair do grupo | Alto | João Marques | Como usuário autenticado desejo sair de um grupo para deixar de ser um de seus membros. |
|  US44 | Postar no grupo | Alto | João Marques | Como usuário autenticado, quero compartilhar conteúdo com um grupo do qual sou membro para poder contribuir nas interações e interagir com os outros membros. |
|  US45 | Criar grupo | Alto | João Marques | Como usuário autenticado desejo criar um grupo para que os usuários possam interagir e compartilhar conteúdo relacionado a um tema específico. |
|  EUA46 | Grupo de relatórios | Alto | Gabriela Mattos | Como usuário autenticado, quero denunciar um grupo para poder alertar os administradores sobre conteúdo prejudicial, de ódio ou inapropriado na plataforma. |
|  EUA47 | Notificação de solicitação de amizade | Alto | Gabriela Mattos | Como usuário autenticado, desejo receber uma notificação sempre que um usuário me enviar uma solicitação de amizade para que eu possa aceitá-la ou negá-la rapidamente. |
|  EUA48 | Curtir notificação de postagem | Alto | Gabriela Mattos | Como usuário autenticado, desejo receber uma notificação sempre que um usuário curtir uma de minhas postagens, para que eu possa me manter informado sobre o envolvimento em meu conteúdo. |
|  EUA49 | Notificação de postagem de comentário | Alto | Gabriela Mattos | Como usuário autenticado, desejo receber uma notificação sempre que um usuário comentar uma de minhas postagens, para que eu possa me manter informado sobre pensamentos e opiniões sobre seu conteúdo. |
|  US50 | Notificação de aceitação de solicitação de amizade | Alto | Gabriela Mattos | Como usuário autenticado, desejo receber uma notificação sempre que uma solicitação de amizade que enviei for aceita, para que eu saiba que agora sou amigo desse usuário. |
|  US51 | Notificação de aceitação de adesão ao grupo | Alto | Gabriela Mattos | Como usuário autenticado, desejo receber uma notificação sempre que uma solicitação de adesão a um grupo que enviei for aceita, para saber que agora sou membro desse grupo. |
|  EUA52 | Notificação de postagem em grupo | Alto | Gabriela Mattos | Como usuário autenticado, desejo receber uma notificação sempre que uma postagem for feita em um grupo do qual sou membro, para poder me manter atualizado sobre novos conteúdos e discussões. |
|  EUA57 | Marcar notificações como lidas | Alto | Gabriela Mattos | Como usuário autenticado quero marcar as notificações que recebo como lidas para poder acompanhar quais eventos já vi ou tratei. |
|  EUA58 | Lista de temas de interesse | Médio | Carolina Ferreira | Como Utilizador Autenticado quero gerir uma lista de temas que me interessam, como modalidades ou equipas, para que a rede social possa recomendar conteúdos que sejam mais relevantes para mim. |
|  EUA59 | Adicionar tópico à postagem | Médio | Carolina Ferreira | Como usuário autenticado desejo associar tópicos a uma postagem para que outros usuários possam encontrá-los facilmente através da pesquisa ou recebê-los como recomendações caso tenham esse tópico como de seu interesse. |
|  US60 | Salvar postagem | Médio | Carolina Ferreira | Como usuário autenticado, desejo salvar as postagens de outros usuários para poder acessá-las e visualizá-las facilmente mais tarde. |
|  US61 | Gerenciar postagens salvas | Médio | Carolina Ferreira | Como usuário autenticado, quero gerenciar uma lista de minhas postagens salvas para poder organizá-las, visualizá-las ou removê-las conforme necessário. |
|  US62 | Compartilhar postagem | Médio | Carolina Ferreira | Como usuário autenticado, desejo enviar postagens a outros usuários ou grupos para poder compartilhá-las diretamente com qualquer pessoa. |
|  EUA63 | Remover amigo | Médio | João Marques | Como usuário autenticado, desejo remover um perfil da minha lista de amigos para poder eliminar conexões indesejadas. |
|  EUA64 | Enviar mensagem para amigo | Médio | João Marques | Como Usuário Autenticado quero enviar uma mensagem privada a um amigo para que eu possa me comunicar diretamente com ele e manter nossa conexão. |
|  US65 | Ver conversas com amigos | Médio | João Marques | Como usuário autenticado, quero visualizar todas as minhas conversas atuais com amigos para poder acessar e continuar facilmente meus bate-papos em andamento. |
|  EUA66 | Adicionar usuário ao grupo | Médio | João Marques | Como usuário autenticado, desejo enviar uma solicitação para que um usuário se junte ao meu grupo para que eu possa adicionar usuários específicos a ele. |
|  EUA67 | Notificação de mensagem privada | Médio | Gabriela Mattos | Como usuário autenticado quero receber uma notificação sempre que um amigo me enviar uma mensagem privada para não perder uma conversa. |
|  EUA68 | Ver notificações | Médio | Gabriela Mattos | Como usuário autenticado, quero visualizar todas as notificações que recebi para poder acompanhar as solicitações pendentes ou interações relevantes para mim. |
|  EUA69 | Marcar conta na postagem | Baixo | Carolina Ferreira | Como usuário autenticado, quero marcar outros perfis em uma postagem para poder referenciar usuários relacionados a essa publicação. |
|  US70 | Curtir Comente | Baixo | Carolina Ferreira | Como usuário autenticado, quero curtir o comentário de outro usuário para poder mostrar minha concordância ou agradecimento por sua opinião. |
|  US71 | Bloquear perfil | Baixo | João Marques | Como usuário autenticado, quero bloquear um usuário para que o perfil e as postagens de um fiquem invisíveis para outro e as interações se tornem impossíveis. |
|  US72 | Notificação de comentário semelhante | Baixo | Gabriela Mattos | Como Usuário Autenticado desejo receber uma notificação sempre que um usuário curtir um de meus comentários para que eu possa ficar informado sobre o recebimento do mesmo. |
|  US73 | Marcado na notificação de postagem | Baixo | Gabriela Mattos | Como usuário autenticado, desejo receber uma notificação sempre que um usuário me marcar em uma postagem ou comentário, para que eu fique ciente das postagens ou interações que me envolvem. |
|  US74 | Notificações da API do Gmail | Baixo | Gabriela Mattos | Como Usuário Autenticado desejo receber notificações importantes por e-mail para me manter informado mesmo quando não estiver utilizando a plataforma. |

<div align="center">
Tabela 4: Histórias de usuários de usuários autenticados. 
</div>

<a id="2.4"></a>
##### 2.4. Usuário verificado

| Identificador | Nome | Prioridade | Responsável | Descrição |
| ------------ | --------- | ----------- | ------------------ | ----------------------------------------------------- |
|  US75 | Selo de verificação | Alto | Tomás Morais | Como usuário verificado, quero ter um selo visível em meu perfil e postagens para que os usuários possam identificar imediatamente minha conta como autêntica e oficial. |
|  US76 | Moderação de comentários aprimorada | Baixo | Tomás Morais | Como usuário verificado, quero ocultar automaticamente comentários contendo palavras-chave específicas que defino e desativar comentários em postagens antigas para poder gerenciar o assédio com eficiência e manter um espaço positivo na comunidade. |

<div align="center">
Tabela 5: Histórias de usuários de usuários verificados. 
</div>

<a id="2.5"></a>
##### 2.5. Proprietário do grupo

| Identificador | Nome | Prioridade | Responsável | Descrição |
| ------------ | --------- | ----------- | ------------------ | ----------------------------------------------------- |
|  EUA77 | Visibilidade do Grupo | Alto | João Marques | Como proprietário do grupo, quero definir a visibilidade de um grupo que criei como público ou privado, para que apenas os usuários que eu definir possam se tornar membros do meu grupo privado. |
|  EUA78 | Remover usuário do grupo | Alto | João Marques | Como proprietário de um grupo, desejo remover diretamente um usuário de um grupo para poder gerenciar a associação e manter um ambiente de grupo adequado. |
|  EUA79 | Gerenciar solicitações de entrada em grupo | Alto | João Marques | Como proprietário do grupo, quero aceitar ou negar solicitações de outros usuários para ingressar em um grupo público que criei para poder controlar quem se torna membro. |
|  US80 | Editar grupo | Alto | João Marques | Como proprietário de um grupo, quero editar as propriedades de um grupo que criei para poder atualizar suas informações ou visibilidade conforme necessário. |
|  US81 | Notificação de solicitação de adesão ao grupo | Alto | Gabriela Mattos | Como proprietário de um grupo, desejo receber uma notificação sempre que um usuário pedir para ingressar em um grupo público que criei, para poder aceitar ou negar rapidamente sua entrada. |

<div align="center">
Tabela 6: Histórias de usuário do proprietário do grupo. 
</div>

<a id="2.6"></a>
#### 2.6. Administrador

| Identificador | Nome | Prioridade | Responsável | Descrição |
| ------------ | --------- | ----------- | ------------------ | ----------------------------------------------------- |
|  US82 | Gerenciar conteúdo denunciado | Alto | Gabriela Mattos |   Como Administrador, quero acessar o conteúdo denunciado pelo usuário para poder avaliar se ele deve ser removido ou mantido na plataforma. |
|  EUA83 | Remover conteúdo | Alto | Gabriela Mattos | Como Administrador, quero remover uma postagem ou comentário da plataforma para poder moderar e manter um ambiente comunitário seguro e apropriado. |
|  EUA84 | Banir usuário | Alto | Gabriela Mattos | Como Administrador, quero banir uma conta da plataforma para poder eliminar aqueles que não contribuem para um ambiente comunitário seguro e respeitoso. |
|  US85 | Bloquear usuário | Alto | João Marques | Como administrador, quero bloquear um usuário para que ele não consiga usar o sistema sem remover sua conta. |
|  EUA86 | Desbloquear usuário | Alto | João Marques | Como administrador, desejo desbloquear um usuário bloqueado para que ele possa usar o sistema novamente como usuário autenticado. |
|  EUA87 | Grupos Moderados | Alto | Gabriela Mattos | Como administrador, quero poder remover grupos ou membros abusivos para manter um ambiente comunitário respeitoso. |
| EUA88 | Administrar contas de usuário | Alto | Gabriela de Mattos | Como administrador, quero poder visualizar, editar, excluir e criar uma conta de usuário. |

<div align="center">
Tabela 7: Histórias de usuários do administrador. 
</div>

<a id="3"></a>
#### 3. Requisitos Complementares

<a id="3.1"></a>
##### 3.1. Regras de negócios

| Identificador | Nome | Descrição |
| ---------- | ------------- | ----------------------------------------------------------------------------------------------------------------------------------------|
| BR01 | Visibilidade do perfil | Os perfis podem ser públicos ou privados, mas o conteúdo dos perfis privados só pode ser acessado por seus amigos. |
| BR02 | Visibilidade do Grupo | Os grupos podem ser públicos ou privados, mas os privados só são visíveis para os seus membros. | 
| BR03 | Diretrizes da comunidade | Conteúdo que seja desrespeitoso, insultuoso ou que promova violência, ódio ou preconceito é estritamente proibido. Esse conteúdo pode ser removido e, em casos graves, o responsável pela conta pode enfrentar um banimento permanente. |
| BR04 | Exclusão de conta | Após a exclusão da conta, os dados compartilhados do usuário (por exemplo, comentários, avaliações, curtidas) são mantidos, mas anonimizados. |
| BR05 | Autointeração | Os usuários têm permissão para comentar, curtir, compartilhar e salvar seu próprio conteúdo. | 
|BR06 | Validação de Data | Todas as datas fornecidas pelo usuário no sistema devem ser atuais ou passadas. |

<div align="center">
Tabela 8: Regras de negócios do PlayNation. 
</div>

<a id="3.2"></a>
##### 3.2. Requisitos técnicos

| Identificador | Nome | Descrição |
| ---------- | ------------- | ----------------------------------------------------------------------------------------------------------------------------------------|
| TR01 | Acessibilidade | O sistema deve garantir que todos possam acessar as páginas, independentemente de terem alguma deficiência ou não, ou do navegador que utilizam. |
| TR02 | Segurança | O sistema deve armazenar as senhas dos usuários de forma segura. |
| TR03 | Escalabilidade | O sistema deve lidar com o crescimento do número de usuários simultâneos e de suas interações, principalmente durante grandes eventos esportivos.
| TR04 | Banco de dados | O sistema de gerenciamento de banco de dados PostgreSQL deve ser usado para persistência de dados. |
| TR05 | Portabilidade | O sistema do lado do servidor deve ser independente de plataforma e capaz de ser executado em sistemas operacionais convencionais (por exemplo, Linux, Windows, MacOS).|
| TR06 | Ética | O sistema deve atender aos princípios éticos no desenvolvimento de software. Os dados pessoais do usuário não serão coletados ou compartilhados sem o consentimento explícito e informado do usuário.|
| TR07 | Usabilidade | O sistema deve ser simples e intuitivo de usar, não necessitando de treinamento prévio.|
| TR08 | Desempenho | O sistema deve renderizar páginas e processar interações do usuário com um tempo médio de resposta inferior a 2 segundos.
| TR09 | Robustez | O sistema deve estar preparado para lidar e continuar operando quando ocorrerem erros de tempo de execução. |

<div align="center">
Tabela 9: Requisitos técnicos do PLAYNation. 
</div>

<a id="3.3"></a>
##### 3.3. Restrições

| Identificador | Nome | Descrição |
| ---------- | ------------- | ----------------------------------------------------------------------------------------------------------------------------------------|
| R01 | Banco de dados | O banco de dados deve usar PostgreSQL |

---


<a id="a3"></a>
### A3: Arquitetura da Informação



<a id="a31"></a>
#### 1. Mapa do site

A plataforma PlayNation está organizada em quatro seções principais: as páginas estáticas, incluindo informações gerais e configurações como Fale Conosco, Sobre/Serviços e Configurações; as Páginas de Usuário, onde os usuários podem gerenciar seus perfis, postagens, amigos, grupos, mensagens e notificações; as páginas de itens, que permitem aos usuários visualizar perfis, postagens, comentários e categorias/tags; e as páginas administrativas, dedicadas a tarefas administrativas como gerenciamento de usuários, moderação de conteúdo e solicitações de verificação. Todas as seções estão interligadas através da Homepage, que funciona como ponto central de navegação dentro do sistema.

<div align="center">
<img width="787" height="510" alt="image" src="https://github.com/user-attachments/assets/c37ec133-e581-4c3a-aa1f-efd5938455de" />


Figura 1: Mapa do site PlayNation.
</div>

<a id="a32"></a>
#### 2. Wireframes

Em relação à Rede Social PlayNation, as duas figuras abaixo, 2 e 3, representam os wireframes da Homepage (UI00) e da Create Post Page (UI16), respectivamente.

<div align="center">
<img width="799" height="360" alt="image" src="https://github.com/user-attachments/assets/e52d108b-fd75-44b3-ad4c-2e51905cc495" />


Figura 2: Wireframe da página inicial (UI00).
</div>

<div align="center">
<img width="799" height="360" alt="image" src="https://github.com/user-attachments/assets/46e56f76-767b-478c-8ea3-f94655c26e11" />


Figura 3: Criar wireframe de postagem (UI16).
</div>


---

<a id="ebd"></a>
## EBD: Componente de Especificação de Banco de Dados

<a id="a4"></a>
### A4: Modelo de Dados Conceituais

O Modelo de Dados Conceituais para a rede social PlayNation inclui e descreve as entidades relevantes e os relacionamentos entre elas que são importantes para a especificação do banco de dados, usando UML.

<a id="a41"></a>
#### 1. Diagrama de classes

O diagrama UML abaixo representa as principais entidades organizacionais, os relacionamentos entre elas e as respectivas multiplicidades, domínios e atributos, bem como os respectivos tipos e restrições, para a Plataforma de Rede Social **PlayNation**.

<div align="center">
<img width="1087" height="770" alt="image" src="https://github.com/user-attachments/assets/2c6eb162-f42c-432f-88aa-f0f4001e9096" />


Figura 1: Dados conceituais do PlayNation em UML
</div>

<a id="a42"></a>
#### 2. Regras comerciais adicionais

A tabela abaixo identifica e descreve regras e restrições de negócios adicionais que não podem ser transmitidas no diagrama de classes UML.

| Identificador | Nome | Descrição |
| ---------- | ------------- | ----------------------------------------------------------------------------------------------------------------------------------------|
| BR07 | Restrição de adesão ao grupo | Um usuário não pode solicitar a adesão a um grupo do qual já faz parte. |
| BR08 | Proibição de auto-amizade | Um usuário não pode ser amigo de si mesmo. | 
| BR09 | Proibição de auto-solicitação | Um usuário não pode solicitar ser amigo de si mesmo. |
| BR10 | Proibição de solicitação de amizade existente | Um usuário não pode solicitar ser amigo de um usuário de quem já é amigo. |
| BR11 | Associação de proprietário do grupo | O proprietário do grupo também é membro do seu grupo. | 
| BR12 | Acesso pós-interação | Um usuário só pode comentar/curtir postagens de usuários públicos, postagens de usuários de quem é amigo ou postagens de grupos aos quais pertence. |
| BR13 | É necessária associação de postagem em grupo | Um usuário só pode postar em um grupo ao qual pertence. | 
| BR14 | Restrição semelhante única | Um usuário só pode curtir um comentário/postagem uma vez. | 
| BR15 | Requisito de conteúdo de postagem | As postagens devem ter uma descrição ou uma imagem (ou ambas). |

<div align="center">

Tabela 1: Regras de negócios adicionais
</div> 

---

<a id="a5"></a>
### A5: Esquema Relacional, validação e refinamento de esquema

O Artefato A5 apresenta o esquema relacional do banco de dados derivado do modelo de dados conceitual correspondente, bem como sua validação e normalização sequencial.

<a id="a51"></a>
#### 1. Esquema Relacional

A tabela a seguir apresenta o esquema relacional obtido da UML, incluindo atributos, domínios, chaves primárias e estrangeiras e restrições para cada tupla.

| Referência de relação | Notação Compacta de Relação |
| ------------------ | ------------------------------------------------ |
| R01 | usuário_registrado (<ins>id_usuário</ins>, nome de usuário **UK** **NN**, nome **NN**, e-mail **UK** **NN**, senha **NN**, biografia, profile_picture **DF** TRUE) |
| R02 | administrador(<ins>id_admin</ins> → usuário_registrado) |
| R03 | usuário_verificado(<ins>id_verificado</ins> → usuário_registrado) |
| R04 | proprietário_grupo(<ins>id_grupo_proprietário</ins> → usuário_registrado) |
| R05 | user_friend(id_usuário → usuário_registrado **NN***, id_amigo → usuário_registrado **NN**, (<ins>id_usuário</ins>,<ins>id_amigo</ins>)) |
| R06 | user_friend_request(id_usuário → usuário_registrado **NN**, id_requester → usuário_registrado **NN**, (<ins>id_usuário</ins>,<ins>id_requester</ins>)) |
| R07 | rótulo(<ins>id_label</ins>, designação **NN**, imagem **NN**) |
| R08 | esporte(<ins>id_sport</ins> → rótulo) |
| R09 | categoria(<ins>id_sport</ins> → rótulo) |
| R10 | rótulo_do_usuário(id_usuário → usuário_registrado **NN**, id_label → rótulo **NN**, (<ins>id_usuário</ins>,<ins> id_label</ins>)) |
| R11 | publicar(<ins>id_post</ins>, id_creator → usuário_registrado **NN**, imagem, descrição, data **NN** **CK** data<=agora()) |
| R12 | post_label(id_post → postagem **NN**, id_label → rótulo **NN**, (<ins>id_post</ins>, <ins>id_label</ins>)) |
| R13 | post_like(id_post → postagem **NN**, id_user → usuário_registrado **NN**, (<ins>id_post</ins>, <ins>id_usuário</ins>)) |
| R14 | post_save(id_post → postagem **NN**, id_user → usuário_registrado **NN**, (<ins>id_post</ins>, <ins>id_usuário</ins>)) |
| R15 | comentários (<ins>id_comment</ins>, id_post → postagem **NN**, id_user → usuário_registrado **NN**, id_reply → comentários **NN**, texto **NN**, data **NN** **CK** data<=agora()) |
| R16 | comment_like(id_comment → comentário **NN**, id_user → usuário_registrado **NN**, (<ins>id_comment</ins>, <ins>id_usuário</ins>)) |
| R17 | grupos (<ins>id_grupo</ins>, id_owner → group_owner **NN**, nome **UK** **NN**, descrição, imagem, is_public **DF** TRUE) |
| R18 | group_membership(id_grupo → grupo **NN**, id_membro → usuário_registrado **NN**, (<ins>id_grupo</ins>, <ins>id_membro</ins>)) |
| R19 | group_join_request(id_grupo → grupo **NN**, id_requester → usuário_registrado **NN**, (<ins>id_grupo</ins>, <ins>id_requester</ins>)) |
| R20 | mensagem(<ins>id_mensagem</ins>, texto **NN**, imagem, data **NN** **CK** data<=agora()) |
| R21 | mensagem_privada(<ins>id_mensagem</ins> → mensagem, id_remetente → usuário_registrado **NN**, id_receiver → usuário_registrado **NN**) |
| R22 | mensagem_grupo(<ins>id_mensagem</ins> → mensagem, id_grupo → grupos **NN**, id_remetente → usuário_registrado **NN**) |
| R23 | relatório(<ins>relatório_id</ins>, descrição **NN**)|
| R24 | report_post(id_report → relatório **NN**, id_post → postagem **NN**, (<ins>relatório_id</ins>, <ins>id_post</ins>)) |
| R25 | report_group(id_report → relatório **NN**, id_group → grupos **NN**, (<ins>relatório_id</ins>, <ins>id_grupo</ins>)) |
| R26 | report_user(id_report → relatório **NN**, id_user → usuário_registrado **NN**, (<ins>relatório_id</ins>, <ins>usuário_registrado</ins>)) |
| R27 | report_comment(id_report → relatório **NN**, id_comment → comentários **NN**, (<ins>relatório_id</ins>, <ins>id_comment</ins>)) |
| R28 | notificação(<ins>notificação_id</ins>, id_receiver → usuário_registrado **NN**, id_emitter → usuário_registrado **NN**, texto **NN**, data **NN** **CK** data<=now()|
| R29 | amigo_request_notificação(<ins>notificação_id</ins> → notificação, aceita) |
| R30 | amigo_request_result_notificação(<ins>notificação_id</ins> → notificação) |
| R31 | like_post_notification(<ins>notificação_id</ins> → notificação, id_post → postagem **NN**) |
| R32 | comentário_notificação(<ins>notificação_id</ins> → notificação, id_comment → comentário **NN**) |
| R33 | like_comment_notification(<ins>notificação_id</ins> → notificação, id_comment → comentário **NN**) |
| R34 | mensagem_privada_notificação(<ins>notificação_id</ins> → notificação, id_message → mensagem **NN**) |
| R35 | group_message_notification(<ins>notificação_id</ins> → notificação, id_message → mensagem **NN**) |
| R36 | join_group_request_notification(<ins>notificação_id</ins> → notificação, id_group → grupos **NN**, aceito) |
| R37 | join_group_request_result_notification(<ins>notificação_id</ins> → notificação, id_group → grupos **NN**) |
| R38 | user_block(id_user → usuário_registrado **NN**, id_blocked → usuário_registrado **NN**, (<ins>id_usuário</ins>,<ins>id_bloqueado</ins>)) |
| R39 | user_tag(id_post → postagem **NN**, id_user → usuário_registrado **NN**, (<ins>id_post</ins>, <ins>id_usuário</ins>) |
| R40 | admin_block(id_admin → administrador **NN**, id_user → usuário_registrado **NN**, (<ins>id_admin</ins>, <ins>id_usuário</ins>) |
| R41 | admin_ban(id_admin → administrador **NN**, id_user → usuário_registrado **NN**, (<ins>id_admin</ins>, <ins>id_usuário</ins>) |

<div align="center">

Tabela 2: Esquema Relacional PlayNation
</div> 

Os esquemas relacionais são documentados usando uma notação compacta onde as restrições são abreviadas: 
- Reino Unido = CHAVE ÚNICA
- NN = NÃO NULO
- DF = PADRÃO
- CK = VERIFICAR  


<a id="a52"></a>
#### 2. Domínios

Especificação de domínios adicionais.

| Nome de domínio | Especificação de Domínio |
| ----------- | ------------------------------ |
| agora | Data e hora atuais (equivalente a CURRENT_TIMESTAMP em SQL) |

<div align="center">

Tabela 3: Domínios PlayNation
</div>

<a id="a53"></a>
#### 3. Validação de esquema 

Para a validação do esquema, todas as dependências funcionais foram identificadas e foi realizada a normalização de todos os esquemas de relação.

| **TABELA R01** | usuário_registrado |
| --------------  | ---                |
| **Chaves** | {id_user, nome de usuário, e-mail} |
| **Dependências Funcionais:** |       |
| FD0101 | id_user → {nome de usuário, nome, e-mail, senha, biografia, profile_picture, is_public } |
| FD0102 | nome de usuário → { id_user, nome, email, senha, biografia, profile_picture, is_public } |
| FD0103 | email → { id_user, nome de usuário, nome, senha, biografia, profile_picture, is_public } |
| **FORMA NORMAL** | BCNF |

<div align="center">

Tabela 4: validação de esquema de usuário_registrado
</div>

| **TABELA R02** | administrador |
| --------------  | ---                |
| **Chaves** | {id_admin} |
| **Dependências Funcionais:** |    nenhum |
| **FORMA NORMAL** | BCNF |

<div align="center">

Tabela 5: validação do esquema do administrador
</div>

| **TABELA R03** | usuário_verificado |
| --------------  | ---                |
| **Chaves** | {id_verificado} |
| **Dependências Funcionais:** |    nenhum |
| **FORMA NORMAL** | BCNF |

<div align="center">

Tabela 6: validação do esquema verify_user
</div>

| **TABELA R04** | proprietário_grupo |
| --------------  | ---                |
| **Chaves** | {id_group_owner} |
| **Dependências Funcionais:** |    nenhum |
| **FORMA NORMAL** | BCNF |

<div align="center">

Tabela 7: validação do esquema group_owner
</div>

| **TABELA R05** | amigo_usuário |
| --------------  | ---                |
| **Chaves** | {id_usuário, id_amigo} |
| **Dependências Funcionais:** |   nenhum |
| **FORMA NORMAL** | BCNF |

<div align="center">

Tabela 8: validação do esquema user_friend
</div>

| **TABELA R06** | solicitação_de_usuário |
| --------------  | ---                |
| **Chaves** | {id_user, id_requester} |
| **Dependências Funcionais:** |   nenhum |
| **FORMA NORMAL** | BCNF |

<div align="center">

Tabela 9: validação do esquema user_friend_request
</div>

| **TABELA R07** | etiqueta |
| --------------  | ---                |
| **Chaves** | {id_label} |
| **Dependências Funcionais:** |       |
| FD0701 | id_label → {designação, imagem } |
| **FORMA NORMAL** | BCNF |

<div align="center">

Tabela 10: validação do esquema de rótulo
</div>

| **TABELA R08** | esporte |
| --------------  | ---                |
| **Chaves** | { id_sport } |
| **Dependências Funcionais:** |    nenhum |
| **FORMA NORMAL** | BCNF |

<div align="center">

Tabela 11: validação do esquema esportivo
</div>

| **TABELA R09** | categoria |
| --------------  | ---                |
| **Chaves** | {id_categoria} |
| **Dependências Funcionais:** |    nenhum |
| **FORMA NORMAL** | BCNF |

<div align="center">

Tabela 12: validação do esquema de categoria
</div>

| **TABELA R10** | rótulo_do_usuário |
| --------------  | ---                |
| **Chaves** | {id_user, id_label} |
| **Dependências Funcionais:** |    nenhum |
| **FORMA NORMAL** | BCNF |

<div align="center">

Tabela 13: validação do esquema user_label
</div>

| **TABELA R11** | postagem |
| --------------  | ---                |
| **Chaves** | {id_post} |
| **Dependências Funcionais:** |       |
| FD1101 | id_post → {imagem, descrição, data, criador } |
| **FORMA NORMAL** | BCNF |

<div align="center">

Tabela 14: validação pós-esquema
</div>

| **TABELA R12** | post_label |
| --------------  | ---                |
| **Chaves** | {id_post, id_label} |
| **Dependências Funcionais:** |  nenhum |
| **FORMA NORMAL** | BCNF |

<div align="center">

Tabela 15: validação do esquema post_label
</div>

| **TABELA R13** | postar_curtir |
| --------------  | ---                |
| **Chaves** | {id_post, id_user} |
| **Dependências Funcionais:** |  nenhum |
| **FORMA NORMAL** | BCNF |

<div align="center">

Tabela 16: validação de esquema post_like
</div>

| **TABELA R14** | post_save |
| --------------  | ---                |
| **Chaves** | {id_post, id_user} |
| **Dependências Funcionais:** |   nenhum |
| **FORMA NORMAL** | BCNF |

<div align="center">

Tabela 17: validação do esquema post_save
</div>

| **TABELA R15** | comentários |
| --------------  | ---                |
| **Chaves** | { id_comment } |
| **Dependências Funcionais:** |       |
| FD1501 | id_comment → {texto, data, postagem, usuário } |
| **FORMA NORMAL** | BCNF |

<div align="center">

Tabela 18: validação do esquema de comentários
</div>

| **TABELA R16** | comentar_curtir |
| --------------  | ---                |
| **Chaves** | { id_comment, id_user } |
| **Dependências Funcionais:** |  nenhum |
| **FORMA NORMAL** | BCNF |

<div align="center">

Tabela 19: validação de esquema comment_like
</div>

| **TABELA R17** | grupos |
| --------------  | ---                |
| **Chaves** | {id_grupo, nome} |
| **Dependências Funcionais:** |       |
| FD1701 | id_group → {nome, descrição, imagem, is_public, proprietário } |
| FD1702 | nome → { id_group, descrição, imagem, is_public, proprietário } |
| **FORMA NORMAL** | BCNF |

<div align="center">

Tabela 20: validação de esquema de grupos
</div>

| **TABELA R18** | associação_grupo |
| --------------  | ---                |
| **Chaves** | {id_grupo, id_membro} |
| **Dependências Funcionais:** |   nenhum |
| **FORMA NORMAL** | BCNF |

<div align="center">

Tabela 21: validação do esquema group_membership
</div>

| **TABELA R19** | group_join_request |
| --------------  | ---                |
| **Chaves** | {id_group, id_requester} |
| **Dependências Funcionais:** |   nenhum |
| **FORMA NORMAL** | BCNF |

<div align="center">

Tabela 22: validação do esquema group_join_request
</div>

| **TABELA R20** | mensagem |
| --------------  | ---                |
| **Chaves** | {id_mensagem} |
| **Dependências Funcionais:** |       |
| FD2001 | id_message → {texto, data, imagem} |
| **FORMA NORMAL** | BCNF |

<div align="center">

Tabela 23: validação do esquema de mensagens
</div>

| **TABELA R21** | mensagem_privada |
| --------------  | ---                |
| **Chaves** | {id_mensagem} |
| **Dependências Funcionais:** |       |
| FD2101 | id_message → {remetente, destinatário} |
| **FORMA NORMAL** | BCNF |

<div align="center">

Tabela 24: validação do esquema private_message
</div>

| **TABELA R22** | mensagem_grupo |
| --------------  | ---                |
| **Chaves** | {id_mensagem} |
| **Dependências Funcionais:** |       |
| FD2201 | id_message → { grupo, remetente } |
| **FORMA NORMAL** | BCNF |

<div align="center">

Tabela 25: validação do esquema group_message
</div>

| **TABELA R23** | relatório |
| --------------  | ---                |
| **Chaves** | {id_relatório} |
| **Dependências Funcionais:** |       |
| FD2301 | id_report → {descrição} |
| **FORMA NORMAL** | BCNF |

<div align="center">

Tabela 26: validação do esquema do relatório
</div>

| **TABELA R24** | report_post |
| --------------  | ---                |
| **Chaves** | {id_relatório} |
| **Dependências Funcionais:** |       |
| FD2401 | id_report → {postagem} |
| **FORMA NORMAL** | BCNF |

<div align="center">

Tabela 27: validação do esquema report_post
</div>

| **TABELA R25** | grupo_relatório |
| --------------  | ---                |
| **Chaves** | {id_relatório} |
| **Dependências Funcionais:** |       |
| FD2501 | id_report → { grupo } |
| **FORMA NORMAL** | BCNF |

<div align="center">

Tabela 28: validação do esquema report_group
</div>

| **TABELA R26** | usuário_relatório |
| --------------  | ---                |
| **Chaves** | {id_relatório} |
| **Dependências Funcionais:** |       |
| FD2601 | id_report → {usuário} |
| **FORMA NORMAL** | BCNF |

<div align="center">

Tabela 29: validação do esquema report_user
</div>

| **TABELA R27** | relatório_comment |
| --------------  | ---                |
| **Chaves** | {id_relatório} |
| **Dependências Funcionais:** |       |
| FD2701 | id_report → {comentário} |
| **FORMA NORMAL** | BCNF |

<div align="center">

Tabela 30: validação do esquema report_comment
</div>

| **TABELA R28** | notificação |
| --------------  | ---                |
| **Chaves** | {id_notificação} |
| **Dependências Funcionais:** |       |
| FD2801 | id_notification → {texto, data, receptor, emissor, leitura } |
| **FORMA NORMAL** | BCNF |

<div align="center">

Tabela 31: validação do esquema de notificação
</div>

| **TABELA R29** | notificação_de_amigo |
| --------------  | ---                |
| **Chaves** | {id_notificação} |
| **Dependências Funcionais:** |       |
| FD2901 | id_notification → {aceito} |
| **FORMA NORMAL** | BCNF |

<div align="center">

Tabela 32: validação do esquema friend_request_notification
</div>

| **TABELA R30** | amigo_request_result_notificação |
| --------------  | ---                |
| **Chaves** | {id_notificação} |
| **Dependências Funcionais:** |    nenhum |
| **FORMA NORMAL** | BCNF |

<div align="center">

Tabela 33: validação do esquema friend_request_result_notification
</div>

| **TABELA R31** | gostei_post_notificação |
| --------------  | ---                |
| **Chaves** | {id_notificação} |
| **Dependências Funcionais:** |       |
| FD3101 | id_notificação → {postagem} |
| **FORMA NORMAL** | BCNF |

<div align="center">

Tabela 34: validação do esquema like_post_notification
</div>

| **TABELA R32** | comentário_notificação |
| --------------  | ---                |
| **Chaves** | {id_notificação} |
| **Dependências Funcionais:** |       |
| FD3201 | id_notificação → {comentário} |
| **FORMA NORMAL** | BCNF |

<div align="center">

Tabela 35: validação do esquema comment_notification
</div>

| **TABELA R33** | gostei_comment_notification |
| --------------  | ---                |
| **Chaves** | {id_notificação} |
| **Dependências Funcionais:** |       |
| FD3301 | id_notificação → {comentário} |
| **FORMA NORMAL** | BCNF |

<div align="center">

Tabela 36: validação do esquema like_comment_notification
</div>

| **TABELA R34** | notificação_mensagem_privada |
| --------------  | ---                |
| **Chaves** | {id_notificação} |
| **Dependências Funcionais:** |       |
| FD3401 | notificação_id → {mensagem_privada} |
| **FORMA NORMAL** | BCNF |

<div align="center">

Tabela 37: validação do esquema private_message_notification
</div>

| **TABELA R35** | notificação_mensagem_grupo |
| --------------  | ---                |
| **Chaves** | {id_notificação} |
| **Dependências Funcionais:** |       |
| FD3501 | notificação_id → {mensagem_grupo} |
| **FORMA NORMAL** | BCNF |

<div align="center">

Tabela 38: validação do esquema group_message_notification
</div>

| **TABELA R36** | join_group_request_notificação |
| --------------  | ---                |
| **Chaves** | {id_notificação} |
| **Dependências Funcionais:** |       |
| FD3601 | id_notification → {aceito, grupo} |
| **FORMA NORMAL** | BCNF |

<div align="center">

Tabela 39: validação do esquema join_group_request_notification
</div>

| **TABELA R37** | group_join_request_result_notification |
| --------------  | ---                |
| **Chaves** | {id_notificação} |
| **Dependências Funcionais:** |       |
| FD3701 | id_notificação → { grupo } |
| **FORMA NORMAL** | BCNF |

<div align="center">

Tabela 40: validação do esquema group_join_request_result_notification
</div>

| **TABELA R38** | bloco_de_usuário |
| --------------  | ---                |
| **Chaves** | {id_usuário, id_bloqueado} |
| **Dependências Funcionais:** |  nenhum |
| **FORMA NORMAL** | BCNF |

<div align="center">

Tabela 41: validação do esquema user_block
</div>

| **TABELA R39** | tag_usuário |
| --------------  | ---                |
| **Chaves** | {id_post, id_user} |
| **Dependências Funcionais:** |  nenhum |
| **FORMA NORMAL** | BCNF |

<div align="center">

Tabela 42: validação do esquema user_tag
</div>

| **TABELA R40** | admin_block |
| --------------  | ---                |
| **Chaves** | {id_admin, id_usuário} |
| **Dependências Funcionais:** |  nenhum |
| **FORMA NORMAL** | BCNF |

<div align="center">

Tabela 43: validação do esquema admin_block
</div>

| **TABELA R41** | administrador_ban |
| --------------  | ---                |
| **Chaves** | {id_admin, id_usuário} |
| **Dependências Funcionais:** |  nenhum |
| **FORMA NORMAL** | BCNF |

<div align="center">

Tabela 44: Validação do esquema admin_ban
</div>

Como cada tabela no esquema relacional satisfaz a forma normal de Boyce-Codd (BCNF), todo o esquema já está totalmente normalizado. Portanto, nenhuma etapa adicional de normalização é necessária.










---

<a id="a6"></a>
### A6: Índices, gatilhos, transações e população de banco de dados

O Artefato A6 contém os scripts SQL para criação e preenchimento do banco de dados que sustentará o sistema de rede social PlayNation, bem como a implementação da integridade dos dados e aplicação de regras de negócios por meio de gatilhos e identificação e caracterização de índices. Além disso, inclui as transições necessárias para manter a consistência dos dados após quaisquer operações no banco de dados.

<a id="a61"></a>
#### 1. Carga de trabalho do banco de dados
 
| **Referência de relação** | **Nome da relação** | **Ordem de grandeza** | **Crescimento estimado** |
| ------------------ | ------------- | ------------------------- | -------- |
| R01 | usuário_registrado | Dezenas de milhares (10 mil) | Centenas por mês |
| R02 | administrador | Unidades (1) | Unidades por ano |
| R03 | usuário_verificado | Centenas (100) | Dezenas por mês |
| R04 | proprietário_grupo | Milhares (1k) | Dezenas por semana |
| R05 | amigo_usuário | Milhares (1k) | Milhares por mês |
| R06 | solicitação_de_usuário | Centenas (100) | Centenas por dia |
| R07 | etiqueta | Unidades (1) | Pouco crescimento |
| R08 | esporte | Unidades (1) | Pouco crescimento |
| R09 | categoria | Unidades (1) | Pouco crescimento |
| R10 | rótulo_do_usuário | Centenas (100) | Centenas por semana |
| R11 | postar | Dezenas de milhares (10k) | Milhares por dia |
| R12 | post_label | Milhares (1k) | Milhares por dia |
| R13 | postar_curtir | Milhares (1k) | Milhares por dia |
| R14 | post_save | Centenas (100) | Centenas por dia |
| R15 | comente | Dezenas de milhares (10 mil) | Milhares por dia |
| R16 | comentar_curtir | Milhares (1k) | Milhares por dia |
| R17 | grupo | Milhares (1k) | Dezenas por dia |
| R18 | associação_grupo | Centenas (100) | Centenas por dia |
| R19 | group_join_request | Centenas (100) | Centenas por semana |
| R20 | mensagem | Dezenas de milhares (10 mil) | Milhares por dia |
| R21 | mensagem_privada | Milhares (1k) |Centenas por dia |
| R22 | mensagem_grupo | Dezenas de milhares (10 mil) | Centenas por dia |
| R23 | relatório | Centenas (100) | Centenas por mês |
| R24 | report_post | Dezenas (10) | Dezenas por dia |
| R25 | grupo_relatório | Dezenas (10) | Dezenas por mês |
| R26 | usuário_relatório | Dezenas (10) | Dezenas por dia |
| R27 | relatório_comment | Dezenas (10) | Dezenas por dia |
| R28 | notificação | Milhares (1k) | Milhares por dia |
| R29 | notificação_de_amigo | Centenas (100) | Centenas por dia |
| R30 | amigo_request_result_notificação | Dezenas (10) | Centenas por dia |
| R31 | gostei_post_notificação | Milhares (1k) | Milhares por dia |
| R32 | comentário_notificação | Milhares (1k) | Milhares por dia |
| R33 | gostei_comment_notification | Milhares (1k) | Milhares por dia |
| R34 | notificação_mensagem_privada | Centenas (100) | Centenas por dia |
| R35 | notificação_mensagem_grupo | Milhares (1k) | Centenas por dia |
| R36 | join_group_request_notificação | Centenas (100) | Centenas por semana |
| R37 | group_join_request_result_notification | Dezenas (10) | Dezenas por semana |
| R38 | bloco_de_usuário | Dezenas (10) | Dezenas por semana |
| R39 | tag_usuário | Centenas (100) | Centenas por semana |
| R40 | admin_block | Centenas (100) | Centenas por mês |
| R40 | admin_block | Dezenas (10) | Dezenas por semana |

<div align="center">

Tabela 43: Carga de trabalho do banco de dados PlayNation
</div>

<a id="a62"></a>
#### 2. Índices Propostos

<a id="a62.1"></a>
##### 2.1. Índices de Desempenho
 
| **Índice** | IDX01 |
| ---                 | ---                                    |
| **Relação** | R11 |
| **Atributo** | id_criador |
| **Tipo** | Árvore B |
| **Cardinalidade** | Médio |
| **Agrupamento** | Não |
| **Justificativa** | A tabela 'post' é consideravelmente grande e as consultas geralmente recuperam postagens de um usuário específico e as ordenam por data. Isso é feito por correspondência exata, na coluna id_creator, e ordenação pelo campo 'data', que é melhor otimizado usando um índice do tipo árvore b. A aplicação deste índice agiliza os processos de busca de todos os posts de um usuário específico, junções entre 'usuário_registrado' e 'post' e cascatas de exclusão ou atualizações pelo usuário |
| `SQL code`                                                  | Veja abaixo

```sql
CREATE INDEX idx_post_creator ON post USING btree (id_creator);
```

<div align="center">

Tabela 44: Tabela do Índice 1
</div>


| **Índice** | IDX02 |
| ---                 | ---                                    |
| **Relação** | R15 |
| **Atributo** | id_post |
| **Tipo** | Árvore B |
| **Cardinalidade** | Alto |
| **Agrupamento** | Não |
| **Justificativa** | A tabela 'comentário' é muito grande. Na verdade, cada postagem pode ter muitos comentários, e as consultas frequentemente recuperam comentários por postagem, para exibir todos os comentários de uma determinada postagem, por exemplo. Isso é conseguido pela correspondência exata com id_post e ordenação para que os comentários sejam classificados. Um índice de árvore B suporta com eficiência pesquisas de intervalo e igualdade, bem como ordenação, tornando seu uso ideal. Este índice melhora muito o carregamento dos comentários de uma postagem e otimiza as junções entre 'post' e 'comentário' |
| `SQL code`                                                  | Veja abaixo 

```sql
CREATE INDEX idx_comment_post ON comments USING btree(id_post);
```

<div align="center">

Tabela 45: Tabela do Índice 2
</div>

| **Índice** | IDX03 |
| ---                 | ---                                    |
| **Relação** | R28 |
| **Atributo** | id_receptor |
| **Tipo** | Árvore B |
| **Cardinalidade** | Médio |
| **Agrupamento** | Não |
| **Justificativa** | A tabela de notificação será grande, pois cada usuário pode receber várias notificações, e as consultas frequentemente recuperam notificações do destinatário (geralmente ordenadas por data), portanto, um índice de árvore b é mais adequado nesse caso, pois suporta com eficiência pesquisas de intervalo e igualdade, bem como pedidos.  |
| `SQL code`                                                  | Veja abaixo

```sql
CREATE INDEX idx_notification_receiver_date ON notification USING btree(id_receiver);
```

<div align="center">

Tabela 46: Tabela do Índice 3
</div>

<a id="a62.2"></a>
#### 2.2. Índices de pesquisa de texto completo 

 

| **Índice** | IDX04 |
| ---                 | ---                                    |
| **Relação** | postagem |
| **Atributo** | descrição |
| **Tipo** | GIM |
| **Agrupamento** | Não |
| **Justificativa** | Para permitir a pesquisa de texto completo nas postagens, combinando suas descrições, foi criado um índice digitado GIN, adequado para este caso, pois o campo de descrição é relativamente estático e não muda com frequência. |
| `SQL code`                                                  | Veja abaixo

```sql

    ALTER TABLE post
    ADD COLUMN tsvectors TSVECTOR;

    CREATE FUNCTION post_search_update() RETURNS TRIGGER AS $
    BEGIN
        IF TG_OP = 'INSERT' THEN
            NEW.tsvectors := to_tsvector('portuguese', NEW.description);
        ELSIF TG_OP = 'UPDATE' THEN
            IF NEW.description <> OLD.description THEN
                NEW.tsvectors := to_tsvector('portuguese', NEW.description);
            END IF;
        END IF;
        RETURN NEW;
    END $ LANGUAGE plpgsql;

    CREATE TRIGGER post_search_update
    BEFORE INSERT OR UPDATE ON post
    FOR EACH ROW
    EXECUTE PROCEDURE post_search_update();

    CREATE INDEX search_post ON post USING GIN (tsvectors);
```

<div align="center">

Tabela 47: Tabela do Índice 4
</div>

| **Índice** | IDX05 |
| ---                 | ---                                    |
| **Relação** | usuário_registrado |
| **Atributo** | nome, nome de usuário |
| **Tipo** | GIM |
| **Agrupamento** | Não |
| **Justificativa** | Para permitir a pesquisa de texto completo nas postagens, combinando seus nomes ou nomes de usuário, foi criado um índice digitado GIN, adequado para este caso, pois os campos indexados são relativamente estáticos e não mudam com frequência.  |
| `SQL code`                                                  | Veja abaixo

```sql
    ALTER TABLE registered_user
    ADD COLUMN tsvectors TSVECTOR;

    CREATE FUNCTION user_search_update() RETURNS TRIGGER AS $
    BEGIN
        IF TG_OP = 'INSERT' THEN
            NEW.tsvectors := 
                setweight(to_tsvector('portuguese', NEW.name), 'A') ||
                setweight(to_tsvector('portuguese', NEW.username), 'B');
        ELSIF TG_OP = 'UPDATE' THEN
            IF NEW.name <> OLD.name OR NEW.username <> OLD.username THEN
                NEW.tsvectors := 
                    setweight(to_tsvector('portuguese', NEW.name), 'A') ||
                    setweight(to_tsvector('portuguese', NEW.username), 'B');
            END IF;
        END IF;
        RETURN NEW;
    END $ LANGUAGE plpgsql;

    CREATE TRIGGER user_search_update
    BEFORE INSERT OR UPDATE ON registered_user
    FOR EACH ROW
    EXECUTE PROCEDURE user_search_update();

    CREATE INDEX search_user ON registered_user USING GIN (tsvectors);
```

<div align="center">

Tabela 48: Tabela do Índice 5
</div>


| **Índice** | IDX06 |
| ---                 | ---                                    |
| **Relação** | grupo |
| **Atributo** | nome, descrição |
| **Tipo** | GIM |
| **Agrupamento** | Não |
| **Justificativa** | Para permitir a pesquisa de texto completo nas postagens, combinando seus nomes ou descrições, foi criado um índice digitado GIN, que é adequado para este caso, uma vez que os campos indexados são relativamente estáticos e não mudam com frequência.   |
| `SQL code`                                                  | Veja abaixo

```sql
    ALTER TABLE groups
    ADD COLUMN tsvectors TSVECTOR;

    CREATE FUNCTION group_search_update() RETURNS TRIGGER AS $
    BEGIN
        IF TG_OP = 'INSERT' THEN
            NEW.tsvectors := 
                setweight(to_tsvector('portuguese', NEW.name), 'A') ||
                setweight(to_tsvector('portuguese', NEW.description), 'B');
        ELSIF TG_OP = 'UPDATE' THEN
            IF NEW.name <> OLD.name OR NEW.description <> OLD.description THEN
                NEW.tsvectors := 
                    setweight(to_tsvector('portuguese', NEW.name), 'A') ||
                    setweight(to_tsvector('portuguese', NEW.description), 'B');
            END IF;
        END IF;
        RETURN NEW;
    END $ LANGUAGE plpgsql;

    CREATE TRIGGER group_search_update
    BEFORE INSERT OR UPDATE ON groups
    FOR EACH ROW
    EXECUTE PROCEDURE group_search_update();

    CREATE INDEX search_group ON groups USING GIN (tsvectors);
```

<div align="center">

Tabela 49: Tabela do Índice 6
</div>

<a id="a63"></a>
### 3. Gatilhos
 
Esta seção descreve o uso de gatilhos e funções definidas pelo usuário como mecanismos principais de banco de dados para automação. Especificamente, eles são usados ​​para executar tarefas automaticamente em resposta a alterações de dados e normalmente são combinados para impor regras de negócios.

| **Gatilho** | TRIGGER01 |
| ---              | ---                                    |
| **Descrição** | Os perfis podem ser públicos ou privados, mas o conteúdo dos perfis privados só pode ser acessado por seus amigos (BR01) |
| `SQL code`                                    | Veja abaixo |

```sql
CREATE FUNCTION check_profile_visibility() RETURNS TRIGGER AS $
BEGIN
    IF NOT EXISTS (
        SELECT 1 FROM registered_user WHERE id_user = NEW.id_user AND is_public = TRUE
    ) AND NOT EXISTS (
        SELECT 1 FROM user_friend WHERE id_user = NEW.id_user AND id_friend = NEW.id_friend
    ) THEN
        RAISE EXCEPTION 'Cannot access private profile content without being friends';
    END IF;
    RETURN NEW;
END;
$ LANGUAGE plpgsql;

CREATE TRIGGER profile_visibility_trigger
BEFORE INSERT OR UPDATE ON user_friend
FOR EACH ROW
EXECUTE FUNCTION check_profile_visibility();
```

<div align="center">

Tabela 50: Tabela do Gatilho 1
</div>


| **Gatilho** | TRIGGER02 |
| ---              | ---                                    |
| **Descrição** | Os grupos podem ser públicos ou privados, mas os privados só são visíveis para os seus membros (BR02) |
| `SQL code`                                    | Veja abaixo |

```sql
CREATE FUNCTION check_group_visibility() RETURNS TRIGGER AS $
BEGIN
    IF NOT EXISTS (
        SELECT 1 FROM groups WHERE id_group = NEW.id_group AND is_public = TRUE
    ) AND NOT EXISTS (
        SELECT 1 FROM group_membership WHERE id_group = NEW.id_group AND id_member = NEW.id_member
    ) THEN
        RAISE EXCEPTION 'Cannot access private group without being a member';
    END IF;
    RETURN NEW;
END;
$ LANGUAGE plpgsql;

CREATE TRIGGER group_visibility_trigger
BEFORE INSERT OR UPDATE ON group_membership
FOR EACH ROW
EXECUTE FUNCTION check_group_visibility();
```

<div align="center">

Tabela 51: Tabela do Gatilho 2
</div>

| **Gatilho** | TRIGGER03 |
| ---              | ---                                    |
| **Descrição** | Os usuários não podem enviar uma solicitação para ingressar em um grupo se já forem membros desse grupo (BR07) |
| `SQL code`                                    | Veja abaixo |

```sql
CREATE FUNCTION prevent_duplicate_group_join() RETURNS TRIGGER AS $
BEGIN
    IF EXISTS (
        SELECT 1 FROM group_membership 
        WHERE id_group = NEW.id_group AND id_member = NEW.id_requester
    ) THEN
        RAISE EXCEPTION 'User is already a member of this group';
    END IF;
    RETURN NEW;
END;
$ LANGUAGE plpgsql;

CREATE TRIGGER no_duplicate_group_join_trigger
BEFORE INSERT ON group_join_request
FOR EACH ROW
EXECUTE FUNCTION prevent_duplicate_group_join();
```

<div align="center">

Tabela 52: Tabela do Gatilho 3
</div>

| **Gatilhos** | TRIGGER04 |
| ---              | ---                                    |
| **Descrição** | Um usuário não pode estabelecer uma conexão de amizade com sua própria conta de usuário (BR08) |
| `SQL code`                                    | Veja abaixo |

```sql
CREATE FUNCTION prevent_self_friendship() RETURNS TRIGGER AS $
BEGIN
    IF NEW.id_user = NEW.id_friend THEN
        RAISE EXCEPTION 'A user cannot be friends with themselves';
    END IF;
    RETURN NEW;
END;
$ LANGUAGE plpgsql;

CREATE TRIGGER no_self_friendship_trigger
BEFORE INSERT OR UPDATE ON user_friend
FOR EACH ROW
EXECUTE FUNCTION prevent_self_friendship();
```

<div align="center">

Tabela 53: Tabela do Gatilho 4
</div>

| **Gatilho** | TRIGGER05 |
| ---              | ---                                    |
| **Descrição** | Um usuário não pode enviar uma solicitação de amizade para si mesmo (BR09) |
| `SQL code`                                    | Veja abaixo |

```sql
CREATE FUNCTION prevent_self_friend_request() RETURNS TRIGGER AS $
BEGIN
    IF NEW.id_user = NEW.id_requester THEN
        RAISE EXCEPTION 'A user cannot send a friend request to themselves';
    END IF;
    RETURN NEW;
END;
$ LANGUAGE plpgsql;

CREATE TRIGGER no_self_friend_request_trigger
BEFORE INSERT ON user_friend_request
FOR EACH ROW
EXECUTE FUNCTION prevent_self_friend_request();
```

<div align="center">

Tabela 54: Tabela do Gatilho 5
</div>

| **Gatilho** | TRIGGER06 |
| ---              | ---                                    |
| **Descrição** | Um usuário não pode enviar uma solicitação de amizade para outro usuário se já for amigo (BR10) |
| `SQL code`                                    | Veja abaixo |

```sql
CREATE FUNCTION prevent_existing_friend_request() RETURNS TRIGGER AS $
BEGIN
    IF EXISTS (
        SELECT 1 FROM user_friend 
        WHERE (id_user = NEW.id_user AND id_friend = NEW.id_requester)
        OR (id_user = NEW.id_requester AND id_friend = NEW.id_user)
    ) THEN
        RAISE EXCEPTION 'Cannot send friend request to existing friend';
    END IF;
    RETURN NEW;
END;
$ LANGUAGE plpgsql;

CREATE TRIGGER no_existing_friend_request_trigger
BEFORE INSERT ON user_friend_request
FOR EACH ROW
EXECUTE FUNCTION prevent_existing_friend_request();
```

<div align="center">

Tabela 55: Tabela do Gatilho 6
</div>

| **Gatilho** | TRIGGER07 |
| ---              | ---                                    |
| **Descrição** | Um usuário pode comentar ou curtir uma postagem somente se a postagem for de um usuário público, de um usuário de quem ele é amigo ou de um grupo ao qual pertence (BR12) |
| `SQL code`                                    | Veja abaixo |

```sql
CREATE FUNCTION check_post_interaction_access() RETURNS TRIGGER AS $
BEGIN
    -- Check if post creator is public
    IF EXISTS (
        SELECT 1 FROM post p
        JOIN registered_user ru ON p.id_creator = ru.id_user
        WHERE p.id_post = NEW.id_post AND ru.is_public = TRUE
    ) THEN
        RETURN NEW;
    END IF;

    -- Check if user is friend with post creator
    IF EXISTS (
        SELECT 1 FROM post p
        JOIN user_friend uf ON p.id_creator = uf.id_user
        WHERE p.id_post = NEW.id_post AND uf.id_friend = NEW.id_user
    ) THEN
        RETURN NEW;
    END IF;

    -- Check if post is in a group where user is member
    IF EXISTS (
        SELECT 1 FROM post p
        JOIN group_membership gm ON p.id_group = gm.id_group
        WHERE p.id_post = NEW.id_post AND gm.id_member = NEW.id_user
    ) THEN
        RETURN NEW;
    END IF;

    RAISE EXCEPTION 'User does not have permission to interact with this post';
END;
$ LANGUAGE plpgsql;

CREATE TRIGGER post_interaction_access_comments_trigger
BEFORE INSERT ON comments
FOR EACH ROW
EXECUTE FUNCTION check_post_interaction_access();

CREATE TRIGGER post_interaction_access_likes_trigger
BEFORE INSERT ON post_like
FOR EACH ROW
EXECUTE FUNCTION check_post_interaction_access();
```

<div align="center">

Tabela 56: Tabela do Gatilho 7
</div>

| **Gatilho** | TRIGGER08 |
| ---              | ---                                    |
| **Descrição** | Um usuário só está autorizado a postar em um grupo se for membro desse grupo específico (BR13) |
| `SQL code`                                    | Veja abaixo |

```sql
CREATE FUNCTION check_group_post_permission() RETURNS TRIGGER AS $
BEGIN
    IF NOT EXISTS (
        SELECT 1 FROM group_membership
        WHERE id_group = NEW.id_group AND id_member = NEW.id_sender
    ) THEN
        RAISE EXCEPTION 'User must be a member of the group to send messages';
    END IF;
    RETURN NEW;
END;
$ LANGUAGE plpgsql;

CREATE TRIGGER group_post_permission_trigger
BEFORE INSERT ON group_message
FOR EACH ROW
EXECUTE FUNCTION check_group_post_permission();
```

<div align="center">

Tabela 57: Tabela do Gatilho 8
</div>

| **Gatilho** | TRIGGER09 |
| ---              | ---                                    |
| **Descrição** | Um usuário está restrito a curtir um comentário ou postagem específica apenas uma vez (BR14) |
| `SQL code`                                    | Veja abaixo |

```sql
CREATE FUNCTION prevent_duplicate_likes() RETURNS TRIGGER AS $
BEGIN
    IF TG_TABLE_NAME = 'post_like' THEN
        IF EXISTS (
            SELECT 1 FROM post_like
            WHERE id_post = NEW.id_post AND id_user = NEW.id_user
        ) THEN
            RAISE EXCEPTION 'User has already liked this post';
        END IF;
    ELSIF TG_TABLE_NAME = 'comment_like' THEN
        IF EXISTS (
            SELECT 1 FROM comment_like
            WHERE id_comment = NEW.id_comment AND id_user = NEW.id_user
        ) THEN
            RAISE EXCEPTION 'User has already liked this comment';
        END IF;
    END IF;
    RETURN NEW;
END;
$ LANGUAGE plpgsql;

CREATE TRIGGER single_post_like_trigger
BEFORE INSERT ON post_like
FOR EACH ROW
EXECUTE FUNCTION prevent_duplicate_likes();

CREATE TRIGGER single_comment_like_trigger
BEFORE INSERT ON comment_like
FOR EACH ROW
EXECUTE FUNCTION prevent_duplicate_likes();
```

<div align="center">

Tabela 58: Tabela do Gatilho 9
</div>

| **Gatilho** | GATILHO10 |
| ---              | ---                                    |
| **Descrição** | Qualquer nova postagem deve conter pelo menos um dos seguintes elementos: uma descrição (conteúdo de texto) ou uma imagem (BR15) |
| `SQL code`                                    | Veja abaixo |

```sql
CREATE FUNCTION check_post_content() RETURNS TRIGGER AS $
BEGIN
    IF NEW.description IS NULL AND NEW.image IS NULL THEN
        RAISE EXCEPTION 'Post must have either a description or an image';
    END IF;
    RETURN NEW;
END;
$ LANGUAGE plpgsql;

CREATE TRIGGER post_content_trigger
BEFORE INSERT OR UPDATE ON post
FOR EACH ROW
EXECUTE FUNCTION check_post_content();
```
<div align="center">

Tabela 59: Tabela do Gatilho 10
</div>                                         

<a id="a64"></a>
#### 4. Transações

Implementamos Transações para garantir a integridade dos dados quando, para realizar uma ação, muitas operações são necessárias.   

| Transação | TRANS01 |
| --------------- | ----------------------------------- |
| Justificação | Enviar uma solicitação de amizade: a operação insere tanto em user_friend_request quanto em notificação e evita casos em que existe uma solicitação sem notificação ou vice-versa.   |
| Nível de isolamento | SERIALIZÁVEL |
| `Complete SQL Code`                                   | Veja abaixo |

```sql
BEGIN TRANSACTION ISOLATION LEVEL SERIALIZABLE;

INSERT INTO user_friend_request (id_user, id_requester)
VALUES ($id_user, $id_requester);

INSERT INTO notification (id_receiver, id_emitter, text, date, read)
VALUES ($id_user, $id_requester, $text, NOW(), FALSE);

INSERT INTO friend_request_notification (id_notification, accepted)
VALUES (currval(pg_get_serial_sequence('notification', 'id_notification')), NULL);

COMMIT;
```

<div align="center">

Tabela 60: Tabela da Transação 1
</div>

| Transação | TRANS02 |
| --------------- | ----------------------------------- |
| Justificação | Aceitar pedido de amizade: crie amizade recíproca, remova o pedido e produza notificação de resultados para evitar estado parcial.   |
| Nível de isolamento | SERIALIZÁVEL |
| `Complete SQL Code`                                   | Veja abaixo |

```sql
BEGIN TRANSACTION ISOLATION LEVEL SERIALIZABLE;

INSERT INTO user_friend (id_user, id_friend)
VALUES ($id_accepter, $id_requester), ($id_requester, $id_accepter);

DELETE FROM user_friend_request
WHERE id_user = $id_accepter AND id_requester = $id_requester;

UPDATE friend_request_notification
SET accepted = TRUE
WHERE id_notification = $original_notification_id;

INSERT INTO notification (id_receiver, id_emitter, text, date, read)
VALUES ($id_requester, $id_accepter, $text, NOW(), FALSE);

INSERT INTO friend_request_result_notification (id_notification)
VALUES (currval(pg_get_serial_sequence('notification', 'id_notification')));

COMMIT;
```

<div align="center">

Tabela 61: Tabela de Transação 2
</div>

| Transação | TRANS03 |
| --------------- | ----------------------------------- |
| Justificação | Remover amigo: exclua ambas as linhas direcionais de amizade para evitar estado assimétrico.   |
| Nível de isolamento | SERIALIZÁVEL |
| `Complete SQL Code`                                   | Veja abaixo |

```sql
BEGIN TRANSACTION ISOLATION LEVEL SERIALIZABLE;

DELETE FROM user_friend
WHERE (id_user = $id_user AND id_friend = $id_friend) OR (id_user = $id_friend AND id_friend = $id_user);

COMMIT;
```

<div align="center">

Tabela 62: Tabela de Transação 3
</div>

| Transação | TRANS04 |
| --------------- | ----------------------------------- |
| Justificação | Crie uma postagem: crie-a e anexe o rótulo usando o ID de sequência correto; evitar corridas em currval.   |
| Nível de isolamento | SERIALIZÁVEL |
| `Complete SQL Code`                                   | Veja abaixo |

```sql
BEGIN TRANSACTION ISOLATION LEVEL SERIALIZABLE;

INSERT INTO post (id_creator, image, description, date)
VALUES ($id_creator, $image, $description, NOW());

INSERT INTO post_label (id_post, id_label)
VALUES (currval(pg_get_serial_sequence('post', 'id_post')), $id_label);

COMMIT;
```

<div align="center">

Tabela 63: Tabela de Transação 4
</div>

| Transação | TRANS05 |
| --------------- | ----------------------------------- |
| Justificação | Curtir postagem: insira o like e sua notificação juntos para evitar notificações duplicadas.    |
| Nível de isolamento | SERIALIZÁVEL |
| `Complete SQL Code`                                   | Veja abaixo |

```sql
BEGIN TRANSACTION ISOLATION LEVEL SERIALIZABLE;

INSERT INTO post_like (id_post, id_user)
VALUES ($id_post, $id_user);

INSERT INTO notification (id_receiver, id_emitter, text, date, read)
VALUES ($id_receiver, $id_user, $text, NOW(), FALSE);

INSERT INTO like_post_notification (id_notification, id_post)
VALUES (currval(pg_get_serial_sequence('notification', 'id_notification')), $id_post);

COMMIT;
```

<div align="center">

Tabela 64: Tabela da Transação 5
</div>

| Transação | TRANS06 |
| --------------- | ----------------------------------- |
| Justificação | Comentário na postagem: crie um comentário e, em seguida, uma notificação referenciando esse comentário atomicamente para garantir os IDs corretos.     |
| Nível de isolamento | SERIALIZÁVEL |
| `Complete SQL Code`                                   | Veja abaixo |

```sql
BEGIN TRANSACTION ISOLATION LEVEL SERIALIZABLE;

INSERT INTO comments (id_post, id_user, id_reply, text, date)
VALUES ($id_post, $id_user, $id_reply, $text, NOW());

INSERT INTO notification (id_receiver, id_emitter, text, date, read)
VALUES ($id_receiver, $id_user, $text, NOW(), FALSE);

INSERT INTO comment_notification (id_notification, id_comment)
VALUES (currval(pg_get_serial_sequence('notification', 'id_notification')), currval(pg_get_serial_sequence('comments', 'id_comment')));

COMMIT;
```

<div align="center">

Tabela 65: Tabela da Transação 6
</div>

| Transação | TRANS07 |
| --------------- | ----------------------------------- |
| Justificação | Compartilhe postagem via mensagem privada: crie mensagem, mensagem privada e sua notificação atomicamente para evitar incompatibilidades de sequência/id.     |
| Nível de isolamento | SERIALIZÁVEL |
| `Complete SQL Code`                                   | Veja abaixo |

```sql
BEGIN TRANSACTION ISOLATION LEVEL SERIALIZABLE;

INSERT INTO message (text, image, date)
VALUES ($text, $image, NOW());

INSERT INTO private_message (id_message, id_sender, id_receiver)
VALUES (currval(pg_get_serial_sequence('message', 'id_message')), $id_sender, $id_receiver);

INSERT INTO notification (id_receiver, id_emitter, text, date, read)
VALUES ($id_receiver, $id_sender, $text, NOW(), FALSE);

INSERT INTO private_message_notification (id_notification, id_message)
VALUES (currval(pg_get_serial_sequence('notification', 'id_notification')), currval(pg_get_serial_sequence('message', 'id_message')));

COMMIT;
```

<div align="center">

Tabela 66: Tabela da Transação 7
</div>

| Transação | TRANS08 |
| --------------- | ----------------------------------- |
| Justificação | Enviar mensagem para um amigo: envie mensagem privada simples e notificação atomicamente para garantir referências consistentes.     |
| Nível de isolamento | SERIALIZÁVEL |
| `Complete SQL Code`                                   | Veja abaixo |

```sql
BEGIN TRANSACTION ISOLATION LEVEL SERIALIZABLE;

INSERT INTO message (text, image, date)
VALUES ($text, NULL, NOW());

INSERT INTO private_message (id_message, id_sender, id_receiver)
VALUES (currval(pg_get_serial_sequence('message', 'id_message')), $id_sender, $id_receiver);

INSERT INTO notification (id_receiver, id_emitter, text, date, read)
VALUES ($id_receiver, $id_sender, $text, NOW(), FALSE);

INSERT INTO private_message_notification (id_notification, id_message)
VALUES (currval(pg_get_serial_sequence('notification', 'id_notification')), currval(pg_get_serial_sequence('message', 'id_message')));

COMMIT;
```

<div align="center">

Tabela 67: Tabela da Transação 8
</div>

| Transação | TRANS09 |
| --------------- | ----------------------------------- |
| Justificação | Postar no grupo: crie mensagens de grupo e notificações por membro em uma função para que todas as inserções relacionadas sejam produzidas como uma unidade.     |
| Nível de isolamento | SERIALIZÁVEL |
| `Complete SQL Code`                                   | Veja abaixo |

```sql
CREATE OR REPLACE FUNCTION post_group_message(
    sender_id INTEGER,
    group_id INTEGER,
    message_text TEXT,
    message_image TEXT
)
RETURNS VOID AS $
DECLARE
    new_message_id INTEGER;
    notification_id INTEGER;
    receiver_id INTEGER;
BEGIN

    INSERT INTO message (text, image, date)
    VALUES (message_text, message_image, NOW())
    RETURNING id_message INTO new_message_id;

    INSERT INTO group_message (id_message, id_sender, id_group)
    VALUES (new_message_id, sender_id, group_id);

    FOR receiver_id IN
        SELECT id_member
        FROM group_membership
        WHERE id_group = group_id AND id_member <> sender_id
    LOOP
        INSERT INTO notification (id_receiver, id_emitter, text, date, read)
        VALUES (receiver_id, sender_id, message_text, NOW(), FALSE)
        RETURNING id_notification INTO notification_id;

        INSERT INTO group_message_notification (id_notification, id_message)
        VALUES (notification_id, new_message_id);
    END LOOP;

END;
$ LANGUAGE plpgsql;
```

<div align="center">

Tabela 68: Tabela da Transação 9
</div>

| Transação | TRANS10 |
| --------------- | ----------------------------------- |
| Justificação | Criar grupo: crie-o, garanta que o proprietário exista e adicione a associação do proprietário atomicamente para evitar o estado parcial do grupo.
--      |
| Nível de isolamento | SERIALIZÁVEL |
| `Complete SQL Code`                                   | Veja abaixo |

```sql
BEGIN TRANSACTION ISOLATION LEVEL SERIALIZABLE;

INSERT INTO group_owner (id_group_owner)
VALUES ($id_group_owner)
ON CONFLICT (id_group_owner) DO NOTHING;

INSERT INTO groups (id_owner, name, description, picture, is_public)
VALUES ($id_group_owner, $name, $description, $picture, TRUE);

INSERT INTO group_membership (id_group, id_member)
VALUES (currval(pg_get_serial_sequence('groups', 'id_group')), $id_group_owner);

COMMIT;
```

<div align="center">

Tabela 69: Tabela da Transação 10
</div>

| Transação | TRANS11 |
| --------------- | ----------------------------------- |
| Justificação | Enviar solicitação de adesão ao grupo: crie uma solicitação de adesão e uma notificação em conjunto para que o proprietário possa atender a uma solicitação válida.|
| Nível de isolamento | SERIALIZÁVEL |
| `Complete SQL Code`                                   | Veja abaixo |

```sql
BEGIN TRANSACTION ISOLATION LEVEL SERIALIZABLE;

INSERT INTO group_join_request (id_group, id_requester)
VALUES ($id_group, $id_requester);

INSERT INTO notification (id_receiver, id_emitter, text, date, read)
VALUES ($id_receiver, $id_emitter, $text, NOW(), FALSE);

INSERT INTO join_group_request_notification (id_notification, id_group, accepted)
VALUES (currval(pg_get_serial_sequence('notification', 'id_notification')), $id_group, NULL);

COMMIT;
```

<div align="center">

Tabela 70: Tabela da Transação 11
</div>

| Transação | TRANS12 |
| --------------- | ----------------------------------- |
| Justificação | Aceite a solicitação de ingresso no grupo: remova a solicitação, adicione a associação, atualize a notificação original e notifique o solicitante atomicamente.|
| Nível de isolamento | SERIALIZÁVEL |
| `Complete SQL Code`                                   | Veja abaixo |

```sql
BEGIN TRANSACTION ISOLATION LEVEL SERIALIZABLE;

DELETE FROM group_join_request
WHERE id_group = $id_group AND id_requester = $id_requester;

INSERT INTO group_membership (id_group, id_member)
VALUES ($id_group, $id_requester);

UPDATE join_group_request_notification
SET accepted = TRUE
WHERE id_notification = $original_notification_id;

INSERT INTO notification (id_receiver, id_emitter, text, date, read)
VALUES ($id_requester, $id_group_owner, $text, NOW(), FALSE);

INSERT INTO join_group_request_result_notification (id_notification, id_group)
VALUES (currval(pg_get_serial_sequence('notification', 'id_notification')), $id_group);

COMMIT;
```

<div align="center">

Tabela 71: Tabela da Transação 12
</div>

| Transação | TRANS13 |
| --------------- | ----------------------------------- |
| Justificação | Postagem de relatório: insira relatório e link para postagem; READ COMMITTED é suficiente para inserções de relatórios independentes. A mesma lógica é aplicada para Denunciar um comentário, Denunciar um perfil e Denunciar um grupo. |
| Nível de isolamento | SERIALIZÁVEL |
| `Complete SQL Code`                                   | Veja abaixo |

```sql
BEGIN TRANSACTION ISOLATION LEVEL READ COMMITTED;

INSERT INTO report (description)
VALUES ($description);

INSERT INTO report_post (id_report, id_post)
VALUES (currval(pg_get_serial_sequence('report', 'id_report')), $id_post);

COMMIT;
```

<div align="center">

Tabela 72: Tabela da Transação 13
</div>

| Transação | TRANS14 |
| --------------- | ----------------------------------- |
| Justificação | Excluir conta: exclua usuário e conte com cascatas; execute atomicamente para evitar recreação simultânea ou limpeza parcial. |
| Nível de isolamento | SERIALIZÁVEL |
| `Complete SQL Code`                                   | Veja abaixo |

```sql
BEGIN TRANSACTION ISOLATION LEVEL SERIALIZABLE;

DELETE FROM registered_user
WHERE id_user = $id_user;

COMMIT;
```

<div align="center">

Tabela 73: Tabela da Transação 14
</div>

| Transação | TRANS15 |
| --------------- | ----------------------------------- |
| Justificação | Bloquear um usuário: registre o bloqueio e remova amizades atomicamente para evitar o estado de amigo transitório. |
| Nível de isolamento | SERIALIZÁVEL |
| `Complete SQL Code`                                   | Veja abaixo |

```sql
BEGIN TRANSACTION ISOLATION LEVEL SERIALIZABLE;

INSERT INTO user_block (id_user, id_blocked)
VALUES ($id_user, $id_blocked);

DELETE FROM user_friend
WHERE (id_user = $id_user AND id_friend = $id_blocked)
OR (id_user = $id_blocked AND id_friend = $id_user);

COMMIT;
```

<div align="center">

Tabela 74: Tabela da Transação 15
</div>

| Transação | TRANS16 |
| --------------- | ----------------------------------- |
| Justificação | Desbloquear um usuário: remova o registro do bloco atomicamente para que as operações dependentes vejam um estado de bloco consistente.  |
| Nível de isolamento | SERIALIZÁVEL |
| `Complete SQL Code`                                   | Veja abaixo |

```sql
BEGIN TRANSACTION ISOLATION LEVEL SERIALIZABLE;

DELETE FROM user_block
WHERE id_user = $id_user AND id_blocked = $id_blocked;

COMMIT;
```

<div align="center">

Tabela 75: Tabela da Transação 16
</div>

| Transação | TRANS17 |
| --------------- | ----------------------------------- |
| Justificação | Remover postagem denunciada: remova-a e notifique atomicamente para evitar notificações órfãs ou estado de moderação inconsistente.  |
| Nível de isolamento | SERIALIZÁVEL |
| `Complete SQL Code`                                   | Veja abaixo |

```sql
BEGIN TRANSACTION ISOLATION LEVEL SERIALIZABLE;

DELETE FROM post
WHERE id_post = $id_post;

INSERT INTO notification (id_receiver, id_emitter, text, date, read)
VALUES ($id_receiver, NULL, $text, NOW(), FALSE);

COMMIT;
```

<div align="center">

Tabela 76: Tabela da Transação 17
</div>

<a id="sql"></a>
### Anexo A. Código SQL 

O esquema de banco de dados PlayNation está disponível [aqui](https://github.com/TM-1-3/PlayNation/blob/main/database/create.sql).

O script de população do banco de dados PlayNation está disponível [aqui](https://github.com/TM-1-3/PlayNation/blob/main/database/populate.sql).


<a id="sqla"></a>
#### A.1. Esquema de banco de dados

 ```sql
CREATE SCHEMA IF NOT EXISTS lbaw2551;
-- drop tables 

DROP TABLE IF EXISTS join_group_request_result_notification CASCADE;
DROP TABLE IF EXISTS join_group_request_notification CASCADE;
DROP TABLE IF EXISTS group_message_notification CASCADE;
DROP TABLE IF EXISTS private_message_notification CASCADE;
DROP TABLE IF EXISTS like_comment_notification CASCADE;
DROP TABLE IF EXISTS comment_notification CASCADE;
DROP TABLE IF EXISTS like_post_notification CASCADE;
DROP TABLE IF EXISTS friend_request_result_notification CASCADE;
DROP TABLE IF EXISTS friend_request_notification CASCADE;
DROP TABLE IF EXISTS group_message CASCADE;
DROP TABLE IF EXISTS private_message CASCADE;
DROP TABLE IF EXISTS report_post CASCADE;
DROP TABLE IF EXISTS report_group CASCADE;
DROP TABLE IF EXISTS report_user CASCADE;
DROP TABLE IF EXISTS report_comment CASCADE;
DROP TABLE IF EXISTS report CASCADE;
DROP TABLE IF EXISTS comment_like CASCADE;
DROP TABLE IF EXISTS comments CASCADE;
DROP TABLE IF EXISTS post_save CASCADE;
DROP TABLE IF EXISTS post_like CASCADE;
DROP TABLE IF EXISTS post_label CASCADE;
DROP TABLE IF EXISTS post CASCADE;
DROP TABLE IF EXISTS user_label CASCADE;
DROP TABLE IF EXISTS category CASCADE;
DROP TABLE IF EXISTS sport CASCADE;
DROP TABLE IF EXISTS label CASCADE;
DROP TABLE IF EXISTS group_membership CASCADE;
DROP TABLE IF EXISTS group_join_request CASCADE;
DROP TABLE IF EXISTS groups CASCADE;
DROP TABLE IF EXISTS user_friend_request CASCADE;
DROP TABLE IF EXISTS user_friend CASCADE;
DROP TABLE IF EXISTS notification CASCADE;
DROP TABLE IF EXISTS group_owner CASCADE;
DROP TABLE IF EXISTS verified_user CASCADE;
DROP TABLE IF EXISTS administrator CASCADE;
DROP TABLE IF EXISTS registered_user CASCADE;
DROP TABLE IF EXISTS user_block CASCADE;
DROP TABLE IF EXISTS user_tag CASCADE;
DROP TABLE IF EXISTS message CASCADE;
DROP TABLE IF EXISTS admin_block CASCADE;
DROP TABLE IF EXISTS admin_ban CASCADE;

-- create tables

CREATE TABLE registered_user(
    id_user SERIAL PRIMARY KEY,
    username TEXT UNIQUE NOT NULL,
    name TEXT NOT NULL,
    email TEXT UNIQUE NOT NULL,
    password TEXT NOT NULL,
    biography TEXT,
    profile_picture TEXT,
    is_public BOOLEAN DEFAULT TRUE
);

CREATE TABLE administrator(
    id_admin INTEGER PRIMARY KEY REFERENCES registered_user (id_user) ON DELETE CASCADE
);

CREATE TABLE verified_user(
    id_verified INTEGER PRIMARY KEY REFERENCES registered_user (id_user) ON DELETE CASCADE
);

CREATE TABLE group_owner(
    id_group_owner INTEGER PRIMARY KEY REFERENCES registered_user (id_user) ON DELETE CASCADE
);

CREATE TABLE user_friend(
    id_user INTEGER NOT NULL REFERENCES registered_user (id_user) ON DELETE CASCADE,
    id_friend INTEGER NOT NULL REFERENCES registered_user (id_user) ON DELETE CASCADE,
    PRIMARY KEY (id_user, id_friend)
);

CREATE TABLE user_friend_request(
    id_user INTEGER NOT NULL REFERENCES registered_user (id_user) ON DELETE CASCADE,
    id_requester INTEGER NOT NULL REFERENCES registered_user (id_user) ON DELETE CASCADE,
    PRIMARY KEY (id_user, id_requester)
);

CREATE TABLE label(
    id_label SERIAL PRIMARY KEY,
    designation TEXT NOT NULL,
    image TEXT NOT NULL
);

CREATE TABLE sport(
    id_sport INTEGER PRIMARY KEY REFERENCES label (id_label) ON DELETE CASCADE
);

CREATE TABLE category(
    id_category INTEGER PRIMARY KEY REFERENCES label (id_label) ON DELETE CASCADE
);

CREATE TABLE user_label(
    id_user INTEGER NOT NULL REFERENCES registered_user (id_user) ON DELETE CASCADE,
    id_label INTEGER NOT NULL REFERENCES label (id_label) ON DELETE CASCADE,
    PRIMARY KEY (id_user, id_label)
);

CREATE TABLE post(
    id_post SERIAL PRIMARY KEY,
    id_creator INTEGER NOT NULL REFERENCES registered_user (id_user) ON DELETE SET NULL,
    image TEXT NOT NULL,
    description TEXT NOT NULL,
    date TIMESTAMP NOT NULL CHECK (date<=now())
);

CREATE TABLE post_label(
    id_post INTEGER NOT NULL REFERENCES post (id_post) ON DELETE CASCADE,
    id_label INTEGER NOT NULL REFERENCES label (id_label) ON DELETE CASCADE,
    PRIMARY KEY (id_post, id_label)
);

CREATE TABLE post_like(
    id_post INTEGER NOT NULL REFERENCES post (id_post) ON DELETE CASCADE,
    id_user INTEGER NOT NULL REFERENCES registered_user (id_user) ON DELETE CASCADE,
    PRIMARY KEY (id_post, id_user)
);

CREATE TABLE post_save(
    id_post INTEGER NOT NULL REFERENCES post (id_post) ON DELETE CASCADE,
    id_user INTEGER NOT NULL REFERENCES registered_user (id_user) ON DELETE CASCADE,
    PRIMARY KEY (id_post, id_user)
);

CREATE TABLE comments(
    id_comment SERIAL PRIMARY KEY,
    id_post INTEGER NOT NULL REFERENCES post (id_post) ON DELETE CASCADE,
    id_user INTEGER NOT NULL REFERENCES registered_user (id_user) ON DELETE SET NULL,
    id_reply INTEGER REFERENCES comments (id_comment) ON DELETE CASCADE,
    text TEXT NOT NULL,
    date TIMESTAMP NOT NULL CHECK (date<=now())
);

CREATE TABLE comment_like(
    id_comment INTEGER NOT NULL REFERENCES comments (id_comment) ON DELETE CASCADE,
    id_user INTEGER NOT NULL REFERENCES registered_user (id_user) ON DELETE CASCADE,
    PRIMARY KEY (id_comment, id_user)
);

CREATE TABLE groups(
    id_group SERIAL PRIMARY KEY,
    id_owner INTEGER NOT NULL REFERENCES group_owner (id_group_owner) ON DELETE SET NULL,
    name TEXT UNIQUE NOT NULL,
    description TEXT,
    picture TEXT,
    is_public BOOLEAN DEFAULT TRUE
);

CREATE TABLE group_membership(
    id_group INTEGER NOT NULL REFERENCES groups (id_group) ON DELETE CASCADE,
    id_member INTEGER NOT NULL REFERENCES registered_user (id_user) ON DELETE CASCADE,
    PRIMARY KEY (id_group, id_member)
);

CREATE TABLE group_join_request(
    id_group INTEGER NOT NULL REFERENCES groups (id_group) ON DELETE CASCADE,
    id_requester INTEGER NOT NULL REFERENCES registered_user (id_user) ON DELETE CASCADE,
    PRIMARY KEY (id_group, id_requester)
);

CREATE TABLE message(
    id_message SERIAL PRIMARY KEY,
    text TEXT NOT NULL,
    image TEXT,
    date TIMESTAMP NOT NULL CHECK (date<=now())
);

CREATE TABLE private_message(
    id_message INTEGER PRIMARY KEY REFERENCES message (id_message) ON DELETE CASCADE,
    id_sender INTEGER NOT NULL REFERENCES registered_user (id_user) ON DELETE CASCADE,
    id_receiver INTEGER NOT NULL REFERENCES registered_user (id_user) ON DELETE CASCADE
);

CREATE TABLE group_message(
    id_message INTEGER PRIMARY KEY REFERENCES message (id_message) ON DELETE CASCADE,
    id_group INTEGER NOT NULL REFERENCES groups (id_group) ON DELETE CASCADE,
    id_sender INTEGER NOT NULL REFERENCES registered_user (id_user) ON DELETE CASCADE
);

CREATE TABLE report(
    id_report SERIAL PRIMARY KEY,
    description TEXT NOT NULL
);

--
CREATE TABLE report_comment(
    id_report INTEGER NOT NULL REFERENCES report (id_report) ON DELETE CASCADE,
    id_comment INTEGER NOT NULL REFERENCES comments (id_comment) ON DELETE CASCADE,
    PRIMARY KEY (id_report, id_comment)
);

CREATE TABLE report_user(
    id_report INTEGER NOT NULL REFERENCES report (id_report) ON DELETE CASCADE,
    id_user INTEGER NOT NULL REFERENCES registered_user (id_user) ON DELETE CASCADE,
    PRIMARY KEY (id_report, id_user)
);

CREATE TABLE report_group(
    id_report INTEGER NOT NULL REFERENCES report (id_report) ON DELETE CASCADE,
    id_group INTEGER NOT NULL REFERENCES groups (id_group) ON DELETE CASCADE,
    PRIMARY KEY (id_report, id_group)
);

CREATE TABLE report_post(
    id_report INTEGER NOT NULL REFERENCES report (id_report) ON DELETE CASCADE,
    id_post INTEGER NOT NULL REFERENCES post (id_post) ON DELETE CASCADE,
    PRIMARY KEY (id_report, id_post)
);

CREATE TABLE notification(
    id_notification SERIAL PRIMARY KEY,
    id_receiver INTEGER NOT NULL REFERENCES registered_user (id_user) ON DELETE CASCADE,
    id_emitter INTEGER REFERENCES registered_user (id_user) ON DELETE SET NULL,
    text TEXT NOT NULL,
    date TIMESTAMP NOT NULL CHECK (date<=now())
);

CREATE TABLE friend_request_notification(
    id_notification INTEGER PRIMARY KEY REFERENCES notification (id_notification) ON DELETE CASCADE,
    accepted BOOLEAN
);

CREATE TABLE friend_request_result_notification(
    id_notification INTEGER PRIMARY KEY REFERENCES notification (id_notification) ON DELETE CASCADE
);

CREATE TABLE like_post_notification(
    id_notification INTEGER PRIMARY KEY REFERENCES notification (id_notification) ON DELETE CASCADE,
    id_post INTEGER NOT NULL REFERENCES post (id_post) ON DELETE CASCADE
);

CREATE TABLE comment_notification(
    id_notification INTEGER PRIMARY KEY REFERENCES notification (id_notification) ON DELETE CASCADE,
    id_comment INTEGER NOT NULL REFERENCES comments (id_comment) ON DELETE CASCADE
);

CREATE TABLE like_comment_notification(
    id_notification INTEGER PRIMARY KEY REFERENCES notification (id_notification) ON DELETE CASCADE,
    id_comment INTEGER NOT NULL REFERENCES comments (id_comment) ON DELETE CASCADE
);

CREATE TABLE private_message_notification(
    id_notification INTEGER PRIMARY KEY REFERENCES notification (id_notification) ON DELETE CASCADE,
    id_message INTEGER NOT NULL REFERENCES message (id_message) ON DELETE CASCADE
);

CREATE TABLE group_message_notification(
    id_notification INTEGER PRIMARY KEY REFERENCES notification (id_notification) ON DELETE CASCADE,
    id_message INTEGER NOT NULL REFERENCES group_message (id_message) ON DELETE CASCADE
);

CREATE TABLE join_group_request_notification(
    id_notification INTEGER PRIMARY KEY REFERENCES notification (id_notification) ON DELETE CASCADE,
    id_group INTEGER NOT NULL REFERENCES groups (id_group) ON DELETE CASCADE,
    accepted BOOLEAN
);


CREATE TABLE join_group_request_result_notification(
    id_notification INTEGER PRIMARY KEY REFERENCES notification (id_notification) ON DELETE CASCADE,
    id_group INTEGER NOT NULL REFERENCES groups (id_group) ON DELETE CASCADE
);

CREATE TABLE user_block(
    id_user INTEGER NOT NULL REFERENCES registered_user (id_user) ON DELETE CASCADE,
    id_blocked INTEGER NOT NULL REFERENCES registered_user (id_user) ON DELETE CASCADE,
    PRIMARY KEY (id_user, id_blocked)
);

CREATE TABLE user_tag(
    id_post INTEGER NOT NULL REFERENCES post (id_post) ON DELETE CASCADE,
    id_user INTEGER NOT NULL REFERENCES registered_user (id_user) ON DELETE CASCADE,
    PRIMARY KEY (id_post, id_user)
);

CREATE TABLE admin_block(
    id_admin INTEGER NOT NULL REFERENCES administrator (id_admin) ON DELETE CASCADE,
    id_user INTEGER NOT NULL REFERENCES registered_user (id_user) ON DELETE CASCADE,
    PRIMARY KEY (id_admin, id_user)
);

CREATE TABLE admin_ban(
    id_admin INTEGER NOT NULL REFERENCES administrator (id_admin) ON DELETE CASCADE,
    id_user INTEGER NOT NULL REFERENCES registered_user (id_user) ON DELETE CASCADE,
    PRIMARY KEY (id_admin, id_user)
);

-- Indexes

DROP FUNCTION IF EXISTS post_search_update() CASCADE;
DROP FUNCTION IF EXISTS user_search_update() CASCADE;
DROP FUNCTION IF EXISTS group_search_update() CASCADE;

CREATE INDEX idx_post_creator ON post USING btree (id_creator);

CREATE INDEX idx_comment_post ON comments USING btree(id_post);
CLUSTER comments USING idx_comment_post;

CREATE INDEX idx_notification_receiver_date ON notification USING btree(id_receiver);
CLUSTER notification USING idx_notification_receiver_date;

-- FTS Indexes

ALTER TABLE post
ADD COLUMN tsvectors TSVECTOR;

CREATE FUNCTION post_search_update() RETURNS TRIGGER AS $
BEGIN
    IF TG_OP = 'INSERT' THEN
        NEW.tsvectors := to_tsvector('portuguese', NEW.description);
    ELSIF TG_OP = 'UPDATE' THEN
        IF NEW.description <> OLD.description THEN
            NEW.tsvectors := to_tsvector('portuguese', NEW.description);
        END IF;
    END IF;
    RETURN NEW;
END $ LANGUAGE plpgsql;

CREATE TRIGGER post_search_update
BEFORE INSERT OR UPDATE ON post
FOR EACH ROW
EXECUTE PROCEDURE post_search_update();

CREATE INDEX search_post ON post USING GIN (tsvectors);

ALTER TABLE registered_user
ADD COLUMN tsvectors TSVECTOR;

CREATE FUNCTION user_search_update() RETURNS TRIGGER AS $
BEGIN
    IF TG_OP = 'INSERT' THEN
        NEW.tsvectors := 
            setweight(to_tsvector('portuguese', NEW.name), 'A') ||
            setweight(to_tsvector('portuguese', NEW.username), 'B');
    ELSIF TG_OP = 'UPDATE' THEN
        IF NEW.name <> OLD.name OR NEW.username <> OLD.username THEN
            NEW.tsvectors := 
                setweight(to_tsvector('portuguese', NEW.name), 'A') ||
                setweight(to_tsvector('portuguese', NEW.username), 'B');
        END IF;
    END IF;
    RETURN NEW;
END $ LANGUAGE plpgsql;

CREATE TRIGGER user_search_update
BEFORE INSERT OR UPDATE ON registered_user
FOR EACH ROW
EXECUTE PROCEDURE user_search_update();

CREATE INDEX search_user ON registered_user USING GIN (tsvectors);

ALTER TABLE groups
ADD COLUMN tsvectors TSVECTOR;

CREATE FUNCTION group_search_update() RETURNS TRIGGER AS $
BEGIN
    IF TG_OP = 'INSERT' THEN
        NEW.tsvectors := 
            setweight(to_tsvector('portuguese', NEW.name), 'A') ||
            setweight(to_tsvector('portuguese', NEW.description), 'B');
    ELSIF TG_OP = 'UPDATE' THEN
        IF NEW.name <> OLD.name OR NEW.description <> OLD.description THEN
            NEW.tsvectors := 
                setweight(to_tsvector('portuguese', NEW.name), 'A') ||
                setweight(to_tsvector('portuguese', NEW.description), 'B');
        END IF;
    END IF;
    RETURN NEW;
END $ LANGUAGE plpgsql;

CREATE TRIGGER group_search_update
BEFORE INSERT OR UPDATE ON groups
FOR EACH ROW
EXECUTE PROCEDURE group_search_update();

CREATE INDEX search_group ON groups USING GIN (tsvectors);



-- Triggers

DROP FUNCTION IF EXISTS check_profile_visibility() CASCADE;
DROP FUNCTION IF EXISTS check_group_visibility() CASCADE;
DROP FUNCTION IF EXISTS prevent_duplicate_group_join() CASCADE;
DROP FUNCTION IF EXISTS prevent_self_friendship() CASCADE;
DROP FUNCTION IF EXISTS prevent_self_friend_request() CASCADE;
DROP FUNCTION IF EXISTS prevent_existing_friend_request() CASCADE;
DROP FUNCTION IF EXISTS check_post_interaction_access() CASCADE;
DROP FUNCTION IF EXISTS check_group_post_permission() CASCADE;
DROP FUNCTION IF EXISTS prevent_duplicate_likes() CASCADE;
DROP FUNCTION IF EXISTS check_post_content() CASCADE;

-- BR01: Profile Visibility
CREATE FUNCTION check_profile_visibility() RETURNS TRIGGER AS $
BEGIN
    IF NOT EXISTS (
        SELECT 1 FROM registered_user WHERE id_user = NEW.id_user AND is_public = TRUE
    ) AND NOT EXISTS (
        SELECT 1 FROM user_friend WHERE id_user = NEW.id_user AND id_friend = NEW.id_friend
    ) THEN
        RAISE EXCEPTION 'Cannot access private profile content without being friends';
    END IF;
    RETURN NEW;
END;
$ LANGUAGE plpgsql;

CREATE TRIGGER profile_visibility_trigger
BEFORE INSERT OR UPDATE ON user_friend
FOR EACH ROW
EXECUTE FUNCTION check_profile_visibility();

-- BR02: Group Visibility
CREATE FUNCTION check_group_visibility() RETURNS TRIGGER AS $
BEGIN
    IF NOT EXISTS (
        SELECT 1 FROM groups WHERE id_group = NEW.id_group AND is_public = TRUE
    ) AND NOT EXISTS (
        SELECT 1 FROM group_membership WHERE id_group = NEW.id_group AND id_member = NEW.id_member
    ) THEN
        RAISE EXCEPTION 'Cannot access private group without being a member';
    END IF;
    RETURN NEW;
END;
$ LANGUAGE plpgsql;

CREATE TRIGGER group_visibility_trigger
BEFORE INSERT OR UPDATE ON group_membership
FOR EACH ROW
EXECUTE FUNCTION check_group_visibility();

-- BR07: Group Join Restriction
CREATE FUNCTION prevent_duplicate_group_join() RETURNS TRIGGER AS $
BEGIN
    IF EXISTS (
        SELECT 1 FROM group_membership 
        WHERE id_group = NEW.id_group AND id_member = NEW.id_requester
    ) THEN
        RAISE EXCEPTION 'User is already a member of this group';
    END IF;
    RETURN NEW;
END;
$ LANGUAGE plpgsql;

CREATE TRIGGER no_duplicate_group_join_trigger
BEFORE INSERT ON group_join_request
FOR EACH ROW
EXECUTE FUNCTION prevent_duplicate_group_join();

-- BR08: Self-Friending Prohibition
CREATE FUNCTION prevent_self_friendship() RETURNS TRIGGER AS $
BEGIN
    IF NEW.id_user = NEW.id_friend THEN
        RAISE EXCEPTION 'A user cannot be friends with themselves';
    END IF;
    RETURN NEW;
END;
$ LANGUAGE plpgsql;

CREATE TRIGGER no_self_friendship_trigger
BEFORE INSERT OR UPDATE ON user_friend
FOR EACH ROW
EXECUTE FUNCTION prevent_self_friendship();

-- BR09: Self-Request Prohibition
CREATE FUNCTION prevent_self_friend_request() RETURNS TRIGGER AS $
BEGIN
    IF NEW.id_user = NEW.id_requester THEN
        RAISE EXCEPTION 'A user cannot send a friend request to themselves';
    END IF;
    RETURN NEW;
END;
$ LANGUAGE plpgsql;

CREATE TRIGGER no_self_friend_request_trigger
BEFORE INSERT ON user_friend_request
FOR EACH ROW
EXECUTE FUNCTION prevent_self_friend_request();

-- BR10: Existing Friend Request Prohibition
CREATE FUNCTION prevent_existing_friend_request() RETURNS TRIGGER AS $
BEGIN
    IF EXISTS (
        SELECT 1 FROM user_friend 
        WHERE (id_user = NEW.id_user AND id_friend = NEW.id_requester)
        OR (id_user = NEW.id_requester AND id_friend = NEW.id_user)
    ) THEN
        RAISE EXCEPTION 'Cannot send friend request to existing friend';
    END IF;
    RETURN NEW;
END;
$ LANGUAGE plpgsql;

CREATE TRIGGER no_existing_friend_request_trigger
BEFORE INSERT ON user_friend_request
FOR EACH ROW
EXECUTE FUNCTION prevent_existing_friend_request();


-- BR12: Post Interaction Access
CREATE FUNCTION check_post_interaction_access() RETURNS TRIGGER AS $
BEGIN
    -- Check if post creator is public
    IF EXISTS (
        SELECT 1 FROM post p
        JOIN registered_user ru ON p.id_creator = ru.id_user
        WHERE p.id_post = NEW.id_post AND ru.is_public = TRUE
    ) THEN
        RETURN NEW;
    END IF;

    -- Check if user is friend with post creator
    IF EXISTS (
        SELECT 1 FROM post p
        JOIN user_friend uf ON p.id_creator = uf.id_user
        WHERE p.id_post = NEW.id_post AND uf.id_friend = NEW.id_user
    ) THEN
        RETURN NEW;
    END IF;

    -- Check if post is in a group where user is member
    IF EXISTS (
        SELECT 1 FROM post p
        JOIN group_membership gm ON p.id_group = gm.id_group
        WHERE p.id_post = NEW.id_post AND gm.id_member = NEW.id_user
    ) THEN
        RETURN NEW;
    END IF;

    RAISE EXCEPTION 'User does not have permission to interact with this post';
END;
$ LANGUAGE plpgsql;

CREATE TRIGGER post_interaction_access_comments_trigger
BEFORE INSERT ON comments
FOR EACH ROW
EXECUTE FUNCTION check_post_interaction_access();

CREATE TRIGGER post_interaction_access_likes_trigger
BEFORE INSERT ON post_like
FOR EACH ROW
EXECUTE FUNCTION check_post_interaction_access();


-- BR13: Group Post Membership Required
CREATE FUNCTION check_group_post_permission() RETURNS TRIGGER AS $
BEGIN
    IF NOT EXISTS (
        SELECT 1 FROM group_membership
        WHERE id_group = NEW.id_group AND id_member = NEW.id_sender
    ) THEN
        RAISE EXCEPTION 'User must be a member of the group to send messages';
    END IF;
    RETURN NEW;
END;
$ LANGUAGE plpgsql;

CREATE TRIGGER group_post_permission_trigger
BEFORE INSERT ON group_message
FOR EACH ROW
EXECUTE FUNCTION check_group_post_permission();


-- BR14: Single Like Constraint
CREATE FUNCTION prevent_duplicate_likes() RETURNS TRIGGER AS $
BEGIN
    IF TG_TABLE_NAME = 'post_like' THEN
        IF EXISTS (
            SELECT 1 FROM post_like
            WHERE id_post = NEW.id_post AND id_user = NEW.id_user
        ) THEN
            RAISE EXCEPTION 'User has already liked this post';
        END IF;
    ELSIF TG_TABLE_NAME = 'comment_like' THEN
        IF EXISTS (
            SELECT 1 FROM comment_like
            WHERE id_comment = NEW.id_comment AND id_user = NEW.id_user
        ) THEN
            RAISE EXCEPTION 'User has already liked this comment';
        END IF;
    END IF;
    RETURN NEW;
END;
$ LANGUAGE plpgsql;

CREATE TRIGGER single_post_like_trigger
BEFORE INSERT ON post_like
FOR EACH ROW
EXECUTE FUNCTION prevent_duplicate_likes();

CREATE TRIGGER single_comment_like_trigger
BEFORE INSERT ON comment_like
FOR EACH ROW
EXECUTE FUNCTION prevent_duplicate_likes();

-- BR15: Post Content Requirement
CREATE FUNCTION check_post_content() RETURNS TRIGGER AS $
BEGIN
    IF NEW.description IS NULL AND NEW.image IS NULL THEN
        RAISE EXCEPTION 'Post must have either a description or an image';
    END IF;
    RETURN NEW;
END;
$ LANGUAGE plpgsql;

CREATE TRIGGER post_content_trigger
BEFORE INSERT OR UPDATE ON post
FOR EACH ROW
EXECUTE FUNCTION check_post_content();








```
<a id="sqlb"></a>
#### A.2. População do banco de dados

 ```sql
BEGIN;


INSERT INTO registered_user (username, name, email, password, biography, profile_picture, is_public) VALUES
('hvegan', 'Hugo Vegano', 'hugo@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Adepto do veganismo e do fitness. Correr é vida! 🏃‍♂️', 'img/users/hugo.png', TRUE),
('ffrioli', 'Franchesco Frioli', 'franco@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Calcio, pasta e golo! Forza Italia! 🍕', 'img/users/franco.png', TRUE),
('acoutinho', 'André Coutinho', 'andre@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Programador de dia, basquetebolista à noite. 🏀', 'img/users/andre.png', TRUE),
('admin', 'Maria Silva (Admin)', 'admin@sportsnet.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'A manter a rede a funcionar.', 'img/users/admin.png', TRUE),
('cr7', 'Cristiano Ronaldo', 'cr7@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'SIUUUU! 🐐', 'img/users/cr7.png', TRUE),
('jmarques', 'Joana Marques', 'joana@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Amante de Padel e corridas de fim-de-semana.', 'img/users/joana.png', TRUE),
('rcosta', 'Rui Costa', 'rui@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Sempre a ver futebol.', 'img/users/rui.png', FALSE);


INSERT INTO administrator (id_admin) VALUES (4);
INSERT INTO verified_user (id_verified) VALUES (5);
INSERT INTO group_owner (id_group_owner) VALUES (1), (2), (6);


INSERT INTO label (designation, image) VALUES
('Futebol', 'img/labels/futebol.png'),
('Basquetebol', 'img/labels/basket.png'),
('Corrida', 'img/labels/running.png'),
('Padel', 'img/labels/padel.png'),
('Nutrição', 'img/labels/nutri.png'),
('Equipamento', 'img/labels/equip.png'),
('Ginásio', 'img/labels/gym.png');

INSERT INTO sport (id_sport) VALUES (1), (2), (3), (4), (7);
INSERT INTO category (id_category) VALUES (5), (6);


INSERT INTO user_label (id_user, id_label) VALUES
(1, 3), (1, 5), (2, 1), (3, 2), (5, 1), (5, 7), (6, 4), (6, 3);


INSERT INTO post (id_creator, image, description, date) VALUES
(5, 'img/posts/cr7_golo.jpg', 'Dia de jogo! Foco total. ⚽️ #Futebol #CR7', NOW() - INTERVAL '2 days'),
(1, 'img/posts/hugo_run.jpg', 'Mais 10km para começar o dia. A energia vegan a funcionar! 🏃‍♂️ #running #vegan', NOW() - INTERVAL '1 day'),
(3, 'img/posts/andre_basket.jpg', 'Grande jogo ontem com a malta! 🏀 #basketamador #LBAW', NOW() - INTERVAL '10 hours'),
(2, 'img/posts/franco_pizza.jpg', 'A preparar o pre-jogo! Non c''è partita senza una buona pizza. 🍕 #italia #futebol', NOW() - INTERVAL '5 hours'),
(5, 'img/posts/cr7_gym.jpg', 'Sem dias de folga. 💪 #gym #foco', NOW() - INTERVAL '3 hours'),
(6, 'img/posts/joana_padel.jpg', 'Manhã de Padel. Quem alinha para a próxima? #padel', NOW() - INTERVAL '1 hour');


INSERT INTO user_tag (id_post, id_user) VALUES
(3, 1), (4, 5);


INSERT INTO post_like (id_post, id_user) VALUES
(1, 1), (1, 2), (1, 3), (2, 3), (2, 6), (5, 1), (6, 1);

INSERT INTO post_save (id_post, id_user) VALUES
(2, 6), (5, 3);


INSERT INTO comments (id_post, id_user, id_reply, text, date) VALUES
(1, 2, NULL, 'Grande!! Il migliore del mondo! 🇮🇹', NOW() - INTERVAL '1 day'),
(2, 3, NULL, 'Boa Hugo! Eu fico-me pelo basket 😅', NOW() - INTERVAL '10 hours'),
(2, 1, 2, 'Obrigado André! Temos de combinar um treino um dia destes.', NOW() - INTERVAL '9 hours'),
(1, 1, NULL, 'Máquina! 🔥', NOW() - INTERVAL '8 hours'),
(6, 3, NULL, 'Eu alinho Joana!', NOW() - INTERVAL '30 minutes');


INSERT INTO comment_like (id_comment, id_user) VALUES
(1, 5), (1, 1), (2, 1), (5, 6);


INSERT INTO user_friend (id_user, id_friend) VALUES
(1, 3), (3, 1), (1, 6), (6, 1), (2, 5), (5, 2);

INSERT INTO user_friend_request (id_user, id_requester) VALUES
(1, 2), (7, 3);


INSERT INTO user_block (id_user, id_blocked) VALUES
(7, 5);


INSERT INTO groups (id_owner, name, description, picture, is_public) VALUES
(1, 'Vegan Runners PT', 'Grupo para partilhar corridas e receitas vegan.', 'img/groups/group_run.png', TRUE),
(2, 'Calcio Amatori 🇮🇹', 'Só para verdadeiros fãs da Serie A.', 'img/groups/group_calcio.png', TRUE),
(6, 'Padel LBAW', 'Grupo privado da malta de Padel.', 'img/groups/group_padel.png', TRUE);


INSERT INTO group_membership (id_group, id_member) VALUES
(1, 1), (1, 6), (2, 2), (2, 5), (3, 6);

INSERT INTO group_join_request (id_group, id_requester) VALUES
(3, 3);


INSERT INTO message (text, image, date) VALUES
('Olá André, tudo bem?', NULL, NOW() - INTERVAL '1 hour'),
('Tudo! E contigo? Vi o teu post da corrida, grande forma!', NULL, NOW() - INTERVAL '55 minutes'),
('Forza! Stasera si vince! ⚽️', 'img/msg/italia_flag.png', NOW() - INTERVAL '30 minutes'),
('Onde é o jogo de Padel amanhã?', NULL, NOW() - INTERVAL '10 minutes');


INSERT INTO private_message (id_message, id_sender, id_receiver) VALUES
(1, 1, 3), (2, 3, 1);

INSERT INTO group_message (id_message, id_group, id_sender) VALUES
(3, 2, 2), (4, 3, 6);


INSERT INTO notification (id_receiver, id_emitter, text, date) VALUES
(5, 1, 'Hugo Vegano gostou do seu post.', NOW() - INTERVAL '2 days'),
(1, 3, 'André Coutinho comentou o seu post.', NOW() - INTERVAL '10 hours'),
(3, 1, 'Hugo Vegano gostou do seu comentário.', NOW() - INTERVAL '9 hours'),
(1, 2, 'Franchesco Frioli enviou-lhe um pedido de amizade.', NOW() - INTERVAL '1 day'),
(3, 1, 'Hugo Vegano enviou-lhe uma mensagem.', NOW() - INTERVAL '1 hour'),
(5, 2, 'Nova mensagem no grupo ''Calcio Amatori 🇮🇹''.', NOW() - INTERVAL '30 minutes'),
(6, 3, 'André Coutinho quer juntar-se ao grupo ''Padel LBAW''.', NOW() - INTERVAL '5 minutes');


INSERT INTO like_post_notification (id_notification, id_post) VALUES (1, 1);
INSERT INTO comment_notification (id_notification, id_comment) VALUES (2, 2);
INSERT INTO like_comment_notification (id_notification, id_comment) VALUES (3, 2);
INSERT INTO friend_request_notification (id_notification, accepted) VALUES (4, NULL);
INSERT INTO private_message_notification (id_notification, id_message) VALUES (5, 1);
INSERT INTO group_message_notification (id_notification, id_message) VALUES (6, 3);
INSERT INTO join_group_request_notification (id_notification, id_group, accepted) VALUES (7, 3, NULL);


INSERT INTO report (description) VALUES
('Este comentário é spam e ofensivo.'),
('Este post é fake news sobre nutrição.');


INSERT INTO report_comment (id_report, id_comment) VALUES (1, 1);
INSERT INTO report_post (id_report, id_post) VALUES (2, 2);


COMMIT;
```



---

<a id="eap"></a>
## EAP: Especificação de Arquitetura e Protótipo

<a id="a7"></a>
### A7: Especificação de recursos da Web

Este artefato documenta e descreve a arquitetura e API web que será desenvolvida para o sistema PlayNation, indicando o catálogo de recursos, bem como as respectivas propriedades, e o formato das respostas JSON.

<a id="a71"></a>
#### 1. Visão geral

|  Módulos | Descrição |     
| ----------------------------- | --- | 
| **M01: Autenticação e Usuários** | Recursos da Web dedicados à autenticação de usuários, abrangendo os principais recursos do sistema, como: login e logout, registro de usuários e recuperação de senha, além de visualizar e editar informações do usuário e dar suporte às interações do usuário. |
| **M02: Administração** | Recursos da Web associados ao controle administrativo, incluindo a aplicação de regras da comunidade, moderação de usuários (bloqueio, desbloqueio e banimento), moderação de conteúdo (remoção de postagens, comentários ou grupos) e gerenciamento do conteúdo de páginas informativas estáticas. |
| **M03: Postagens** | Recursos da Web dedicados ao tratamento de postagens de usuários, incluindo operações de criação, leitura, edição e exclusão. |
| **M04: Pesquisa** | Recursos web associados a todas as funcionalidades de pesquisa (correspondência exata ou pesquisa de texto completo), permitindo aos utilizadores localizar e aceder a utilizadores, grupos, posts e comentários específicos. |
| **M05: Comentários** | Recursos da Web associados a interações de comentários, como criação, visualização, edição e exclusão de comentários. |
| **M06: Grupos** | Recursos web dedicados ao gerenciamento de grupos de usuários, fornecendo os recursos necessários para criação, modificação e exclusão de grupos, além de apoiar as interações entre os membros de um grupo. |


<a id="a72"></a>
#### 2. Permissões

|  Identificador |  Nome |  Descrição |
| ----------------------------- | --- | ---- |
| **VIS** | Visitante | Usuários sem qualquer autenticação ou privilégios específicos. |
| **AUTO** | Usuário autenticado | Um usuário que efetuou login com sucesso no sistema. |
| **PRÓPRIO** | Proprietário | Um usuário autenticado que é o criador ou proprietário designado de um conteúdo específico (perfil, postagem, comentário ou grupo). |
| **GRM** | Membro do Grupo | Um usuário autenticado que é membro de um grupo específico. |
| **ADM** | Administrador | Administrador do sistema PlayNation. |

<a id="a73"></a>
#### 3. Especificação OpenAPI

O arquivo de especificação PlayNation OpenAPI está disponível [aqui](https://github.com/TM-1-3/PlayNation/blob/main/docs/a7_openapi.yaml).

```yaml
openapi: 3.0.0

info:
 version: '1.0'
 title: 'LBAW PlayNation Web API'
 description: 'Web Resources Specification (A7) for PlayNation'

servers:
- url: http://lbaw.fe.up.pt
  description: Production server

externalDocs:
 description: Find more info here.
 url: https://gitlab.up.pt/lbaw/lbaw2526/lbaw2551/-/wikis/eap
 

tags:
 - name: 'M01: Authentication and Users'
 - name: 'M02: Administration'
 - name: 'M03: Posts'
 - name: 'M04: Search'
 - name: 'M05: Comments'
 - name: 'M06: Groups'
 
paths:

############################################ AUTHENTICATION AND USERS ############################################

######### LOGIN #########
  /login:

    get:
      operationId: R101
      summary: 'R101: Login Form'
      description: 'Present Login Form. Access: VST'
      tags:
        - 'M01: Authentication and Users'

      responses:
        '200':
          description: 'OK. Show Login Form'

    post:
      operationId: R102
      summary: 'R102: Login Action'
      description: 'Present Login Information. Access: VST'
      tags:
        - 'M01: Authentication and Users'

      requestBody:
        required: true
        content:
          application/x-www-form-urllencoded:
            schema:
              properties:
                username:
                  type: string
                email:
                  type: string
                  format: email
                password:
                  type: string
                  format: password
              required:
                  - password
              oneOf:
                    - required: [username]
                    - required: [email]

      responses:
       '302':
         description: 'Redirect after processing the login credentials.'
         headers:
           Location:
             schema:
               type: string
             examples:
               302Success:
                 description: 'Successful authentication. Redirect to timeline.'
                 value: '/home'
               302Error:
                 description: 'Failed authentication. Redirect to login form.'
                 value: '/login'


######### LOGOUT #########

  /logout:

    post:
      operationId: R103
      summary: 'R103 : Logout Operation'
      description: 'Logout the current logged user. Access: AUTH, ADM, OWN, GRM'
      tags:
        - 'M01: Authentication and Users'

      responses:
        '302':
          description: 'Redirect after processing logout.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Successful logout. Redirect to public timeline.'
                  value: '/home'


######### REGISTER #########

  /register:

   get:
     operationId: R104
     summary: 'R104: Register Form'
     description: 'Provide new user registration form. Access: VST'
     tags:
       - 'M01: Authentication and Users'
     responses:
       '200':
         description: 'Ok. Show Sign-Up UI'

   post:
     operationId: R105
     summary: 'R105: Register Operation'
     description: 'Processes the new user registration information. Access: VST'
     tags:
       - 'M01: Authentication and Users'

     requestBody:
       required: true
       content:
         application/x-www-form-urlencoded:
           schema:
             type: object
             properties:
               username:
                 type: string
               name:
                 type: string
               password:
                 type: string
                 format: password
               email:
                 type: string
                 format: email
               picture:
                 type: string
                 format: binary
               description:
                 type: string
               labels:
                 type: array
                 items:
                  type: string
               is_public:
                 type: boolean
             required:
                - name
                - username
                - email
                - password

     responses:
       '302':
         description: 'Redirect after processing the new user information.'
         headers:
           Location:
             schema:
               type: string
             examples:
               302Success:
                 description: 'Account created. Redirect to profile setup.'
                 value: '/profile/setup'
               302Failure:
                 description: 'Failed authentication. Redirect to login form.'
                 value: '/login'


######### RECOVER PASSWORD #########
  
  /recoverPassword:

    post:
      operationId: R106
      summary: 'R106 : Recover Password Operation'
      description: 'Changes the current password after receiving the validation code. Access: VST'
      tags:
        - 'M01: Authentication and Users'
      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                code:
                  type: string
                password:
                  type: string
                  format: password
                verify_password:
                  type: string
                  format: password
              required:
                - code
                - password
                - verify_password;
      responses:
        '200':
          description: 'Success. Your password has been changed successfully.'
        '404':
          description: 'Error. Wrong code.'

######### SEND EMAIL #########

  /sendEmail:

    post:
      operationId: R107
      summary: 'R107 : Send Email Operation'
      description: 'Sends an email with a validation code. Access: VST'
      tags:
        - 'M01: Authentication and Users'
      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                email:
                  type: string 
                  format: email
              required:
                - email
               
      responses:
        '200':
          description: 'Success. A validation code was sent to your email.'
        '404':
          description: 'Error. Email not existant.'
      
######### TIMELINE #########

  /home:

    get:
      operationId: R108
      summary: 'R108: View timeline.'
      description: 'Show the timeline, Access: AUTH'
      parameters:
        - in: query
          name: feed
          schema:
            type: string
            enum: [public, personalized]
            default: public
          description: 'Type of timeline.'
      tags:
        - 'M01: Authentication and Users'
      responses:
        '200':
          description: 'OK. Show the timeline.'
        '302':
          description: 'Redirect after unauthorized request. User is not logged in'
          headers:
            Location:
              schema:
                type: string
              example:
                  302Success:
                    description: 'You need to login first. Redirect to login page.'
                    value: '/login'

######### USER PROFILE #########

  /profile/{id}:

    get:
      operationId: R109
      summary: 'R109: View User Profile Page'
      description: 'Show the profile for an user, Access: AUTH, VST'
      tags:
        - 'M01: Authentication and Users'

      parameters:
        - in: path
          name: id
          schema:
            type: integer
          required: True

      responses:
        '200':
          description: 'OK. Show the profile page for an user'



######### EDIT PROFILE #########

  /profile/{id}/edit:

    get:
      operationId: R110
      summary: 'R110: Edit user profile page.'
      description: 'Shows the page for edittin the profile of the user. Access: OWN'
      tags:
        - 'M01: Authentication and Users'
      responses:
        '200':
          description: 'Ok. Show edit profile UI.'
        '401':
          description: 'Unauthorized. You do not have the permission to edit this profile.'
          headers:
            Location:
              schema:
                type: string
              examples:
                401Success:
                  description: 'Unauthorized. Redirect to user profile.'
                  value: '/user/{id}'
    
    put:
      operationId: R111
      summary: 'R111: Edit user profile operation'
      description: 'Processes and saves the alterations made by user. Access: OWN'
      tags:
        - 'M01: Authentication and Users'

      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                name:
                  type: string
                username:
                  type: string
                email:
                  type: string
                  format: email
                description:
                  type: string
                password:
                  type: string
                  format: password
                confirm_password:
                  type: string
                  format: password
                image:
                  type: string
                  format: binary
                is_public:
                  type: boolean
                labels:
                  type: array
                  items:
                    type: string
              required:
              - name
              - username
              - email
              - password
              - is_public

      responses:
        '302':
          description: 'Redirect after processing the changes to the user information.'
          headers:
            Location:
              schema:
                type: string
              example:
                302Success:
                  description: 'Successful update. Redirect to user profile page.'
                  value: '/user/{id}'
                302Failure:
                  description: 'Failed update. Redirect to edit profile page.'
                  value: '/user/{id}/edit'

######### PROFILE DELETE #########

  /user/delete/{id}:

    delete:
      operationId: R112
      summary: 'R112: Deletes an user account.'
      description: 'Deletes an user while in the profile page. Access: OWN, ADM'
      tags:
        - 'M01: Authentication and Users'

      parameters:
        - in: path
          name: id
          schema:
            type: integer
          required: true

      responses:
        '302':
          description: 'Redirect after deleting user information.'
          headers:
            Location:
              schema:
                type: string
              example:
                302Success:
                  description: 'Successful account deletion. Redirect to public timeline.'
                  value: '/'
        '403':
          description: 'Forbiden action.'

######### BEFRIEND #########

  /user/befriend:

    post:
      operationId: R113
      summary: 'R113: Is friend with another user.'
      description: 'Is friend with another user. Access: AUTH'
      tags:
        - 'M01: Authentication and Users'

      requestBody:
          required: true
          content:
            application/x-www-form-urlencoded:
              schema:
                type: object
                properties:
                  id:
                    type: integer
                required:
                  - id

      responses:
        '200':
          description: 'Ok. You are now friends with a user.'
        '403':
          description: 'Forbiden action.'

######### DEFRIEND #########

  /user/defriend:

    post:
      operationId: R114
      summary: 'R114: Ends friendship with another user.'
      description: 'Ends friendship with another user. Access: AUTH'
      tags:
        - 'M01: Authentication and Users'

      requestBody:
          required: true
          content:
            application/x-www-form-urlencoded:
              schema:
                type: object
                properties:
                  id:
                    type: integer
                required:
                  - id

      responses:
        '200':
          description: 'Ok. You defriended a user.'
        '403':
          description: 'Forbiden action.'

######### SEND FRIEND REQUEST #########

  /user/{id}/sendFriendRequest:
    post:
      operationId: R115
      summary: 'R115: Sends a friend request to another user.'
      description: 'Sends a notification with a friend request to another user. Access: AUTH'
      tags:
        - 'M01: Authentication and Users'

      requestBody:
          required: true
          content:
            application/x-www-form-urlencoded:
              schema:
                type: object
                properties:
                  id:
                    type: integer
                required:
                  - id

      responses:
        '200':
          description: 'Ok. You sent a friend request to a user.'
        '403':
          description: 'Forbiden action.'

######### CANCEL FRIEND REQUEST #########

  /user/{id}/cancelFriendRequest:

    post:
      operationId: R116
      summary: 'R116: Cancels a previously made friend request to another user.'
      description: 'Removes the notification of the friend request to other user. Access: AUTH'
      tags:
        - 'M01: Authentication and Users'

      requestBody:
          required: true
          content:
            application/x-www-form-urlencoded:
              schema:
                type: object
                properties:
                  id:
                    type: integer
                required:
                  - id

      responses:
        '200':
          description: 'Ok. You  successfully canceled the friend request.'
        '403':
          description: 'Forbiden action.'

######### ACCEPT FRIEND REQUEST #########

  /notifications/notification/acceptFriendRequest:

    post:
      operationId: R117
      summary: 'R117: Accept a friend request.'
      description: 'Accepts a friend request from another user. Access: AUTH'
      tags:
        - 'M01: Authentication and Users'

      requestBody:
          required: true
          content:
            application/x-www-form-urlencoded:
              schema:
                type: object
                properties:
                  id:
                    type: integer
                required:
                  - id

      responses:
        '200':
          description: 'Ok. You successfully accepted a friend request.'
        '403':
          description: 'Forbiden action.'

######### REJECT FRIEND REQUEST #########

  /notifications/notification/rejectFriendRequest:

    post:
      operationId: R118
      summary: 'R118: Reject a friend request.'
      description: 'Rejects a friend request sent by another user. Access: AUTH'
      tags:
        - 'M01: Authentication and Users'

      requestBody:
          required: true
          content:
            application/x-www-form-urlencoded:
              schema:
                type: object
                properties:
                  id:
                    type: integer
                required:
                  - id

      responses:
        '200':
          description: 'Ok. You rejected a friend request.'
        '403':
          description: 'Forbiden action.'

######### BLOCK USER #########

  /user/{id}/block:

    post:
      operationId: R119
      summary: 'R119: Blocks another user.'
      description: 'Blocks another user. Access: AUTH'
      tags:
        - 'M01: Authentication and Users'

      requestBody:
          required: true
          content:
            application/x-www-form-urlencoded:
              schema:
                type: object
                properties:
                  id:
                    type: integer
                required:
                  - id

      responses:
        '200':
          description: 'Ok. You successfully blocked a user.'
        '403':
          description: 'Forbiden action.'

######### FRIENDS PAGE #########

  /friends:

    get:
      operationId: R120
      summary: 'R120: User friends page.'
      description: 'Show user friends. Access: AUTH, ADM'
      tags:
        - 'M01: Authentication and Users'

      responses:
        '200':
          description: 'OK. Show the user friends page.'
        '302':
          description: 'Redirect if user is not logged in'
          headers:
            Location:
              schema:
                type: string
              example:
                302Failure:
                  description: 'Failure. User not logged in.'
                  value: '/login'

######### NOTIFICATIONS PAGE #########

  /notifications:

    get:
      operationId: R121
      summary: 'R121: User notifications page.'
      description: 'Show received user notifications page. Access: AUTH, ADM'
      tags:
        - 'M01: Authentication and Users'

      responses:
        '200':
          description: 'OK. Show the user notifications page.'
        '302':
          description: 'Redirect if user is not logged in'
          headers:
            Location:
              schema:
                type: string
              example:
                302Failure:
                  description: 'Failure. User not logged in.'
                  value: '/login'

######### MARK NOTIFICATION AS READ #########

  /notifications/notification/read:

    post:
      operationId: R122
      summary: 'R122: Marks notification as read.'
      description: 'Marks notification as read. Access: AUTH'
      tags:
        - 'M01: Authentication and Users'

      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                id:
                  type: integer
              required:
                - id

      responses:
        '200':
          description: 'Ok. Notification successfully marked as read.'
        '403':
          description: 'Forbiden action.'

######### DIRECT MESSAGES PAGE #########

  /messages:

    get:
      operationId: R123
      summary: 'R2123: User private conversations page.'
      description: 'Show user private conversations page. Access: AUTH, ADM'
      tags:
        - 'M01: Authentication and Users'
      responses:
        '200':
          description: 'OK. Show the user chats page.'
        '302':
          description: 'Redirect if user is not logged in'
          headers:
            Location:
              schema:
                type: string
              example:
                302Failure:
                  description: 'Failure. User not logged in.'
                  value: '/login'

######### CONVERSATION #########

  /messages/conversation/{id}:

    get:
      operationId: R124
      summary: 'R124: Show conversation with a user.'
      description: 'Shows the private conversion established with another user. Access: AUTH, ADM'
      tags:
        - 'M01: Authentication and Users'

      parameters:
        - in: path
          name: id
          schema:
            type: integer
          required: True

      responses:
        '200':
          description: 'OK. Show the conversation for an individual user'
        '302':
          description: 'Redirect if user is not logged in or other user doesnt exists'
          headers:
            Location:
              schema:
                type: string
              example:
                302Failure:
                  description: 'Failure.'

######### MESSAGE CREATE #########

  /messages/conversation/create:

    post:
      operationId: R125
      summary: 'R125: Sends a new message to a user.'
      description: 'Sends a new message to a user. Access: AUTH'
      tags:
        - 'M01: Authentication and Users'

      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                id:
                  type: integer
                content:
                  type: string
                media:
                  type: string
                  format: binary
              required:
                - id

      responses:
        '302':
          description: 'Redirect after processing the new message sent.'
          headers:
            Location:
              schema:
                type: string
              example:
                302Success:
                  description: 'Successful creation of message.'
                302Failure:
                  description: 'Error.'  


################## USERNAME VERIFY ####################

  /api/usernameVerify:

    get:
      operationId: R126
      summary: 'R126 : Verify username existance'
      description: 'Verify if username exists. Access: AUTH'
      tags:
        - 'M01: Authentication and Users'

      parameters:
        - in: query
          name: username
          description: 'Username account field'
          schema:
            type: string
          required: true

      responses:
        '200':
          description: 'Success. Returns the id of a correspondent username'
        '403':
          description: 'Forbiden action. You need to be logged in first'
    

################## EMAIL VERIFY ####################

  /api/emailVerify:

    get:
      operationId: R127
      summary: 'R127 : Verify the exitance of an account associated with the email'
      description: 'Verify if there is an account associated with the same email. Access: AUTH'
      tags:
        - 'M01: Authentication and Users'

      parameters:
        - in: query
          name: email
          description: 'Email account field'
          schema:
            type: string
            format: email
          required: true

      responses:
        '200':
          description: 'Success. Returns the id of a correspondent email'
        '403':
          description: 'Forbiden action. You need to be logged in first'


################## NOTIFICATIONS ####################

  /api/notifications:

    get:
      operationId: R128
      summary: 'R128 : Notifications'
      description: 'Get user notifications. Access: AUTH'
      tags:
        - 'M01: Authentication and Users'
      parameters:
        - in: query
          name: id
          description: 'User ID'
          schema:
            type: integer
          required: true
      responses:
        '200':
          description: 'Success. Returns a list of the user notifications'
        '403':
          description: 'Forbiden action. You need to be logged in first'


################## MESSAGES ####################

  /api/messages:

    get:
      operationId: R129
      summary: 'R129 : Private messages'
      description: 'Get new private messages with certain user. Access: AUTH'
      tags:
        - 'M01: Authentication and Users'
      parameters:
        - in: query
          name: id
          description: 'User ID'
          schema:
            type: integer
          required: true
      responses:
        '200':
          description: 'Success. Returns a list of new received messages'
        '403':
          description: 'Forbiden action. You need to be logged in first'

################## FRIENDS ####################

  /api/friends:

    get:
      operationId: R130
      summary: 'R130 : Private messages'
      description: 'Get the account who are friends with a certain user. Access: AUTH'
      tags:
        - 'M01: Authentication and Users'
      parameters:
        - in: query
          name: id
          description: 'User ID'
          schema:
            type: integer
          required: true
      responses:
        '200':
          description: 'Success. Returns a list of friends'
        '403':
          description: 'Forbiden action'
      
######### SETUP #########

  /profile/setup:

    get:
      operationId: R131
      summary: 'R131: Profile Setup Form'
      description: 'Show the profile setup wizard (Bio, Picture, Labels). Access: AUTH (Partial)'
      tags:
        - 'M01: Authentication and Users'
      responses:
        '200':
          description: 'OK. Show Setup UI.'

    post:
      operationId: R132
      summary: 'R132: Complete Profile Setup'
      description: 'Saves bio, picture, and selected interest labels. Access: AUTH (Partial)'
      tags:
        - 'M01: Authentication and Users'
      requestBody:
        required: true
        content:
          multipart/form-data:
            schema:
              type: object
              properties:
                biography:
                  type: string
                profile_picture:
                  type: string
                  format: binary
                is_public:
                  type: string 
                'labels[]':
                  type: array
                  items:
                    type: integer
      responses:
        '302':
          description: 'Setup complete. Redirect to Home.'
          headers:
            Location:
              schema:
                type: string
              example: '/home'


############################################ ADMINISTRATION ############################################

######### ADMIN PAGE #########

  /admin:
      get:
        operationId: R201
        summary: 'R201: Admin Page'
        description: 'Show Admin Page. Access: ADM'
        tags:
          - 'M02: Administration'

        responses:
          '200':
            description: 'OK. Show admin page UI'
          '403':
            description: 'This action is forbidden.'

######### USER BLOCK #########

  /admin/block:

    post:
      operationId: R202
      summary: 'R202: User Block'
      description: 'Block user. Access: ADM'
      tags:
        - 'M02: Administration'

      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              properties:
                user_id:
                  type: integer
              required:
                  - user_id
      responses:
        '302':
          description: 'Redirect back to admin panel after action.'
          headers:
            Location:
              schema:
                type: string
              example:
                value: '/admin'
        '403':
          description: 'This action is forbidden.'

######### USER UNBLOCK #########

  /admin/unblock:

    post:
      operationId: R203
      summary: 'R203: User Unblock'
      description: 'Unblock user. Access: ADM'
      tags:
        - 'M02: Administration'

      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              properties:
                user_id:
                  type: integer
              required:
                  - user_id
      responses:
        '302':
          description: 'Redirect back to admin panel after action.'
          headers:
            Location:
              schema:
                type: string
              example:
                value: '/admin'
        '403':
          description: 'This action is forbidden.'

######### ADMIN CREATE USER #########

  /admin/create:

    get:
      operationId: R204
      summary: 'R204: Admin Create User Form'
      description: 'Provide administrator with user creation form . Access: ADM'
      tags:
        - 'M02: Administration'
      responses:
        '200':
          description: 'OK. Show create user form.'
        '403':
          description: 'You do not have permission.'

    post:
      operationId: R205
      summary: 'R205: Admin Create User Action'
      description: 'Process the creation of a new user. Access: ADM'
      tags:
        - 'M02: Administration'
      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                username:
                  type: string
                name:
                  type: string
                email:
                  type: string
                  format: email
                password:
                  type: string
                  format: password
                is_admin:
                  type: boolean
                  description: 'Optional field to set the new user as admin.'
              required:
                - username
                - name
                - email
                - password
      responses:
        '302':
          description: 'Redirect after successful creation.'
          headers:
            Location:
              schema:
                type: string
              example:
                value: '/admin'
        '403':
          description: 'Forbidden.'

######### ADMIN EDIT USER #########

  /admin/edit/{id}:

    get:
      operationId: R206
      summary: 'R206: Admin Edit User Form'
      description: 'Provide administratot with edit user form. Access: ADM'
      tags:
        - 'M02: Administration'
      parameters:
        - in: path
          name: id
          schema:
            type: integer
          required: true
      responses:
        '200':
          description: 'OK. Show edit user form.'
        '403':
          description: 'Forbidden.'
        '404':
          description: 'User not found.'

  /admin/user/{id}:

    put:
      operationId: R207
      summary: 'R207: Admin Edit User'
      description: 'Update user details. Access: ADM'
      tags:
        - 'M02: Administration'
      parameters:
        - in: path
          name: id
          schema:
            type: integer
          required: true
      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                username:
                  type: string
                name:
                  type: string
                email:
                  type: string
                  format: email
                password:
                  type: string
                  format: password
              required:
                - username
                - name
                - email
      responses:
        '302':
          description: 'Successful update.'
          headers:
            Location:
              schema:
                type: string
              example:
                value: '/admin'
        '403':
          description: 'Forbidden.'


############################################ POSTS ############################################

######### POST #########

  /post/{id}:
    get:
      operationId: R301 
      summary: 'R301: View Post Page'
      description: 'Shows a single post page, including its comments and likes. Access: AUTH, VST'
      tags:
        - 'M03: Posts'

      parameters:
        - in: path
          name: id
          schema:
            type: integer
          required: True  
          
      responses:
        '200':
          description: 'OK. Show Post UI.'
        '404':
          description: 'Post not found.'

######### POST CREATE #########

  /post/create:
  
    get:
      operationId: R306
      summary: 'R306: Create Post Form'
      description: 'Show the form to create a new post. Access: AUTH'
      tags:
        - 'M03: Posts'
      responses:
        '200':
          description: 'OK. Show Create Post UI.'
        '403':
          description: 'Forbidden. User not logged in.'
    post:
      operationId: R302
      summary: 'R302: Create Post'
      description: 'Creates a new post. Access: AUTH'
      tags:
        - 'M03: Posts' 

      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                caption:
                  type: string
                  description: 'Post caption'
                media:
                  type: string
                  format: binary
                  description: 'media file (photo/video etc.)'
                is_public:
                  type: boolean

      responses:
        '302':
          description: 'Redirect after creating the new post.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Success, redirect to the new post.'
                  value: '/post/{id}'
                302Failure:
                  description: 'Failed. Redirect back to timeline.'
                  value: '/privateTimeline'  

######### POST EDIT ######### 

  /post/{id}/edit:
    post:
      operationId: R303
      summary: 'R303: Edit Post Operation'
      description: 'Edits an existing post. Access: OWN'
      tags:
        - 'M03: Posts'

      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                id:
                  type: integer
                  description: 'ID of the post to edit'
                caption:
                  type: string
                  description: 'The content of the new caption for the post'
              required:
                - id
                - caption

      responses:
        '200': 
          description: 'Ok. Post edited successfully.'
        '403':
          description: 'Forbidden action.'
        '404':
          description: 'Post not found.'

######### POST DELETE ######### 

  /post/delete/{id}:
    delete:
      operationId: R304
      summary: 'R304: Delete Post'
      description: 'Deletes a specific post. Access: OWN, ADM'
      tags:
        - 'M03: Posts'
      parameters:
        - in: path
          name: id
          schema:
            type: integer
          required: true
      responses:
        '200':
          description: 'Post deleted successfully.'
          content:
            application/json:
              schema:
                type: object
                properties:
                  success:
                    type: boolean
                  message:
                    type: string
        '403':
          description: 'Unauthorized.'
        '500':
          description: 'Internal Server Error.'

  /post/like:
    post:
      operationId: R305
      summary: 'R305: Like Post Operation'
      description: 'Likes/unlikes a post. Access: AUTH'
      tags:
        - 'M03: Posts'

      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                id:
                  type: integer
                  description: 'ID of the post to like'
              required:
                - id

      responses:
        '200':
          description: 'Ok. Like/Unlike successful.'
        '401':
          description: 'Not authenticated.'
        '404':
          description: 'Post not found.'

############################################ SEARCH ############################################

######### SEARCH USER #########  

  /api/user:

    get:
      operationId: R401
      summary: 'R401: Search User'
      description: 'Searches for users and returns the results as JSON. Access: VIS'
      tags:
        - 'M04: Search'

      parameters:
      - in: query
        name: content
        description: String to search for
        schema: 
          type: string
        required: true

      responses:
        '200':
          description: Success
          content:
            application/json:
              schema:
                type: array
                items:
                  type: object
                  properties: 
                    id_user: 
                      type: string
                    username: 
                      type: string
                    name: 
                      type: string
                    biography: 
                      type: string
                    profile_picture: 
                      type: string
                example:
                  - id_user: 1
                    username: Gamer87
                    name: Marco Rossi
                    biography: Huge fan of the local basketball league. Always ready to debate stats and predictions!
                    profile_picture: /images/profiles/101.jpg

######### SEARCH POST #########

  /api/post:

    get:
      operationId: R402
      summary: 'R402: Search Post'
      description: 'Searches for posts and returns the results as JSON. Access: VIS'
      tags:
        - 'M04: Search'

      parameters:
      - in: query
        name: content
        description: String to search for
        schema: 
          type: string
        required: true

      responses:
        '200':
          description: Success
          content:
            application/json:
              schema:
                type: array
                items:
                  type: object
                  properties: 
                    id_post: 
                      type: string
                    id_creator: 
                      type: string
                    image: 
                      type: string
                    description: 
                      type: string
                    date: 
                      type: string
                example:
                  - id_post: 55
                    id_creator: 105
                    image: /images/posts/55_photo.png
                    description: What a game! My team came back from two goals down in the second half. Incredible energy today!
                    date: 2025-10-20 14:30:00

######### SEARCH COMMENT #########

  /api/comment:

    get:
      operationId: R403
      summary: 'R403: Search Comment'
      description: 'Searches for comments and returns the results as JSON. Access: VIS'
      tags:
        - 'M04: Search'

      parameters:
      - in: query
        name: content
        description: String to search for
        schema: 
          type: string
        required: true

      responses:
        '200':
          description: Success
          content:
            application/json:
              schema:
                type: array
                items:
                  type: object
                  properties: 
                    id_comment: 
                      type: string
                    id_post: 
                      type: string
                    id_user: 
                      type: string
                    id_reply: 
                      type: string
                    text:
                      type: string
                    date: 
                      type: string
                example:
                  - id_comment: 201
                    id_post: 55
                    id_user: 88
                    id_reply: 
                    text: Absolutely deserved! That striker's goal in the 85th minute was pure class.
                    date: 2025-10-20 14:45:00
                  - id_comment: 202
                    id_post: 56
                    id_user: 105
                    id_reply: 201
                    text: Congrats! What shoes do you use for long distance?
                    date: 2025-10-20 20:01:00

######### SEARCH GROUPS #########

  /api/group:

    get:
      operationId: R404
      summary: 'R404: Search Group'
      description: 'Searches for groups and returns the results as JSON. Access: VIS'
      tags:
        - 'M04: Search'

      parameters:
      - in: query
        name: content
        description: String to search for
        schema: 
          type: string
        required: true

      responses:
        '200':
          description: Success
          content:
            application/json:
              schema:
                type: array
                items:
                  type: object
                  properties: 
                    id_group: 
                      type: string
                    id_owner: 
                      type: string
                    name: 
                      type: string
                    description: 
                      type: string
                    picture:
                      type: string
                example:
                  - id_group: 12
                    id_owner: 10
                    name: Sport Enthusiasts Portugal
                    description: Official group for discussing weekly games.
                    picture: /images/groups/strategy_icon.jpg


############################################ COMMENTS ############################################

######### CREATE COMMENT #########

  /comment/create:
    post:
      operationId: R501
      summary: 'R501: Create Comment Operation'
      description: 'Creates a new comment on a post. Access: AUTH'
      tags:
        - 'M05: Comments'

      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                post_id:
                  type: integer
                  description: 'ID of the post being commented'
                content:
                  type: string
                  description: 'The content of the comment'
              required:
              -   post_id
                - content

      responses:
        '302': 
          description: 'Redirect after creating the comment.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Success. Redirect back to the post.'
                  value: '/post/{id}'
                302Failure:
                  description: 'Failed. Redirect back.'

######### EDIT COMMENT #########

  /comment/edit:
    post:
      operationId: R502
      summary: 'R502: Edit Comment Operation'
      description: 'Edits an existing comment. Access: OWN'
      tags:
        - 'M05: Comments'

      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                id: 
                  type: integer
                  description: 'ID of the comment to edit'
                content:
                  type: string
                  description: 'The new comment text'
              required:
                - id
                - content

      responses:
        '200': 
          description: 'Ok. Comment edited successfully.'
        '403':
          description: 'Forbidden action.'
        '404':
          description: 'Comment not found.'

######### DELETE COMMENT #########

  /comment/delete/{id}:
    delete:
      operationId: R503
      summary: 'R503: Delete Comment Operation'
      description: 'Deletes a comment. Access: OWN, ADM'
      tags:
        - 'M05: Comments'

      parameters:
        - in: path
          name: id
          schema:
            type: integer
          required: true
                
      responses:
        '200': 
          description: 'Ok. Comment deleted successfully.'
        '403':
          description: 'Forbidden action.'
        '404':
          description: 'Comment not found.'

######### LIKE COMMENT #########

  /comment/like:
    post:
      operationId: R504
      summary: 'R504: Like Comment Operation'
      description: 'Likes/unlikes a comment. Access: AUTH'
      tags:
        - 'M05: Comments'

      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                id: 
                  type: integer
                  description: 'ID of the comment to like'
              required:
                - id

      responses:
        '200':
          description: 'Ok. Like/Unlike successful.'
        '401':
          description: 'Not authenticated.'
        '404':
          description: 'Comment not found.'
      
############################################ GROUPS ############################################

######### GROUP PAGE #########  

  /group/{id}:
    get:
      operationId: R601
      summary: 'R601: View Group Page'
      description: 'Show the page for a singular group, Access: AUTH, VST, OWN, GRM, ADM'
      tags:
        - 'M06: Groups'
      parameters:
        - in: path
          name: id
          schema:
            type: integer
          required: true
      responses:
        '200':
          description: 'Success. Show Group Page'
        '302':
          description: 'Redirect if user is not logged in, if user is not a group menber of that group or if group doesnt exists'
          headers:
            Location:
              schema:
                type: string
              example:
                  302Failure:
                    description: 'Failure'

######### GROUPS PAGE #########

  /groups:

    get:
      operationId: R602
      summary: 'R602: View Groups Page'
      description: 'Show the page with all groups, Access: AUTH, OWN, GRM, ADM'
      tags:
        - 'M06: Groups'

      responses:
        '200':
          description: 'Success. Show Groups Page'
        '302':
          description: 'Redirect if user is not logged in'
          headers:
            Location:
              schema:
                type: string
              example:
                  302Failure:
                    description: 'User not logged in. Redirect to login page.'
                    value: '/login'

######### EDIT GROUP PAGE #########

  /group/{id}/edit:

    get:
      operationId: R603
      summary: 'R603: Edit Group Page'
      description: 'Show the page for editing a group, Access: OWN'
      tags:
        - 'M06: Groups'

      parameters:
        - in: query
          name: id
          description: 'Group ID'
          schema:
            type: integer
          required: True

      responses:
        '200':
          description: 'Success. Show Edit Group Page'
        '401':
          description: 'Unauthorized. You do not have permission to edit this group.'
          headers:
            Location:
              schema:
                type: string
              examples:
                401Success:
                  description: 'Unauthorized. Redirect to group page.'
                  value: '/group/{id}'

######### EDIT GROUP #########

  /group/edit:

    post:
      operationId: R604
      summary: 'R604: Edit Group Operation'
      description: 'Saves the alterations made to a group by its owner. Access: OWN'
      tags:
        - 'M06: Groups'

      requestBody:
        required: true
        content:
          multipart/form-data:
            schema:
              type: object
              properties:
                name:
                  type: string
                description:
                  type: string
                picture:
                  type: string
                  format: binary
                is_public:
                  type: boolean

      responses:
        '302':
          description: 'Redirect to group page after processing the alterations.'
          headers:
            Location:
              schema:
                type: string
              example:
                302Success:
                  description: 'Updated successfully. Redirect to group page.'
                  value: '/group/{id}'
                302Failure:
                  description: 'Failed to update. Redirect to edit group page.'
                  value: '/group/{id}/edit'

######### CREATE GROUP #########

  /group/create:

    post:
      operationId: R605
      summary: 'R605: Create Group Operation'
      description: 'Creates a new group. Access: AUTH'
      tags:
        - 'M06: Groups'

      requestBody:
        required: true
        content:
          multipart/form-data:
            schema:
              type: object
              properties:
                name:
                  type: string
                description:
                  type: string
                picture:
                  type: string
                  format: binary
                is_public:
                  type: boolean

      responses:
        '302':
          description: 'Redirect to the new groups group page after creating it.'
          headers:
            Location:
              schema:
                type: string
              example:
                302Success:
                  description: 'Created successfully. Redirect to group page.'
                  value: '/group/{id}'
                302Failure:
                  description: 'Failed to create. Redirect to groups page.'
                  value: '/groups'

######### JOIN GROUP #########

  /group/join:

    post:
      operationId: R606
      summary: 'R606: Join Group'
      description: 'Joins a public group. Access: AUTH'
      tags:
        - 'M06: Groups'

      requestBody:
          required: true
          content:
            application/x-www-form-urlencoded:
              schema:
                type: object
                properties:
                  group_id:
                    type: integer
                  user_id: 
                    type: integer
                required:
                  - user_id
                  - group_id

      responses:
        '200':
          description: 'Group joined successfully.'
        '401':
          description: 'Unauthorized. You cannot join this group.'

######### LEAVE GROUP #########

  /group/leave:

    post:
      operationId: R607
      summary: 'R607: Leave Group'
      description: 'Leaves a group. Access: AUTH, GRM, OWN'
      tags:
        - 'M06: Groups'

      requestBody:
          required: true
          content:
            application/x-www-form-urlencoded:
              schema:
                type: object
                properties:
                  group_id:
                    type: integer
                  user_id: 
                    type: integer
                required:
                  - user_id
                  - group_id

      responses:
        '200':
          description: 'Group left successfully.'
        '401':
          description: 'Unauthorized. You cannot leave this group.'

######### DELETE GROUP #########

  /group/delete/{id}:

    delete:
      operationId: R608
      summary: 'R608: Delete Group Operation'
      description: 'Deletes a group. Access: OWN, ADM'
      tags:
        - 'M06: Groups'

      parameters:
        - in: path
          name: id
          schema:
            type: integer
          required: true

      responses:
        '302':
          description: 'Redirect to groups page after deleting the group.'
          headers:
            Location:
              schema:
                type: string
              example:
                302Success:
                  description: 'Deleted successfully. Redirect to groups page.'
                  value: '/groups'
        '401':
          description: 'Unauthorized. You cannot delete this group.'

######### JOIN GROUP REQUEST #########

  /group/sendJoinRequest:

    post:
      operationId: R609
      summary: 'R609: Join Group Request'
      description: 'Sends a join request to a private group. Access: AUTH'
      tags:
        - 'M06: Groups'

      requestBody:
          required: true
          content:
            application/x-www-form-urlencoded:
              schema:
                type: object
                properties:
                  group_id:
                    type: integer
                  user_id: 
                    type: integer
                required:
                  - user_id
                  - group_id

      responses:
        '200':
          description: 'Join request sent successfully.'
        '401':
          description: 'Unauthorized. You cannot send a request to join this group.'

######### CANCEL JOIN GROUP REQUEST #########

  /group/cancelJoinRequest:

    post:
      operationId: R610
      summary: 'R610: Cancel Join Group Request'
      description: 'Cancels a previously sent join request to a private group. Access: AUTH'
      tags:
        - 'M06: Groups'

      requestBody:
          required: true
          content:
            application/x-www-form-urlencoded:
              schema:
                type: object
                properties:
                  group_id:
                    type: integer
                  user_id: 
                    type: integer
                required:
                  - user_id
                  - group_id

      responses:
        '200':
          description: 'Join request canceled successfully.'
        '401':
          description: 'Unauthorized. You cannot cancel this request.'

######### ACCEPT JOIN GROUP REQUEST #########

  /group/acceptJoinRequest:

    post:
      operationId: R611
      summary: 'R611: Accept Join Group Request'
      description: 'Accepts a join request from a user to a private group. Access: OWN'
      tags:
        - 'M06: Groups'

      requestBody:
          required: true
          content:
            application/x-www-form-urlencoded:
              schema:
                type: object
                properties:
                  group_id:
                    type: integer
                  user_id: 
                    type: integer
                required:
                  - user_id
                  - group_id

      responses:
        '200':
          description: 'Join request accepted successfully.'
        '401':
          description: 'Unauthorized. You cannot accept this request.'

######### REJECT JOIN GROUP REQUEST #########

  /group/rejectJoinRequest:

    post:
      operationId: R612
      summary: 'R612: Reject Join Group Request'
      description: 'Rejects a join request from a user to a private group. Access: OWN'
      tags:
        - 'M06: Groups'

      requestBody:
          required: true
          content:
            application/x-www-form-urlencoded:
              schema:
                type: object
                properties:
                  group_id:
                    type: integer
                  user_id: 
                    type: integer
                required:
                  - user_id
                  - group_id

      responses:
        '200':
          description: 'Join request rejected successfully.'
        '401':
          description: 'Unauthorized. You cannot reject this request.'

######### REMOVE GROUP MEMBER #########

  /group/removeMember:

    post:
      operationId: R613
      summary: 'R613: Remove Group Member Operation'
      description: 'Removes a member from the group. Access: OWN'
      tags:
        - 'M06: Groups'

      requestBody:
          required: true
          content:
            application/x-www-form-urlencoded:
              schema:
                type: object
                properties:
                  group_id:
                    type: integer
                  user_id: 
                    type: integer
                required:
                  - user_id
                  - group_id

      responses:
        '200':
          description: 'Group member removed successfully.'
        '401':
          description: 'Unauthorized. You cannot remove this group member.'

######### INVITE TO GROUP #########

  /group/invite:

    post:
      operationId: R614
      summary: 'R614: Invite to Group'
      description: 'Invites a user to join the group. Access: OWN'
      tags:
        - 'M06: Groups'

      requestBody:
          required: true
          content:
            application/x-www-form-urlencoded:
              schema:
                type: object
                properties:
                  group_id:
                    type: integer
                  user_id: 
                    type: integer
                required:
                  - user_id
                  - group_id

      responses:
        '200':
          description: 'User invited to group successfully.'
        '401':
          description: 'Unauthorized. You cannot invite this user to the group.'

######### CANCEL INVITE TO GROUP #########

  /group/cancelInvite:

    post:
      operationId: R615
      summary: 'R615: Cancel Invite to Group'
      description: 'Cancels a previously sent invitation to a user to join the group. Access: OWN'
      tags:
        - 'M06: Groups'

      requestBody:
          required: true
          content:
            application/x-www-form-urlencoded:
              schema:
                type: object
                properties:
                  group_id:
                    type: integer
                  user_id: 
                    type: integer
                required:
                  - user_id
                  - group_id

      responses:
        '200':
          description: 'Group invitation canceled successfully.'
        '401':
          description: 'Unauthorized. You cannot cancel this invitation.'

######### ACCEPT INVITE TO GROUP #########

  /group/acceptInvite:

    post:
      operationId: R616
      summary: 'R616: Accept Invite to Group'
      description: 'Accepts an invitation to join the group. Access: AUTH'
      tags:
        - 'M06: Groups'

      requestBody:
          required: true
          content:
            application/x-www-form-urlencoded:
              schema:
                type: object
                properties:
                  group_id:
                    type: integer
                  user_id: 
                    type: integer
                required:
                  - user_id
                  - group_id

      responses:
        '200':
          description: 'Group invitation accepted successfully.'
        '401':
          description: 'Unauthorized. You cannot accept this invitation.'

######### REJECT INVITE TO GROUP #########

  /group/rejectInvite:

    post:
      operationId: R617
      summary: 'R617: Reject Invite to Group'
      description: 'Rejects an invitation to join the group. Access: AUTH'
      tags:
        - 'M06: Groups'

      requestBody:
          required: true
          content:
            application/x-www-form-urlencoded:
              schema:
                type: object
                properties:
                  group_id:
                    type: integer
                  user_id: 
                    type: integer
                required:
                  - user_id
                  - group_id

      responses:
        '200':
          description: 'Group invitation rejected successfully.'
        '401':
          description: 'Unauthorized. You cannot reject this invitation.'
```

---

<a id="a8"></a>
### A8: Protótipo vertical

O protótipo vertical da rede social PlayNation inclui a implementação de funcionalidades de alta prioridade e histórias de usuários consideradas necessárias para apresentar e validar a arquitetura do sistema, bem como aumentar a familiaridade dos membros do grupo com o framework e as tecnologias utilizadas no desenvolvimento. As funcionalidades apresentadas neste protótipo incluem funcionalidades de autenticação, como login, cadastro e logout, busca, funcionalidades de acesso (visitante, autenticado, admin), timelines e posts.

<a id="a81"></a>
#### 1. Recursos implementados

<a id="a81.1"></a>
##### 1.1. Histórias de usuários implementadas 

| Referência da história do usuário | Nome | Prioridade | Responsável | Descrição |
| -------------------- | --------- | ----------- | ------------------ | ----------------------------------------------------- |
| US01 | Linha do tempo pública | Alto | Tomás Morais | Como usuário, quero acessar uma linha do tempo que exiba conteúdo público popular de todos os usuários para que eu possa me manter atualizado com as postagens mais populares. |
| US03 | Pesquisar conta | Alto | Gabriela Mattos | Como usuário, desejo pesquisar contas para poder visualizar diretamente seu conteúdo, se estiver acessível para mim. |
| US04 | Ver postagem | Alto | Carolina Ferreira | Como usuário, quero visualizar uma postagem, se estiver acessível para mim, para poder compreender completamente seu conteúdo, contexto e qualquer informação associada. |
| US08 | Pesquisa de correspondência exata | Alto | Gabriela Mattos | Como Usuário quero pesquisar o nome exato do conteúdo desejado, para que apenas esse apareça. |
| US09 | Pesquisa de texto completo | Alto | Gabriela Mattos | Como usuário, desejo pesquisar usando texto para que todo o conteúdo relacionado a ele apareça nos resultados. |
| EUA15 | Inscreva-se | Alto | Tomás Morais | Como Usuário Não Autenticado desejo criar uma conta para que, quando logado, possa acessar todas as funcionalidades de um usuário Autenticado. |
| EUA16 | Login | Alto | Tomás Morais | Como usuário não autenticado, quero fazer login em uma conta existente para poder experimentar a rede social como usuário autenticado.|
| EUA18 | Acesso somente para visitantes | Alto | Tomás Morais | Como Usuário Não Autenticado quero poder acessar a rede social sem registro para poder acessar apenas as funcionalidades de um usuário não Autenticado.|
| EUA21 | Visibilidade do perfil | Alto | João Marques | Como Usuário Autenticado quero tornar meu perfil público ou privado para que apenas meus amigos possam acessar seu conteúdo. |
| EUA22 | Sair | Alto | Tomás Morais | Como usuário autenticado, desejo editar meu perfil para poder alterar suas informações, visibilidade e detalhes conforme necessário e mantê-lo atualizado. |
| EUA25 | Editar perfil | Alto | João Marques | Como Usuário Autenticado quero tornar meu perfil público ou privado para que apenas meus amigos possam acessar seu conteúdo. |
| EUA26 | Linha do tempo personalizada | Alto | Carolina Ferreira | Como usuário autenticado, quero acessar uma linha do tempo personalizada que mostre postagens de contas das quais sou amigo e conteúdos relacionados aos meus interesses para que eu possa interagir com o que é mais relevante para mim.|
| EUA27 | Criar postagem | Alto | Carolina Ferreira | Como usuário autenticado, quero poder adicionar uma legenda à minha postagem para poder complementá-la com texto descritivo ou contexto. |
| EUA29 | Editar postagem | Alto | Carolina Ferreira | Como usuário autenticado, quero editar minhas próprias postagens para poder atualizar ou refinar seu conteúdo para que outros usuários vejam. |
| US30 | Excluir postagem | Alto | Carolina Ferreira | Como usuário autenticado, desejo excluir minhas próprias publicações para que sejam removidas permanentemente da rede social e não fiquem mais visíveis para outros usuários. |
| EUA88 | Administrar contas de usuário | Alto | Gabriela de Mattos | Como administrador, quero poder visualizar, editar, excluir e criar uma conta de usuário. |

<div align="center">

Tabela 77: Tabela de histórias de usuários implementadas
</div>


<a id="a81.2"></a>
##### 1.2. Recursos da Web implementados

A seção a seguir identifica os recursos da web implementados no protótipo.  

###### Módulo M01: Autenticação e Usuários

| Referência de recursos da Web | URL |
| ---------------------- | ------------------------------ |
| R101: Formulário de login | OBTER /login |
| R102: Ação de login | POSTAR /login |
| R103: Operação de logout | POSTAR/sair |
| R104: Formulário de Registro | OBTER /registrar |
| R105: Operação de registro | POSTAR /registrar |
| R108: Ver linha do tempo | OBTER /casa |
| R109: Ver página de perfil do usuário | OBTER /perfil/{id} |
| R110: Editar página de perfil do usuário | OBTER /perfil/{id}/editar | 
| R111: Editar operação de perfil de usuário | COLOQUE /perfil/{id}/editar | 
| R131: Formulário de configuração de perfil | OBTER /perfil/configuração |
| R132: Configuração completa do perfil | POST /perfil/configuração |

<div align="center">

Tabela 78: Recursos Web Implementados da Tabela do Módulo MO1
</div>


###### Módulo M02: Administração

| Referência de recursos da Web | URL |
| ---------------------- | ------------------------------ |
| R201: Página de administração | OBTER /admin |
| R204: Formulário de criação de usuário do administrador | GET /admin/criar |
| R205: Ação de criação de usuário do administrador | POSTAR /admin/criar |
| R206: Formulário de usuário para edição de administrador | OBTER /admin/editar/{id} |
| R207: Usuário de edição de administrador | PUT /admin/usuário/{id} |
| R208: Usuário de pesquisa de administrador | OBTER /admin/usuário |
| R209: Administrador excluir usuário | POST /admin/usuário/{id} |

<div align="center">

Tabela 79: Recursos Web Implementados da Tabela do Módulo MO2
</div>

###### Módulo M03: Postagens

| Referência de recursos da Web | URL |
| ---------------------- | ------------------------------ | 
| R302: Criar postagem | POSTAR /postar/criar |
| R304: Excluir postagem | DELETE /post/delete/{id} |
| R304: Editar postagem | POST /post/{id}/editar |

<div align="center">

Tabela 80: Recursos Web Implementados da Tabela do Módulo MO3
</div>

###### Módulo M04: Pesquisa

| Referência de recursos da Web | URL |
| ---------------------- | ------------------------------ | 
| R401: Pesquisar usuário | GET /api/usuário |
| R402: Postagem de pesquisa | GET /api/post |

<div align="center">

Tabela 81: Recursos Web Implementados da Tabela do Módulo MO4
</div>

<a id="a82"></a>
#### 2. Protótipo

Comando para iniciar a imagem Docker

```docker
docker pull gitlab.up.pt:5050/lbaw/lbaw2526/lbaw2551
docker run -d --name lbaw2551 -p 8001:80 gitlab.up.pt:5050/lbaw/lbaw2526/lbaw2551
```
<a id="a83"></a>
#### 3. Credenciais para teste

**Usuário Regular** e-mail: hugo@email.com; senha: senha

E-mail do **administrador**: admin@sportsnet.com; senha: senha




---

<a id="pa"></a>
## PA: Produto e Apresentação

<a id="a9"></a>
### A9: Produto

O sistema PlayNation consiste em uma rede social baseada na web desenvolvida com o propósito de conectar pessoas que compartilham a paixão pelo esporte. O produto final consiste em uma aplicação web desenvolvida em PHP, mais especificamente o framework Laravel, para gerenciar operações de backend, como roteamento, cache e armazenamento de arquivos, HTML e CSS para criar páginas web bem estruturadas e visualmente apelativas, AJAX para tornar o sistema mais intuitivo e dinâmico, e PostgreSQL para criar e gerenciar o banco de dados que armazenou todos os dados do produto.

<a id="a91"></a>
#### 1. Instalação

Comando para iniciar a imagem Docker

```docker
docker pull gitlab.up.pt:5050/lbaw/lbaw2526/lbaw2551
docker run -d --name lbaw2551 -p 8001:80 gitlab.up.pt:5050/lbaw/lbaw2526/lbaw2551
```

<a id="a92"></a>
#### 2. Uso

<a id="a92.1"></a>
##### 2.1. Credenciais de administração

| Tipo | Nome de usuário | E-mail | Senha |
| -------- | -------- |-------- | -------- |
| administrador | administrador | admin@sportsnet.com | senha |

<div align="center">

Tabela 82: Tabela de credenciais de administrador
</div>

<a id="a92.2"></a>
##### 2.2. Credenciais do usuário

| Tipo | Nome de usuário | E-mail | Senha |
| ------------- | --------- | -------- | -------- |
| usuário regular | vegano | hugo@email.com | senha |

<div align="center">

Tabela 83: Tabela de credenciais de usuário regular
</div>

<a id="a93"></a>
#### 3. Ajuda do aplicativo

Como parte das principais funcionalidades da aplicação, foram também implementadas funcionalidades relacionadas com a Ajuda desenvolvidas com o objetivo de auxiliar o utilizador na navegação e utilização do sistema. 

As duas mais notáveis ​​são as páginas “Sobre” e FAQ. A primeira apresenta a rede social PlayNation, mais especificamente suas principais funcionalidades, garante ao usuário que o sistema é seguro, inclusivo e otimizado, e apresenta a equipe de desenvolvimento. 

<div align="center">
<img width="940" height="856" alt="image" src="https://github.com/user-attachments/assets/2c5c7d5f-2224-408a-ba77-dd3c0cad5efe" />


Figura 4: Captura de tela da página "Sobre"
</div>

A página FAQ, como o nome indica, fornece respostas para dúvidas que os usuários possam ter sobre o sistema e suas funcionalidades, como as diferenças entre contas privadas e públicas, como funcionam os grupos e conteúdos proibidos. No final da página é disponibilizado o contato eletrônico da equipe de desenvolvimento para que os usuários relatem problemas técnicos com o aplicativo ou ofereçam sugestões. O conteúdo desta página está corretamente agrupado e separado por assunto, para facilitar ao usuário a busca e localização de uma dúvida específica. 

<div align="center">
<img width="940" height="941" alt="image" src="https://github.com/user-attachments/assets/c332508a-30de-4008-b406-866f99cec716" />


Figura 5: Captura de tela da página "Perguntas frequentes"
</div>

Além dessas duas páginas, é fornecida ajuda contextual dentro da interface do aplicativo, orientando o usuário na ação desejada. Os dois exemplos mais notáveis ​​da presença deste tipo de assistência dentro do sistema são os placeholders nas entradas do formulário, que especificam claramente quais informações o usuário deve escrever dentro dele, e as mensagens que aparecem quando o usuário passa o mouse sobre um elemento específico da interface, que indicam especificamente sua finalidade e o que acontece se o usuário interagir com ele. Um exemplo para cada um desses recursos de ajuda é mostrado nas capturas de tela a seguir.

<div align="center">
<img width="1105" height="620" alt="image" src="https://github.com/user-attachments/assets/a2c59814-1510-4256-96b2-9b5ff84633a6" />


Figura 6: Espaços reservados dentro das entradas do formulário de Login
</div>
<br>
<div align="center">
<img width="391" height="80" alt="image" src="https://github.com/user-attachments/assets/e9b4e5fb-e7de-46d0-829f-b73106ecc8d9" />


Figura 7: Mensagem instantânea especificando a finalidade da mensagem "Esqueceu a senha?" hiperlink
</div>

Mensagens de feedback também estão presentes quando o usuário realiza uma operação com retorno bem-sucedido, resultando em uma mensagem de "sucesso" ou em uma mensagem de erro se a operação falhar (por exemplo, tentando fazer login com as credenciais erradas). 

<div align="center">
<img width="523" height="83" alt="image" src="https://github.com/user-attachments/assets/cdf02fd9-df25-4b80-a195-c816865c5dcc" />


Figura 8: Mensagem de sucesso indicando que a conversão de um usuário regular para um verificado foi bem-sucedida
</div>
<br>
<div align="center">
![Captura_de_ecrã_de_2025-12-20_19-08-59](uploads/d4de0defbc299fba0a8f3822636376b1/Captura_de_ecrã_de_2025-12-20_19-08-59.png){largura=281 altura=258}

Mensagem de erro indicando que as credenciais digitadas pelo usuário não correspondiam a nenhuma no banco de dados
</div>

Estando ciente da ocorrência de erros de clique, ou mudança repentina de opinião por parte do usuário, para operações específicas que resultem em mais significativas, como excluí-las, antes de serem efetivamente executadas, uma janela pop up aparecerá na tela solicitando a confirmação do usuário. Desta forma, um clique errado em um elemento relacionado a essas operações não é crítico e garante-se que o usuário realmente deseja realizar aquela ação específica, resultando em uma melhor experiência de usuário.

<div align="center">
<img width="275" height="251" alt="image" src="https://github.com/user-attachments/assets/33458112-2985-45d1-b300-e6a8b6d5288f" />


Figura 9: Painel de confirmação que aparece quando o usuário clica no BOTÃO “Excluir Post”
</div>


<a id="a94"></a>
#### 4. Validação de input

A validação de input do usuário é realizada tanto no lado do cliente quanto no lado do servidor, de forma a garantir a consistência dos dados fornecidos, bem como a segurança de todo o sistema.

Em relação à validação do lado do servidor, a utilização do objeto "Illuminate\Http\Request" do Laravel concede acesso à função "validate", que permite a definição de regras de validação rigorosas para todas as solicitações HTTP recebidas. Os mecanismos utilizados para conseguir isso foram regras de validação, como "obrigatório", "único", "mínimo" e "máximo", aplicação de tipo, verificação de banco de dados e validação de arquivo (restringindo tipos e tamanhos de arquivo para uploads).

Um exemplo é o registro de conta no RegisterController, que utilizando o método "validate", especifica requisitos para garantir que os dados inseridos pelo usuário sejam válidos antes de criar a conta, como o e-mail ser único, o nome não estar vazio e a senha ter no mínimo 8 caracteres.

```php
$validatedData = $request->validate([
            'name' => 'required|string|max:250',
            'username' => 'required|string|max:250|unique:registered_user',
            'email' => 'required|email|max:250|unique:registered_user',
            'password' => 'required|min:8|confirmed'
        ]);
```
A validação do lado do cliente fornece feedback ao usuário quando ele tenta inserir dados incorretos. Voltando ao exemplo anterior, se tentar definir uma senha com menos de 8 caracteres, aparece uma mensagem indicando o formato correto, conforme mostrado na imagem abaixo.

<div align="center">
<img width="1097" height="497" alt="image" src="https://github.com/user-attachments/assets/b991d5eb-0c3f-4ca1-b87c-398356de91d0" />


Figura 10: Mensagem indicando que a senha deve ter, no mínimo, 8 caracteres
</div>

<a id="a95"></a>
#### 5. Verifique a acessibilidade e usabilidade

Os resultados dos testes de acessibilidade e usabilidade estão presentes nas listas de verificação abaixo.

Acessibilidade: [acessibilidade.pdf](https://github.com/TM-1-3/PlayNation/blob/main/docs/acessibility.pdf)

Usabilidade: [usabilidade.pdf](https://github.com/TM-1-3/PlayNation/blob/main/docs/usability.pdf) 

<a id="a96"></a>
#### 6. Validação de HTML e CSS

Os relatórios de validação de HTML e CSS estão listados abaixo.
  
HTML: [htmlValidação.pdf](https://github.com/TM-1-3/PlayNation/blob/main/docs/htmlValidation.pdf)

CSS: [cssValidação.pdf](https://github.com/TM-1-3/PlayNation/blob/main/docs/cssValidation.pdf)  

Nota: Os erros e avisos que aparecem no relatório de validação HTML referem-se à sintaxe do Blade, devido ao fato de que a ferramenta foi projetada para HTML puro.

<a id="a97"></a>
#### 7. Revisões do Projeto

Nesta secção são listadas as alterações que foram realizadas desde a especificação inicial do projeto, nas diversas componentes do projeto, de forma a alcançar com sucesso o produto final.

##### A2: Atores e histórias de usuários

* Nome US50 alterado de "Notificação de aceitação de solicitação de amizade" para "Notificação de resultado de solicitação de amizade";
* A propriedade de algumas histórias de usuários mudou; o proprietário final de cada história de usuário pode ser visto na seção 8.2 abaixo, conforme o nome em negrito.

##### EBD: Especificação de banco de dados

* Adicionada tabela **password_reset_tokens**;
* **profile_visibility_trigger** removido da tabela **user_friend**;
* Adicionada tabela **admin_block**.

##### A7: Especificação de recursos da Web

Para corresponder à implementação e às rotas de navegação na web especificadas no arquivo **web.php**, as seguintes alterações foram feitas no arquivo **a7_openapi.yaml**.

- Modificado **/recoverPasswrd**;
- Excluído **/sendEmail**;
- Adicionado **/resetPassword/{token}**;
- Adicionado **/resetPassword**;
- **/user/delete/{id}** renomeado para **/profile/{id}**;
- Modificado **/profile/{id}/edit**;
- Lógica PUT movida para **/profile/{id}**;
- **/amigos** renomeado para **/perfil/{id}/amigos**;
- **/user/defriend** renomeado para **/friend/remove/{id}**;
- Renomeado **/user/{id}/block**;
- **/post/create** (POST) renomeado para **/post**;
- Renomeado **/post/{id}/edit** (POST) para **/post/{id}** (PUT);
- **/post/delete/{id}** renomeado para **/post/{id}** (DELETE);
- Modificado **/post/like**;
- Modificado **/comment/create**;
- Modificado **/comentário/editar**;
- Modificado **/comment/delete/{id}**;
- Modificado **/comentar/curtir**;
- **/group/create** (POST) renomeado para **/groups**;
- Renomeado **/group/edit** (POST) para **/groups/{id}** (PUT);
- **/group/delete/{id}** renomeado para **/groups/{id}** (DELETE);
- Modificado **/group/join** para **/groups/{id}/join**;
- Modificado **/group/leave** para **/groups/{id}/leave**;
- Modificado **/group/cancelJoinRequest** (POST) para **/groups/{id}/request** (DELETE);
- Modificado **/group/acceptJoinRequest** para **/groups/{group}/accept/{user}**;
- Modificado **/group/rejectJoinRequest** (POST) para **/groups/{group}/reject/{user}** (DELETE);
- Modificado **/group/removeMember** (POST) para **/groups/{id}/members/{user}** (DELETE);
- Modificado **/group/invite** para **/groups/{id}/invite**;
- Modificado **/group/acceptInvite** para **/groups/{id}/accept-invite**;
- Modificado **/group/rejectInvite** (POST) para **/groups/{id}/reject-invite** (DELETE);
- **/admin/block** e **/admin/unblock** substituídos por **/admin/user/{id}/ban** e **/admin/user/{id}/unban**;
- Adicionado \*\*/admin/user/{id}/verify (POST);
- Adicionado **/admin/users/{id}/unverify** (DELETE);
- Adicionado **/admin/user/{id}** (DELETE);
- Adicionado **/admin/post/{id}** (DELETE);
- Adicionado **/admin/comment/{id}** (DELETE);
- Adicionado **/admin/group/{id}** (DELETE);
- Adicionado **/admin/{type}/{id}/dismiss**;
- Modificado **/messages/conversation/{id}**;
- Modificado **/messages/conversation/create**.

<a id="a98"></a>
#### 8. Detalhes de implementação

<a id="a98.1"></a>
##### 8.1. Bibliotecas usadas

As seguintes bibliotecas e frameworks externos foram utilizados para o desenvolvimento da rede social PlayNation:

###### Laravel

**Referência:** https://laravel.com/

**Descrição de Utilização:** Este framework PHP para desenvolvimento de aplicações web foi utilizado como base para o backend do sistema, pois trata de diversas operações como roteamento, intercações de banco de dados, sessões e cache. Além disso, o padrão MVC que segue cria um código muito bem estruturado.

**Exemplo:** [LoginController.php](https://gitlab.up.pt/lbaw/lbaw2526/lbaw2551/-/blob/main/app/Http/Controllers/Auth/LoginController.php?ref_type=heads) (Laravel lida com a lógica de autenticação)

###### CSS do vento favorável

**Referência:** https://tailwindcss.com/

**Descrição de Utilização:** Este framework CSS foi utilizado para estilizar rapidamente as páginas web desenvolvidas e desenvolver UI, ao mesmo tempo em que criava um design responsivo e consistente, como a barra lateral de navegação presente em toda a aplicação. 

**Exemplo:** [home.blade.php](https://gitlab.up.pt/lbaw/lbaw2526/lbaw2551/-/blob/main/resources/views/pages/home.blade.php?ref_type=heads) (presença de classes diretamente na marcação HTML, como *flex* ou *fa-solid*)

###### Armadilha postal

**Referência:** https://mailtrap.io/

**Descrição do uso:** Este serviço de sandbox de e-mail foi usado para inspecionar e depurar e-mails enviados do ambiente de desenvolvimento sem enviar para um endereço de e-mail real e foi configurado para capturar e-mails de recuperação de senha.

**Exemplo:** [ResetPasswordController.php](https://gitlab.up.pt/lbaw/lbaw2526/lbaw2551/-/blob/main/app/Http/Controllers/Auth/RecoverPasswordController.php?ref_type=heads) (aciona o processo de envio de e-mail)

A conta Mailtrap onde o Sandbox usado está presente possui as seguintes credenciais:

**E-mail:** up202304692@g.uporto.pt
**Senha:** Fahrenheit_451

###### Fonte incrível

**Referência:** https://fontawesome.com/

**Descrição de uso:** Este kit de ferramentas de ícones foi utilizado para a inclusão de ícones UI a fim de melhorar o visual das páginas web desenvolvidas e fornecer pistas visuais para as funcionalidades de alguns elementos, como um ícone de "lixeira" para botões de exclusão.

**Exemplo:** [app.blade.php](https://gitlab.up.pt/lbaw/lbaw2526/lbaw2551/-/blob/main/resources/views/layouts/app.blade.php?ref_type=heads) (presença de ícones em cada uma das opções da barra lateral)

###### Carbono

**Referência:** https://carbon.nesbot.com/

**Descrição do uso:** Esta extensão da API PHP permite fácil manipulação e formatação de datas e foi usada para formatar carimbos de data/hora em texto legível para o usuário.

**Exemplo:** [post.blade.php](https://gitlab.up.pt/lbaw/lbaw2526/lbaw2551/-/blob/main/resources/views/partials/post.blade.php?ref_type=heads) (inclusão do carimbo de data/hora de uma postagem)




<a id="a98.2"></a>
##### 8.2 Histórias de usuários

Esta seção inclui todas as histórias de usuários de prioridade de protótipo e produto implementadas por ordem de implementação.

| Identificador dos EUA | Nome | Módulo | Prioridade | Membros da equipe | Estado |
| ------------- | ------- | ------ | ------------------------------ | -------------------------- | ------ |
|  EUA16 | Login | M01: Autenticação e Usuários | Protótipo | **Tomás Morais** |  100% |
|  EUA15 | Inscreva-se | M01: Autenticação e Usuários | Protótipo | **Tomás Morais**, |   100% | 
|  EUA22 | Sair | M01: Autenticação e Usuários | Protótipo | **Tomás Morais** |  100% |
|  US08          | Exact Match Search | M04: Search | Prototype | **Gabriela Mattos**                 |   100%  | 
|  EUA88 | Administrar contas de usuário | M02: Administração | Protótipo | **Gabriela Mattos** |   100% | 
|  US01 | Linha do tempo pública | M01: Autenticação e Usuários | Protótipo | **Tomás Morais** |  100% |
|  EUA18 | Acesso somente para visitantes | M01: Autenticação e Usuários | Protótipo | **Tomás Morais** |  100% |
|  EUA26 | Linha do tempo personalizada | M01: Autenticação e Usuários | Protótipo | **Tomás Morais** |  100% |
|  US02 | Ver conta | M01: Autenticação e Usuários | Protótipo | **João Marques** |  100% |
|  EUA25 | Editar perfil | M01: Autenticação e Usuários | Protótipo | **Gabriela Mattos** |  100% |
|  US24          | Upload/Update Profile Picture | M01: Authentication and Users | Prototype | **Tomás Morais**, Gabriela Mattos   |  100%  |
|  US09          | Text Search | M04: Search | Prototype | **Gabriela Mattos**   |  100%  |
|  US03 | Pesquisar conta | M04: Pesquisa | Protótipo | **Gabriela Mattos** |  100% |
|  EUA05 | Pesquisar postagem | M04: Pesquisa | Protótipo | **Gabriela Mattos** |  100% |
|  US27          | Create Post | M03: Posts | Prototype | **Carolina Ferreira**   |  100%  |
|  EUA28 | Adicionar legenda à postagem | M03: Postagens | Protótipo | **Carolina Ferreira** |  100% |
|  EUA59 | Adicionar tópico à postagem | M03: Postagens | Produto | **Carolina Ferreira** |  100% |
|  US29          | Edit Post | M03: Posts | Prototype | **Carolina Ferreira**   |  100%  |
|  US30          | Delete Post | M03: Posts | Prototype | **Carolina Ferreira**   |  100%  |
|  EUA17 | Recuperar senha | M01: Autenticação e Usuários | Protótipo | **Tomás Morais** |  100% |
|  US75 | Selo de verificação | M01: Autenticação e Usuários | Protótipo | **Tomás Morais** |  100% |
|  US60 | Salvar postagens | M03: Postagens | Produto | **Gabriela Mattos** |  100% |
|  US61 | Postagens salvas gerenciadas | M03: Postagens | Produto | **Gabriela Mattos** |  100% |
|  US41 | Ver grupo | M06: Grupos | Protótipo | **João Marques** |  100% |
|  US45 | Criar grupo | M06: Grupos | Protótipo | **João Marques** |  100% |
|  EUA77 | Visibilidade do Grupo | M06: Grupos | Protótipo | **João Marques** |  100% |
|  US80          | Edit Group | M06: Groups | Prototype | **João Marques**   |  100%  |
|  EUA39 | Ver lista de amigos | M01: Autenticação e Usuários | Protótipo | **Tomás Morais** |  100% |
|  EUA37 | Enviar solicitação de amizade | M01: Autenticação e Usuários | Protótipo | **Tomás Morais** |  100% |
|  EUA47 | Notificação de solicitação de amizade | M01: Autenticação e Usuários | Protótipo | **Tomás Morais** |  100% |
|  US68          | View Notifications | M01: Authentication and Users | Product | **Gabriela Mattos**, João Marques, Tomás Morais   |  100%  |
|  EUA38 | Gerenciar solicitações de amizade recebidas | M01: Autenticação e Usuários | Protótipo | **Tomás Morais** |  100% |
|  EUA63 | Remover amigo | M01: Autenticação e Usuários | Protótipo | **Tomás Morais** |  100% |
|  EUA21 | Visibilidade do perfil | M01: Autenticação e Usuários | Protótipo | **Tomás Morais** |  100% |
|  US42 | Grupo de pesquisa | M06: Grupos | Protótipo | **João Marques** |  100% |
|  EUA66 | Adicionar usuário ao grupo | M06: Grupos | Produto | **João Marques** |  100% |
|  US43 | Sair do grupo | M06: Grupos | Protótipo | **João Marques** |  100% |
|  EUA78 | Remover usuário do grupo | M06: Grupos | Protótipo | **João Marques** |  100% |
|  EUA79 | Gerenciar solicitações de entrada em grupo | M06: Grupos | Protótipo | **João Marques** |  100% |
|  US32         | Report Post | M03: Posts | Prototype | **Gabriela Mattos**   |  100%  |
|  US44 | Postar no grupo | M06: Grupos | Protótipo | **João Marques** |  100% |
|  US65 | Ver conversas com amigos | M01: Autenticação e Usuários | Produto | **João Marques** |  100% |
|  EUA64 | Enviar mensagem para amigo | M01: Autenticação e Usuários | Produto | **João Marques** |  100% |
|  US62 | Compartilhar postagem | M03: Postagens | Produto | **João Marques** |  100% |
|  US04 | Ver postagem | M03: Postagens | Protótipo | **João Marques** |  100% |
|  US87        | Moderate Groups | M02: Administration | Prototype | **Gabriela Mattos**   |  100%  |
|  US40 | Perfil do relatório | M01: Autenticação e Usuários | Protótipo | **Gabriela Mattos** |  100% |
|  US46        | Report Group | M06: Groups | Prototype | **Gabriela Mattos**   |  100%  |
|  US10       | Filter Search | M04: Search | Prototype | **Gabriela Mattos**   |  100%  |
|  US07 | Ver curtidas na postagem | M03: Postagens | Protótipo | **Carolina Ferreira** |  100% |
|  US31       | Like Post | M03: Posts | Prototype | **Carolina Ferreira**   |  100%  |
|  EUA12 | Informações Contextuais e Dicas | M01: Autenticação e Usuários | Protótipo | **Tomás Morais** |  100% |
|  EUA13 | Mensagens de erro contextuais | M01: Autenticação e Usuários | Protótipo | **Tomás Morais** |  100% |
|  EUA58 | Lista de temas de interesse | M01: Autenticação e Usuários | Produto | **Tomás Morais** |  100% |
|  US50 | Notificação de resultado de solicitação de amizade | M01: Autenticação e Usuários | Produto | **Tomás Morais** |  100% |
|  EUA57 | Marcar notificações como lidas | M01: Autenticação e Usuários | Produto | **Tomás Morais** |  100% |
|  EUA06 | Ver comentários na postagem | M05: Comentários | Protótipo | **Carolina Ferreira** |  100% |
|  US33 | Comente na postagem | M05: Comentários | Protótipo | **Carolina Ferreira** |  100% |
|  US34 | Editar Comentário | M05: Comentários | Protótipo | **Carolina Ferreira** |  100% |
|  US35 | Excluir comentário | M05: Comentários | Protótipo | **Carolina Ferreira** |  100% |
|  US36       | Report Comment | M05: Comments | Prototype | **Gabriela Mattos**   |  100%  |
|  EUA14 | Pesquisar comentários na postagem | M04: Pesquisa | Produto | **Gabriela Mattos** |  100% |
|  US70 | Curtir Comente | M05: Comentários | Produto | **Carolina Ferreira** |  100% |
|  EUA11 | Informações do produto | M01: Autenticação e Usuários | Protótipo | **João Marques** |  100% |
|  US51 | Notificação de aceitação de adesão ao grupo | M06: Grupos | Protótipo | **Gabriela Mattos** |  100% |
|  EUA67 | Notificação de mensagem privada | M01: Autenticação e Usuários | Produto | **Gabriela Mattos** |  100% |
|  EUA52 | Notificação de postagem em grupo | M06: Grupos | Protótipo | **Gabriela Mattos** |  100% |
|  US81 | Notificação de solicitação de adesão ao grupo | M06: Grupos | Protótipo | **João Marques** |  100% |
|  US85 | Bloquear usuário | M02: Administração | Protótipo | **João Marques** |  100% |
|  EUA86 | Desbloquear usuário | M02: Administração | Protótipo | **João Marques** |  100% |
|  US84     | Ban User | M02: Administration | Prototype | **Gabriela Mattos**   |  100%  |
|  US71 | Bloquear perfil | M01: Autenticação e Usuários | Protótipo | **Gabriela Mattos** |  100% |
|  US83       | Remove Content | M02: Administration | Prototype | **Gabriela Mattos**   |  100%  |
|  US82 | Gerenciar conteúdo denunciado | M02: Administração | Protótipo | **Gabriela Mattos** |  100% |
|  EUA23 | Excluir conta | M01: Autenticação e Usuários | Protótipo | **Tomás Morais** |  100% |
|  EUA49 | Notificação de postagem de comentário | M05: Comentários | Protótipo | **Carolina Ferreira** |  100% |
|  US72 | Notificação de comentário semelhante | M05: Comentários | Inovação | **Carolina Ferreira** |  100% |
|  EUA48 | Curtir notificação de postagem | M01: Autenticação e Usuários | Protótipo | **Carolina Ferreira** |  100% |
|  EUA69 | Marcar conta na postagem | M05: Comentários | Inovação | **Carolina Ferreira** |  100% |
|  US73 | Marcado na notificação de postagem | M05: Comentários | Inovação | **Carolina Ferreira** |  100% |

<div align="center">

Tabela 84: Tabela de histórias de usuários implementadas
</div>

###### Histórias de usuários não implementadas

| Identificador dos EUA | Nome | Módulo | Prioridade | Membros da equipe | Estado |
| ------------- | ------- | ------ | ------------------------------ | -------------------------- | ------ |
|  EUA19 | Inscrição na API OAuth | M01: Autenticação e Usuários | Inovação | **Tomás Morais** |  0% |
|  EUA20 | Login da API OAuth | M01: Autenticação e Usuários | Inovação | **Tomás Morais** |  0% |
|  US74 | Notificações da API do Gmail | M01: Autenticação e Usuários | Inovação | **Gabriela Mattos** |  0% |
|  US76 | Moderação de comentários aprimorada | M05: Comentários | Inovação | **Tomás Morais** |  0% |

<div align="center">

Tabela 85: Tabela de histórias de usuários não implementadas
</div>

<a id="a10"></a>
### A10: Apresentação
 
O objetivo deste artefato é apresentar o produto da rede social PLayNation com suas principais funcionalidades e principais características.

<a id="a101"></a>
#### 1. Apresentação do produto

PlayNation é uma rede social web desenvolvida com o objetivo de conectar torcedores, atletas, clubes e pessoas que compartilham a paixão pelo esporte em geral. Esta plataforma oferece aos usuários um espaço personalizado onde podem compartilhar seus pensamentos e experiências com o esporte, na forma de postagens interativas, acompanhar seus atletas, clubes e modalidades favoritas, interagir com pessoas que pensam como você, por meio de grupos ou mensagens diretas, e, em geral, participar de uma comunidade esportiva vibrante. Os usuários poderão postar fotos e mensagens, salvar e compartilhar posts com outros usuários, interagir através de curtidas e comentários, navegar, pesquisar e seguir outras contas, reunir-se com pessoas com os mesmos interesses em grupos temáticos, ser atualizado com notificações, entre muitas outras funcionalidades. PlayNation oferece um ambiente seguro e inclusivo para seus usuários, onde eles podem especificar a privacidade de seu conteúdo, ter certeza da segurança de seus dados, usar o aplicativo em todos os tipos de dispositivos e esperar tolerância zero a conteúdo de ódio ou prejudicial.

O PlayNation foi desenvolvido utilizando Laravel, um framework PHP para aplicações web, para gerenciar operações de backend, como roteamento, cache e armazenamento de arquivos, HTML e CSS, mais especificamente o framework Tailwind, para criar páginas web bem estruturadas e visualmente apelativas, com facilidade de navegação devido à implementação de uma barra de menu lateral, que está sempre presente durante a presença do usuário no sistema, mantendo também um design adaptável a todos os tipos de dispositivos. Em relação às demais tecnologias, utilizou-se AJAX para tornar a aplicação mais intuitiva e dinâmica, permitindo a exibição de efeitos automáticos sem a necessidade do usuário consultar manualmente a página, e PostgreSQL para gerenciar o banco de dados que armazena todos os dados do sistema e do usuário de forma segura. 


