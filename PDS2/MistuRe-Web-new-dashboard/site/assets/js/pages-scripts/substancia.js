var apelidos = [];
var nomesComerciais = [];

$(document).ready(function () {
  $("#customDialog").empty();
  //--- Pegando nome do usuário logado e colocando no menu
  var user_name;
  $.get("../controller/UsuarioController.php?getUserName=1").then((data) => {
    user_name = data;
    $("#user-name").append("Olá, " + user_name);
  });

  appendParceriaPage();
  appendDashboardPage();

  $(".openSidebar").click(openSidebar);

  $(".closeSidebar").click(closeSidebar);

  $("#open-menu").click(function () {
    $(".menu").toggleClass("open");
  });

  $("#addApelido").click(function () {
    const text = $("#apelido").val();
    if (text === "") return;

    if (apelidos.find((ap) => ap === text)) {
      displayError("#headerApelido", "#apelido", "Apelido já informado!");
    } else {
      apelidos.push(text);
    }
    showCustomList(apelidos, ".apelidosList");
  });

  $("#addComercial").click(function () {
    const text = $("#comercial").val();
    if (text === "") return;

    if (nomesComerciais.find((ap) => ap === text)) {
      displayError(
        "#headerComercial",
        "#comercial",
        "Produto comercial já informado!"
      );
    } else {
      nomesComerciais.push(text);
    }
    showCustomList(nomesComerciais, ".comerciaisList");
  });

  $(".apelidosList").on("click", ".trashIcon", function () {
    const idx = $(this).closest(".customListItem").find(".index").text() - 1;
    apelidos.splice(idx, 1);
    showCustomList(apelidos, ".apelidosList");
  });

  $(".comerciaisList").on("click", ".trashIcon", function () {
    const idx = $(this).closest(".customListItem").find(".index").text() - 1;
    nomesComerciais.splice(idx, 1);
    showCustomList(nomesComerciais, ".comerciaisList");
  });

  $("#limparForm").click(limparForm);

  $(".substanciasWrapper").on("click", ".substancia", async function () {
    const id_sub = $(this).find("input[type=hidden]").val();
    const sub = subs.find((x) => x.id == id_sub);
    if (!sub) return;

    $("#hiddenSubstanciaId").val(id_sub);
    $("#principioAtivo").val(sub.principio_ativo);

    if (sub.apelidos) {
      apelidos = sub.apelidos.map((ap) => ap.descricao);
      $("#apelidosFieldset").removeClass("d-none");
    } else {
      apelidos = [];
      $("#apelidosFieldset").addClass("d-none");
    }

    if (sub.nomes_comerciais) {
      nomesComerciais = sub.nomes_comerciais.map(
        (comercial) => comercial.descricao
      );
      $("#comerciaisFieldset").removeClass("d-none");
    } else {
      nomesComerciais = [];
      $("#comerciaisFieldset").removeClass("d-none");
    }

    $("#novoApelido").addClass("d-none");
    $("#novoComercial").addClass("d-none");
    showCustomList(apelidos, ".apelidosList");
    showCustomList(nomesComerciais, ".comerciaisList");

    var radios = $("input:radio[name=classe_item]");
    radios.filter(`[value=${sub.classe.id}]`).prop("checked", true);
    $(`label:contains('${sub.classe.descricao}')`).addClass(
      "classeItemSelected"
    );

    $("#buttonsCadastrar").addClass("d-none");

    const deletePermission = await verificarPermissaoDoUsuario(
      "session",
      "excluir_substancia"
    );
    if (deletePermission.retorno) {
      $("#buttonsEditAndRemove").removeClass("d-none");
    }

    toggleDisableForm(true);
    openSidebar();
  });

  $("#excluirSubstancia").click(async function () {
    if (confirm("Deseja excluir esta substância?")) {
      let id = $("#hiddenSubstanciaId").val();

      let resultado = await excluirSubstancia(id);

      if (resultado.result) {
        showDialog("Substância excluída com sucesso!", "Sucesso!", "success");
        setTimeout(() => location.reload(), 1500);
      } else {
        showDialog(
          "Substância presente em alguma Mistura!</p>",
          "Erro ao excluir substância!",
          "error"
        );
      }
    }
  });

  //--- Evento para diferenciar label selecionado na classe da substancia
  $(".appendClasses").on("click", ".classeItem", function () {
    $(".classeItemSelected").removeClass("classeItemSelected");
    $(this).toggleClass("classeItemSelected");
  });

  //--- Função para carregar todas as substâncias restantes na página
  $(".substanciasWrapper").on("click", ".load-all-text", function () {
    //Removendo o card clicado - o que contém o texto "visualizar todas as substancias"
    $(this).closest(".load-all").remove();

    //Carregando substâncias restantes
    for (let i = 17; i < subs.length; i++) {
      //chamando função que adicionará variáveis no objeto para mostrar todas suas informações adequadamente na tela
      objeto_adaptado = adaptarObjetoSubstancia(subs[i]);

      //chamando função para dar append na div
      appendSubstancia(objeto_adaptado);
    }
  });

  //Evento de quando o form for submetido
  $("#substanciaForm").submit(function (e) {
    e.preventDefault(); // impedir que a tela seja recarregada

    //pegando valores dos campos do form
    var principio_ativo = $("#principioAtivo").val();
    var classe = $('input[name="classeItemSelected"]:checked').val();

    if (!principio_ativo) {
      displayError(
        "#headerPrincipioAtivo",
        "#principioAtivo",
        "Campo obrigatório!"
      );
      return;
    }

    if (!classe) {
      showDialog("Selecione uma classe!", "Erro!", "error");
      return;
    }

    //Criando JSON para enviar ao backend
    var json = {
      save: 1,
      principio_ativo: principio_ativo,
      apelidos: apelidos,
      nomes_comerciais: nomesComerciais,
      classe_id: classe,
    };

    $.post(
      "../controller/SubstanciaController.php",
      json,
      function (data, status, jqXHR) {
        if (status == "success") {
          var res = JSON.parse(data);
          if (res) {
            if (res.retorno == 1) {
              showDialog(
                "Substância inserida com sucesso!",
                "Sucesso!",
                "success"
              );
              setTimeout(() => location.reload(), 1500);
            } else {
              showDialog(
                "Informe pelo menos um nome comercial!",
                "Erro!",
                "error"
              );
            }
          }
        }
      }
    );
  });
}); // fim document.ready

