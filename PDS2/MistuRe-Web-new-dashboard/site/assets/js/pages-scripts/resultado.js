function closeSidebar() {
  limparFormulario();
  hideAllButtons();

  toggleDisableForm("#resultado-form", false);

  $(".sidebarCommon").toggleClass("sidebarOpen");
}

function hideAllButtons() {
  [
    "#limparForm",
    "#resultadoSubmit",
    "#avaliarRejeitar",
    "#avaliarAprovar",
    "#editarResultado",
    "#salvarEdicao",
    "#cancelarEdicao",
    "#excluirResultado",
    "#pendenteResultado",
  ].forEach((btn) => {
    $(btn).hide();
  });
}

function showButtons(buttonsToShow) {
  hideAllButtons();

  buttonsToShow.forEach((btn) => {
    $(btn).show();
  });
}

async function appendDashboardPage() {
  const canSeeDashboard = await verificarPermissaoDoUsuario(
    "session",
    "dashboard"
  );

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

async function getResultadosFiltrados(filtros) {
  let resultados = [];

  await $.get(
    "../controller/ResultadoController.php",
    filtros,
    (data, response) => {
      resultados = JSON.parse(data) ? JSON.parse(data) : [];
    }
  );

  return resultados;
}

async function excluirResultado(res_id) {
  let resultado = {};
  await $.ajax({
    url: "../controller/ResultadoController.php",
    type: "DELETE",
    data: {
      deleteResult: res_id,
    },
    success: function (data) {
      resultado = JSON.parse(data) ? JSON.parse(data) : {};
    },
  });
  return { resultado };
}

async function deixarResultadoPendente(res_id) {
  let resultado = {};
  await $.ajax({
    url: "../controller/ResultadoController.php",
    type: "PUT",
    data: {
      resultadoId: res_id,
      changeStatusTo: 0,
    },
    success: function (data) {
      resultado = JSON.parse(data) ? JSON.parse(data) : {};
    },
  });
  return { resultado };
}

function toggleDisableForm(formSelector, value) {
  let inputs = $(formSelector).find("input, textarea");
  let selects = $(formSelector).find("select");

  inputs.prop("readonly", value);
  selects.prop("readonly", value);
  if (value) {
    selects.attr("tabindex", "-1");
    selects.attr("style", "pointer-events: none;");
  } else {
    selects.attr("tabindex", "");
    selects.css("pointer-events", "");
  }
}

function limparFormulario() {
  let inputs = $("#resultado-form").find("input, textarea");
  let selects = $("#resultado-form").find("select");

  inputs.val("");
  selects.val("");

  substancias_selecionadas = [];
  selectedSub = null;

  listarSubstanciasSelecionadas(substancias_selecionadas, false);

  $("#fieldsetMistura").removeClass("d-none");
  $("#subsLegend").text("Substâncias Selecionadas");

  $("#users-div").removeClass("d-flex").addClass("d-none");

  $("#avaliador-div").addClass("d-none");
}

async function avaliarResultado(status, res_id) {
  let res = {};
  await $.ajax({
    url: "../controller/ResultadoController.php",
    type: "PUT",
    data: {
      evaluateReference: res_id,
      status,
    },
    succes: function (data) {
      res = JSON.parse(data) ? JSON.parse(data) : {};
    },
  });

  return { res };
}

async function carregarResultadoNoFormulario(res) {
  $("#h-r-id").val(res.resultado.id);
  $(".sidebarTitle").text("Visualizar Resultado");
  $("#link").val(res.resultado.referencia.link);
  $("#titulo").val(res.resultado.referencia.titulo);
  $("#pais").val(res.resultado.referencia.pais);
  $("#h-ref-id").val(res.resultado.referencia.id);

  $("#fieldsetMistura").addClass("d-none");
  $("#subsLegend").text("Mistura");

  substancias_selecionadas = res.resultado.substancias.map((sub) => {
    let label = sub.nome_comercial
      ? `${sub.nome_comercial} (${sub.principio_ativo})`
      : sub.principio_ativo;
    return {
      classeCor: sub.classe.cor,
      classeTitle: sub.classe.descricao,
      comercial: sub.nome_comercial ?? null,
      label,
      ncDos: sub.dosagem_comercial ?? null,
      ncId: sub.nc_id,
      pA: sub.principio_ativo,
      subDos: sub.dosagem_substancia,
      value: sub.sub_id,
    };
  });

  listarSubstanciasSelecionadas(substancias_selecionadas, false);

  $("#resultado option")
    .filter(function () {
      return (
        $(this).text().toLowerCase() == res.resultado.resultado.toLowerCase()
      );
    })
    .prop("selected", true);
  $("#cultura option")
    .filter(function () {
      return (
        $(this).text().toLowerCase() == res.resultado.cultura.toLowerCase()
      );
    })
    .prop("selected", true);

  $("#users-div").removeClass("d-none").addClass("d-flex");
  $("#pesquisador").val(res.pesquisador.id);

  if (res.avaliador) {
    $("#avaliador-div").removeClass("d-none");
    $("#avaliador").val(res.avaliador.id);
  } else {
    $("#avaliador-div").addClass("d-none");
  }

  $("#comentario").val(res.resultado.comentario ?? "");

  const buttonsToShow = [];

  if (res.status === "Pendente") {
    buttonsToShow.push("#excluirResultado");

    let { retorno: canEvalueate } = await verificarPermissaoDoUsuario(
      "session",
      "avaliar_resultado"
    );

    let { retorno: canEdit } = await verificarPermissaoDoUsuario(
      "session",
      "editar_resultado"
    );

    buttonsToShow.push("#excluirResultado");

    if (canEvalueate) {
      buttonsToShow.push("#avaliarAprovar");
      buttonsToShow.push("#avaliarRejeitar");
    }

    if (canEdit) {
      buttonsToShow.push("#editarResultado");
    }
  } else {
    let { retorno: canEdit } = await verificarPermissaoDoUsuario(
      "session",
      "editar_resultado"
    );
    let { retorno: canDelete } = await verificarPermissaoDoUsuario(
      "session",
      "excluir_resultado"
    );

    if (canEdit) {
      buttonsToShow.push("#editarResultado");
      buttonsToShow.push("#pendenteResultado");
    }

    if (canDelete) {
      buttonsToShow.push("#excluirResultado");
    }
  }

  showButtons(buttonsToShow);
}

async function getResultadoEspecífico(res_id) {
  let resultado = null;

  await $.get(
    "../controller/ResultadoController.php",
    { getOne: res_id },
    (data, response) => {
      resultado = JSON.parse(data) ?? null;
    }
  );

  return resultado;
}

async function getCulturas() {
  let culturas = [];

  await $.get(
    "../controller/CulturaController.php",
    { findAll: 1 },
    function (data, response) {
      culturas = JSON.parse(data) ? JSON.parse(data) : [];
      culturas.forEach((cultura) => {
        $("#filter-cultura, #cultura").append(`
                <option value="${cultura.id}">${cultura.descricao}</option>
            `);
      });
    }
  );

  return culturas;
}

async function getReferenciaByLink(link) {
  let referencia = null;
  await $.get(
    "../controller/ReferenciaController.php",
    { findByLink: link },
    function (data, response) {
      let res = JSON.parse(data);
      referencia = res.error ? null : res;
    }
  ).catch((e) => console.log(e));

  return referencia;
}

function listarSubstanciasSelecionadasNoFiltro(subs) {
  if (subs.length > 0) {
    $("#filter-subs-div").removeClass("d-none");
    // $("#filter-selected-subs-title").text(`Substâncias Selecionadas: ${subs.length}`)
    $(".filter-append-subs").empty();
    subs.forEach((sub, index) => {
      let title = sub.pA;
      if (sub.comercial) title = sub.comercial;
      if (sub.apelido) title = sub.apelido;

      let aux = "";
      if (sub.apelido || sub.comercial)
        aux = sub.comercial
          ? `<span class="capitalize">${sub.pA}</span>`
          : `<span class="capitalize">${sub.pA}</span>`;

      $(".filter-append-subs").prepend(`
                <div class="subSelecionada">
                    <div 
                        class="subIndex"
                        style="background-color: ${sub.classeCor};"
                        title="${sub.classeTitle}"
                    >
                        ${index + 1}
                    </div>
                    <div class="subContent">
                        <span class="capitalize">${title}</span>
                        ${aux}
                    </div>
                    <div 
                        class="cursor-pointer"
                        title="Remover substância"
                    >
                        <i class="fas fa-trash-alt trashIcon" style="font-size: 20px;"></i>
                    </div>
                </div>
            `);
    });
  } else {
    $("#filter-subs-div").addClass("d-none");
  }
}

function listarSubstanciasSelecionadas(subs, showTrashIcon) {
  if (subs.length > 0) {
    $("#subs-selecionadas").removeClass("d-none");
    $("#append-substancias").empty();
    subs.forEach((sub, index) => {
      let title = sub.pA;
      if (sub.comercial) title = sub.comercial;
      if (sub.apelido) title = sub.apelido;

      let titleDos = sub.ncId ? sub.ncDos : sub.subDos;

      let trashIcon = `
        <div 
          class="cursor-pointer removeSubs ${showTrashIcon ? "" : "d-none"}"
          title="Remover substância"
        >
          <i class="fas fa-trash-alt trashIcon" style="font-size: 20px;"></i>
        </div>
      `;

      let aux = "";
      if (sub.apelido || sub.comercial)
        aux = sub.comercial
          ? `<span class="capitalize">${sub.pA}: ${sub.subDos}</span>`
          : `<span class="capitalize">${sub.pA}</span>`;

      $("#append-substancias").append(`
        <div class="subSelecionada">
          <div 
            class="subIndex"
            style="background-color: ${sub.classeCor};"
            title="${sub.classeTitle}"
          >
            ${index + 1}
          </div>
          <div class="subContent">
            <span class="capitalize">${title}: ${titleDos}</span>
            ${aux}
          </div>
          ${trashIcon}
        </div>
      `);
    });
  } else {
    $("#subs-selecionadas").addClass("d-none");
  }
}

function listarResultados(resultados) {
  if (!resultados || resultados.length == 0) {
    $("#resultadosAppend").addClass("d-none");
    return;
  }
  $("#resultadosAppend").removeClass("d-none");
  $("#resultadosAppend").empty();

  resultados.forEach((res) => {
    let auxResultado = "";
    let cardStatus = "";

    if (res.status === "Rejeitado") {
      auxResultado = "resultadoRejeitado";
      cardStatus = "Rejeitado";
    } else if (res.status === "Pendente") {
      auxResultado = "resultadoPendente";
      cardStatus = "Pendente";
    } else if (res.resultado === "Positivo") {
      auxResultado = "resultadoPositivo";
      cardStatus = "Positivo";
    } else if (res.resultado === "Negativo") {
      auxResultado = "resultadoNegativo";
      cardStatus = "Negativo";
    }

    let auxSubstancias = "";
    res.substancias.forEach((sub) => {
      if (sub.nome_comercial)
        auxSubstancias += `
                    <div class="sub">
                        <span>${
                          sub.nome_comercial.length >= 20
                            ? sub.nome_comercial.substring(0, 17) + "..."
                            : sub.nome_comercial
                        }</span>
                        <span>${sub.dosagem_comercial}</span>
                    </div>
                `;

      auxSubstancias += `
                <div class="sub">
                    <span ${sub.nome_comercial ? 'style="color: gray;"' : ""}>${
        sub.principio_ativo.length >= 20
          ? sub.principio_ativo.substring(0, 17) + "..."
          : sub.principio_ativo
      }</span>
                    <span ${sub.nome_comercial ? 'style="color: gray;"' : ""}>${
        sub.dosagem_substancia
      }</span>
                </div>
            `;
      auxSubstancias += `
            <div class="divider"/>
            `;
    });

    $("#resultadosAppend").append(`
            <div class="resultado">
                <input type="hidden" value="${res.id}"/>
                <div class="resultadoContainer shaddow-right cursor-pointer" title="Clique para mais informações...">
                    <div class="header">
                        <div class="cultura">
                            <i class="fas fa-leaf"></i>
                            <span>${
                              res.cultura.length >= 15
                                ? res.cultura.substring(0, 12) + "..."
                                : res.cultura
                            }</span>
                        </div>

                        <div class="${auxResultado}">
                            ${cardStatus}
                        </div>
                    </div>
                    <div class="body">
                        <div class="tableHeader">
                            <span>Produtos (${res.substancias.length})</span>
                            <span>Dose</span>
                        </div>
                        <div class="divider"></div>
                        <div class="tableBody">
                            ${auxSubstancias}
                        </div>
                    </div>
                </div>
            </div>
        `);
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

//Função para verificar permissão do usuário
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

//Função pra buscar X referencias do banco de dados
async function getResultados(quantidade) {
  let resultados = false;

  await $.get(
    "../controller/ResultadoController.php",
    { firstOnes: quantidade },
    function (data, response) {
      resultados =
        response == "success" && JSON.parse(data) ? JSON.parse(data) : false;
      if (resultados.length > 0) listarResultados(resultados);
    }
  ).catch((e) => console.log(e));
}

//Função para buscar uma referência específica com o id passado no parâmetro
async function getReferenciaPorID(mist_id) {
  let referencia = false;

  await $.get("../controller/ReferenciaController.php", { findById: mist_id })
    .then((data, response) => {
      referencia = response == "success" ? JSON.parse(data) : false;
    })
    .catch((e) => console.log(e));

  return referencia;
}

//Função para buscar um json contendo todas as substâncias cadastradas no banco
async function getSubstancias() {
  let subs = false; //substancias

  await $.get(
    "../controller/SubstanciaController.php",
    { fetchAll: 1 },
    function (data, response) {
      subs =
        response == "success" && JSON.parse(data) ? JSON.parse(data) : false;
      if (subs) substancias_autocomplete = getSubstanciasAutocomplete(subs);
    }
  ).catch((e) => console.log(e));
}

//Função para buscar usuários avaliadores
async function getAvaliadores() {
  let avaliadores = false;

  await $.get(
    "../controller/UsuarioController.php",
    { avaliadores: 1 },
    function (data, response) {
      avaliadores =
        response == "success" && JSON.parse(data) ? JSON.parse(data) : false;
    }
  ).catch((e) => console.log(e));

  return avaliadores;
}

//Função para buscar usuários pesquisadores
async function getPesquisadores() {
  let pesquisadores = false;

  await $.get(
    "../controller/UsuarioController.php",
    { pesquisadores: 1 },
    function (data, response) {
      pesquisadores =
        response == "success" && JSON.parse(data) ? JSON.parse(data) : false;
    }
  ).catch((e) => console.log(e));

  return pesquisadores;
}

//Função que retornará objetos do formato {id_da_substancia: array_de_possibilidades_de_busca_da_substância}
function getSubstanciasAutocomplete(subs) {
  let subs_objects = [];

  $.map(subs, (sub) => {
    let sub_id = sub.id;
    let sub_pa = sub.principio_ativo;
    let sub_cor = sub.classe[0].cor;
    let sub_cor_title = sub.classe[0].descricao;

    //tratando princípio ativo
    subs_objects.push({
      subId: sub_id,
      principioAtivo: sub_pa.toLowerCase(),
      descricao: sub.principio_ativo.toLowerCase(),
      classeCor: sub_cor,
      classeTitle: sub_cor_title,
    });

    //tratando apelidos
    sub.apelidos &&
      sub.apelidos.forEach((apelido) => {
        let object = {
          subId: sub_id,
          principioAtivo: sub_pa.toLowerCase(),
          apelido: apelido.descricao.toLowerCase(),
          descricao: `${apelido.descricao.toLowerCase()} (${sub_pa.toLowerCase()})`,
          classeCor: sub_cor,
          classeTitle: sub_cor_title,
        };
        subs_objects.push(object);
      });

    //tratando nomes comerciais
    sub.nomes_comerciais &&
      sub.nomes_comerciais.forEach((nome_comercial) => {
        let object = {
          subId: sub_id,
          principioAtivo: sub.principio_ativo.toLowerCase(),
          comercial: nome_comercial.descricao.toLowerCase(),
          ncId: nome_comercial.id,
          descricao: `${nome_comercial.descricao.toLowerCase()} (${sub_pa.toLowerCase()})`,
          classeCor: sub_cor,
          classeTitle: sub_cor_title,
        };

        subs_objects.push(object);
      });
  });

  return subs_objects;
}

function limparFiltros() {
  //inputs e selects
  let inputs = $(".referencia-filter input");
  let selects = $(".referencia-filter select");

  inputs.val("");
  selects.val("");

  $(".filter-append-subs").empty();
  filter_subs = [];
  listarSubstanciasSelecionadasNoFiltro(filter_subs);
  $("#filter-qtd-div").addClass("d-none");
}

$(document).ready(function () {
  //--- Pegando nome do usuário logado
  var user_name;
  $.get("../controller/UsuarioController.php?getUserName=1").then((data) => {
    user_name = data;
    $("#user-name").append("Olá, " + user_name);
  });

  appendParceriaPage();
  appendDashboardPage();

  // Abrir e fechar o formulário de resultado
  $("#open_modal_resultado").click(() => {
    $(".sidebarCommon").toggleClass("sidebarOpen");
    $(".sidebarTitle").text("Cadastrar Novo Resultado");

    showButtons(["#limparForm", "#resultadoSubmit"]);
  });

  $(".closeSidebar").click(closeSidebar);

  $("#open-menu").click(function () {
    $(".menu").toggleClass("open");
  });

  //Autocomplete de países
  $.getJSON("../assets/js/json/paises.json", function (countriesData) {
    let paises = $.map(countriesData, (pais) => pais.nome);
    $("#pais").autocomplete({
      minLength: 3,
      source: paises,
    });
  });

  //Carregando opções de pesquisador
  getPesquisadores().then((data) => {
    data &&
      data.forEach((user) => {
        $("#filter-pesquisador, #pesquisador").append(`
          <option value="${user.id}">${user.nome}</option>
        `);
      });
  });

  //Carregando opções de avaliador
  getAvaliadores().then((data) => {
    data &&
      data.forEach((user) => {
        $("#filter-avaliador, #avaliador").append(`
                <option value="${user.id}">${user.nome}</option>
            `);
      });
  });

  // adicionar sub selecionada a lista
  $("#add-produto").click(() => {
    if (selectedSub) {
      let subDos = $("#sub-dos").val();
      let ncDos = $("#nc-dos").val();

      if (!subDos) {
        displayError(
          "#header-produto",
          "#sub-dos",
          "Dose da substância não informada!"
        );
        return;
      }
      if (!ncDos && !$("#comercial-div").hasClass("d-none")) {
        displayError(
          "#header-produto",
          "#nc-dos",
          "Dose do comercial não informada!"
        );
        return;
      }

      selectedSub["subDos"] = subDos;
      selectedSub["ncDos"] = ncDos;

      substancias_selecionadas.push(selectedSub);

      listarSubstanciasSelecionadas(substancias_selecionadas, true);

      selectedSub = null;
      $("#produto").val("");
      $("#sub-dos").val("");
      $("#nc-dos").val("");
      $("#dosagem-div").removeClass("flex").addClass("d-none");
      $("#comercial-div").addClass("d-none");
    } else {
      displayError(
        "#header-produto",
        "#produto",
        "Nenhum produto selecionado!"
      );
      return;
    }
  });

  // remover sub selecinada quando clicar no ícone de lixeira
  $("#append-substancias").on(
    "click",
    ".subSelecionada .trashIcon",
    function () {
      const subSelecionada = $(this).parent().parent();
      const index = subSelecionada.find(".subIndex").text() - 1;

      substancias_selecionadas.splice(index, 1);
      listarSubstanciasSelecionadas(substancias_selecionadas, true);
    }
  );

  $(".filter-append-subs").on(
    "click",
    ".subSelecionada .trashIcon",
    function () {
      let subSelecionada = $(this).parent();
      let index = subSelecionada.parent().find(".subIndex").text() - 1;

      filter_subs.splice(index, 1);
      listarSubstanciasSelecionadasNoFiltro(filter_subs);
    }
  );

  $("#resultado-form").submit(function (e) {
    e.preventDefault();
    let validacao = true;
    let link = $("#link").val();
    let titulo = $("#titulo").val();
    let pais = $("#pais").val();
    let cultura = $("#cultura").val();
    let resultado = $("#resultado").val();
    let comentario =
      $("#comentario").val() != "" ? $("#comentario").val() : null;

    if (!link) {
      displayError("#header-link", "#link", "Campo obrigatório!");
      validacao = false;
    }
    if (!titulo) {
      displayError("#header-titulo", "#titulo", "Campo obrigatório!");
      validacao = false;
    }
    if (!pais) {
      displayError("#header-pais", "#pais", "Campo obrigatório!");
      validacao = false;
    }
    if (!cultura) {
      displayError("#header-cultura", "#cultura", "Campo obrigatório!");
      validacao = false;
    }
    if (!resultado) {
      displayError("#header-resultado", "#resultado", "Campo obrigatório!");
      validacao = false;
    }
    if (!comentario) {
      displayError("#header-comentario", "#comentario", "Campo obrigatório!");
      validacao = false;
    }

    if (substancias_selecionadas.length < 2) {
      displayError(
        "#header-produto",
        "#produto",
        "Selecione no mínimo 2 substâncias!"
      );
      validacao = false;
    }

    if (!validacao) {
      e.preventDefault();
      return;
    }

    let ref_id = $("#h-ref-id").val() != "" ? $("#h-ref-id").val() : null;

    $.post("../controller/ResultadoController.php", {
      ref_id,
      link,
      titulo,
      pais,
      substancias_selecionadas,
      cultura,
      resultado,
      comentario,
    }).then((data) => {
      if (JSON.parse(data)) {
        res = JSON.parse(data);
        $("#customDialog").append(`<p>${res.msg}</p>`);
        $("#customDialog").dialog({
          title: "Sucesso!",
          height: 100,
          width: 350,
          modal: true,
          resizable: false,
          dialogClass: "no-close success-dialog",
        });
        setTimeout(() => location.reload(), 2000);
      }
    });
  });

  // buscar ref ao blur
  $("#link").blur(async function () {
    let link = $(this).val();
    let referencia = await getReferenciaByLink(link);

    if (referencia) {
      if (referencia.titulo && referencia.titulo != "")
        $("#titulo").val(referencia.titulo);
      $("#pais").val(referencia.pais);
      $("#h-ref-id").val(referencia.id);

      if (!$("#salvarEdicao").is(":visible")) {
        $("#titulo").prop("readonly", true);
        $("#pais").prop("readonly", true);
      }
    } else {
      $("#titulo").val("");
      $("#pais").val("");
      $("#h-ref-id").val("");

      if (!$("#salvarEdicao").is(":visible")) {
        $("#titulo").prop("readonly", false);
        $("#pais").prop("readonly", false);
      }
    }
  });

  $(".dosagem-mask").mask("00000.0", { reverse: true });

  $("#resultadosAppend").on("click", ".resultado", async function () {
    let id = $(this).find("input").val();
    let resultado = await getResultadoEspecífico(id);

    $(".sidebarCommon").addClass("sidebarOpen");
    carregarResultadoNoFormulario(resultado);
    toggleDisableForm("#resultado-form", true);
  });

  $("#avaliarAprovar").click(async function () {
    if (confirm("Deseja APROVAR este resultado?")) {
      let id = $("#h-r-id").val();
      let res = await avaliarResultado("aprovar", id);
      if (res) {
        $("#customDialog").empty();
        $("#customDialog").append("<p>Resultado aprovado com sucesso!</p>");
        $("#customDialog").dialog({
          title: "Sucesso!",
          height: 100,
          width: 350,
          modal: true,
          resizable: false,
          dialogClass: "no-close success-dialog",
        });
        setTimeout(() => location.reload(), 2000);
      }
    }
  });

  $("#avaliarRejeitar").click(async function () {
    if (confirm("Deseja REJEITAR este resultado?")) {
      let id = $("#h-r-id").val();
      let res = await avaliarResultado("rejeitar", id);
      if (res) {
        $("#customDialog").empty();
        $("#customDialog").append("<p>Resultado rejeitado com sucesso!</p>");
        $("#customDialog").dialog({
          title: "Sucesso!",
          height: 100,
          width: 350,
          modal: true,
          resizable: false,
          dialogClass: "no-close success-dialog",
        });
        setTimeout(() => location.reload(), 2000);
      }
    }
  });

  $("#limparForm").click(function () {
    if (confirm("Deseja limpar todos os campos do formulário?"))
      limparFormulario();
  });

  $("#excluirResultado").click(async function () {
    if (confirm("Deseja EXCLUIR este resultado ?")) {
      let id = $("#h-r-id").val();
      let res = await excluirResultado(id);
      if (res) {
        $("#customDialog").empty();
        $("#customDialog").append("<p>Resultado excluído com sucesso!</p>");
        $("#customDialog").dialog({
          title: "Sucesso!",
          height: 100,
          width: 350,
          modal: true,
          resizable: false,
          dialogClass: "no-close success-dialog",
        });
        setTimeout(() => location.reload(), 2000);
      }
    }
  });

  $("#filter-add-substance").click(function () {
    if (filterSelectedSub) {
      filter_subs.push(filterSelectedSub);
      listarSubstanciasSelecionadasNoFiltro(filter_subs);
      filterSelectedSub = null;
      $("#filter-autocomplete").val("");
    } else {
      displayError(
        "#filter-message",
        "#filter-autocomplete",
        "Selecione uma substância!"
      );
      return;
    }
  });

  $("#filter-button").click(async function () {
    const filtros = {};

    const avaliador = $("#filter-avaliador").val();
    const pesquisador = $("#filter-pesquisador").val();
    const status = $("#filter-status").val();
    const link = $("#filter-link").val();

    if (filter_subs.length > 0) {
      const subs = filter_subs.map((sub) => {
        return {
          sub_id: sub.value,
          nc_id: sub.ncId,
        };
      });
      filtros["subs"] = JSON.stringify(subs);
    }
    if (avaliador && avaliador != "") filtros["avaliador"] = avaliador;
    if (pesquisador && pesquisador != "") filtros["pesquisador"] = pesquisador;
    if (status && status != "") filtros["status"] = status;
    if (link && link != "") filtros["link"] = link;

    if (
      !(Object.keys(filtros).length === 0 && filtros.constructor === Object)
    ) {
      filtros["filter"] = true;
      filtros["origin"] = "web";

      const results = await getResultadosFiltrados(filtros);
      listarResultados(results);
      $("#filter-limpar").removeClass("d-none");
      $("#filter-qtd-div").removeClass("d-none");
      $("#filter-qtd").text(
        `Quantidade de resultados encontrados: ${results.length}`
      );
    } else {
      limparFiltros();
      getResultados(20);
      $("#filter-limpar").addClass("d-none");
    }
  });

  $("#filter-limpar").click(function () {
    limparFiltros();
    getResultados(20);
    $("#filter-limpar").addClass("d-none");
  });

  $("#editarResultado").click(function () {
    toggleDisableForm("#resultado-form", false);

    hideAllButtons();

    // botões que estarão visíveis
    $("#salvarEdicao").show();
    $("#cancelarEdicao").show();

    // seção para adicionar substâncias
    $("#fieldsetMistura").removeClass("d-none");

    $(".removeSubs").removeClass("d-none");
  });

  $("#pendenteResultado").click(async function () {
    if (confirm("Deseja alterar o status deste resultado para PENDENTE?")) {
      let id = $("#h-r-id").val();
      let res = await deixarResultadoPendente(id);
      if (res) {
        $("#customDialog").empty();
        $("#customDialog").append("<p>Resultado alterado para pendente!</p>");
        $("#customDialog").dialog({
          title: "Sucesso!",
          height: 100,
          width: 350,
          modal: true,
          resizable: false,
          dialogClass: "no-close success-dialog",
        });
        setTimeout(() => location.reload(), 2000);
      }
    }
  });

  $("#cancelarEdicao").click(closeSidebar);

  $("#salvarEdicao").click(async function () {
    let validacao = true;

    const id = $("#h-r-id").val();

    const referenciaId = $("#h-ref-id").val()
      ? $("#h-ref-id").val()
      : undefined;
    const link = $("#link").val();
    const titulo = $("#titulo").val();
    const pais = $("#pais").val();

    const culturaId = $("#cultura").val();
    const resultado = $("#resultado").val();
    const pesquisadorId = $("#pesquisador").val();
    const avaliadorId = $("#avaliador").val()
      ? $("#avaliador").val()
      : undefined;
    const comentario = $("#comentario").val()
      ? $("#comentario").val()
      : undefined;

    if (!link) {
      displayError("#header-link", "#link", "Campo obrigatório!");
      validacao = false;
    }
    if (!titulo) {
      displayError("#header-titulo", "#titulo", "Campo obrigatório!");
      validacao = false;
    }
    if (!pais) {
      displayError("#header-pais", "#pais", "Campo obrigatório!");
      validacao = false;
    }
    if (!cultura) {
      displayError("#header-cultura", "#cultura", "Campo obrigatório!");
      validacao = false;
    }
    if (!resultado) {
      displayError("#header-resultado", "#resultado", "Campo obrigatório!");
      validacao = false;
    }
    if (!comentario) {
      displayError("#header-comentario", "#comentario", "Campo obrigatório!");
      validacao = false;
    }

    if (substancias_selecionadas.length < 2) {
      displayError(
        "#header-produto",
        "#produto",
        "Selecione no mínimo 2 substâncias!"
      );
      validacao = false;
    }

    if (!validacao) {
      e.preventDefault();
      return;
    }

    await $.ajax({
      url: "../controller/ResultadoController.php",
      type: "PUT",
      data: {
        update: true,
        id,
        referenciaId,
        link,
        titulo,
        pais,
        culturaId,
        resultado,
        pesquisadorId,
        avaliadorId,
        comentario,
        substancias_selecionadas,
      },
      success: function (data) {
        res = JSON.parse(data);
        classes = res.result
          ? "no-close success-dialog"
          : "no-close error-dialog";
        title = res.result ? "Sucesso!" : "Erro!";

        $("#customDialog").append(`<p>${res.msg}</p>`);
        $("#customDialog").dialog({
          title,
          height: 100,
          width: 350,
          modal: true,
          resizable: false,
          dialogClass: classes,
        });
        setTimeout(() => location.reload(), 1200);
      },
    });
  });

  getCulturas();
  getSubstancias();
  getResultados(20);
}); // Fim document.ready

//--- Preparando variáveis para autocomplete
var substancias_autocomplete = []; //array que contem todas as opções válidas de substâncias que podem ser escolhidas pelo usuário para criar uma nova mistura - utilizando o form

var selectedSub = null; // Substância selecionada no autocomplete do formulário de cadastrar novo resultado
var substancias_selecionadas = []; // array com todas as substtancias escolhidas no form de cadastro de resultado

var filter_subs = [];
var filterSelectedSub = null;

// Autocomplete de substancias
$(document).on("input.autocomplete", "#produto", async function () {
  if ($(this).val() == "") {
    $("#dosagem-div").addClass("d-none").removeClass("flex");
    $("#comercial-div").addClass("d-none");
  }
  $(this).autocomplete({
    minLength: 4,
    source: function (request, response) {
      let array = $.map(substancias_autocomplete, function (options, key) {
        return {
          label: options.descricao,
          value: options.subId,
          pA: options.principioAtivo,
          ncId: options.ncId,
          comercial: options.comercial,
          apelido: options.apelido,
          classeCor: options.classeCor,
          classeTitle: options.classeTitle,
        };
      });
      response($.ui.autocomplete.filter(array, request.term));
    },
    select: function (event, ui) {
      let selectedOption = ui.item;
      $(this).val(selectedOption.label);

      if (
        substancias_selecionadas.find(
          (sub) => sub.value == selectedOption.value
        )
      ) {
        //verificando se essa substância selecionada ja foi escolhida anteriormente
        displayError(
          "#header-produto",
          "#produto",
          "Substância já selecionada!"
        );
        $(this).val("");
      } else {
        $("#dosagem-div").removeClass("d-none").addClass("flex");
        if (selectedOption.ncId) {
          // Selecionou produto comercial
          $("#comercial-div").removeClass("d-none");
          $("#sub-dos-label").text(selectedOption.pA);
          $("#nc-dos-label").text(selectedOption.comercial);
        } else {
          $("#comercial-div").addClass("d-none");
          if (!selectedOption.apelido) {
            // Selecionou princípio Ativo
            $("#sub-dos-label").text(selectedOption.pA);
          } else {
            $("#sub-dos-label").text(selectedOption.apelido);
          }
        }
        selectedSub = selectedOption;
      }

      return false;
    },
  });
});

$(document).on("input.autocomplete", "#filter-autocomplete", function () {
  let text = $(this).val();

  $(this).autocomplete({
    minLength: 3,
    source: function (request, response) {
      let array = $.map(substancias_autocomplete, function (options, key) {
        return {
          label: options.descricao,
          value: options.subId,
          pA: options.principioAtivo,
          ncId: options.ncId,
          comercial: options.comercial,
          apelido: options.apelido,
          classeCor: options.classeCor,
          classeTitle: options.classeTitle,
        };
      });
      response($.ui.autocomplete.filter(array, request.term));
    },
    select: function (event, ui) {
      let selectedOption = ui.item;

      if (filter_subs.find((sub) => sub.value == selectedOption.value)) {
        //verificando se essa substância selecionada ja foi escolhida anteriormente
        displayError(
          "#filter-message",
          "#filter-autocomplete",
          "Substância já selecionada!"
        );
        $(this).val("");
      } else {
        $(this).val(ui.item.label); // colocando o texto no input
        filterSelectedSub = selectedOption;
      }

      return false;
    },
  });
});
