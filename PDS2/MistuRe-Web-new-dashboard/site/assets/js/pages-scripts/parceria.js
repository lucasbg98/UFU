$(document).ready(function () {
  //--- Pegando nome do usuário logado e colocando no menu
  var user_name;
  $.get("../controller/UsuarioController.php?getUserName=1").then((data) => {
    user_name = data;
    $("#user-name").append("Olá, " + user_name);
  });

  appendParceriaPage();
  appendDashboardPage();

  $("#customDialog").empty();

  $(".openSidebar").click(() => openSidebar("Cadastrar Nova Parceria"));

  $(".closeSidebar").click(clearParceriaOnSidebar);

  $("#open-menu").click(toggleMenu);

  $("#parceriaForm").submit(submitForm);

  $(".parceriasWrapper").on("click", ".parceria", loadParceriaOnForm);

  $("#deleteParceria").click(deleteParceria);

  $("#editarParceria").click(handleEditClick);

  $("#salvarEdicao").click(updateParceria);

  fetchAndListParcerias();

  $("#inicio").mask("99/99/9999");
  $("#fim").mask("99/99/9999");
}); // document.ready

function toggleMenu() {
  $(".menu").toggleClass("open");
}

function openSidebar(title) {
  $(".sidebarCommon").addClass("sidebarOpen");
  $(".sidebarTitle").text(title);
}

function closeSidebar() {
  $(".sidebarCommon").removeClass("sidebarOpen");
}

function toggleDisableForm(bool) {
  //Bloqueando os inputs, botões, ícones e classes
  let inputs = $("#parceriaForm").find("input");
  let botoes = $("#parceriaForm").find(
    "button:not(.closeSidebar, #buttonsDiv button)"
  );

  inputs.prop("disabled", bool);
  botoes.prop("disabled", bool);

  //Colocando classe que muda o cursor
  if (bool) {
    inputs.removeClass("cursor-default");
    botoes.removeClass("cursor-pointer");

    inputs.addClass("cursor-not-allowed");
    botoes.addClass("cursor-not-allowed");
  } else {
    inputs.removeClass("cursor-not-allowed");
    botoes.removeClass("cursor-not-allowed");

    inputs.addClass("cursor-default");
    botoes.addClass("cursor-pointer");
  }
}

async function getParcerias() {
  let parcerias = [];

  await $.get(
    "../controller/ParceriaController.php",
    { getAll: 1 },
    (data, response) => {
      parcerias = data;
    }
  );

  return parcerias;
}

function listarParcerias(parcerias) {
  parcerias.forEach((p) => {
    $(".parceriasWrapper").append(`
      <div class="parceria">
        <input type="hidden" value="${p.id}">
        <div class="parceriaContainer shaddow-right cursor-pointer">
          <div class="card-header textLimiter" title="${p.nome}">
              ${p.nome}
          </div>
          <div class="parceria-img">
            <img src="data:image/png;base64, ${p.image64}"/>
          </div>
        </div>
      </div>
    `);
  });
}

async function fetchAndListParcerias() {
  const parcerias = await getParcerias();
  if (parcerias.length > 0) listarParcerias(parcerias);
}

async function submitForm(e) {
  e.preventDefault();

  const data = getFormData(true);
  if (!data) return;

  data.append("save", true);

  fetch("../controller/ParceriaController.php", {
    method: "POST",
    body: data,
  }).then(function (response) {
    response.json().then(function (data) {
      const { ok, msg } = data;
      if (ok) {
        showDialog(msg, "Sucesso!", "success");
        setTimeout(() => location.reload(), 1000);
      } else showDialog(msg, "Erro!", "error");
    });
  });
}

function testDate(str) {
  var regex = /^[0-9]{2}[\/][0-9]{2}[\/][0-9]{4}$/g;
  if (regex.test(str)) {
    let parts = str.split("/");
    let dd = parseInt(parts[0]);
    let mm = parseInt(parts[1]);
    let yyyy = parseInt(parts[2]);
    let validation = true;

    if (mm < 1 || mm > 12) validation = false;
    if (dd < 1 || dd > 31) validation = false;
    if (yyyy < 1) validation = false;

    return validation;
  } else {
    return false;
  }
}