function showDialog(text, title, type) {
  const classes =
    type === "success" ? "no-close success-dialog" : "no-close error-dialog";

  $("#customDialog").empty();
  $("#customDialog").append(`<p>${text}</p>`);
  $("#customDialog").dialog({
    title: title,
    height: 100,
    width: 350,
    modal: true,
    resizable: false,
    dialogClass: classes,
  });
}

function displayError(selector, input, msg) {
  if ($(selector).find("#error-message").length > 0) return;

  $(selector).append(`
        <span id="error-message" class="form-error">${msg}</span>
    `);
  $(selector).find("label").addClass("red");
  $(input).addClass("error-border");

  setTimeout(function () {
    $(selector).find("#error-message").remove();
    $(selector).find("label").removeClass("red");
    $(input).removeClass("error-border");
  }, 2000);
}

function showCustomList(list, listRootSelector) {
  $(listRootSelector).empty();
  if (list.length == 0) {
    $(listRootSelector).addClass("d-none");
  } else {
    $(listRootSelector).removeClass("d-none");

    list.forEach((item, index) => {
      $(listRootSelector).append(`
                <div class="customListItem">
                    <div 
                        class="index"
                        style="background-color: white; color: black; border: 1px solid rgba(0,0,0,.125);"
                    >
                        <span>${index + 1}</span>
                    </div>
                    <div class="itemContent">
                        <span>${item}</span>
                    </div>
                    <div 
                        class="cursor-pointer"
                        title="Excluir Apelido"
                    >
                        <i class="fas fa-trash-alt trashIcon" style="font-size: 20px;"></i>
                    </div>
                </div>
            `);
    });
  }
}

function limparForm() {
  $("#hiddenSubstanciaId").val(null);
  $("#principioAtivo").val(null);
  $("#apelido").val(null);
  $("#comercial").val(null);
  apelidos = [];
  nomesComerciais = [];
  showCustomList(apelidos, ".apelidosList");
  showCustomList(nomesComerciais, ".comerciaisList");

  $('input[name="classeItemSelected"]').prop("checked", false);
  $(".classeItemSelected").removeClass("classeItemSelected");

  $("#novoApelido").removeClass("d-none");
  $("#novoComercial").removeClass("d-none");
  $("#apelidosFieldset").removeClass("d-none");
  $("#comerciaisFieldset").removeClass("d-none");

  $("#buttonsEditAndRemove").addClass("d-none");
  $("#buttonsCadastrar").removeClass("d-none");
}

function openSidebar() {
  $(".sidebarCommon").addClass("sidebarOpen");
  $(".sidebarTitle").text("Cadastrar Nova Substância");
}

function closeSidebar() {
  $(".sidebarCommon").removeClass("sidebarOpen");
  $(".sidebarTitle").text("Cadastrar Nova Substância");
  toggleDisableForm(false);
  limparForm();
}

