const btnCreateTable = document.querySelector("#btnCreateTable");
const btnCreateRows = document.querySelector("#addRow");
const btnCreateColumn = document.querySelector("#addColumn");

const btnSubmitCrTable = document.querySelector("#submit");

const formInput = document.querySelector("#form-input");

const titleTable =
  document.querySelector("#titleTable") !== null
    ? document.querySelector("#titleTable")
    : "";
const columnTotal = document.querySelector("#columnTotal");
const rowTotal = document.querySelector("#rowsTotal");

function crElement(titleTable) {
  const createTable = document.createElement("table");
  const createThead = document.createElement("thead");
  const createTbody = document.createElement("tbody");
  const crInputTitle = document.createElement("input");
  const crButtonSubmit = document.createElement("button");
  const createTr = document.createElement("tr");
  const createTd = document.createElement("td");
  const createTh1 = document.createElement("th");
  const createInput1 = document.createElement("input");
  const selectChart = document.createElement("select");
  const optionChart = document.createElement("option");
  const labelText = document.createElement("label");

  createTable.className = "table table-bordered table-striped table-hover";
  crButtonSubmit.type = "submit";
  crButtonSubmit.name = "submit";
  crButtonSubmit.innerText = "Submit";
  crButtonSubmit.className = "btn btn-outline-primary";

  crInputTitle.className = "form-control border-0 my-2";
  crInputTitle.placeholder = "Masukan Judul Table";
  crInputTitle.type = "text";
  crInputTitle.name = `titleTable`;
  crInputTitle.value = `${titleTable.split("-")[0]}`;
  crInputTitle.required;
  crInputTitle.autocomplete = "off";

  labelText.className = "input-group-text";
  labelText.setAttribute("for", "chart-select");
  selectChart.className = "form-select";
  selectChart.id = "chart-select";

  return {
    createTable,
    createThead,
    createTbody,
    crInputTitle,
    crButtonSubmit,
    createTr,
    createTd,
    createTh1,
    createInput1,
    selectChart,
    optionChart,
  };
}

function addDataTable(createThead, createTbody, valTitle) {
  for (let row = 1; row <= rowTotal.value; row++) {
    const { createTr, createTd } = crElement(valTitle);
    createTd.innerText = row;
    createTr.appendChild(createTd);
    console.log(`row ======= : ${row}`);

    for (let col = 1; col <= columnTotal.value; col++) {
      console.log(`col : ${col}`);

      const { createTh1, createInput1 } = crElement(valTitle);

      createInput1.className = "form-control border-0";
      createInput1.placeholder = "Masukan Data";
      createInput1.type = "text";
      createInput1.name = `${row}-${col}`;
      createInput1.autocomplete = "off";

      createTh1.appendChild(createInput1);
      createTr.appendChild(createTh1);
    }
    if (row === 1) createThead.appendChild(createTr);
    else createTbody.appendChild(createTr);
  }
}

function updateDataTable(createThead, createTbody, data, valTitle, chart) {
  const rows = data[1].length;
  for (let row = -1; row <= rows - 1; row++) {
    const { createTr, createTd } = crElement(valTitle);
    createTd.innerText = row === -1 ? "No" : row + 1;
    createTr.appendChild(createTd);
    // console.log(`row ======= : ${row}`);

    if (row === -1) {
      data[0].forEach((col, key) => {
        // col
        const { createTh1, createInput1 } = crElement(valTitle);

        createInput1.className = "form-control border-0 bg-transparent";
        createInput1.placeholder = "Masukan Data";
        createInput1.type = "text";
        createInput1.name = `${row + 1}-${key}`;
        createInput1.autocomplete = "off";
        createInput1.value = col;
        createInput1.readOnly = true;

        if (data[0].length - 1 === key && chart === true) {
          createInput1.hidden = true; // id inputText
        } else if (data[0].length - 2 === key && chart === false) {
          createInput1.hidden = true; // id inputText
        } else if ((data[0].length - 1 === key || data[0].length - 2 === key) && chart === undefined){
          createInput1.hidden = true
        }

        createTh1.appendChild(createInput1);
        createTr.appendChild(createTh1);
      });
    } else {
      data[1][row].forEach((rowData, key) => {
        // row
        const { createTh1, createInput1, selectChart } = crElement(valTitle);
        selectChart.name = `${row + 1}-${key}`;

        if (data[0].length - 1 === key && chart === true) {
          createInput1.hidden = true; // id inputText
        } else if (data[0].length - 2 === key && chart === false) {
          createInput1.hidden = true; // id inputText
        } else if ((data[0].length - 1 === key || data[0].length - 2 === key) && chart === undefined){
            createInput1.hidden = true
        }

        if (data[0].length - 2 == key && chart === true) {
          // chart handler
          const chart = ["line", "pie", "bar", "doughnut"];
          for (let totalChart = 0; totalChart < chart.length; totalChart++) {
            const { optionChart } = crElement(valTitle);
            optionChart.value = chart[totalChart];
            optionChart.innerText = chart[totalChart];

            if (rowData === chart[totalChart]) {
              optionChart.selected = true;
            }
            selectChart.appendChild(optionChart);
          }

          createTh1.appendChild(selectChart);
        } else {
          createInput1.className = "form-control border-0 bg-transparent";
          createInput1.placeholder = "Masukan Data";
          createInput1.type = "text";
          createInput1.name = `${row + 1}-${key}`;
          createInput1.autocomplete = "off";
          createInput1.value = rowData;

          createTh1.appendChild(createInput1);
        }

        createTr.appendChild(createTh1);
      });
    }

    if (row === -1) createThead.appendChild(createTr);
    else createTbody.appendChild(createTr);
  }
}

function crTable(updateData, tableName, chart) {
  const valTitle = titleTable.value;

  const {
    createTable,
    createThead,
    createTbody,
    crInputTitle,
    crButtonSubmit,
  } = crElement((valTitle == "" || valTitle === undefined) ? tableName : valTitle);

  if (updateData) {
    updateDataTable(createThead, createTbody, updateData, tableName, chart);
  } else {
    addDataTable(createThead, createTbody, valTitle);
  }
  
  createTable.appendChild(createThead);
  createTable.appendChild(createTbody);
  formInput.appendChild(crInputTitle);
  formInput.appendChild(createTable);
  formInput.appendChild(crButtonSubmit);
}

// btnSubmitCrTable.addEventListener('click', (e) => {
//     e.preventDefault();
//     btnCreateColumn.removeAttribute("disabled");
//     btnCreateRows.removeAttribute("disabled");

//     console.log('ter click modal');
//     crTable();
// })
