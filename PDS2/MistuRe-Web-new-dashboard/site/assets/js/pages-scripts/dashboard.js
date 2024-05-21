$(document).ready(function () {
  //--- Pegando nome do usuário logado e colocando no menu
  var user_name;
  $.get("../controller/UsuarioController.php?getUserName=1").then((data) => {
    user_name = data;
    $("#user-name").append("Olá, " + user_name);
  });

  $("#customDialog").empty();

  initializeFilters();
  $("#filter").click(filterLogsAndPopulateSection);

  $(".showTableVision").click(showTableVision);
  $(".showChartVision").click(showChartVision);
  $("input[type=radio][name=page-toggler]").change(handlePageContentToggler);

  // loading menu items
  appendParceriaPage();
  appendDashboardPage();
  $("#open-menu").click(toggleMenu);

  // loading page content with initial logs
  filterLogsAndPopulateSection();

  filterOccuranceSection();
}); // document.ready

function handlePageContentToggler() {
  $(".page-content-option").addClass("d-none");

  const pageContentId = "#" + this.value;
  $(pageContentId).removeClass("d-none");
}

function showChartVision() {
  $(this).parent().parent().find(".table-content").addClass("d-none");
  $(this).parent().parent().find(".chart-content").removeClass("d-none");

  $(this).siblings("button").removeClass("d-none");
  $(this).addClass("d-none");
}

function showTableVision() {
  $(this).parent().parent().find(".table-content").removeClass("d-none");
  $(this).parent().parent().find(".chart-content").addClass("d-none");

  $(this).siblings("button").removeClass("d-none");
  $(this).addClass("d-none");
}

function toggleMenu() {
  $(".menu").toggleClass("open");
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

async function appendParceriaPage() {
  const res1 = await verifyUserHasPermission("session", "cadastrar_parceria");
  const res2 = await verifyUserHasPermission("session", "excluir_parceria");

  if (res1.retorno || res2.retorno) {
    $("#menuAppend").append(`
      <div class="menu-item" style="margin-right: 10px;">
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
      <div class="menu-item menu-item-active" style="margin-right: 10px;">
        <a class="link" href="./dashboard.html">
          <img src="../assets/img/dashboard.png" />
          Painel
        </a>
      </div>
    `);
  } else {
    window.location.href = "../view/login.html";
  }
}

function initializeFilters() {
  const startOfMonth = moment().startOf("month").format("YYYY-MM-DD");
  const endOfMonth = moment().endOf("month").format("YYYY-MM-DD");

  $("#start-date").val(startOfMonth);
  $("#end-date").val(endOfMonth);
}

async function filterOccuranceSection() {
  const subsOccurences = await getSubstancesOccurences();
  const culturesOccurences = await getCulturesOccurences();

  const parsedSubs = subsOccurences.map((item) => ({
    label: item.principioAtivo,
    count: item.count,
  }));

  const parsedCultures = culturesOccurences.map((item) => ({
    label: item.descricao,
    count: item.count,
  }));

  populateChart(parsedSubs, "substancesOccurencesChart");
  populateTable(parsedSubs, "substancesOccurencesTable");

  populateChart(parsedCultures, "culturesOccurencesChart");
  populateTable(parsedCultures, "culturesOccurencesTable");
}

async function filterLogsAndPopulateSection() {
  const logs = await getLogs();
  const logsWithoutResponse = await getLogs({ result: "[]" });

  const parsedLogs = logs.map((log) => ({
    label: log.mixture.join(" +\n"),
    count: log.count,
  }));

  const parsedEmptyLogs = logsWithoutResponse.map((log) => ({
    label: log.mixture.join(" +\n"),
    count: log.count,
  }));

  populateChart(parsedLogs, "mixtureLogsChart");
  populateTable(parsedLogs, "mixtureLogsTable");

  populateChart(parsedEmptyLogs, "mixtureWithEmptyResultsChart");
  populateTable(parsedEmptyLogs, "mixtureWithEmptyResultsTable");
}

function populateTable(data, htmlId) {
  let tbody = "";

  if (Boolean(data?.length)) {
    data.forEach(({ label, count }) => {
      tbody += `
        <tr>
          <td>${label}</td>
          <td>${count}</td>
        </tr>
      `;
    });
  }

  const tableEl = $(`#${htmlId}`);
  const tbodyEl = tableEl.find("tbody");

  tbodyEl.empty();
  tbodyEl.append(tbody);
}

function populateChart(data, htmlId) {
  const first10 = data.slice(0, 10);

  const labels = first10.map((item) => item.label);
  const counts = first10.map((log) => log.count);

  const chartData = {
    labels,
    datasets: [
      {
        label: "Quantidade (ocorrências)",
        data: counts,
      },
    ],
  };

  const options = {
    type: "pie",
    data: chartData,
    options: {
      plugins: {
        legend: {
          display: false,
        },
      },
    },
  };

  generateCanvas(htmlId, options);
}

function generateCanvas(chartId, configObj) {
  let chartStatus = Chart.getChart(chartId); // <canvas> id
  if (chartStatus != undefined) {
    chartStatus.destroy();
  }

  var chartCanvas = $(`#${chartId}`); //<canvas> id
  new Chart(chartCanvas, configObj);
}

async function getLogs(filter = {}) {
  const startDate = $("#start-date").val();
  const endDate = $("#end-date").val();
  const origin = $("#origin").val();

  const { result } = filter;

  try {
    const res = await $.get("../controller/LogController.php", {
      filter: true,
      start: startDate,
      end: endDate,
      result,
      origin,
    });

    return JSON.parse(res);
  } catch (e) {
    console.log({ e });
  }
}

async function getCulturesOccurences() {
  const orderDirection = "desc";

  try {
    const res = await $.get("../controller/CulturaController.php", {
      filterByResultOccurence: true,
      orderDirection,
    });

    return JSON.parse(res);
  } catch (e) {
    console.log({ e });
  }
}

async function getSubstancesOccurences() {
  const orderDirection = "desc";

  try {
    const res = await $.get("../controller/SubstanciaController.php", {
      filterByMixtureOccurence: true,
      orderDirection,
    });

    return JSON.parse(res);
  } catch (e) {
    console.log({ e });
  }
}