async function excluirSubstancia(sub_id) {
  let resultado = {};
  await $.ajax({
    url: "../controller/SubstanciaController.php",
    type: "DELETE",
    data: {
      deleteSub: sub_id,
    },
    success: function (data) {
      resultado = JSON.parse(data) ? JSON.parse(data) : {};
    },
  });
  return resultado;
}

async function verificarPermissaoDoUsuario(usuario, permissao) {
  let result = false;

  // se o parâmetro usuário for igual a "session", o php busca o usuário da sessão, caso contrário deve-se passar o id do usuário
  await $.get("../controller/UsuarioController.php", {
    verifyPermission: 1,
    usuario: usuario,
    permissao: permissao,
  }).then((data, response) => {
    result =
      response == "success" && JSON.parse(data) ? JSON.parse(data) : false;
  });

  return result;
}

//Esta função irá retornar um objeto substancia contendo campos adicionais que serão mostrados na interface
function adaptarObjetoSubstancia(s) {
  //ajustando string que mostrará os apelidos
  let aps = "";
  let aps_title = "";
  if (s.apelidos) {
    if (s.apelidos.length > 1) {
      //Se houver mais de 1 apelido deve reservar espaço para a parte da string '+ x apelidos'
      if (s.apelidos[0].descricao.length > 300)
        aps += s.apelidos[0].descricao.slice(0, 10) + "...";
      else aps += s.apelidos[0].descricao;

      for (let i = 0; i < s.apelidos.length; i++) {
        aps_title += s.apelidos[i].descricao + "&#010";
      }

      aps += ` <b>+${s.apelidos.length - 1}</b> Apelidos`;
      if (s.apelidos.length == 2) aps = aps.slice(0, -1);
    } else {
      //Caso seja apenas 1 apelido, o espaço reservado deve ser um pouco menor
      if (s.apelidos[0].descricao.length > 200)
        aps += s.apelidos[0].descricao.slice(0, 17) + "...";
      else aps += s.apelidos[0].descricao;

      aps_title += s.apelidos[0].descricao; //adicionando title
    }
  } else {
    aps = "Sem apelidos";
  }

  //Atribuindo ao objeto do parâmetro
  s.aps = aps;
  s.aps_title = aps_title;

  //ajustando string que mostrará os nomes comerciais
  let ncs = '<i class="fas fa-tags" style="font-size: 13px;"></i>&nbsp '; //colocando primeiro ícone - pois cada subs. deve ter no min. 1 nome comercial
  let ncs_title = "";
  if (s.nomes_comerciais) {
    //Arrumando o único nome comercial que aparecerá na tela
    if (s.nomes_comerciais[0].descricao.length > 200)
      ncs += s.nomes_comerciais[0].descricao.slice(0, 17) + "...";
    else ncs += s.nomes_comerciais[0].descricao;

    //Arrumando o título
    for (let i = 0; i < s.nomes_comerciais.length; i++) {
      ncs_title += s.nomes_comerciais[i].descricao + "&#010";
    }

    //"+x Nomes"
    if (s.nomes_comerciais.length > 1)
      ncs += `<br><i class="fas fa-tags" style="font-size: 13px;"></i>&nbsp <b>+ ${
        s.nomes_comerciais.length - 1
      } Nomes`;

    if (s.nomes_comerciais.length == 2) ncs = ncs.slice(0, -1);
    ncs += "</b>";
  }

  //Atribuindo ao objeto do parâmetro
  s.ncs = ncs;
  s.ncs_title = ncs_title;

  //classe
  if ((s.classe = {})) {
    let classe_subs = classes.find((x) => x.id == s.classe_id);
    s.classe = classe_subs; //atribuindo a classe da substancia no array buscado via ajax de substancias
  }

  return s;
}

//Função para bloquear ou desbloquear os campos do modal
function toggleDisableForm(bool) {
  //Bloqueando os inputs, botões, ícones e classes
  let inputs = $("#substanciaForm").find("input");
  let botoes = $("#substanciaForm").find(
    "button:not(.closeSidebar, #buttonsDiv button)"
  );
  let icones = $("#substanciaForm").find("i");
  let classes = $("#substanciaForm").find(".classeItem");

  inputs.prop("readonly", bool);
  botoes.prop("disabled", bool);
  icones.prop("disabled", bool);
  classes.prop("disabled", bool);

  //Colocando classe que muda o cursor
  if (bool) {
    inputs.removeClass("cursor-default");
    botoes.removeClass("cursor-pointer");
    icones.removeClass("cursor-pointer");
    classes.removeClass("cursor-pointer");

    inputs.addClass("cursor-not-allowed");
    botoes.addClass("cursor-not-allowed");
    icones.addClass("cursor-not-allowed");
    classes.addClass("cursor-not-allowed");
  } else {
    inputs.removeClass("cursor-not-allowed");
    botoes.removeClass("cursor-not-allowed");
    icones.removeClass("cursor-not-allowed");
    classes.removeClass("cursor-not-allowed");

    inputs.addClass("cursor-default");
    botoes.addClass("cursor-pointer");
    icones.addClass("cursor-pointer");
    classes.addClass("cursor-pointer");
  }
}

