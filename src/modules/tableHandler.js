// import { crTable } from "./table/createTable";

const btnCreateTable = document.querySelector("#btnCreateTable");
const btnCreateRows = document.querySelector("#addRow");
const btnCreateColumn = document.querySelector("#addColumn");

const btnSubmitCrTable = document.querySelector('#submit');

const formInput = document.querySelector("#form-input");

const titleTable = document.querySelector('#titleTable');
const columnTotal = document.querySelector('#columnTotal');
const rowTotal = document.querySelector('#rowsTotal');

function crElement(titleTable) { 
    const createTable = document.createElement('table');
    const createThead = document.createElement('thead');
    const createTbody = document.createElement('tbody');
    const crInputTitle = document.createElement('input');
    const crButtonSubmit = document.createElement('button');
    const createTr = document.createElement('tr'); 
    const createTd = document.createElement('td');
    const createTh1 = document.createElement('th');
    const createInput1 = document.createElement('input');

    createTable.className = 'table table-bordered table-striped table-hover';
    crButtonSubmit.type = 'submit'
    crButtonSubmit.name = 'submit'
    crButtonSubmit.innerText = 'Submit'
    crButtonSubmit.className = 'btn btn-outline-primary';

    crInputTitle.className = 'form-control border-0 my-2';
    crInputTitle.placeholder = 'Masukan Judul Table';
    crInputTitle.type = 'text';
    crInputTitle.name = `titleTable`;
    crInputTitle.value = `${titleTable}`;
    crInputTitle.required
    crInputTitle.autocomplete = 'off'

    return {
        createTable, createThead, createTbody, crInputTitle, 
        crButtonSubmit, createTr, createTd, createTh1, createInput1
    }
}

function addDataTable(createThead, createTbody, valTitle) {

    for (let row = 1; row <= rowTotal.value; row++) {
        const { createTr, createTd } = crElement(valTitle); 
        createTd.innerText = row;
        createTr.appendChild(createTd);
        console.log(`row ======= : ${row}`);
        
        for (let col = 1; col <= columnTotal.value; col++) {
            console.log(`col : ${col}`);
        
            const {createTh1, createInput1} = crElement(valTitle);

            createInput1.className = 'form-control border-0';
            createInput1.placeholder = 'Masukan Data';
            createInput1.type = 'text';
            createInput1.name = `${row}-${col}`;
            createInput1.autocomplete = 'off'
 
            createTh1.appendChild(createInput1);
            createTr.appendChild(createTh1);
        }
        if (row === 1) createThead.appendChild(createTr);
        else createTbody.appendChild(createTr);
    }
}

function updateDataTable(createThead, createTbody, data, valTitle) {

    const cols = data[0].length;
    const rows = data[1].length;

    for (let row = 0; row <= rows - 1; row++) {
        const { createTr, createTd } = crElement(valTitle); 
        createTd.innerText = (row === 0)? 'No': row;
        createTr.appendChild(createTd);
        // console.log(`row ======= : ${row}`);
        
        if (row === 0) {
            data[0].forEach((element, key) => {
                // col
                // console.log(`col : ${col}`);
                
                const {createTh1, createInput1} = crElement(valTitle);
                
                createInput1.className = 'form-control border-0';
                createInput1.placeholder = 'Masukan Data';
                createInput1.type = 'text';
                createInput1.name = `${row}-${key}`;
                createInput1.autocomplete = 'off';
                createInput1.value = element;
                
                createTh1.appendChild(createInput1);
                createTr.appendChild(createTh1);
    
            })
        } else {
            console.log('============= TRY ===================');
            console.log(row);
            data[1][row].forEach((element, key) => {
                // row
    
                const {createTh1, createInput1} = crElement(valTitle);
                
                createInput1.className = 'form-control border-0';
                createInput1.placeholder = 'Masukan Data';
                createInput1.type = 'text';
                createInput1.name = `${row}-${key}`;
                createInput1.autocomplete = 'off';
                createInput1.value = element;
                
                createTh1.appendChild(createInput1);
                createTr.appendChild(createTh1);
            });
        }

        if (row === 0) createThead.appendChild(createTr);
        else createTbody.appendChild(createTr);
    }

    
}

function crTable(updateData, tableName){
    const valTitle = titleTable.value;

    const { createTable, 
        createThead, 
        createTbody, 
        crInputTitle, 
        crButtonSubmit 
    } = crElement((valTitle == '')? tableName : valTitle);
    
    if (updateData) {
        updateDataTable(createThead, createTbody, updateData, tableName);

    } else {
        addDataTable(createThead, createTbody, valTitle);
    }
 
    createTable.appendChild(createThead);
    createTable.appendChild(createTbody);
    formInput.appendChild(crInputTitle);
    formInput.appendChild(createTable);
    formInput.appendChild(crButtonSubmit);
}

btnSubmitCrTable.addEventListener('click', (e) => {
    e.preventDefault();
    btnCreateColumn.removeAttribute("disabled");
    btnCreateRows.removeAttribute("disabled");

    console.log('ter click modal');
    crTable();
})