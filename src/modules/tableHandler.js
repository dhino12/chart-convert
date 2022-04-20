// import { crTable } from "./table/createTable";

const btnCreateTable = document.querySelector("#btnCreateTable");
const btnCreateRows = document.querySelector("#addRow");
const btnCreateColumn = document.querySelector("#addColumn");

const btnSubmitCrTable = document.querySelector('#submit');

const formInput = document.querySelector("#form-input");

const titleTable = document.querySelector('#titleTable');
const columnTotal = document.querySelector('#columnTotal');
const rowTotal = document.querySelector('#rowsTotal');

function crTable(){
    const valColumnTotal = columnTotal.value;
    const valRowTotal = rowTotal.value;
    const valTitle = titleTable.value;
    console.log(valColumnTotal);
    console.log(valRowTotal);

    const createTable = document.createElement('table');
    createTable.className = 'table table-bordered table-striped table-hover';
    const createThead = document.createElement('thead');
    const createTbody = document.createElement('tbody');
    const crInputTitle = document.createElement('input');        

    for (let row = 1; row <= valRowTotal; row++) {
        const createTr = document.createElement('tr'); 
        console.log(`row ======= : ${row}`);
        
        for (let col = 1; col <= valColumnTotal; col++) {
            console.log(`col : ${col}`);
        
            const createTh1 = document.createElement('th');
                
            const createInput1 = document.createElement('input');        
            createInput1.className = 'form-control border-0';
            createInput1.placeholder = 'Masukan Data';
            createInput1.type = 'text';
            createInput1.name = `${row}${col}`;
 
            createTh1.appendChild(createInput1);
            createTr.appendChild(createTh1);
        }
        if (row === 1) createThead.appendChild(createTr);
        else createTbody.appendChild(createTr);
    }
    crInputTitle.className = 'form-control border-0 my-2';
    crInputTitle.placeholder = 'Masukan Data';
    crInputTitle.type = 'text';
    crInputTitle.name = `titleTable`;
    crInputTitle.value = valTitle
 
    createTable.appendChild(createThead);
    createTable.appendChild(createTbody);
    formInput.appendChild(crInputTitle);
    formInput.appendChild(createTable);
}

// btnCreateTable.addEventListener("click", () => {
    //     crTable(formInput);
// });
    
btnSubmitCrTable.addEventListener('click', () => {
    btnCreateColumn.removeAttribute("disabled");
    btnCreateRows.removeAttribute("disabled");

    console.log('ter click modal');
    crTable();
})