function appendSubstancia(substancia) {
  //Espaçamento caso o princípio ativo não ocupe duas linhas
  let pa = "";
  if (substancia.principio_ativo.length <= 17) {
    pa = "<br><br>";
  }

  $(".substanciasWrapper").append(`
            <div class="substancia ">
                <input type="hidden" value="${substancia.id}" />
                <div class="card shaddow-right cursor-pointer text-black">
                    <div class="card-header text-white" style="background-color: ${
                      substancia.classe.cor
                    };">
                        ${substancia.classe.descricao}
                    </div>
                    <div class="pd-20">
                        <h4 class="card-title textLimiter">${
                          substancia.principio_ativo
                        }</h4>
                        
                        <h6 class="card-subtitle mb-2 text-muted textLimiter" title="${
                          substancia.aps_title
                        }">${substancia.aps + pa}</h6>

                        <h6 class="card-title fz-18">Nomes Comerciais</h6>
                        <p class="card-subtitle mb-2 text-muted textLimiter" title="${
                          substancia.ncs_title
                        }">${substancia.ncs}</p>
                    </div>
                </div>
            </div>
        `);
}

//--- Setando variáveis globais que armazenarão todas as classes e todas as substâncias cadastradas
var classes;
var subs;

//- Setando valor das variáveis e carregando substâncias na tela
Promise.all([
  $.get("../controller/ClasseController.php", { fetchAll: 1 }),
  $.get("../controller/SubstanciaController.php", { fetchAll: 1 }),
])
  .then(([response1, response2]) => {
    // respostas vem na mesma ordem das requisições

    //Pegando todas as classes de substancias
    if (response1 && JSON.parse(response1)) {
      classes = JSON.parse(response1);
      $.each(classes, (idx, cla) => {
        $(".appendClasses").prepend(`
                <label for="${cla.id}" class="classeItem text-black cursor-pointer" style="background-color: ${cla.cor}">${cla.descricao}</label>
                <input type="radio" class="d-none" name="classeItemSelected" id="${cla.id}" value="${cla.id}"> 
            `);
      });
    }

    //Append das substancias
    if (response2 && JSON.parse(response2)) {
      //colocando todas as substâncias em uma variável global
      subs = JSON.parse(response2);

      //Dando o append
      $.each(subs, function (index, sub) {
        if (index == 29) {
          //Criando funcionalidade de carregar todas as substâncias
          $(".substanciasWrapper").append(`
                    <div class="substancia d-flex items-center load-all text-black border-none s${index}">
                        <div class="pd-20">
                            <h5 class="card-title cursor-pointer load-all-text" style="color: #6c757d">
                                Visualizar Todas as Substâncias&nbsp
                                <i class="fas fa-arrow-right" style="font-size: 16px;"></i>
                            </h5>
                        </div>

                    </div>
                `);

          //Parando a execução do loop
          return false;
        } else {
          //chamando função que adicionará variáveis no objeto para mostrar todas suas informações adequadamente na tela
          objeto_adaptado = adaptarObjetoSubstancia(sub);

          //chamando função para dar append na div
          appendSubstancia(objeto_adaptado);
        }
      });
    }
  })
  .catch(() => {
    // erro em qualquer uma das duas cai aqui
    console.log("*Erro ao realizar get*");
  });

async function appendParceriaPage() {
  const res1 = await verificarPermissaoDoUsuario(
    "session",
    "cadastrar_parceria"
  );
  const res2 = await verificarPermissaoDoUsuario("session", "excluir_parceria");

  if (res1.retorno || res2.retorno) {
    $("#menuAppend").append(`
        <div class="menu-item" style="margin-right: 10px;">
          <a class="link" href="./parceiro.html">
            <img src="../assets/img/handshake.svg" />
            Parceiros
          </a>
        </div>
      `);
  }
}

async function appendDashboardPage() {
  const canSeeDashboard = await verificarPermissaoDoUsuario(
    "session",
    "dashboard"
  );

  console.log({ canSeeDashboard });

  if (canSeeDashboard) {
    $("#menuAppend").append(`
      <div class="menu-item" style="margin-right: 10px;">
        <a class="link" href="./dashboard.html">
          <img src="../assets/img/dashboard.png" />
          Painel
        </a>
      </div>
    `);
  }
}
