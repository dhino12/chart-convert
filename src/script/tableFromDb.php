<?php 
include './functions.php';

$dataTables = query("SHOW TABLES;", false);
$dataValue = [];
$dataField = [];
$dataTmpTables = [];

foreach($dataTables as $key => $data) {
    $dataTmpTables[] = $data; // title table
    $dataValue[] = query("SELECT * FROM `$data`;", false); // value
    
    $dataField[] = query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = Database() AND TABLE_NAME = '$data';", false); // column
}
// print_r($dataValue);
?>
<script>
    // import { crTable } from "./table/createTable";


const formInput = document.querySelector("#form-input");

const titleTable = document.querySelector('#titleTable');
const columnTotal = [4, 3, 2];
const rowTotal = 4;

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

    return {
        createTable, createThead, createTbody, crInputTitle, 
        crButtonSubmit, createTr, createTd, createTh1, createInput1
    }
}

function crTable(){
    const valColumnTotal = columnTotal;
    const valRowTotal = rowTotal;
    const valTitle = titleTable.value;
    console.log(valColumnTotal);
    console.log(valRowTotal);

    const { createTable, 
        createThead, 
        createTbody, 
        crInputTitle, 
        crButtonSubmit 
    } = crElement(valTitle);
    
    for (let row = 0; row <= valRowTotal; row++) {
        const { createTr, createTd } = crElement(valTitle); 
        createTd.innerText = row;
        createTr.appendChild(createTd);
        console.log(`row ======= : ${row}`);
        
        for (let col = 0; col <= valColumnTotal[row]; col++) {
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

crTable();
</script>