function checkDateGreaterThan(str1, str2) {
  var startDate = new Date(str1);
  var endDate = new Date(str2);

  return startDate > endDate;
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
  }, 1000);
}

function showDialog(text, title, type) {
  const classes =
    type === "success" ? "no-close success-dialog" : "no-close error-dialog";

  $("#customDialog").empty();
  $("#customDialog").append(`<p>${text}</p>`);
  $("#customDialog").dialog({
    title: title,
    height: 150,
    width: 450,
    modal: true,
    resizable: false,
    dialogClass: classes,
  });
}

async function loadParceriaOnForm() {
  const id = $(this).find("input[type=hidden]").val();
  const parceria = await getOneParceria(id);
  loadParceriaOnSidebar(parceria);
}

async function getOneParceria(p_id) {
  let parceria = null;

  await $.get(
    "../controller/ParceriaController.php",
    { getOne: p_id },
    (data, response) => {
      parceria = data;
    }
  );

  return parceria;
}

async function loadParceriaOnSidebar(parceria) {
  $("#hiddenParceriaId").val(parceria.id);
  $("#nome").val(parceria.nome);
  $("#link").val(parceria.link ? parceria.link : "");
  $("#inicio").val(parceria.periodo_inicial);
  $("#fim").val(parceria.periodo_final ? parceria.periodo_final : null);

  openSidebar("Visualizar Parceria");
  // hideLogoInput();
  clearLogoImg();
  showLogoImg(parceria.image64);

  toggleDisableForm(true);

  toggleDisplay("#buttonsCadastrar", false);
  toggleDisplay("#salvarEdicao", true);
  toggleDisplay("#editarParceria", false);

  const verifyUserHasDeletePermission = await verifyUserHasPermission(
    "session",
    "excluir_parceria"
  );
  const verifyUserHasEditPermission = await verifyUserHasPermission(
    "session",
    "editar_parceria"
  );
  if (verifyUserHasEditPermission || verifyUserHasEditPermission)
    toggleDisplay("#buttonDeleteAndEdit", true);
  if (verifyUserHasDeletePermission) toggleDisplay("#buttonDelete", true);
  if (verifyUserHasEditPermission) toggleDisplay("#editarParceria", true);
  toggleDisplay("#salvarEdicao", false);
}

async function clearParceriaOnSidebar() {
  $("#hiddenParceriaId").val("");
  $("#nome").val("");
  $("#link").val("");
  $("#inicio").val("");
  $("#fim").val("");

  closeSidebar();
  showLogoInput();
  clearLogoImg();

  toggleDisableForm(false);

  toggleDisplay("#buttonDeleteAndEdit", false);

  const verifyUserHasSavePermission = await verifyUserHasPermission(
    "session",
    "cadastrar_parceria"
  );
  if (verifyUserHasSavePermission) toggleDisplay("#buttonsCadastrar", true);
}

function showLogoInput() {
  $("#logoInput").show();
}

function hideLogoInput() {
  $("#logoInput").hide();
}

function showLogoImg(imageBase64) {
  $("#logoImg").append(`
    <img
      style='max-height: 100%;
      max-width: 100%;
      object-fit: contain'
      src="data:image/png;base64, ${imageBase64}"
    />
  `);
}

function clearLogoImg() {
  $("#logoImg").empty();
}

function toggleDisplay(selector, val) {
  if (val) {
    $(selector).show();
  } else {
    $(selector).hide();
  }
}

