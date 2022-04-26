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
    crInputTitle.value = titleTable
    crInputTitle.required
    crInputTitle.autocomplete = 'off'

    return {
        createTable, createThead, createTbody, crInputTitle, 
        crButtonSubmit, createTr, createTd, createTh1, createInput1
    }
}

function crTable(){
    const valColumnTotal = columnTotal.value;
    const valRowTotal = rowTotal.value;
    const valTitle = titleTable.value;
    console.log(valColumnTotal);
    console.log(valRowTotal);

    const { createTable, 
        createThead, 
        createTbody, 
        crInputTitle, 
        crButtonSubmit 
    } = crElement(valTitle);
    
    for (let row = 1; row <= valRowTotal; row++) {
        const { createTr, createTd } = crElement(valTitle); 
        createTd.innerText = row;
        createTr.appendChild(createTd);
        console.log(`row ======= : ${row}`);
        
        for (let col = 1; col <= valColumnTotal; col++) {
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