async function verifyUserHasPermission(usuario, permissao) {
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

async function deleteParceria() {
  if (confirm("Deseja realmente excluir esta parceria?")) {
    const id = $("#hiddenParceriaId").val();
    const res = await removeParceria(id);

    if (res) {
      showDialog("Parceria excluída com sucesso!", "Sucesso!", "success");
      setTimeout(() => location.reload(), 1000);
    } else {
      showDialog("Erro ao excluir parceria!", "Erro!", "error");
    }
  }
}

async function removeParceria(p_id) {
  let resultado = {};
  await $.ajax({
    url: "../controller/ParceriaController.php",
    type: "DELETE",
    data: {
      deleteId: p_id,
    },
    success: function (data) {
      resultado = JSON.parse(data) ? JSON.parse(data) : {};
    },
  });
  return { resultado };
}

async function appendDashboardPage() {
  const canSeeDashboard = await verifyUserHasPermission("session", "dashboard");

  if (canSeeDashboard) {
    $("#menuAppend").append(`
      <div class="menu-item menu-item-active" style="margin-right: 10px;">
        <a class="link" href="./dashboard.html">
          <img src="../assets/img/dashboard.png" />
          Painel
        </a>
      </div>
    `);
  }
}

async function appendParceriaPage() {
  const res1 = await verifyUserHasPermission("session", "cadastrar_parceria");
  const res2 = await verifyUserHasPermission("session", "excluir_parceria");

  if (res1.retorno || res2.retorno) {
    $("#menuAppend").append(`
      <div class="menu-item menu-item-active" style="margin-right: 10px;">
        <a class="link" href="./parceiro.html">
          <img src="../assets/img/handshake.svg" />
          Parceiros
        </a>
      </div>
    `);
  } else {
    window.location.href = "../view/login.html";
  }
}

async function appendDashboardPage() {
  const canSeeDashboard = await verifyUserHasPermission("session", "dashboard");

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

function handleEditClick(e) {
  e.preventDefault();

  toggleDisableForm(false);
  toggleDisplay("#salvarEdicao", true);
  toggleDisplay("#editarParceria", false);
  toggleDisplay("#deleteParceria", false);
}

function updateParceria() {
  const data = getFormData(false);
  if (!data) return;

  const id = $("#hiddenParceriaId").val();
  data.append("id", id);
  data.append("update", true);

  fetch("../controller/ParceriaController.php", {
    method: "POST",
    body: data,
  }).then(function (response) {
    response.json().then(function (data) {
      const { ok, msg } = data;
      if (ok) {
        showDialog(msg, "Sucesso!", "success");
        setTimeout(() => location.reload(), 1000);
      } else showDialog(msg, "Erro!", "error");
    });
  });
}

function getFormData(withLogo) {
  var validation = true;
  var nome = $("#nome").val();
  var link = $("#link").val() ? $("#link").val() : null;
  var dataInicio = $("#inicio").val();
  var dataFim = $("#fim").val() ? $("#fim").val() : null;
  var logo = $("#logo")[0].files;

  if (!nome) {
    displayError("#headerNome", "#nome", "Campo obrigatório!");
    validation = false;
  }
  if (!dataInicio) {
    displayError("#headerInicio", "#inicio", "Campo obrigatório!");
    validation = false;
  }
  if (dataInicio && !testDate(dataInicio)) {
    displayError("#headerInicio", "#inicio", "Formato incorreto!");
    validation = false;
  }
  if (dataFim && !testDate(dataFim)) {
    displayError("#headerFim", "#fim", "Formato incorreto!");
    validation = false;
  }
  if (dataInicio && dataFim && checkDateGreaterThan(dataInicio, dataFim)) {
    displayError("#headerFim", "#fim", "Valores incorretos!");
    displayError("#headerInicio", "#inicio", "Valores incorretos!");
    validation = false;
  }
  if (withLogo && logo.length == 0) {
    displayError("#headerLogo", "#logo", "Campo obrigatório!");
    validation = false;
  }

  if (validation) {
    var data = new FormData();
    data.append("logo", logo[0]);
    data.append("nome", nome);
    data.append("periodo_inicial", dataInicio);
    if (dataFim) data.append("periodo_final", dataFim);
    if (link) data.append("link", link);

    return data;
  }
  return false;
}
